<?php

namespace MF\Controller;

abstract class Action {

	protected $view;

	public function __construct() {
		$this->view = new \stdClass();
	}

	protected function render($view, $layout = 'layout') {
		$this->view->page = $view;

		if(file_exists("../pizzaria/App/Views/".$layout.".phtml")) {
			require_once "../pizzaria/App/Views/".$layout.".phtml";
		} else {
			$this->content();
		}
	}

	protected function content() {
		$classAtual = get_class($this);

		$classAtual = str_replace('App\\Controllers\\', '', $classAtual);

		$classAtual = strtolower(str_replace('Controller', '', $classAtual));

		require_once "../pizzaria/App/Views/".$classAtual."/".$this->view->page.".phtml";
	}

	public function ajaxMessage(string $message, string $type) : string {
		return json_encode(["message" => "<div class=\"message {$type}\">{$message}</div>"]);
	}

}

?>