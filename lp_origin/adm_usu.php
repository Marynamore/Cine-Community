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
            <a href="./pages/listausuario.php"><i class="fa-solid fa-users"></i><br>SOBRE NÓS</a>
            <a href="login.php" style="-i:4;"><i class="fa-solid fa-user"><br><?=$_SESSION['nome_usu'];?></i></a>
            <a href="./view/adm/painel_adm.php"><i class="fa-solid fa-user"></i><br>PERFIL</a>
        </nav>
    </header>
<?php }?>
    <div>
        <img class="banner"  src="assets/Banner.png" alt="">
        <br>
        <br>
    </div>

<?php

    require_once './model/dao/filmeDAO.php';
    $FilmeDAO = new FilmeDAO();
    $filmeFech = $FilmeDAO->listarFilmesComCategoria();
    $filmes = array();
    echo '<pre>';
   print_r($filmeFech);
   echo '</pre>';
?>

<!-- Exibe a lista de filmes -->
<?php foreach ($filmes as $filmeFech) { ?>
    <div class="container-galeria">
        <!-- Exibe a categoria do filme -->
        <h2 class="h2"><?php echo $filmeFech->getFk_categoria_filme_id_categoria_filme(); ?></h2>
        
        <a href="./resenha/redesocial/form_resenha.php" class="itens-galeria">
            <!-- Exibe a capa do filme -->
            <img src="assets/<?=$filmeFech->getCapa_filme(); ?>" alt="Capa do filme <?=$filmeFech->getNome_filme(); ?>">
            <!-- Exibe o nome do filme -->
            <h4><?php echo $filmeFech->getNome_filme(); ?></h4>
        </a>
    </div>
    
<?php } ?>

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