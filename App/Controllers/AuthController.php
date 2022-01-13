<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class AuthController extends Action {


	public function autenticar() {
		
		$usuario = Container::getModel('Usuario');

		$usuario->__set('email', $_POST['email']);
		$usuario->__set('senha', md5($_POST['senha']));
		$this->view->pagina = $_POST['pagina'];
		

		$usuario->autenticar();

		if($usuario->__get('id_usuario') != '' && $usuario->__get('nome') != '') {
			
			session_start();

			$_SESSION['id_usuario'] = $usuario->__get('id_usuario');
			$_SESSION['nome'] = $usuario->__get('nome');
			$_SESSION['tipo'] = $usuario->__get('tipo');
			$this->view->nome = $usuario->__get('nome');
			$_SESSION['login'] = 'logado';
			$_SESSION['autenticar'] = 'sucesso';

			header("Location: {$this->view->pagina}");
			// if ($this->view->pagina == '/') {
			// 	header('Location: /');
			// }

			// if ($this->view->pagina == '/inscreverse') {
			// 	header('Location: /inscreverse');
			// }

			// if ($this->view->pagina == '/cardapio') {
			// 	header('Location: /cardapio');
			// }

			// if ($this->view->pagina == '/pizzas') {
			// 	header('Location: /pizzas');
			// }

		} else {
			//$URL_ATUAL= "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    		//echo $URL_ATUAL;
			//header('Location: /?login=erro');
			//$this->view->login = 'erro';
			//header("Refresh");
			session_start();
			$_SESSION['autenticar'] = 'erro';
			header("Location: {$this->view->pagina}");
			// if ($this->view->pagina == '/') {
			// 	header('Location: /');
			// }

			// if ($this->view->pagina == '/inscreverse') {
			// 	header('Location: /inscreverse');
			// }

			// if ($this->view->pagina == '/cardapio') {
			// 	header('Location: /cardapio');
			// }

			// if ($this->view->pagina == '/pizzas') {
			// 	header('Location: /pizzas');
			// }
		
		}

	}

	public function sair() {
		session_start();
		session_destroy();
		//header('Location: /');
		
		session_start();
		$_SESSION['autenticar'] = '';

		$this->view->pagina = $_POST['pagina'];

		header("Location: {$this->view->pagina}");
		// if ($this->view->pagina == '/') {
		// 	header('Location: /');
		// }

		// if ($this->view->pagina == '/inscreverse') {
		// 	header('Location: /inscreverse');
		// }

		// if ($this->view->pagina == '/cardapio') {
		// 	header('Location: /cardapio');
		// }

		// if ($this->view->pagina == '/pizzas') {
		// 	header('Location: /pizzas');
		// }
	}

}