<?php

namespace App;

use MF\Init\Bootstrap;

class Route extends Bootstrap {

	protected function initRoutes() {

		$routes['home'] = array(
			'route' => '/',
			'controller' => 'indexController',
			'action' => 'index'
		);

		
		$routes['entregaBuscar'] = array(
			'route' => '/entregaBuscar',
			'controller' => 'indexController',
			'action' => 'entregaBuscar'
		);

		$routes['adicionarPedido'] = array(
			'route' => '/adicionarPedido',
			'controller' => 'indexController',
			'action' => 'adicionarPedido'
		);
		
		$routes['inscreverse'] = array(
			'route' => '/inscreverse',
			'controller' => 'indexController',
			'action' => 'inscreverse'
		);

		$routes['registrar'] = array(
			'route' => '/registrar',
			'controller' => 'indexController',
			'action' => 'registrar'
		);

		$routes['autenticar'] = array(
			'route' => '/autenticar',
			'controller' => 'AuthController',
			'action' => 'autenticar'
		);

		$routes['sair'] = array(
			'route' => '/sair',
			'controller' => 'AuthController',
			'action' => 'sair'
		);

		$routes['finalizarPedido'] = array(
			'route' => '/finalizarPedido',
			'controller' => 'AppController',
			'action' => 'finalizarPedido'
		);

		$routes['paginaPagamento'] = array(
			'route' => '/paginaPagamento',
			'controller' => 'AppController',
			'action' => 'paginaPagamento'
		);

		$routes['finalizarCompra'] = array(
			'route' => '/finalizarCompra',
			'controller' => 'PizzariaController',
			'action' => 'finalizarCompra'
		);

		$routes['sucessoCompra'] = array(
			'route' => '/sucessoCompra',
			'controller' => 'AppController',
			'action' => 'sucessoCompra'
		);

		
		$routes['cardapio'] = array(
			'route' => '/cardapio',
			'controller' => 'AppController',
			'action' => 'cardapio'
		);

		$routes['pizzas'] = array(
			'route' => '/pizzas',
			'controller' => 'AppController',
			'action' => 'pizzas'
		);
		$routes['bebidas'] = array(
			'route' => '/bebidas',
			'controller' => 'AppController',
			'action' => 'bebidas'
		);
		$routes['sobremesas'] = array(
			'route' => '/sobremesas',
			'controller' => 'AppController',
			'action' => 'sobremesas'
		);

		$routes['addNoCarrinho'] = array(
			'route' => '/addNoCarrinho',
			'controller' => 'PizzariaController',
			'action' => 'addNoCarrinho'
		);

		$routes['webCart'] = array(
			'route' => '/webCart',
			'controller' => 'PizzariaController',
			'action' => 'webCart'
		);

		$routes['order'] = array(
			'route' => '/order',
			'controller' => 'AppController',
			'action' => 'order'
		);
		$routes['cart'] = array(
			'route' => '/cart',
			'controller' => 'PizzariaController',
			'action' => 'cart'
		);
		$routes['add'] = array(
			'route' => '/add',
			'controller' => 'PizzariaController',
			'action' => 'add'
		);
		$routes['remove'] = array(
			'route' => '/remove',
			'controller' => 'PizzariaController',
			'action' => 'remove'
		);

		$routes['clear'] = array(
			'route' => '/clear',
			'controller' => 'PizzariaController',
			'action' => 'clear'
		);

		$routes['administrador'] = array(
			'route' => '/administrador',
			'controller' => 'AppController',
			'action' => 'administrador'
		);

		$routes['gerenciarCardapio'] = array(
			'route' => '/gerenciarCardapio',
			'controller' => 'AppController',
			'action' => 'gerenciarCardapio'
		);
		$routes['gerenciarPedidos'] = array(
			'route' => '/gerenciarPedidos',
			'controller' => 'AppController',
			'action' => 'gerenciarPedidos'
		);

		$routes['adicionarProdutos'] = array(
			'route' => '/adicionarProdutos',
			'controller' => 'AppController',
			'action' => 'adicionarProdutos'
		);

		$routes['removerProdutos'] = array(
			'route' => '/removerProdutos',
			'controller' => 'AppController',
			'action' => 'removerProdutos'
		);

		$routes['removerProdutoPizza'] = array(
			'route' => '/removerProdutoPizza',
			'controller' => 'AppController',
			'action' => 'removerProdutoPizza'
		);
		$routes['removerProdutoBebida'] = array(
			'route' => '/removerProdutoBebida',
			'controller' => 'AppController',
			'action' => 'removerProdutoBebida'
		);
		$routes['removerProdutoSobremesa'] = array(
			'route' => '/removerProdutoSobremesa',
			'controller' => 'AppController',
			'action' => 'removerProdutoSobremesa'
		);

		$routes['removeProdutoBanco'] = array(
			'route' => '/removeProdutoBanco',
			'controller' => 'PizzariaController',
			'action' => 'removeProdutoBanco'
		);

		$routes['atualizarProdutos'] = array(
			'route' => '/atualizarProdutos',
			'controller' => 'AppController',
			'action' => 'atualizarProdutos'
		);

		$routes['atualizarProdutoPizza'] = array(
			'route' => '/atualizarProdutoPizza',
			'controller' => 'AppController',
			'action' => 'atualizarProdutoPizza'
		);
		$routes['atualizarProdutoBebida'] = array(
			'route' => '/atualizarProdutoBebida',
			'controller' => 'AppController',
			'action' => 'atualizarProdutoBebida'
		);
		$routes['atualizarProdutoSobremesa'] = array(
			'route' => '/atualizarProdutoSobremesa',
			'controller' => 'AppController',
			'action' => 'atualizarProdutoSobremesa'
		);

		$routes['atualizaProdutoBanco'] = array(
			'route' => '/atualizaProdutoBanco',
			'controller' => 'PizzariaController',
			'action' => 'atualizaProdutoBanco'
		);
		

		$routes['validaAutenticacao'] = array(
			'route' => '/validaAutenticacao',
			'controller' => 'PizzariaController',
			'action' => 'validaAutenticacao'
		);

		$routes['adicionarProdutoBanco'] = array(
			'route' => '/adicionarProdutoBanco',
			'controller' => 'PizzariaController',
			'action' => 'adicionarProdutoBanco'
		);

		$routes['acompanhar'] = array(
			'route' => '/acompanhar',
			'controller' => 'AppController',
			'action' => 'acompanhar'
		);

		$routes['pedidosAbertos'] = array(
			'route' => '/pedidosAbertos',
			'controller' => 'AppController',
			'action' => 'pedidosAbertos'
		);

		$routes['pedidosFechados'] = array(
			'route' => '/pedidosFechados',
			'controller' => 'AppController',
			'action' => 'pedidosFechados'
		);

		$routes['fecharPedido'] = array(
			'route' => '/fecharPedido',
			'controller' => 'PizzariaController',
			'action' => 'fecharPedido'
		);

		$routes['excluirPedido'] = array(
			'route' => '/excluirPedido',
			'controller' => 'PizzariaController',
			'action' => 'excluirPedido'
		);
		$routes['gerenciarUsuarios'] = array(
			'route' => '/gerenciarUsuarios',
			'controller' => 'AppController',
			'action' => 'gerenciarUsuarios'
		);

		$routes['adicionarUsuario'] = array(
			'route' => '/adicionarUsuario',
			'controller' => 'AppController',
			'action' => 'adicionarUsuario'
		);

		$routes['addUsuario'] = array(
			'route' => '/addUsuario',
			'controller' => 'AppController',
			'action' => 'addUsuario'
		);

		$routes['removerUsuario'] = array(
			'route' => '/removerUsuario',
			'controller' => 'AppController',
			'action' => 'removerUsuario'
		);

		$routes['removerUsuarioBanco'] = array(
			'route' => '/removerUsuarioBanco',
			'controller' => 'PizzariaController',
			'action' => 'removerUsuarioBanco'
		);
		
		
		$routes['atualizarUsuario'] = array(
			'route' => '/atualizarUsuario',
			'controller' => 'AppController',
			'action' => 'atualizarUsuario'
		);

		$routes['atualizarUsuarioBanco'] = array(
			'route' => '/atualizarUsuarioBanco',
			'controller' => 'AppController',
			'action' => 'atualizarUsuarioBanco'
		);

		$routes['gerenciarEstoque'] = array(
			'route' => '/gerenciarEstoque',
			'controller' => 'AppController',
			'action' => 'gerenciarEstoque'
		);


		$routes['carrinho'] = array(
			'route' => '/carrinho',
			'controller' => 'AppController',
			'action' => 'carrinho'
		);



		$this->setRoutes($routes);
	}

}

?>