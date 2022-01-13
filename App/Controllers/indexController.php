<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class IndexController extends Action {

	public function index() {

		$this->view->login = isset($_GET['login']) ? $_GET['login'] : '';
		
		//$_SESSION['autenticar'] = '';


		$this->render('index');

	}

	public function entregaBuscar() {


		$this->render('entregaBuscar');

	}

	public function adicionarPedido() {

		session_start();
		
		
		$_SESSION['pedido']['tipo'] = $_POST['tipo'];
		$_SESSION['pedido']['rua'] = $_POST['rua'];
		$_SESSION['pedido']['numero'] = $_POST['numero'];
		$_SESSION['pedido']['bairro'] = $_POST['bairro'];
		$_SESSION['pedido']['tel'] = $_POST['tel'];
		$_SESSION['pedido']['info'] = $_POST['info'];

		
		echo '<pre>';
		print_r($_SESSION['pedido']);
		echo '</pre>';

		if($_SESSION['pedido']['pagina'] != ''){
			header("Location: /{$_SESSION['pedido']['pagina']}");
		} else {
			header("Location: /cardapio");
		}
	}

	public function inscreverse() {
		
		$this->view->login = isset($_GET['login']) ? $_GET['login'] : '';
		$this->view->usuario = array(
				'nome' => '',
				'email' => '',
				'senha' => '',
			);

		$this->view->erroCadastro = false;

		$this->render('inscreverse');
		
	}

	public function registrar() {
		$this->view->login = isset($_GET['login']) ? $_GET['login'] : '';
		$usuario = Container::getModel('Usuario');

		if (isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['senha'])) {
			$usuario->__set('nome', $_POST['nome']);
			$usuario->__set('email', $_POST['email']);
			$usuario->__set('senha', md5($_POST['senha']));

		}
		
		
		if($usuario->validarCadastro() && count($usuario->getUsuarioPorEmail()) == 0) {
		
				$usuario->salvar();

				$this->render('cadastro');

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

			$this->render('inscreverse');
		}

	}

}


?>