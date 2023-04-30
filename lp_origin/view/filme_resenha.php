<?php
    if(isset($_GET['id'])){
    $get_id = $_GET['id'];
    }else{
    $get_id = '';
    header('location:../usu_logado.php');
    }
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
        <div><h1>Filme</h1> <a href="../usu_logado.php?id=<?= $get_id; ?>" class="inline-btn" style="margin-top: 0;">Adicionar Filme</a></div>
        <?php 
            require_once '../model/dao/filmeDAO.php';

            $id_filme = $_GET['id'];
            $FilmeDAO = new FilmeDAO();
            $filme = $FilmeDAO->selecionarFilme($id_filme);
        ?>
        <div class="dados-filme">
            <img src="../upload/<?= $filme->getCapa_filme();?>" alt="">
            <h1><?= $filme->getNome_filme();?></h1>
            <h3><?= $filme->getDt_de_lancamento_filme();?></h3>
            <h3><?= $filme->getDuracao_filme();?></h3>
            <h3><?= $filme->getGenero_filme();?></h3>
            <h3><?= $filme->getClassificacao_filme();?></h3>            
            <h3><a href="https://www.youtube.com/watch?v=SS6ABPkfmBE">Trailer</a><?= $filme->getTrailer_filme();?></h3>
            
            <p><?= $filme->getSinopse_filme();?></p>
        </div>
    </div>
    <section class="resenha">
        <div class="heading">
            <h1>Resenhas:</h1> <a href="../resenhas/crud/cadastrar_resenha.php?id=<?= $id_filme; ?>" class="inline-btn" style="margin-top: 0;">Adicionar Resenha</a>
        </div>
    </section>



<!-- sweetalert cdn link  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>


<?php include '../app/alers.php'; ?>
</body>
</html>
