<?php
session_start();
require_once '../model/dao/UsuarioDAO.php';
require_once '../model/dao/filmeDAO.php';
require_once '../model/dao/favoritoDAO.php';

if (isset($_GET['get_id'])) {
    $get_id = $_GET['get_id'];
} else {
    $get_id = '';
    header('location:../index.php');
}

$usuarioDAO = new UsuarioDAO();
$filmeDAO = new FilmeDAO();
$favoritoDAO = new FavoritoDAO();

// Verifica se o usuário está logado
if (isset($_SESSION["id_usuario"]) && $_SESSION["id_usuario"] !== null) {
    $id_usuario = $_SESSION["id_usuario"];

    // Obtém a lista de filmes favoritos do usuário
    $filmesFavoritos = $favoritoDAO->obterFilmesFavorito($id_usuario);

    if ($filmesFavoritos) {
        // Exibe os filmes favoritos na página
        echo "<div class='header'>";
        echo "<div class='logo'>";
        echo "<img src='./assets/logo.png' alt='Logo'>";
        echo "</div>";
        echo "<div class='navbar'>";
        echo "<a href='#'>Home</a>";
        echo "<a href='#'>Perfil</a>";
        echo "<a href='#'>Favoritos</a>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "</div>";

        echo "<section>";
        echo "<div class='container-filme'>";
        echo "<div class='categoria'>";
        echo "<h2>Favoritos</h2>";
        echo "</div>";
        echo "<div class='filme-carousel'>";
        foreach ($filmesFavoritos as $filme) {
            echo "<div class='filme-item'>";
            echo "<img src='./assets/" . $filme->getCapa_filme() . "' alt='Capa do Filme'>";
            echo "<div class='dados-filme'>";
            echo "<p>" . $filme->getNome_filme() . "</p>";
            echo "</div>";
            echo "</div>";
        }
        echo "</div>";
        echo "</div>";
        echo "</section>";
    } else {
        echo "<div class='header'>";
        echo "<div class='logo'>";
        echo "<img src='../assets/logo.png' alt='Logo'>";
        echo "</div>";
        echo "<div class='navbar'>";
        echo "<a href='#'>Home</a>";
        echo "<a href='#'>Perfil</a>";
        echo "<a href='#'>Favoritos</a>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "</div>";

        echo "<section>";
        echo "<div class='container-filme'>";
        echo "<div class='categoria'>";
        echo "<h2>Favoritos</h2>";
        echo "</div>";
        echo "<p>Nenhum filme marcado como favorito.</p>";
        echo "</div>";
        echo "</section>";
    }
} else {
    echo "<div class='header'>";
    echo "<div class='logo'>";
    echo "<img src='../assets/logo.png' alt='Logo'>";
    echo "</div>";
    echo "<div class='navbar'>";
    echo "<a href='#'>Home</a>";
    echo "<a href='#'>Perfil</a>";
    echo "<a href='#'>Favoritos</a>";
    echo "</div>";
    echo "<div class='search-box'>";
    echo "<input type='text' class='search-text' placeholder='Pesquisar'>";
    echo "<div class='search-btn'>";
    echo "<img class='loupe-blue' src='../assets/loupe-blue.png' alt='Pesquisar'>";
    echo "<img class='loupe-white' src='../assets/loupe-white.png' alt='Pesquisar'>";
    echo "</div>";
    echo "</div>";
    echo "</div>";

    echo "<section>";
    echo "<div class='container-filme'>";
    echo "<div class='categoria'>";
    echo "<h2>Favoritos</h2>";
    echo "</div>";
    echo "<p>Usuário não encontrado.</p>";
    echo "</div>";
    echo "</section>";
}
?>
<style>
* {
   margin: 0;
   padding: 0;
   box-sizing: border-box;
   font-family: 'Poppins', sans-serif;
}

body {
   background-color: #1f242d;
   color: #fff;
}

.header {
   width: 100% auto;
   padding: 20px 10%;
   background: #1f242d;
   display: flex;
   justify-content: space-between;
   align-items: center;
   text-align: center;
}

.logo {
  display: flex;
  align-items: center;
}

.logo img {
   animation: slideRight 1s ease forwards;
   max-width: 150px;
   border-radius: 50%;
   -moz-border-radius: 50%;
   -webkit-border-radius: 50%;
   padding: 3px;
   background-color: #08ef;
}

.navbar {
  display: flex;
  
}

.navbar a {
   display: flex;
   flex-direction: column;
   align-items: center;
   font-size: 1.5em;
   color: #fff;
   text-decoration: none;
   margin: 0 15px;
   transition: -7s;
   animation: slideTop 3s ease forwards;
}

.navbar a:hover {
   color: #08ef;
}
/* input Pesquisar */
.search-box{

   background: #fff;
   height: 50px;
   padding: 10px;
   border-radius: 40px;

   display: flex;
   justify-content: space-between;
   align-items: center;
}

.search-text {
   background: none;
   border: 0;
   outline: 0;

   padding: 0;

   font-size: 16px;
   width: 0;
}

.search-btn {
   width: 50px;
   height: 50px;

   display: flex;
   justify-content: center;
   align-items: center;
}

.search-btn {

   width: 45px;
   height: 50px;
   border-radius: 50%;

   display: flex;
   justify-content: center;
   align-items: center;
   cursor: pointer;
 
}
.loupe-white{
   display: none;
}

.search-box:hover > .search-text {
   width: 320px;
   padding-left: 20px;
}

.search-box:hover > .search-btn{
   background-color: #fff;
   border: none;
}

.search-box:hover > .search-btn .loupe-blue{
   display: none;
   border: none;
   background-color: #fff;
}

.search-box:hover > .search-btn .loupe-white {
   display: block;
   border: none;
   background-color: #fff;
   
}


/* FIM DO INPUT PESQUISAR */
section{
	width: 100%;
	height: 100vh; 
	overflow: hidden;
}

.box{
   margin-top: 150px;
   display: flex;
   width: 100%;
   height: 100vh;
   
}

.box-image img{
   width: 100em;
   height: 500px;
   animation: anima;
   animation-duration: 800ms;
}

@keyframes anima{

    from{transform: translate(-50px,00);}
    to{transform: translate(0px,00);}
}

/*Parte dos filmes*/
.container-filme{
  padding: 20px;
}

.container-galeria {
  margin-top: 20px;
}

.categoria {
  margin-bottom: 20px;
}

.categoria h2 {
  font-size: 24px;
  font-weight: bold;
  margin-bottom: 10px;
}

.filme-carousel {
   display: flex;
   overflow: hidden;
   scroll-snap-type: x mandatory;
   justify-content: space-between;
   align-items: center;
}


.filme-item {
   width: 15em;
   height: 22em;
   transition: .2s;
   padding: 1.5em;
}

.filme-item img {
   width: 130%;
   height: 20em;
   object-fit: cover;
   border-radius: 10px;
   flex-wrap: wrap;
}

.filme-item:hover {
   transform: scale(1.1);
}

/*Fim parte dos filmes*/

/*Animação*/

@keyframes slideRight {
   0% {
      transform: translateX(-100px);
      opacity: 0;
   }

   100% {
      transform: translateX(0);
      opacity: 10;
   }
}

@keyframes slideTop {
   0% {
      transform: translateX(100px);
      opacity: 0;
   }

   100% {
      transform: translateX(0);
      opacity: 10;
   }
}

@keyframes slideBotton {
   0% {
      transform: translateX(-100px);
      opacity: 0;
   }

   100% {
      transform: translateX(0);
      opacity: 10;
   }
}

@keyframes foto {
   0% {
      transform: scale(0);
      opacity: 0;
   }

   100% {
      transform: scale(1);
      opacity: 1;
   }
}
/* <!-- INICIO TELA COLECIONÁVEIS --> */
section {
   font-family: Arial, sans-serif;
   background-color:#1f242d ;
   margin: 0;
   padding: 0;
   justify-content: center;
 }
 
 .compras {
   max-width: 800px;
   margin: 0 auto;
   padding: 20px;
    
 }
 h1{
   font-size: 30px;
 }
 h1, p {
   text-align: center;
   color: #fff;
 }

 p{
   font-size: 20px;
 }
 
 .product-list {
   display: flex;
   flex-wrap: wrap;
   justify-content: space-between;
   margin-top: 20px;
 }
 
 .product-item {
   width: 300px;
   margin-bottom: 20px;
   padding: 20px;
   border-radius: 5px;
   background-color: #2c313b;
   transition: transform 0.3s ease-in-out;
   cursor: pointer;
 }
 
 .product-item:hover {
   transform: scale(1.05);
 }
 
 .product-image {
   text-align: center;
 }
 
 .product-image img {
   max-width: 200px;
   max-height: 200px;
   object-fit: cover;
   border-radius: 5px;
   margin-bottom: 10px;
 }
 
 .product-title {
   font-size: 18px;
   font-weight: bold;
   color: #fff;
   margin-bottom: 10px;
   text-align: center;
 }
 
 .product-price {
   font-size: 16px;
   color: #fff;
   text-align: center;
 }
 
 .product-description {
   font-size: 14px;
   color: #fff;
   text-align: justify;
   margin-top: 10px;
 }
 
 .btn-comprar {
   display: block;
   width: 100%;
   padding: 10px;
   margin-top: 20px;
   border-radius: 5px;
   background-color: #08ef;
   color: #fff;
   text-align: center;
   text-decoration: none;
   transition: background-color 0.3s ease-in-out;
 }
 
 .btn-comprar:hover {
   background-color: #0492d9;
 }
 
 /* <!-- FIM TELA COLECIONÁVEIS --> */
</style>