<!-- Modal Carrinho-->
<div id="carrinhoModal" class="modal modalc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div id="contentModalCarrinho" class="modal-dialog" role="document">
    <div id="carrinhoLargura" class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title text-dark" id="exampleModalLabel">Carrinho</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="bg-dark" style="height: 1px; width: 100%;"></div>
  
      <div class="modal-body carrinhoVazio">
        <p class="text-dark font-weight-normal text-center">Seu carrinho está vazio, mas a sua barriga não precisa estar. Adicione seus itens de preferência e volte aqui para finalizar o seu pedido.</p>
      </div>

      <form class="carrinhoVazio" action="cardapio" method="post">
        <button type="submit" class="btn btn-danger btn-block m-auto">COMEÇAR O PEDIDO</button>
      </form>
      <small class="text-danger m-auto pb-3 carrinhoVazio">*Comece clicando aqui</small>
      
     
      <?php foreach($_SESSION['cart']["items"] as $id_p => $produto) { ?>
          
        <div class="container  mt-4 pb-3 imgNomePreco imgNomePreco_<?=$produto['id_produto']?>">
          <div class="row ">
            <div class="col-3 imgp imgp_<?=$produto['id_produto']?>">
              <img src="img/imgProdutos/<?=$produto['id_produto']?>/<?=$produto['img']?>" alt="" width="90" height="80">
            </div>
            <div class="col-9">
              <div class="row">

                <div class="col-12 d-flex">
                  <h6 class="mr-4 text-dark font-weight-bold text-monospace nomep nome_<?=$produto['id_produto']?>"></h6>
                  <h6 class="text-secondary font-weight-bold text-monospace tamp tam_<?=$produto['id_produto']?>"> <?=$produto['tamanho']?>"> <?=$produto['tamanho']?></h6>
                </div>

                <div class="col-12 d-flex">
                  <small class="text-secondary mb-1">Mussarela, calabresa e cebola, oregano.</small>
                  
                </div>
                
                <div class="col-12 precoCarrinho">
                  <div class="row">
                    <div class="col-md-4 mt-2 cval1">
                      <small class="text-dark font-weight-bold mt-4 valp val_<?=$produto['id_produto']?>">R$ <?=number_format($produto['valor'], 2, ',', '')?></small>
                    </div>
                    <div class="col-md-4 mt-2 cval">
                      <small class="text-dark font-weight-bold mt-4 qnt item_<?=$produto['id_produto']?>"></small>
                    </div>
                    <div class="col-md-4 cval2 maisMenos maisMenos_<?=$produto['id_produto']?>">
                      <button data-action="/add/<?=$produto['id_produto']?>" class="btn btn-success">+</button>
                      <button data-action="/remove/<?=$produto['id_produto']?>" class="btn btn-danger">-</button>
                    </div>
                    
                  </div>
                </div>
              </div>
              
            </div>
          </div>
          
        </div>
        
      <?php } ?>
      
      <?php if (count($_SESSION['cart']['items']) > 0) { ?>
        <div class="precoFinalizar">
          <div class="bg-dark mt-3" style="height: 1px; width: 100%;"></div>
          <div class="container mt-2 finalizarPedido">
            <div class="row">
              <div class="col-md-6">
              <h5 class="text-dark font-weight-bold text-monospace mt-4 cart_total"><?=number_format($produto['total'], 2, ',', '')?></h5>
              </div>
              <div class="col-md-6">
                <button onclick="Atualiza2()" class="btn btn-info mt-2">Finalizar Pedido</button>
              </div>
            </div>
          </div>
        </div>
      <?php } ?>
    
       
      
    
     
    </div>
  </div>
</div> 
<!-- Fim Modal Carrinho -->