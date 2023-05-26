<?php
session_start();
require_once '../model/dto/carrinhoDTO.php';
require_once '../model/dao/carrinhoDAO.php';
require_once '../model/dao/itemDAO.php';

$itemDAO = new ItemDAO();
$carrinhoDAO = new CarrinhoDAO();

if(isset($_SESSION["id_usuario"])) {
    $usuarioLogado = $_SESSION["nickname_usu"];
    $id_usuarioLogado = $_SESSION["id_usuario"];
    $id_perfil =  $_SESSION["fk_id_perfil"];
    //exit;  
} else {
    $usuarioLogado = "";
} 
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Carrinho de Compra</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
   <link rel="stylesheet" href="css">
</head>
<body>
    <header>
        <section>
            <a href="#">Logo</a>
            <nav>
                <a href="cadastrar_item.php">Cadastrar Item</a>
                <a href="./todos_itens.php">Itens</a>
                <a href="pedidos.php">Meus Pedidos</a>
                <a href="./view/alterar_usuario.php?id_usuario=<?= $id_usuarioLogado;?>" onclick="funcPerfil()"><i class="fa-solid fa-user"></i><?=$_SESSION["nickname_usu"];?></a>
                <?php 
                    $carrinho = $carrinhoDAO->countItemCarrinho($id_usuarioLogado);
                    $total_itens = $carrinho['total_itens'];
                    $carrinhoItens = $carrinho['carrinho_itens'];

                    foreach ($carrinhoItens as $carrinhoItem) {                   
                ?>
                <a href="carrinho.php">Carrinho<span><?=$total_itens;?></span></a>
                <?php } ?>

            </nav>
        </section>
    </header>

    <section>
        <h1>Carrinho de Compra</h1>
        <div>
        <?php 
            $total_itens = 0;
            $carItens = $carrinhoDAO->obterItemCarPorUsuarioID($id_usuarioLogado);
                echo'<pre>';
                print_r($carItens);
                echo'</pre>';
            if (!empty($carItens)) {
                foreach ($carItens as $carrinhoFetch) {
                    $itemFetch = $itemDAO->obterItemCarPorId($carrinhoFetch->getFk_id_item());

                    if ($itemFetch) {
                echo'<pre>';
                var_dump($itemFetch);
                echo'</pre>';
        ?>
            <form action="" method="POST">
                <input type="hidden" name="id_carrinho" value="<?=$carrinhoFetch->getId_carrinho()?>">
                <img src="../assets/project_assets/<?=$itemFetch['imagem_item']?>">
                <h3><?=$itemFetch['nome_item']?></h3>
                <div>
                    <p class="price"><i class="fas fa-indian-rupee-sign"></i><?=$itemFetch['preco_item']?></p>
                    <input type="number" name="qtd_item" required min="1" value="1" max="99" maxlength="2">
                    <input type="submit" name="atualizar_car" class="fas fa-edit">
                </div>
                <p>Subtotal: <span><i class="fas fa-indian-rupee-sign"></i> <?= $sub_total = ($carrinhoFetch->getQtd_compra() * $itemFetch['preco_item']); ?></span></p>
                <input type="submit" value="Delet" name="deletar_item" onclick="return confirm('Quer deletar este item?');">
            </form>
            <?php
                $total_itens += $sub_total;
                } else {
                    echo '<p>Item não encontrado</p>';
                }
            }
        } else {
            echo '<p>Seu carrinho está vazio</p>';
        }
        ?>
        </div>

        <?php if ($total_itens != 0) {?>
        <div>
            <p>Total Itens: <span><i class="fas fa-indian-rupee-sign"></i> <?= $total_itens; ?></span></p>
            <form action="" method="POST">
                <input type="submit" value="Esvaziar Carrinho" name="carrinho_vazio" onclick="return confirm('Deseja esvaziar o seu carrinho?');">
            </form>
            <a href="checkout.php" class="btn">Checkout</a>
        </div>
        <?php }?>            
    </section>

    <script src="js/script.js"></script>
</body>
</html>
