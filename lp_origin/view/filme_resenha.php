<?php
require_once '../model/dao/filmeDAO.php';
require_once '../model/dao/resenhaDAO.php';

if(isset($_GET['get_id'])) {
    $get_id = $_GET['get_id'];
} else {
    $get_id = '';
    header('location:../index.php');
}

$FilmeDAO = new FilmeDAO();
$ResenhaDAO = new ResenhaDAO();

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/resenhas.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>Filme</title>
</head>

<body>
    <header class="header" >
        <a href="index.php" class="logo"><img src="../assets/logoinicio.png" alt="index.php"></a>
        <nav class="navbar" style="-i:1;">
            <a href="#" style="-i:2;"><i class="fa-solid fa-house"></i><br>INICIO</a>
            <a href="./view/cadastro.php" style="-i:3;"><i class="fa-solid fa-user"></i><br>CADASTRO</a>
            <a href="./view/login.php" style="-i:4;"><i class="fa-solid fa-user"></i><br>LOGIN</a>
            <a href="#comment"><i class="fa-solid fa-comment-dots"></i><br>COMENTÁRIOS</a>
            <a href="#about"><i class="fa-solid fa-users"></i><br>SOBRE NÓS</a>
        </nav>
    </header>

    <div>
        <div><h1>Resenha Filme</h1><a href="../index.php" class="inline-btn" style="margin-top: 0;">Todos os Filmes</a></div>
    <?php
    $filmeFetch = $FilmeDAO->selecionarFilmesComCategoria($get_id);
    if($filmeFetch) { ?>
        <div class="dados-filme">
            <img src="../assets/<?= $filmeFetch->getCapa_filme();?>" alt="" class="poster">
            <div>
                <h1><?= $filmeFetch->getNome_filme();?></h1>
                <h3>Lançamento: <?= $filmeFetch->getDt_de_lancamento_filme();?></h3>
                <h3>Duração: <?= $filmeFetch->getDuracao_filme();?></h3>
                <h3>Categoria: <?= $filmeFetch->getFk_categoria_filme_id_categoria_filme();?></h3>
                <h3>Classificação indicativa: <?= $filmeFetch->getClassificacao_filme();?></h3>            
                <h3><a href="https://www.youtube.com/watch?v=SS6ABPkfmBE">Trailer</a><?= $filmeFetch->getTrailer_filme();?></h3>
                <p>Sinopse: <?= $filmeFetch->getSinopse_filme();?></p>
            </div>
        </div>
    </div>
    <?php 
    //echo '<pre>';
    //print_r($filmeFetch);
    //echo '</pre>';

}else {
    echo '<p>Nenhum Filme Adicionado!</p>';
}?>
    <section class="resenha">
        <div class="titulo">
            <h1>Resenhas:</h1> 
            <a href="../resenhas/crud/cadastrar_resenha.php?get_id=<?= $get_id; ?>" class="criar_resenha">Criar Resenha</a>
        </div>
        <div class="resenha">

            <div class="titulo_res">
                
                <a class="edicao_resenha" href="">Editar</a>
                <a class="edicao_resenha" href="">Excluir</a> 
            </div>
        <?php
            $resenhas = $ResenhaDAO->verificarResenha($get_id);
            foreach($resenhas as $resenha) {
        ?>
            <h4 <?php if($resenhaFetch['id_usuario'] == $id_usuario){echo 'style="order: -1;"';}; ?>></h4>
        <?php }?>
    </section>



<!-- sweetalert cdn link  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>


<?php include '../app/alers.php'; ?>
</body>
</html>
