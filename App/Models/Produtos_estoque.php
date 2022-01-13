<?php

namespace App\Models;

use MF\Model\Model;

class Produtos_estoque extends Model {

	private $id_estoque;
	private $id_produto;

	

	public function __get($atributo) {
		return $this->$atributo;
	}

	public function __set($atributo, $valor) {
		$this->$atributo = $valor;
	}

	//salvar
	public function salvar() {

		$query = "insert into produtos_estoque(id_produto, id_estoque)values(:id_produto, :id_estoque)";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':id_produto', $this->__get('id_produto'));
		$stmt->bindValue(':id_estoque', $this->__get('id_estoque'));
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

	
}

?>