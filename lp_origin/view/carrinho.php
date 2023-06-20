<?php
session_start();

require_once '../model/dao/carrinhoDAO.php';
require_once '../model/dao/itemDAO.php';
require_once '../model/dao/UsuarioDAO.php';

$itemDAO = new ItemDAO();
$carrinhoDAO = new CarrinhoDAO();
$usuarioDAO = new UsuarioDAO();

if (isset($_SESSION["id_usuario"])) {
    $usuarioLogado = $_SESSION["nickname_usu"];
    $id_usuarioLogado = $_SESSION["id_usuario"];
    $id_perfil = $_SESSION["id_perfil"];
} else {
    $usuarioLogado = "";
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/pedidos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <link rel="apple-touch-icon" sizes="180x180" href="favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon_io/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <title>Cine Community</title>
</head>
<body>
    <header class="header">
        <a href="index.php" class="logo"><img src="../assets/logoinicio.png" alt="index.php"></a>
        <nav class="navbar">
           <a href="./view/alterar_usuario.php?id_usuario=<?= $id_usuarioLogado?>" onclick="funcPerfil()"><i class="fa-solid fa-user"></i><?= $_SESSION["nickname_usu"]; ?></a>
          <a href="../view/todos_itens.php"><i class="fa-solid fa-house"></i>Voltar</a>  
        </nav>
    </header>

    <section class="itens">
        <h1>Carrinho de Compra</h1>
        <div class="pedido-container">
            <?php
            $total_itens = 0;
            $carrinhoData = $carrinhoDAO->obterItemCarPorUsuarioID($id_usuarioLogado);
            if (!empty($carrinhoData)) {
                foreach ($carrinhoData as $carrinhoFetch) {
                    $itemFetch = $itemDAO->obterItemCarPorId($carrinhoFetch->getFk_id_item());
                    if ($itemFetch) {
                        ?>
                        <form action="../control/deleta_atualiza.php" method="POST" class="item-box">
                            <input type="hidden" name="id_carrinho" value="<?= $carrinhoFetch->getId_carrinho() ?>">
                            <input type="hidden" name="dt_hora_car" value="<?= date('d-m-y H:i:s');?>">
                            <img src="../assets/imagensprodutos/<?= $itemFetch->getImagem_item()?>" class="image">
                            <h3 class="name"><?= $itemFetch->getNome_item() ?></h3>
                            <div class="flex">
                                <p class="price"><i class="fas fa-brazilian-real-sign"></i> <?= $carrinhoFetch->getPreco() ?></p>
                                <input type="number" name="qtd_compra" required min="1" value="<?= $carrinhoFetch->getQtd_compra() ?>" max="99" maxlength="2" class="qtd">
                                <button type="submit" name="atualizar_car"class="fas fa-edit"></button>
                            </div>
                            <p class="sub-total">Subtotal: <span><i class="fas fa-brazilian-real-sign"></i> <?= $sub_total = ($carrinhoFetch->getQtd_compra() * $itemFetch->getPreco_item()); ?></span></p>
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

        <?php if ($total_itens != 0) { ?>
            <div class="total">
                <p>Total Itens: <span><i class="fas fa-brazilian-real-sign"></i> <?= $total_itens; ?></span></p>
                <form action="../control/esvaziar_car.php" method="POST">
                    <input type="submit" value="Esvaziar Carrinho" name="carrinho_vazio" onclick="return confirm('Deseja esvaziar o seu carrinho?');">
                </form>
                <button><a href="transacao.php" class="btn">Comprar</a></button>
            </div>
        <?php } ?>
    </section>
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