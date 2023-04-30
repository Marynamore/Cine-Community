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
            <a href="login.php" style="-i:4;"><i class="fa-solid fa-user"><br><?=$_SESSION['nickname_usu'];?></i></a>
            <a href="./pages/alterar_usuario.php"><i class="fa-solid fa-comment-dots"></i><br>COMENTÁRIOS</a>
            <a href="./pages/listausuario.php"><i class="fa-solid fa-users"></i><br>SOBRE NÓS</a>
            <a href="./pages/perfilusu.php"><i class="fa-solid fa-user"></i><br>PERFIL</a>
        </nav>
    </header>
<?php }?>
    <div>
        <img class="banner"  src="assets/Banner.png" alt="">
        <br>
        <br>
    </div>
    <h2 class="h2">Lançamentos</h2> 
<?php 
    require_once './model/dao/filmeDAO.php';

    $FilmeDAO = new FilmeDAO();
    $filme = $FilmeDAO->listarTodos();
?>
    <div class="container-galeria">
      <img src="upload/<?= $filme['capa_filme']; ?>" alt="" class="image" class="itens-galeria">
      <h3><?= $filme['nome_filme']; ?></h3>
      <a href="filme.php?id=<?= $filme['id_filme']; ?>">Ver Mais</a>
    </div>
    <a href="./pages/cadastrar_filme.php" >Adicionar Filme</a>

    <h2 class="h2">Terror</h2> 
    <div class="container-galeria">
        <a href="" class="itens-galeria">
            <img src="assets/umlugarsilencioso.jpg" alt="">
        </a>
        
    </div>
    <h2 class="h2">Comédia</h2> 
    <div class="container-galeria">
        <a href="" class="itens-galeria">
            <img src="assets/americanpie1.jpg" alt="">
        </a>
        <a href="" class="itens-galeria">
            <img src="assets/americanpie2.jpg" alt="">
        </a>
        
    </div>
    <h2 class="h2">Drama</h2> 
    <div class="container-galeria">
        <a href="" class="itens-galeria">
            <img src="assets/incendios.jpg" alt="">
        </a>
         
    </div>
    <h2 class="h2">Ação</h2> 
    <div class="container-galeria">
        <a href="" class="itens-galeria">
            <img src="assets/johnwick1.jpg" alt="">
        </a>
        <a href="" class="itens-galeria">
            <img src="assets/jhonwick.jfif" alt="">
        
        <a href="" class="itens-galeria">
            <img src="assets/velozesefuriosos.png" alt="">
        </a>
        <a href="" class="itens-galeria">
            <img src="assets/indianajones.jpg" alt="">
        </a>
    </div>
    <h2 class="h2">Suspense</h2> 
    <div class="container-galeria">
        <a href="" class="itens-galeria">
            <img src="assets/ossuspeitos.jpg" alt="">
        </a> 
    </div>



    <footer>
        <section class="inicio">
            <div class="conteudo-do-inicio">
               
                <h1>Cine Community</h1>
                <h3>As melhores resenhas da comunidade estão aqui!</h3>
                <p</p>
                <div class="redessociais"> <a  href="https://www.youtube.com/watch?v=CI2Nz_3gSNI"><i class="bx bxl-instagram-alt"></i></a></div>
            </div>
            
    </section>
    </footer>
</body>
</html>