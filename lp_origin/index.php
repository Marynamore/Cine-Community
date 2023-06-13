<?php
session_start();


if (isset($_SESSION["id_usuario"])) {
    $usuarioLogado = $_SESSION["nickname_usu"];
    $id_usuarioLogado = $_SESSION["id_usuario"];
    $id_perfil = $_SESSION["id_perfil"];
} else {
    $usuarioLogado = "";
}



if (isset($_POST['nome_filme'])) {
    $nome_filme = $_POST['nome_filme'];
    $lista = [];

    $stmt = $pdo->prepare("SELECT * FROM filme WHERE nome_filme = :nome_filme");
    $stmt->bindValue(':nome_filme', $nome_filme);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $lista = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $stmt = $pdo->prepare("SELECT * FROM filme WHERE nome_filme LIKE :nome_filme");
        $stmt->bindValue(':nome_filme', '%' . $nome_filme . '%');
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $lista = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <link rel="apple-touch-icon" sizes="180x180" href="favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon_io/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <title>Cine Community</title>
</head>

<body>
    <div id="container">
        <header class="header">
            <a href="index.php" class="logo"><img src="assets/logoinicio.png" alt="index.php"></a>
            <nav class="navbar">
                <form action="./control/control_pesquisa.php" method="post">
                    <div class="search-box">
                        <input type="search" class="search-text" placeholder="Pesquisar..." id="pesquisar">
                        <a class="search-btn">
                            <img class="loupe-blue" src="./assets/search.svg" alt="" width="25px" height="25px">
                            <button onclick="searchData()">
                                <svg class="loupe-white" xmlns="http://www.w3.org/2000/svg"  width="30px" height="30px" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                </svg>
                            </button>
                        </a>
                    </div>
                </form>    
            
                <a href="index.php"><i class="fa-solid fa-house"></i>INICIO</a>
                <?php
                if (!empty($usuarioLogado)) {
                    if ($id_perfil == 1) {
                        echo '<a href="./view/dashboard/painel_adm.php"><i class="fa-solid fa-user"></i>Painel Administrador</a>';
                        echo '<a class="border1" href="./control/control_sair.php" class="item_menu"><i class="fa-solid fa-right-from-bracket"></i>SAIR</a>';
                    } elseif ($id_perfil == 2) {
                        echo '<a href="./view/dashboard/painel_moderador.php"><i class="fa-solid fa-users"></i> PAINEL MODERADOR</a>';
                        echo '<a class="border1" href="./control/control_sair.php" class="item_menu"><i class="fa-solid fa-right-from-bracket"></i>SAIR</a>';
                    } elseif ($id_perfil == 3 || $id_perfil == 4) {
                        echo '<a href="./view/perfil_usuario.php?id_usuario=' . $id_usuarioLogado . '" onclick="funcPerfil()"><i class="fa-solid fa-user"></i>' . $usuarioLogado . '</a>';
                        echo '<a class="border1" href="./control/control_sair.php" class="item_menu"><i class="fa-solid fa-right-from-bracket"></i>SAIR</a>';
                    }
                } else {
                    echo '<a href="./view/cadastro.php"><i class="fa-solid fa-user"></i>CADASTRO</a>';
                    echo '<a href="./view/login.php"><i class="fa-solid fa-user"></i>LOGIN</a>';
                }
                ?>
                <!-- Resto do conteúdo -->
    </div>
    </nav>

    </header>
    <section>
        <div class="box">
        <div class="box-image"><img src="./assets/banner/imagemsite.png"></div>
            <div class="box-image"><img src='./assets/banner/Banner loja virtual cosméticos black friday .png'></div>
            <div class="box-image"><img src="./assets/banner/avatar.jpeg"></div>
            <div class="box-image"><img src='./assets/banner/creed3.jpg'></div>
            <div class="box-image"><img src="./assets/banner/Indiana-Jones.jpg"></div>
            <div class="box-image"><img src='./assets/banner/guardians-galaxy.jpg'></div>
            <div class="box-image"><img src='./assets/banner/oppenheimer.jpg'></div>
            <div class="box-image"><img src='./assets/banner/supermario.jpg'></div>
            <div class="box-image"><img src='./assets/banner/velozesefuriososx.png'></div>
        </div>
    </section>
    <div class="container-filme">
        <div class="container-galeria">
            <?php
            require_once './model/dao/filmeDAO.php';
            $FilmeDAO   = new FilmeDAO();
            $filme      = $FilmeDAO->listarTodos();
            $categorias = array();

            // Obter todas as categorias dos filmes
            foreach ($filme as $filmeFetch) {
                $categoria = $filmeFetch['categoria_filme'];
                if (!in_array($categoria, $categorias)) {
                    $categorias[] = $categoria;
                }
            }

            // Exibir os filmes agrupados por categoria
            foreach ($categorias as $categoria) {
            ?>
                <div class="categoria">
                    <h2><?= $categoria ?></h2>
                    <div class="filme-carousel">
                        <?php foreach ($filme as $filmeFetch) {
                            if ($filmeFetch['categoria_filme'] === $categoria) { ?>
                                <div class="filme-item">
                                    <a href="./view/filme_resenha.php?get_id=<?= $filmeFetch['id_filme']; ?>">
                                        <img src="assets/<?= $filmeFetch['capa_filme']; ?>" alt="Capa do filme <?= $filmeFetch['nome_filme']; ?>">
                                    </a>
                                </div>
                        <?php }
                        } ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <br>
    <hr>

    <!-- INICIO TELA COLECIONÁVEIS -->
    <section class="sessaocompras">
        <br>
        <div class="compras">
            <h1>Compre e/ou Venda Itens Colecionáveis</h1><br>
            <p>Encontre os itens mais raros e exclusivos para completar sua coleção. Nosso site oferece uma ampla variedade de itens colecionáveis. Explore a nossa seleção e participe da comunidade de colecionadores!</p>

            <div class="product-list">
                <div class="product-item">
                    <img src="../lp_origin/assets/boneco-coringa.jpg" alt="Produto 1">
                    <div class="title">Produto 1</div>
                    <div class="price">$10.00</div>
                    <div class="description">Descrição do Produto 1</div>
                </div>

                <div class="product-item">
                    <img src="../lp_origin/assets/bonecojason.webp" alt="Produto 2">
                    <div class="title">Produto 2</div>
                    <div class="price">$15.00</div>
                    <div class="description">Descrição do Produto 2</div>
                </div>

                <div class="product-item">
                    <img src="../lp_origin/assets/bonecorambo.webp" alt="Produto 3">
                    <div class="title">Produto 3</div>
                    <div class="price">$20.00</div>
                    <div class="description">Descrição do Produto 3</div>
                </div>

            </div>
        </div>
        <center><a href="../lp_origin/view/todos_itens.php" class="checkout-btn">Explorar Itens</a>
            </div>
        </center>

    </section>

    <!-- FIM TELA COLECIONÁVEIS -->
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
    <script src="./js/search.js"></script>
    <script src="./js/carrossel.js"></script>
    <script src="./js/script.js"></script>
    <!-- Inclua o arquivo JavaScript do jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Inclua o arquivo JavaScript do Slick Carousel -->
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel/slick/slick.min.js"></script>

</body>

</html>