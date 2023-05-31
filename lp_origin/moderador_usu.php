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
</head>
<body>
<?php
   if(session_start()){
?>
    <header class="header" >
        <a href="index.html" class="logo"><img src="assets/logoinicio.png" alt=""></a>
        <nav class="navbar" style="-i:1;">
            <a href="#" style="-i:2;"><i class="fa-solid fa-house"></i><br>INICIO</a>
            <a href="./view/cadastrar_filme.php"><i class="fa-solid fa-users"></i><br>ADICIONAR FILME</a>
            <a href="./view/alterar_usuario.php?id=<?=$usuario["id_usuario"]?>" title="ALTERAR">Alterar <i class="bi bi-pencil"></i></a>
            <a href="./view/adm/painel_moderador.php"><i class="fa-solid fa-user"></i><br>PERFIL</a>
            <a class="border1" href="./control/control_sair.php" class="item_menu"><i class="fa-solid fa-right-from-bracket"></i><br>SAIR</a>
        </nav>
    </header>
<?php }?>
    

    <section>
        <div class="box">
            <div class="box-image"><img src="./assets/banner/imagemsite.png"></div>
            <div class="box-image"><img src='./assets/banner/Compre2.png'><div>
            <div class="box-image"><img src='./assets/banner/criesuas2.png'></div>

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