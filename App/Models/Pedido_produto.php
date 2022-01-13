<?php

namespace App\Models;

use MF\Model\Model;

class Pedido_produto extends Model {

	private $id_pedido;
	private $id_produto;
	private $nome;
	private $valor;
	private $quantidade;
	private $total;

	public function __get($atributo) {
		return $this->$atributo;
	}

	public function __set($atributo, $valor) {
		$this->$atributo = $valor;
	}

	//salvar
	public function salvar() {

		$query = "insert into pedidos_produtos(id_pedido, id_produto, nome, valor, quantidade, total)values(:id_pedido, :id_produto, :nome, :valor, :quantidade, :total)";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':id_pedido', $this->__get('id_pedido'));
		$stmt->bindValue(':id_produto', $this->__get('id_produto'));
		$stmt->bindValue(':nome', $this->__get('nome'));
		$stmt->bindValue(':valor', $this->__get('valor'));
		$stmt->bindValue(':quantidade', $this->__get('quantidade'));
		$stmt->bindValue(':total', $this->__get('total'));
		$stmt->execute();

		return $this;
	}

	public function ultimoId() {
		
		$last_id = $this->db->lastInsertId();

		return $last_id;
	}

	public function listarPedidosAbertos() {
		$query = "
			select *	
			from  
				pedidos
			where 
				status = 'aberto'
			";

		$stmt = $this->db->prepare($query);
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function listarBebidas() {
		$query = "
			select *	
			from  
				produtos
			where 
				tipo = 'bebida'
			";

		$stmt = $this->db->prepare($query);
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function listarSobremesas() {
		$query = "
			select *	
			from  
				produtos
			where 
				tipo = 'sobremesa'
			";

		$stmt = $this->db->prepare($query);
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function listarPizzasTamanho() {
		$query = "
			select *	
			from  
				produtos
			where 
				tipo = 'pizza' AND tamanho = :tamanho
			";

		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':tamanho', $this->__get('tamanho'));
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function findById() {
		$query = "
			select *	
			from  
				produtos
			where 
				id_produto = :id_produto
			";

		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':id_produto', $this->__get('id_produto'));
		$stmt->execute();
		$teste = $stmt->fetch(\PDO::FETCH_ASSOC);
		$this->__set("nome", $teste["nome"]);
		$this->__set("valor", $teste["valor"]);
		$this->__set("tamanho", $teste["tamanho"]);
		$this->__set("tipo", $teste["tipo"]);
		$this->__set("img", $teste["img"]);
		//return $stmt->fetch(\PDO::FETCH_ASSOC);
		return $this;
	}

	public function remover() {
		$query = "delete from produtos where id_produto = :id_produto";

		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':id_produto', $this->__get('id_produto'));
		
		$stmt->execute();

		return true;
	}

	public function atualizar() {
		$query = "
			update
				produtos
			set
				nome = :nome, valor = :valor,  tamanho = :tamanho, descricao = :descricao
			where 
				id_produto = :id_produto";

		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':id_produto', $this->__get('id_produto'));
		$stmt->bindValue(':nome', $this->__get('nome'));
		$stmt->bindValue(':valor', $this->__get('valor'));
		$stmt->bindValue(':tamanho', $this->__get('tamanho'));
		$stmt->bindValue(':descricao', $this->__get('descricao'));
		
		$stmt->execute();

		return true;
	}

	public function atualizaImg() {
		$query = "
		update
			produtos
		set
			img = :img
		where 
			id_produto = :id_produto";
		
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':id_produto', $this->__get('id_produto'));
		$stmt->bindValue(':img', $this->__get('img'));

		$stmt->execute();

		return true;
	}

	//validar se um cadastro pode ser feito
	public function validarCadastro() {
		$valido = true;

		if(strlen($this->__get('nome')) < 3) {
			$valido = false;
		}

		if(strlen($this->__get('email')) < 3) {
			$valido = false;
		}

		if(strlen($this->__get('senha')) < 3) {
			$valido = false;
		}


		return $valido;
	}

	//recuperar um usuário por e-mail
	public function getUsuarioPorEmail() {
		$query = "select nome, email from usuarios where email = :email";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':email', $this->__get('email'));
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function autenticar() {

		$query = "select id_usuario, nome, email, tipo from usuarios where email = :email and senha = :senha";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':email', $this->__get('email'));
		$stmt->bindValue(':senha', $this->__get('senha'));
		$stmt->execute();

		$usuario = $stmt->fetch(\PDO::FETCH_ASSOC);
		

		if($usuario['id_usuario'] != '' && $usuario['nome'] != '') {
			$this->__set('id_usuario', $usuario['id_usuario']);
			$this->__set('nome', $usuario['nome']);
			$this->__set('tipo', $usuario['tipo']);
		}

		

		return $this;
	}

	public function getAll() {
		$query = "
			select 
				u.id, 
				u.nome, 
				u.email,
				(
					select
						count(*)
					from
						usuarios_seguidores as us 
					where
						us.id_usuario = :id_usuario and us.id_usuario_seguindo = u.id
				) as seguindo_sn
			from  
				usuarios as u
			where 
				u.nome like :nome and u.id != :id_usuario
			";

		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':nome', '%'.$this->__get('nome').'%');
		$stmt->bindValue(':id_usuario', $this->__get('id_usuario'));
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function seguirUsuario($id_usuario_seguindo) {
		$query = "insert into usuarios_seguidores(id_usuario, id_usuario_seguindo)values(:id_usuario, :id_usuario_seguindo)";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':id_usuario', $this->__get('id'));
		$stmt->bindValue(':id_usuario_seguindo', $id_usuario_seguindo);
		$stmt->execute();

		return true;
	}

	public function deixarSeguirUsuario($id_usuario_seguindo) {
		$query = "delete from usuarios_seguidores where id_usuario = :id_usuario and id_usuario_seguindo = :id_usuario_seguindo";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':id_usuario', $this->__get('id'));
		$stmt->bindValue(':id_usuario_seguindo', $id_usuario_seguindo);
		$stmt->execute();

		return true;
	}

	//Informações do Usuário
	public function getInfoUsuario() {
		$query = "select nome from usuarios where id = :id_usuario";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':id_usuario', $this->__get('id'));
		$stmt->execute();

		return $stmt->fetch(\PDO::FETCH_ASSOC);
	}

	//Total de tweets
	public function getTotalTweets() {
		$query = "select count(*) as total_tweet from tweets where id_usuario = :id_usuario";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':id_usuario', $this->__get('id'));
		$stmt->execute();

		return $stmt->fetch(\PDO::FETCH_ASSOC);
	}

	//Total de usuários que estamos seguindo
	public function getTotalSeguindo() {
		$query = "select count(*) as total_seguindo from usuarios_seguidores where id_usuario = :id_usuario";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':id_usuario', $this->__get('id'));
		$stmt->execute();

		return $stmt->fetch(\PDO::FETCH_ASSOC);
	}

	//Total de seguidores
	public function getTotalSeguidores() {
		$query = "select count(*) as total_seguidores from usuarios_seguidores where id_usuario_seguindo = :id_usuario";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':id_usuario', $this->__get('id'));
		$stmt->execute();

		return $stmt->fetch(\PDO::FETCH_ASSOC);
	}
}

?>