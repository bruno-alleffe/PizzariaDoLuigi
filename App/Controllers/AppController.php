<?php

namespace App\Controllers;

//os recursos do miniframework
use App\Models\Produto;
use MF\Controller\Action;
use MF\Model\Container;

class AppController extends Action {


	public function cardapio() {
		
		$this->render('cardapio');

	}

	public function finalizarPedido() {

		$this->render('finalizarPedido');
		
		

	}

	public function paginaPagamento() {

		$this->render('paginaPagamento');


	}

	public function sucessoCompra() {
		$this->render('sucessoCompra');
	}

	public function pizzas() {
		
		$pizza = Container::getModel('Produto');
		
		$pizzas = $pizza->listarPizzas();
		
		$this->view->pizzas = $pizzas;

		$this->render('pizzas');
		
	}

	public function bebidas() {
		
		$bebida = Container::getModel('Produto');
		
		$bebidas = $bebida->listarBebidas();
		
		$this->view->bebidas = $bebidas;

		$this->render('bebidas');
		
	}

	public function sobremesas() {
		
		$sobremesa = Container::getModel('Produto');
		
		$sobremesas = $sobremesa->listarSobremesas();
		
		$this->view->sobremesas = $sobremesas;

		$this->render('sobremesas');
		
	}

	public function order(): void {
		//var_dump($_SESSION['cart']);
		session_start();
		print_r($_SESSION);
		echo "<a href='/pizzas'>Voltar</a>";
	}

	public function carrinho() {
		
		
		$this->render('carrinho', 'layout2');
		
		

	}
	
	public function administrador() {
		
		
		$this->validaAutenticacao();
		
		$this->render('administrador');
		
		

	}

	public function gerenciarCardapio() {
		
		
		$this->validaAutenticacao();
		
		$this->render('gerenciarCardapio');

	}

	public function gerenciarPedidos() {
		
		
		$this->validaAutenticacao();
		
		$this->render('gerenciarPedidos');

	}

	public function adicionarProdutos() {

		$this->validaAutenticacao();

		$estoque = Container::getModel('Estoque');
		
		$ingredientes = $estoque->listarIngredientes();
		
		$this->view->ingredientes = $ingredientes;
		
		$this->render('adicionarProdutos');

	}

	public function removerProdutos() {
		
		
		$this->validaAutenticacao();
		
		$this->render('removerProdutos');

	}

	public function removerProdutoPizza() {
		
		$this->validaAutenticacao();
		
		$pizza = Container::getModel('Produto');
		
		$pizzas = $pizza->listarPizzas();
		
		$this->view->pizzas = $pizzas;

		$this->render('removerProdutoPizza');
		
	}
	public function removerProdutoBebida() {
		
		$this->validaAutenticacao();

		$bebida = Container::getModel('Produto');
		
		$bebidas = $bebida->listarBebidas();
		
		$this->view->bebidas = $bebidas;

		$this->render('removerProdutoBebida');
		
	}
	public function removerProdutoSobremesa() {
		
		$this->validaAutenticacao();
		
		$sobremesa = Container::getModel('Produto');
		
		$sobremesas = $sobremesa->listarSobremesas();
		
		$this->view->sobremesas = $sobremesas;

		$this->render('removerProdutoSobremesa');
		
	}

	public function atualizarProdutos() {
		
		$this->validaAutenticacao();

		$this->render('atualizarProdutos');
		
	}

	public function atualizarProdutoPizza() {
		
		$this->validaAutenticacao();
		
		$pizza = Container::getModel('Produto');
		
		$pizzas = $pizza->listarPizzas();
		
		$this->view->pizzas = $pizzas;

		$this->render('atualizarProdutoPizza');
		
	}

	public function atualizarProdutoBebida() {
		
		$this->validaAutenticacao();
		
		$bebida = Container::getModel('Produto');
		
		$bebidas = $bebida->listarBebidas();
		
		$this->view->bebidas = $bebidas;

		$this->render('atualizarProdutoBebida');
		
	}

	public function atualizarProdutoSobremesa() {
		
		$this->validaAutenticacao();
		
		$sobremesa = Container::getModel('Produto');
		
		$sobremesas = $sobremesa->listarSobremesas();
		
		$this->view->sobremesas = $sobremesas;

		$this->render('atualizarProdutoSobremesa');
		
	}

	public function acompanhar() {
		
		$pedido = Container::getModel('Pedido');
		
		$pedidos = $pedido->listarPedidosAbertos();
		$produtos_pedidos = $pedido->listarProdutosPedido();
		
		$this->view->pedidos = $pedidos;

		$this->view->produtos_pedidos = $produtos_pedidos;
		

		$this->render('acompanhar');
		
	}

	public function pedidosAbertos() {
		
		$this->validaAutenticacao();
		
		$pedido = Container::getModel('Pedido');
		
		$pedidos = $pedido->listarPedidosAbertos();
		$produtos_pedidos = $pedido->listarProdutosPedido();
		
		$this->view->pedidos = $pedidos;

		$this->view->produtos_pedidos = $produtos_pedidos;
		

		$this->render('pedidosAbertos');
		
	}

	public function pedidosFechados() {
		
		$this->validaAutenticacao();
		
		$pedido = Container::getModel('Pedido');
		
		$pedidos = $pedido->listarPedidosFechados();
		$produtos_pedidos = $pedido->listarProdutosPedidoFechados();
		
		$this->view->pedidos = $pedidos;

		$this->view->produtos_pedidos = $produtos_pedidos;
		
		
	
		

		$this->render('pedidosFechados');
		
	}

	public function gerenciarUsuarios() {
		
		$this->validaAutenticacao();
		

		$this->render('gerenciarUsuarios');
		
	}

	public function adicionarUsuario() {
		
		$this->validaAutenticacao();

		$this->view->erroCadastro = false;
		

		$this->render('adicionarUsuario');
		
	}


	public function addUsuario() {
		$this->view->login = isset($_GET['login']) ? $_GET['login'] : '';
		$usuario = Container::getModel('Usuario');

		if (isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['senha'])) {
			$usuario->__set('nome', $_POST['nome']);
			$usuario->__set('email', $_POST['email']);
			$usuario->__set('senha', md5($_POST['senha']));
			$usuario->__set('tipo', $_POST['tipo']);

		}
		
		
		if($usuario->validarCadastro() && count($usuario->getUsuarioPorEmail()) == 0) {
		
				$usuario->salvar2();

				header("location: /adicionarUsuario?usuario=adicionado");
			

		} else {

			if (isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['senha'])) {
				$this->view->usuario = array(
					'nome' => $_POST['nome'],
					'email' => $_POST['email'],
					'senha' => $_POST['senha'],
					
				);
			} else {
			  	$this->view->usuario = array(
					'nome' => '',
					'email' => '',
					'senha' => '',
				);
			}
			

			$this->view->erroCadastro = true;

			$this->render('adicionarUsuario');
		}

	}

	public function removerUsuario() {
		
		$this->validaAutenticacao();
		
		$usuario = Container::getModel('Usuario');

		$usuarios = $usuario->getAll2();

		$this->view->usuarios = $usuarios;
		
		
		$this->render('removerUsuario');
		
	}
	public function atualizarUsuario() {
		
		$this->validaAutenticacao();

		
		$usuario = Container::getModel('Usuario');

		$usuarios = $usuario->getAll2();

		$this->view->usuarios = $usuarios;

		
		

		$this->render('atualizarUsuario');
		
	}
	
	public function atualizarUsuarioBanco() {

		echo '<pre>';
		print_r($_POST);
		echo '</pre>';
		
		$this->validaAutenticacao();

		$usuario = Container::getModel('Usuario');

		if (isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['id_usuario']) && isset($_POST['tipo'])) {
			$usuario->__set('id_usuario', $_POST['id_usuario']);
			$usuario->__set('nome', $_POST['nome']);
			$usuario->__set('email', $_POST['email']);
			$usuario->__set('tipo', $_POST['tipo']);

		}

		$id = $_POST['id_usuario'];
		
		
		if(count($usuario->getUsuarioPorEmail2()) == 0) {

			if (isset($_POST['senha']) && $_POST['senha'] != '' ) {
				$usuario->__set('senha', md5($_POST['senha']));
				$usuario->update();
	
			} else {
				$usuario->update2();
			}

			header("Location: /atualizarUsuario?id={$id}&error=false");
		} else {
			
			$this->view->erroCadastro = true;

			header("Location: /atualizarUsuario?id={$id}&error=true");
		}
	}

	public function gerenciarEstoque() {
		
		$this->validaAutenticacao();
		
		$estoque = Container::getModel('Estoque');
		
		$lista_estoque = $estoque->listarEstoque();
		
		$this->view->lista_estoque = $lista_estoque;

	
		$this->render('gerenciarEstoque');
		
	}
	


	public function validaAutenticacao() {

		session_start();
		error_reporting(E_ALL ^ E_NOTICE);

		if(!isset($_SESSION['id_usuario']) || $_SESSION['id_usuario'] == '' || !isset($_SESSION['nome']) || $_SESSION['nome'] == '' || $_SESSION['tipo'] != 'administrador' ) {
			header('Location: /');
		}	

	}

}

?>