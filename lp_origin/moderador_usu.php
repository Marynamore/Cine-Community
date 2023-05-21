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
    <div>
        <img class="banner"  src="assets/Banner.png" alt="">
        <br>
        <br>
    </div>

    <?php 
    require_once './model/dao/filmeDAO.php';
    $FilmeDAO = new FilmeDAO();
    $filme = $FilmeDAO->listarTodos();

    ?>
    <div class="container-galeria">
        <?php 
        $categoria='';  
        foreach ($filme as $filmeFetch) {   ?>
        <!-- Exibe a categoria do filme -->
        <?php if($categoria != $filmeFetch['categoria_filme']){
            $categoria = $filmeFetch['categoria_filme'];
            echo '<div>';
            echo '<h2>'.$filmeFetch['categoria_filme'].'</h2>';
            echo '</div>';
        } ?>
        <div class="itens-galeria">
        <a href="" onclick="funImg()">
            <!-- Exibe a capa do filme -->
            <img src="assets/<?=$filmeFetch['capa_filme'];?>" alt="Capa do filme <?=$filmeFetch['nome_filme']; ?>">
            <!-- Exibe o nome do filme -->
            <h4><?= $filmeFetch['nome_filme']; ?></h4>
        </a>
        </div>
      <?php 
        //  echo '<pre>';
        //var_dump($filmeFetch);
        //echo '</pre>'; 
    
    }?>

    </div>
  


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