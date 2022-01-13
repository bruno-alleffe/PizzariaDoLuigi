<?php

namespace App\Controllers;

//os recursos do miniframework
use App\Facades\Cart;
use App\Models\Produto;
use MF\Controller\Action;
use MF\Model\Container;

class PizzariaController extends Action {
	
	private $cart;

	public function __construct() {
		$this->cart = new Cart();
	}
	

	public function webCart() {
		echo '<pre>';
		print_r($this->cart);
		echo '</pre>';
	}

	public function cart(): void {
		
		echo json_encode($this->cart->cart());
		
	}


	public function add($data): void {
		//$id = filter_var($data["id"], FILTER_VALIDATE_INT);

		$id = $data;
		
		$produto = Container::getModel('Produto');
		$produto->__set("id_produto", $id);
		$product = $produto->findById();

		// echo '<pre>';
		// print_r($product);
		// echo '</pre>';

		if (!$id || !$product) {
			echo $this->ajaxMessage("Erro ao adicionar produto", "error");
			return;
		}
		$this->cart->add($product);
		echo json_encode($this->cart->cart());
	}

	public function remove($data): void {
		$id = $data;
		
		$produto = Container::getModel('Produto');
		$produto->__set("id_produto", $id);
		$product = $produto->findById();

		// echo '<pre>';
		// print_r($product);
		// echo '</pre>';

		if (!$id || !$product) {
			echo $this->ajaxMessage("Erro ao remover produto", "error");
			return;
		}

		$this->cart->remove($product);
		echo json_encode($this->cart->cart());
	}

	public function clear():void {
		
		$this->cart->clear();
		
		echo json_encode($this->cart->cart());
	}


	public function SessionPedido () {
		session_start();
		if(!isset($_SESSION['pedido']['tipo']) OR $_SESSION['pedido']['tipo'] == '') {
			header("Location: /cardapio");
		} else {
			header('location: /');
		}
	}

	public function adicionarProdutoBanco() {
		
		$this->validaAutenticacao();
		
		$produto = Container::getModel('Produto');
		

		$nomeImg = $_FILES['img']['name'];
		$nomeTemp = $_FILES['img']['tmp_name'];
		


		$produto->__set('nome', $_POST['nome']);
		$produto->__set('valor', $_POST['valor']);
		$produto->__set('tamanho', $_POST['tamanho']);
		$produto->__set('tipo', $_POST['tipo']);
		$produto->__set('img', $nomeImg);
		$produto->__set('descricao', $_POST['descricao']);
		

		$produto->salvar();

		$id = $produto->ultimoId();

		mkdir("img/imgProdutos/{$id}", 0755);

		session_start();

		if(move_uploaded_file($nomeTemp, "img/imgProdutos/{$id}/{$nomeImg}")) {
			$_SESSION['addProduto'] = 'sucesso';
		} else {
			$_SESSION['addProduto'] = 'erro';
		}

		if($_POST['tipo'] == 'bebida' OR $_POST['tipo'] == 'sobremesa') {
			$estoque = Container::getModel('Estoque');
			
			$estoque->__set('nome', $_POST['nome']);
			$estoque->__set('quantidade', $_POST['quantidade']);
			$estoque->__set('tipo', $_POST['tipo']);
		
			$estoque->salvar();

			$id_estoque = $estoque->ultimoId();

			$produtos_estoque = Container::getModel('Produtos_estoque');
			$produtos_estoque->__set('id_produto', $id);
			$produtos_estoque->__set('id_estoque', $id_estoque);

			$produtos_estoque->salvar();

		}

		if($_POST['tipo'] == 'pizza') {

			$produtos_estoque = Container::getModel('Produtos_estoque');

			if(isset($_POST['ing1'])) {
				$produtos_estoque->__set('id_produto', $id);
				$produtos_estoque->__set('id_estoque', $_POST['ing1']);
				$produtos_estoque->salvar();
			}
			if(isset($_POST['ing2'])) {
				$produtos_estoque->__set('id_produto', $id);
				$produtos_estoque->__set('id_estoque', $_POST['ing2']);
				$produtos_estoque->salvar();
			}
			if(isset($_POST['ing3'])) {
				$produtos_estoque->__set('id_produto', $id);
				$produtos_estoque->__set('id_estoque', $_POST['ing3']);
				$produtos_estoque->salvar();
			}
			if(isset($_POST['ing4'])) {
				$produtos_estoque->__set('id_produto', $id);
				$produtos_estoque->__set('id_estoque', $_POST['ing4']);
				$produtos_estoque->salvar();
			}
			
			

		}

		

		header('Location: /adicionarProdutos?produto=adicionado');
	}

	public function removeProdutoBanco() {
		
		$this->validaAutenticacao();

		$produto = Container::getModel('Produto');
		
		$tipo = $_POST['tipo'];
		$Tipo = ucfirst($tipo);

		$produto->__set('id_produto', $_POST['id_produto']);
		
		echo $_POST['id_produto']. '<br>';
		echo $_POST['tipo']. '<br>';

		$produto->remover();

		$id = $_POST['id_produto'];

		array_map('unlink', glob("img/imgProdutos/{$id}/*.*"));
		rmdir("img/imgProdutos/{$id}");
		

		header("Location: /removerProduto{$Tipo}?produto=removido&tipo={$tipo}");
	}

	public function atualizaProdutoBanco() {
		
		$this->validaAutenticacao();

		$produto = Container::getModel('Produto');

		$tipo = $_POST['tipo'];
		$Tipo = ucfirst($tipo);
		

		$produto->__set('id_produto', $_POST['id_produto']);
		$produto->__set('nome', $_POST['nome']);
		$produto->__set('valor', $_POST['valor']);
		$produto->__set('tamanho', $_POST['tamanho']);
		$produto->__set('descricao', $_POST['descricao']);

		$produto->atualizar();
		

		$nomeImg = $_FILES['img']['name'];
		$nomeTemp = $_FILES['img']['tmp_name'];

		if($nomeImg != '' && $nomeTemp != '') {
			$id = $_POST['id_produto'];
			array_map('unlink', glob("img/imgProdutos/{$id}/*.*"));
			move_uploaded_file($nomeTemp, "img/imgProdutos/{$id}/{$nomeImg}");
			$produto->__set('img', $nomeImg);
			$produto->atualizaImg();
		}

		// $produto->__set('id_produto', $_POST['id_produto']);
		
		// echo $_POST['id_produto']. '<br>';
		// echo $_POST['tipo']. '<br>';

		// $produto->atualizar();

		// $id = $_POST['id_produto'];

		// array_map('unlink', glob("img/imgProdutos/{$id}/*.*"));
		// rmdir("img/imgProdutos/{$id}");
		
		header("Location: /atualizarProduto{$Tipo}?produto=atualizado&tipo={$tipo}");
	}

	public function finalizarCompra() {
		
		session_start();

		if($_SESSION['cart']['amount'] > 0 && $_POST['pagamento'] == 'ok') {	
			$pedido = Container::getModel('Pedido');
			
			// echo '<pre>';
			// print_r($_SESSION);
			// echo '/<pre>';

			if(isset($_SESSION['id_usuario'])) {
				$pedido->__set('id_usuario', $_SESSION['id_usuario']);
			} else {
				$pedido->__set('id_usuario', NULL);
			}

			$pedido->__set('tipo', $_SESSION['pedido']['tipo']);
			$pedido->__set('rua', $_SESSION['pedido']['rua']);
			$pedido->__set('numero', $_SESSION['pedido']['numero']);
			$pedido->__set('bairro', $_SESSION['pedido']['bairro']);
			$pedido->__set('telefone', $_SESSION['pedido']['tel']);
			$pedido->__set('info_adicionais', $_SESSION['pedido']['info']);
			$pedido->__set('total', $_SESSION['cart']['total']);

			$pedido->salvar();

			$id = $pedido->ultimoId();

			$pedido_produto = Container::getModel('Pedido_produto');

			foreach($_SESSION['cart']["items"] as $id_p => $produto) {
				$pedido_produto->__set('id_pedido', $id);
				$pedido_produto->__set('id_produto', $produto['id_produto']);
				$pedido_produto->__set('nome', $produto['nome']);
				$pedido_produto->__set('valor', $produto['valor']);
				$pedido_produto->__set('quantidade', $produto['amount']);
				$pedido_produto->__set('total', $produto['total']);

				$pedido_produto->salvar();
			}
			$_SESSION['cart2'] = [];
			$_SESSION['cart2'] = $_SESSION['cart'];
			$_SESSION['cart'] = [];
			$_SESSION['pedido'] = [];

			$_SESSION['pagamento'] = '';
			header("Location: /sucessoCompra?id=$id");
		} else {
			header("Location: /cardapio");
		}	
		

	}

	public function fecharPedido() {
		
		$this->validaAutenticacao();

		$pedido = Container::getModel('Pedido');

		$pedido->__set('id_pedido', $_POST['id_pedido']);

		$pedido->fechar();

		header("Location: /pedidosAbertos?pedido=fechado");
	}

	public function excluirPedido() {
		
		$this->validaAutenticacao();

		$pedido = Container::getModel('Pedido');

		$pedido->__set('id_pedido', $_POST['id_pedido']);

		$pedido->excluir();

		header("Location: /pedidosAbertos?pedido=excluido");
	}

	public function removerUsuarioBanco() {

		$this->validaAutenticacao();

		$usuario = Container::getModel('Usuario');

		$usuario->__set('id_usuario', $_POST['id_usuario']);

		$usuario->remover();

		header("Location: /removerUsuario?usuario=removido");
		
	}

	

	public function validaAutenticacao() {

		session_start();

		if(!isset($_SESSION['id_usuario']) || $_SESSION['id_usuario'] == '' || !isset($_SESSION['nome']) || $_SESSION['nome'] == '' || $_SESSION['tipo'] != 'administrador' ) {
			header('Location: /');
		}	

	}

}

?>