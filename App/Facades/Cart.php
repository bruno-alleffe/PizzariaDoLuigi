<?php

namespace App\Facades;

//os recursos do miniframework

use App\Models\Produto;
use MF\Controller\Action;
use MF\Model\Container;

class Cart extends Action { 

    public function __construct() {
        if(!session_id()) {
            session_start();
        }

        $_SESSION['cart'] = (!empty($_SESSION['cart']) ? $_SESSION['cart'] : []);
    }

    public function cart(): ?array {
        return $_SESSION["cart"];
	}


	public function add(Produto $product): Cart {
        
        $_SESSION["cart"]["total"] = ($_SESSION["cart"]["total"] ?? 0);
        $_SESSION["cart"]["total"] += $product->valor;
       
        $_SESSION["cart"]["amount"] = ( $_SESSION["cart"]["amount"] ?? 0);
        $_SESSION["cart"]["amount"] += 1;
       
        if(empty($_SESSION["cart"]["items"][$product->id_produto])) {
            $_SESSION["cart"]["items"][$product->id_produto] = [
                "id_produto" => $product->id_produto,
                "nome" => $product->nome,
                "valor" => $product->valor,
                "total" => $product->valor,
                "tamanho" => $product->tamanho,
                "tipo" => $product->tipo,
                "img" => $product->img,
                "amount" => 1
            ];
            return $this;
       }


       $_SESSION["cart"]["items"][$product->id_produto]["amount"] += 1;
       $_SESSION["cart"]["items"][$product->id_produto]["total"] += $product->valor;
       return $this;
	}

	public function remove(Produto $product): Cart {
        
        if(!empty($_SESSION["cart"]["items"][$product->id_produto])) {
            $_SESSION["cart"]["total"] -= $product->valor;
            $_SESSION["cart"]["amount"] -= 1;

            if($_SESSION["cart"]["items"][$product->id_produto]["amount"] > 1) {
                $_SESSION["cart"]["items"][$product->id_produto]["amount"] -= 1;
                $_SESSION["cart"]["items"][$product->id_produto]["total"] -= $product->valor;
                return $this;
            }

            unset($_SESSION["cart"]["items"][$product->id_produto]);
            return $this;
        }
        return $this;
	}

	public function clear(): Cart {
        $_SESSION["cart"] = [];
        return $this;
	}

   
}
?>