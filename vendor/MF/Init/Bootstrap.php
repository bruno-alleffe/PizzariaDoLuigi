<?php

namespace MF\Init;

abstract class Bootstrap {
	private $routes;

	abstract protected function initRoutes(); 

	public function __construct() {
		$this->initRoutes();
		$this->run($this->getUrl());
	}

	public function getRoutes() {
		return $this->routes;
	}

	public function setRoutes(array $routes) {
		$this->routes = $routes;
	}

	protected function run($url) {
		foreach ($this->getRoutes() as $key => $route) {
			
			// para a rota /contact/2
            $urlWithoutBar = ltrim($url,'/'); // retira a barra da esquerda da URL
            //isto explode uma string, ou seja, cria um array de acordo com o delimitador
            $routeParts = explode('/',$urlWithoutBar);  // [0] => contact, [1] => 2
            if("/{$routeParts[0]}" == $route['route']){ //verifica se são iguais
                $class = "App\\Controllers\\".ucfirst($route['controller']);
                $controller = new $class;
                $action = $route['action'];
                if(isset($routeParts[1])){
                   $controller->$action($routeParts[1]); //passa o parâmetro
                }else{
                    $controller->$action(); //passa o parâmetro
                }
            }
			// if($url == $route['route']) {
			// 	$class = "App\\Controllers\\".ucfirst($route['controller']);

			// 	$controller = new $class;
				
			// 	$action = $route['action'];

			// 	$controller->$action();
			// }
		}
	}

	protected function getUrl() {
		return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
	}
}

?>