<?php
session_start();
require '../model/dto/carrinhoDTO.php';
require '../model/dao/carrinhoDAO.php';

$carrinhoDAO = new CarrinhoDAO();

if(isset($_SESSION["id_usuario"])) {
$usuarioLogado = $_SESSION["nickname_usu"];
$id_usuarioLogado = $_SESSION["id_usuario"];
$id_perfil =  $_SESSION["fk_id_perfil"];
//exit;  
} else {
$usuarioLogado = "";
} 

include '../control/control_carrinho_add.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Itens</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
   <link rel="stylesheet" href="css">
</head>
<body>
    <header>
        <section>
            <a href="#">Logo</a>
            <nav>
                <a href="cadastrar_item.php">Cadastrar Item</a>
                <a href="todos_itens.php">Itens</a>
                <a href="pedidos.php">Meus Pedidos</a>
                <a href="./view/alterar_usuario.php?id_usuario=<?= $id_usuarioLogado;?>" onclick="funcPerfil()"><i class="fa-solid fa-user"></i><?=$_SESSION["nickname_usu"];?></a>
                <?php 
                    $carrinhoData = $carrinhoDAO->countItemCarrinho($id_usuarioLogado);
                    $total_itens = $carrinhoData['total_itens'];
                    $carrinho_itens = $carrinhoData['carrinho_itens'];

                    foreach ($carrinho_itens as $carrinhoItem) {                   
                ?>
                <a href="carrinho.php">Carrinho<span><?=$total_itens;?></span></a>
                <?php } ?>
            </nav>

        </section>
    </header>
    <section>
        <h1>Itens</h1>
        <div>
        <?php 
            require_once '../model/dao/itemDAO.php';
            $itemDAO = new ItemDAO();
            $item = $itemDAO->listarTodosItens();
            $categorias = array();

            foreach($item as $itemFetch){
                $categoria = $itemFetch->getFk_id_categoria_item();
                // echo'<pre>';
                // print_r($itemFetch);
                // echo'</pre>';
                if(!in_array($categoria,$categorias)){
                    $categorias[] = $categoria;
                }
            }

            foreach($categorias as $categoria){
        ?>
            <div class="categoria">
                <h2><?= $categoria ?></h2>
                <div class="categoria-carousel">
            <?php foreach($item as $itemFetch){
                // echo'<pre>';
                // print_r($itemFetch->getImagem_item());
                // echo'</pre>';
                if($itemFetch->getFk_id_categoria_item() === $categoria){?>
                    <form action="../control/control_carrinho_add.php" method="POST">
                        <img src="../assets/project_assets/<?=$itemFetch->getImagem_item()?>">
                        <h3><?=$itemFetch->getNome_item()?></h3>
                        <input type="hidden" name="id_item" value="<?=$itemFetch->getId_item()?>">
                        <div>
                            <p><i class="fas fa-indian-rupee-sign"></i><?=$itemFetch->getPreco_item()?></p>
                            <input type="number" name="qtd_item" required min="1" value="1" max="99" maxlength="2">
                        </div>
                        <input type="submit" name="item_adicionado" value="Adicionar">
                        <a href="transacao.php?get_id=<?=$itemFetch['id']?>">Comprar</a>
                    </form>
                    <?php }
                    }?>
                </div>
            </div>
            <?php }?>            
        </div>
    </section>

<script src="js/script.js"></script>

</body>
</html>
