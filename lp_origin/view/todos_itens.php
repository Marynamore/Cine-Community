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

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <link rel="apple-touch-icon" sizes="180x180" href="favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon_io/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
</head>
<body>
    <header class="header" >
        <a href="index.php" class="logo"><img src="../assets/logoinicio.png" alt="index.php"></a>
        <nav class="navbar" style="-i:1;">
            <a href="#" style="-i:2;"><i class="fa-solid fa-house"></i>INICIO</a>
            <a href="todos_itens.php">Itens</a>
        <?php
            if(!empty($usuarioLogado)){
            echo  '<a href="cadastrar_item.php" onclick="funcFavorito()"><i class="fa-solid fa-users"></i>Cadastrar Item</a>';     
            echo  '<a href="./view/alterar_usuario.php?id_usuario='.$id_usuarioLogado.'" onclick="funcPerfil()"><i class="fa-solid fa-user"></i>'.$usuarioLogado.'</a>';
            echo  '<a class="border1" href="pedidos.php" class="item_menu"><i class="fa-solid fa-right-from-bracket"></i>Meus Pedidos</a>';
            echo  '<a class="border1" href="./control/control_sair.php" class="item_menu"><i class="fa-solid fa-right-from-bracket"></i>SAIR</a>'; 
        ?>
        <?php 
            $carrinho = $carrinhoDAO->countItemCarrinho($id_usuarioLogado);
            $total_itens = $carrinho['total_itens'];
            $carrinhoItens = $carrinho['carrinho_itens'];

            foreach ($carrinhoItens as $carrinhoItem) {                   
        ?>
        <a href="carrinho.php"><i class="fa-solid fa-cart-shopping"></i><span><?=$total_itens;?></span></a>
        <?php } ?>
        <?php                             
            } else {   
                echo  '<a href="./view/cadastro.php" style="-i:3;"><i class="fa-solid fa-user"></i>CADASTRO</a>
            <a href="./view/login.php" style="-i:4;"><i class="fa-solid fa-user"></i>LOGIN</a>';
            } 
        ?>
        </nav>
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
