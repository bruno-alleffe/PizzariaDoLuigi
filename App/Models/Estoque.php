<?php

namespace App\Models;

use MF\Model\Model;

class Estoque extends Model {

	private $id_estoque;
	private $nome;
	private $quantidade;
	private $tipo;
	

	public function __get($atributo) {
		return $this->$atributo;
	}

	public function __set($atributo, $valor) {
		$this->$atributo = $valor;
	}

	//salvar
	public function salvar() {

		$query = "insert into estoque(nome, quantidade, tipo)values(:nome, :quantidade, :tipo)";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':nome', $this->__get('nome'));
		$stmt->bindValue(':quantidade', $this->__get('quantidade'));
		$stmt->bindValue(':tipo', $this->__get('tipo'));
		$stmt->execute();

		return $this;
	}

	

	public function listarIngredientes() {
		$query = "
			select *	
			from  
				estoque
			where 
				tipo = 'ingrediente'
			";

		$stmt = $this->db->prepare($query);
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function ultimoId() {
		
		$last_id = $this->db->lastInsertId();

		return $last_id;
	}

	public function listarEstoque() {
		$query = "
			select 
				*	
			from  
				estoque
			";

		$stmt = $this->db->prepare($query);
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	
}

?>