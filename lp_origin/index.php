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
   session_start();
   if(!isset($_SESSION["usuario"])) {
?>
    <header class="header" >
        <a href="index.php" class="logo"><img src="assets/logoinicio.png" alt="index.php"></a>
        <nav class="navbar" style="-i:1;">
            <a href="#" style="-i:2;"><i class="fa-solid fa-house"></i><br>INICIO</a>
            <a href="./view/cadastro.php" style="-i:3;"><i class="fa-solid fa-user"></i><br>CADASTRO</a>
            <a href="./view/login.php" style="-i:4;"><i class="fa-solid fa-user"></i><br>LOGIN</a>
            <a href="#about"><i class="fa-solid fa-users"></i><br>SOBRE NÓS</a>
        </nav>
    </header>
    <?php 
    }else{
    echo '
    <header class="header" >
        <a href="index.php" class="logo"><img src="assets/logoinicio.png" alt="index.php"></a>
        <nav class="navbar" style="-i:1;">
            <a href="#" style="-i:2;"><i class="fa-solid fa-house"></i><br>INICIO</a>
            <a href="#about"><i class="fa-solid fa-users"></i><br>FAVORITOS</a>
            <a href="./view/adm/painel_adm.php"><i class="fa-solid fa-user"></i><br>'.$_SESSION['nickname_usu'].'</a>
            <a class="border1" href="./control/control_sair.php" class="item_menu"><i class="fa-solid fa-right-from-bracket"></i><br>SAIR</a>
        </nav>
    </header>
    ';
    }
    ?>
    <div>
        <img class="banner" src="assets/Banner.png" alt="">
        <br>
        <br>
    </div>

<!-- Exibe a lista de filmes -->
    <?php 
    require_once './model/dao/categoriaDAO.php';
    $categoriaDAO = new categoriaDAO();
    $categoria = $categoriaDAO->listarCategoria();
    foreach ($categoria as $categoriaFetch) { 
        
    //echo '<pre>';
    //print_r($categoriaFetch);
    //echo '</pre>';
        echo '<input type="hidden" name='.$categoriaFetch['id_categoria_filme'].'>';
        ?>
    <div class="container-galeria">
        <!-- Exibe a categoria do filme -->
        <h2 class="h2"><?=$categoriaFetch['categoria_filme']; ?></h2>
    
    <?php 
    foreach ($filme as $filmeFetch) { 
    //echo '<pre>';
    //print_r($filmeFetch);
    //echo '</pre>';
        echo '<input type="hidden" name='.$filmeFetch['fk_categoria_filme_id_categoria_filme'].'>';
        ?>
        <a href="./view/filme_resenha.php" class="itens-galeria">
            <!-- Exibe a capa do filme -->
            <img src="assets/<?=$filmeFetch['capa_filme']?>" alt="Capa do filme <?=$filmeFech['nome_filme']; ?>">
            <!-- Exibe o nome do filme -->
            <h4><?= $filmeFetch['nome_filme']; ?></h4>
        </a>
    <?php }?>
    </div>
    
<?php }?>



  <!-- FIM SELEÇÃO DE FILMES -->

    <footer>
        <hr>
        <!--  INICIO RODAPE -->
        <section class="main_tutor">
            <div class="main_tutor_content">
                <header>
                    <h1>Conheça mais nosso trabalho</h1>
                
                </header>
                <div class="main_tutor_content_img">
                    <img src="../lp_origin/assets/logoinicio.png" width="100" title="Instrutor" alt="Instrutor">
                </div>
                <article class="main_tutor_content_history">
                    <header>
                        <h2>Formados em TI e apaixonados por filmes</h2>
                    </header>
                     
                </article>

                <section class="main_tutor_social_media">
                    <header>
                        <h2 >Nos siga nas redes sociais</h2>
                    </header>

                    <article>
                        <header>
                            <h3 ><a href="#" class="icon-facebook"> Facebook</a></h3>
                        </header>
                    </article>

                        <article>
                            <header>
                                <h3><a href="#" class="icon-instagram"> Instagram</a></h3>
                            </header>
                        </article>

                        <article>
                            <header>
                                <h3><a href="#" class="icon-google-plus2"> Twitter</a></h3>
                            </header>
                        </article>
                </section>
            </div>
        </section>

        <!-- FIM  RODAPE -->
    </footer>
</body>
</html>
