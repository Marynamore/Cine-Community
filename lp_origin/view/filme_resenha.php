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
    <link rel="stylesheet" href="resenhas.css">
    <title>Filme</title>
</head>

<body>
    <div>
        <div><h1>Resenha Filme</h1><a href="../index.php" class="inline-btn" style="margin-top: 0;">Todos os Filmes</a></div>
    <?php
    $filmeFetch = $FilmeDAO->selecionarFilmesComCategoria($get_id);
    if($filmeFetch) { ?>
        <div class="dados-filme">
            <img src="../assets/<?= $filmeFetch->getCapa_filme();?>" alt="">
            <h1><?= $filmeFetch->getNome_filme();?></h1>
            <h3><?= $filmeFetch->getDt_de_lancamento_filme();?></h3>
            <h3><?= $filmeFetch->getDuracao_filme();?></h3>
            <h3><?= $filmeFetch->getGenero_filme();?></h3>
            <h3><?= $filmeFetch->getClassificacao_filme();?></h3>            
            <h3><a href="https://www.youtube.com/watch?v=SS6ABPkfmBE">Trailer</a><?= $filmeFetch->getTrailer_filme();?></h3>
            <p><?= $filmeFetch->getSinopse_filme();?></p>
        </div>
    </div>
    <?php 
    echo '<pre>';
    print_r($filmeFetch);
    echo '</pre>';

}else {
    echo '<p>Nenhum Filme Adicionado!</p>';
}?>
    <section class="resenha">
        <div class="heading">
            <h1>Resenhas:</h1> <a href="../resenhas/crud/cadastrar_resenha.php?get_id=<?= $get_id; ?>" class="inline-btn" style="margin-top: 0;">Adicionar Resenha</a>
        </div>
        <div>

        <?php
            $resenhas = $ResenhaDAO->verificarResenha($get_id);
            foreach($resenhas as $resenha) {
        ?>
            <div class="box" <?php if($resenhaFetch['id_usuario'] == $id_usuario){echo 'style="order: -1;"';}; ?>>
        </div>
        <?php }?>
    </section>



<!-- sweetalert cdn link  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>


<?php include '../app/alers.php'; ?>
</body>
</html>
