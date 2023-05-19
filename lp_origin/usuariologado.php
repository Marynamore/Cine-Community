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
    <script>
        function funcPerfil(){
            alert('Em breve:\nFunção "Meu Perfil" disponível');
        }
        function funcFavorito(){
            alert('Em breve:\nFunção "Favorito" disponível');
        }
    </script>
</head>
<body>
<?php
   session_start();
   if(!isset($_SESSION["usuario"]) && empty($_SESSION["usuario"])) {
?>
    <header class="header" >
        <a href="index.php" class="logo"><img src="assets/logoinicio.png" alt="index.php"></a>
        <nav class="navbar" style="-i:1;">
            <a href="#" style="-i:2;"><i class="fa-solid fa-house"></i><br>INICIO</a>
            <a href="#about" onclick="funcFavorito()"><i class="fa-solid fa-users"></i><br>FAVORITOS</a>
            <a href="./view/alterar_usuario.php" onclick="funcPerfil()"><i class="fa-solid fa-user"></i><br><?=($_SESSION["nickname_usu"]);?></a>
            <a href="./view/alterar_usuario.php?id=<?=$usuario["id_usuario"]?>" title="ALTERAR">Alterar <i class="bi bi-pencil"></i></a>
            <a class="border1" href="./control/control_sair.php" class="item_menu"><i class="fa-solid fa-right-from-bracket"></i><br>SAIR</a>
        </nav>
    </header>
   <?php
   };
   ?> 
  <section>
        <div class="box">

            <div class="box-image"><img src="./assets/banner/imagemsite.png"></div>
            <div class="box-image"><img src='./assets/banner/avatar.jpeg'></div>
            <div class="box-image"><img src='./assets/banner/creed3.jpg'></div>
            <div class="box-image"><img src='./assets/banner/john-wick-4.jpg'></div>
            <div class="box-image"><img src="./assets/banner/guardians-galaxy.jpg"></div>
            <div class="box-image"><img src='./assets/banner/supermario.jpg'></div>
            <div class="box-image"><img src="./assets/banner/Indiana-Jones.jpg"></div>
            <div class="box-image"><img src="./assets/banner/oppenheimer.jpg"></div>
            <div class="box-image"><img src="./assets/banner/Panico6.jpg"></div>
            <div class="box-image"><img src="./assets/banner/amortedodemonio.webp"></div>
            <div class="box-image"><img src="./assets/banner/velozesefuriososx.png"></div>     
        </div>
        <div class="bolinhas">
    
        </div>
    </section>
<!-- Exibe a lista de filmes -->
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
        <a href="./view/filme_resenha.php?get_id=<?= $filmeFetch['id_filme'];?>" >
            <!-- Exibe a capa do filme -->
            <img src="assets/<?=$filmeFetch['capa_filme'];?>" alt="Capa do filme <?=$filmeFetch['nome_filme']; ?>">
            <!-- Exibe o nome do filme -->
            
        </a>
        </div>
      <?php 
        //  echo '<pre>';
        //var_dump($filmeFetch);
        //echo '</pre>'; 
    
    }?>

    </div>




  <!-- FIM SELEÇÃO DE FILMES -->

  <hr>
  <!-- INICIO RODAPE -->
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
    <!-- FIM RODAPE -->
  </footer>
    <script src="./js/script.js"></script>
</body>
</html>
