<?php
session_start();
require '../model/dto/carrinhoDTO.php';
require '../model/dao/carrinhoDAO.php';
require_once '../model/dao/itemDAO.php';

$itemDAO = new ItemDAO();
$carrinhoDAO = new CarrinhoDAO();

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
    <link rel="stylesheet" href="../css/styleItens.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <link rel="apple-touch-icon" sizes="180x180" href="favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon_io/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <title>Cine Community</title>

</head>

<body>
    <header class="header">
        <a href="../index.php" class="logo"><img src="../assets/logoinicio.png" alt="index.php"></a>
        <nav class="navbar">
        <?php
            if (!empty($usuarioLogado)) {
                if($id_perfil == 3){
                    echo' <a href="cadastrar_item.php"><i class="fa-solid fa-pen-to-square"></i>Cadastrar Item</a>';
                    echo' <a href="./dashboard/painel_colecionador.php"><i class="fa-solid fa-user"></i>PAINEL COLECIONADOR</a>';
                    echo '<a class="border1" href="../control/control_sair.php" class="item_menu"><i class="fa-solid fa-right-from-bracket"></i>SAIR</a>';
                }elseif ($id_perfil == 4) {
                    echo '<a href="meus_pedidos.php"><i class="fa-solid fa-bags-shopping"></i>Meus Pedidos</a>';
                    echo '<a href="todos_itens.php"><i class="fa-brands fa-product-hunt"></i>Itens</a>';
                    $carrinhoData = $carrinhoDAO->countItemCarrinho($id_usuarioLogado);
                    if (isset($carrinhoData['total_itens']) && isset($carrinhoData['carrinho_itens'])) {
                        $total_itens = $carrinhoData['total_itens'];
                        $carrinho_itens = $carrinhoData['carrinho_itens'];
                        if (!empty($carrinho_itens)) {
                            echo '<a href="carrinho.php"><i class="fa-solid fa-cart-plus"></i>Carrinho<span>' . $total_itens . '</span></a>';
                        } else {
                            echo '<a href="carrinho.php"><i class="fa-solid fa-cart-plus"></i>Carrinho<span>0</span></a>';
                        }
                    } else {
                        echo '<a href="carrinho.php"><i class="fa-solid fa-cart-plus"></i>Carrinho<span>0</span></a>';
                    }
                }elseif($id_perfil == 3 || $id_perfil == 4){
                echo '<a href="../index.php"><i class="fa-solid fa-house"></i>INICIO</a>';
                    echo '<a href="todos_itens.php">Itens</a>';
                    echo'<a href="alterar_usuario.php?id_usuario=<?= $id_usuarioLogado; ?>" onclick="funcPerfil()"><i
                    class="fa-solid fa-user"></i>'.$usuarioLogado.'</a>';
                } 
            }else {
                echo '<a href="cadastro.php"><i class="fa-solid fa-user"></i>CADASTRO</a>';
                echo '<a href="login.php"><i class="fa-solid fa-user"></i>LOGIN</a>';
            }
            ?>
            <!-- Resto do conteúdo -->
        </nav>
    </header>
    <h1>Itens</h1>
    <div class="container-item">
        <div class="container-galeria">
            <?php
            $item = $itemDAO->listarTodosItens();
            $categorias = array();
            // Obter todas as categorias dos itens
            foreach ($item as $itemFetch) {
                $categoria = $itemFetch['categoria_item'];
                if (!in_array($categoria, $categorias)) {
                    $categorias[] = $categoria;
                }
            }

            // Exibir os itens agrupados por categoria
            foreach ($categorias as $categoria) {
            ?>
            <div class="categoria">
                <h2><?= $categoria ?></h2>
                <div class="item-carousel">
                    <?php foreach ($item as $itemFetch) {
                        if ($itemFetch['categoria_item'] === $categoria) {
                    ?>
                    <div class="item-conteudo">
                        <img src="../assets/imagensprodutos/<?= $itemFetch['imagem_item'] ?>">
                        <h2><?= $itemFetch['nome_item'] ?></h2><br>
                        <p><i class="fas fa-brazilian-real-sign"></i> <?= $itemFetch['preco_item'] ?></p><br><br>
                        <a class="detalhesbotao" href="detalhe_item.php?id_item=<?=$itemFetch['id_item']?>">Detalhes</a>
                    </div>
                    <?php
                        }
                    } ?>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
    <hr>
    <footer>
        <center>
            <h3>O lugar perfeito para os amantes do cinema!</h3>
        </center>
        <center>
            <h5>Nos siga!</h5>
        </center>

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

    <script src="../js/carrossel_itens.js"></script>
    <!-- Inclua o arquivo JavaScript do jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Inclua o arquivo JavaScript do Slick Carousel -->
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel/slick/slick.min.js"></script>
</body>

</html>