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
    <title>Cine Community</title>

</head>
<body>
    <header class="header" >
        <a href="index.php" class="logo"><img src="../assets/logoinicio.png" alt="index.php"></a>
        <nav class="navbar">
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
    </header>
    <h1>Itens</h1>
    <div class="container-filme">
        <div class="container-galeria">
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
                <div class="filme-carousel">
            <?php foreach($item as $itemFetch){
                // echo'<pre>';
                // print_r($itemFetch->getImagem_item());
                // echo'</pre>';
                if($itemFetch->getFk_id_categoria_item() === $categoria){?>
                    <div class="filme-item">
                        <form action="../control/control_carrinho_add.php" method="POST">
                            <img src="../assets/imagensprodutos/<?=$itemFetch->getImagem_item()?>">
                            <h3><?=$itemFetch->getNome_item()?></h3>
                            <input type="hidden" name="id_item" value="<?=$itemFetch->getId_item()?>">
                            <div>
                                <p><i class="fas fa-indian-rupee-sign"></i><?=$itemFetch->getPreco_item()?></p>
                                <input type="number" name="qtd_item" required min="1" value="1" max="99" maxlength="2">
                            </div>
                            <input type="submit" name="item_adicionado" value="Adicionar">
                            <a href="transacao.php?get_id=<?=$itemFetch['id']?>">Comprar</a>
                        </form>
                    </div>
                    <?php }
                    }?>
                </div>
            </div>
            <?php }?>            
        </div>
    </div>
<!-- FIM TELA COLECIONÁVEIS -->
<hr>
    <footer>
        <center><h3>O lugar perfeito para os amantes do cinema!</h3></center>
        <center><h5>Nos siga!</h5></center>

        <div class="rodapeinicio">
            <div class="rodapesocial">
                <button class="botaorodape"> <a href="https://www.youtube.com/watch?v=W4VTq0sa9yg" class="social">Instagram<i class="fab fa-instagram"></i></a></button>
                <button class="botaorodape"><a href="https://www.youtube.com/watch?v=Sx86-18V3m8" class="social">Twitter<i class="fab fa-twitter"></i></a></button>
                <button class="botaorodape"><a href="https://www.youtube.com/watch?v=YKdgcYZy1rQ" class="social">Facebook<i class="fab fa-facebook-f"></i></a></button>
            </div>

            <div class="rodapefim">
                <p>Todos os direitos reservados &copy; 2023</p>
            </div>

        </div>
    </footer>
    </div>

   <script src="../js/carrossel.js"></script>
<!-- Inclua o arquivo JavaScript do jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Inclua o arquivo JavaScript do Slick Carousel -->
<script src="https://cdn.jsdelivr.net/npm/slick-carousel/slick/slick.min.js"></script>
</body>
</html>
