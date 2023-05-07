<?php
    if(isset($_GET['id_filme'])){
    $id_filme = $_GET['id_filme'];
    }else{
    $id_filme = '';
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
        <div><h1>Resenha Filme</h1> <a href="../usu_logado.php?id=<?= $id_filme; ?>" class="inline-btn" style="margin-top: 0;">Filmes</a></div>

        <?php 
            $sql = "SELECT * FROM filme WHERE id_filme=? LIMIT 1";
            $selecione_filme = $this->pdo->prepare($sql);
            $selecione_filme->execute([$id_filme]);

            if($selecione_filme->rowCount() > 0){
                while ($filmeFetch = $selecione_filme->fetch(PDO::FETCH_ASSOC)){
                }}
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
        <div>

            <?php 
                $sql = "SELECT * FROM resenha WHERE fk_filme_id_filme=?";
                $selecione_resenha = $this->pdo->prepare($sql);
                $selecione_resenha->execute([$id_filme]);

                if($selecione_resenha->rowCount() > 0){
                    while ($resenhaFetch = $selecione_resenha->fetch(PDO::FETCH_ASSOC)){
                    }}?> 
            <div class="box" <?php if($resenhaFetch['perfil_usu'] == $usuario){echo 'style="order: -1;"';}; ?>>
        <?php
            $sql = "SELECT * FROM usuario WHERE id_usuario=?";
            $selecione_usuario = $this->pdo->prepare($sql);
            $selecione_usuario->execute([$resenhaFetch['usuario']]);

            if($selecione_usuario->rowCount() > 0){
                while ($resenhaFetch = $selecione_usuario->fetch(PDO::FETCH_ASSOC)){
                }}
        ?>   
        </div>
    </section>



<!-- sweetalert cdn link  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>


<?php include '../app/alers.php'; ?>
</body>
</html>
