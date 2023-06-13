<?php
session_start();
require_once '../model/dto/carrinhoDTO.php';
require_once '../model/dao/carrinhoDAO.php';
require_once '../model/dao/itemDAO.php';
require_once '../model/dao/UsuarioDAO.php';

$itemDAO = new ItemDAO();
$carrinhoDAO = new CarrinhoDAO();
$usuarioDAO = new UsuarioDAO();

if(isset($_SESSION["id_usuario"])) {
    $usuarioLogado = $_SESSION["nickname_usu"];
    $id_usuarioLogado = $_SESSION["id_usuario"];
    $id_perfil =  $_SESSION["id_perfil"];
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
            <a href="./view/alterar_usuario.php?id_usuario=<?= $id_usuarioLogado?>" onclick="funcPerfil()"><i class="fa-solid fa-user"></i><?=$_SESSION["nickname_usu"];?></a>
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
                <img src="../assets/imagensprodutos?=$itemFetch['imagem_item']?>">
                <h3><?=$itemFetch['nome_item']?></h3>
                <div>
                    <p class="price"><i class="fas fa-indian-rupee-sign"></i><?=$itemFetch['preco_item']?></p>
                    <input type="number" name="qtd_item" required min="1" value="1" max="99" maxlength="2">
                    <input type="submit" name="atualizar_car" class="fas fa-edit">
                </div>
                <p>Subtotal: <span><i class="fas fa-indian-rupee-sign"></i> <?= $sub_total = ($carrinhoFetch->getQtd_compra() * $itemFetch['preco_item']); ?></span></p>
                <input type="submit" value="Delete" name="deletar_item" onclick="return confirm('Quer deletar este item?');">
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
