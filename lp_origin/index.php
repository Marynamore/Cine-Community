<?php
    session_start();

    if (isset($_SESSION["id_usuario"])) {
        $usuarioLogado    = $_SESSION["nickname_usu"];
        $nomeUsuario      = $_SESSION["nome_usu"];
        $id_usuarioLogado = $_SESSION["id_usuario"];
        $id_perfil        = $_SESSION["fk_id_perfil"];
    } else {
        $usuarioLogado = "";
    }
    
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <link rel="apple-touch-icon" sizes="180x180" href="favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon_io/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <title>Cine Community</title>
    <!-- <script>
        function funImg()
        {
        alert("Esta função requer o login do usuario!");
        }
        function funcPerfil(){
            alert('Em breve:\nFunção "Meu Perfil" disponível');
        }
        function funcFavorito(){
            alert('Em breve:\nFunção "Favorito" disponível');
        }
    </script> -->
</head>
<body>
    <div id="container">
    <header class="header" >
        <a href="index.php" class="logo"><img src="assets/logoinicio.png" alt="index.php"></a>
        <nav class="navbar" style="-i:1;">
            <a href="index.php" style="-i:2;"><i class="fa-solid fa-house"></i>INICIO</a> 
     <?php 
     if (!empty($usuarioLogado)) {
     if ($id_perfil == 1) {
        echo '<a href="./view/dashboard/painel_adm.php?id_usuario=' . $id_usuarioLogado . '"><i class="fa-solid fa-user"></i>' . $id_usuarioLogado . 'Painel Administrador</a>';
        echo '<a class="border1" href="./control/control_sairadm.php" class="item_menu"><i class="fa-solid fa-right-from-bracket"></i>SAIR</a>';
    } if ($id_perfil == 2) {
        echo '<a href="./view/adm/painel_moderador.php"><i class="fa-solid fa-users"></i>PAINEL MODERADOR</a>';
        echo '<a class="border1" href="./control/control_sair.php" class="item_menu"><i class="fa-solid fa-right-from-bracket"></i>SAIR</a>';
    } if ($id_perfil == 3 || $id_perfil == 4) {
        echo '<a href="./view/alterar_usuario.php?id_usuario=' . $id_usuarioLogado . '" onclick="funcPerfil()"><i class="fa-solid fa-user"></i>' . $usuarioLogado . '</a>';
        echo '<a class="border1" href="./control/control_sair.php" class="item_menu"><i class="fa-solid fa-right-from-bracket"></i>SAIR</a>';
    }
    } else {
       echo '<a href="./view/cadastro.php" style="-i:3;"><i class="fa-solid fa-user"></i>CADASTRO</a>
         <a href="./view/login.php" style="-i:4;"><i class="fa-solid fa-user"></i>LOGIN</a>';
}
?>


        </nav>
    </header>
    <section>
        <div class="box">
            <div class="box-image"><img src="./assets/banner/imagemsite.png"></div>
            <div class="box-image"><img src='./assets/banner/Compre2.png'><div>
            <div class="box-image"><img src='./assets/banner/criesuas2.png'></div>
            <div class="box-image"><img src="./assets/banner/avatar.jpeg"></div>
            <div class="box-image"><img src='./assets/banner/Indiana-Jones.jpg'><div>
            <div class="box-image"><img src='./assets/banner/oppenheimer.jpg'></div>
            <div class="box-image"><img src="./assets/banner/john-wick-4.jpg"></div>
            <div class="box-image"><img src='./assets/banner/Panico6.jpg'><div>
            <div class="box-image"><img src='./assets/banner/supermario.jpg'></div>
            <div class="box-image"><img src="./assets/banner/velozesefuriososx.png"></div>
            <div class="box-image"><img src='./assets/banner/amortedodemonio.webp'><div>
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
                foreach ( $filme as $filmeFetch ) {
                    $categoria = $filmeFetch['categoria_filme'];
                    if ( !in_array( $categoria, $categorias ) ) {
                        $categorias[] = $categoria;
                    }
                }

                // Exibir os filmes agrupados por categoria
                foreach ( $categorias as $categoria ) {
                ?>
            <div class="categoria">
                <h2><?=$categoria?></h2>
                <div class="filme-carousel">
                    <?php foreach ( $filme as $filmeFetch ) {
                            if ( $filmeFetch['categoria_filme'] === $categoria ) {?>
                    <div class="filme-item">
                        <a href="./view/filme_resenha.php?get_id=<?=$filmeFetch['id_filme'];?>">
                        <img src="assets/<?=$filmeFetch['capa_filme'];?>" alt="Capa do filme <?=$filmeFetch['nome_filme'];?>">
                        </a>
                    </div>
                    <?php }
                        }?>
                </div>
            </div>
            <?php }?>
        </div>
    </div>

  <!-- FIM SELEÇÃO DE FILMES -->
  <br>
  <br>
  <br>
  <hr>

<!-- INICIO TELA COLECIONÁVEIS -->
<section class="sessaocompras">
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
  <div class="compras">
    <h1>Compre, Venda e Troque Itens Colecionáveis</h1>
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
  </div></center>

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

    <script src="./js/carrossel.js"></script>
    <script src="./js/script.js"></script>
<!-- Inclua o arquivo JavaScript do jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Inclua o arquivo JavaScript do Slick Carousel -->
<script src="https://cdn.jsdelivr.net/npm/slick-carousel/slick/slick.min.js"></script>

</body>
</html>