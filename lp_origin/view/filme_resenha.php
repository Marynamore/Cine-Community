<?php
require_once '../model/dao/filmeDAO.php';
require_once '../model/dao/resenhaDAO.php';
require_once '../model/dao/UsuarioDAO.php';

session_start();

if(isset($_GET['get_id'])) {
    $get_id = $_GET['get_id'];
} else {
    $get_id = '';
    header('location:../usuariologado.php');
}

$FilmeDAO = new FilmeDAO();
$ResenhaDAO = new ResenhaDAO();
$UsuarioDAO = new UsuarioDAO(); 

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/resenhas.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <link rel="apple-touch-icon" sizes="180x180" href="favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon_io/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <title>Cine Community</title>
</head>
<body>
    <header class="header" >
        <a href="../index.php" class="logo"><img src="../assets/logoinicio.png" alt="index.php"></a>
        <nav class="navbar" style="-i:1;">
            <a href="#" style="-i:2;"><i class="fa-solid fa-house"></i><br>INICIO</a>
            <a href="../view/cadastro.php" style="-i:3;"><i class="fa-solid fa-user"></i><br>CADASTRO</a>
            <a href="../view/login.php" style="-i:4;"><i class="fa-solid fa-user"></i><br><?=$_SESSION["nickname_usu"];?></a>
        </nav>
    </header>
    <div id="all">
        <div class="titulo"><h1>Resenha Filme</h1><a href="../index.php" class="criar_resenha">Voltar Filmes</a></div>
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
            <a href="resenha.php?get_id=<?= $get_id; ?>" class="criar_resenha">Criar Resenha</a>
            <input type="hidden" name="fk_usuario_id_usuario" value="<?=$id_usuario = $_SESSION['id_usuario'];?>">
        </div>

        <?php
            $resenhas = $ResenhaDAO->verificarResenha($get_id,$id_usuario);
            if(!empty($resenhas)){
            foreach($resenhas as $resenha) {
                $usuario = $UsuarioDAO->dadosUsuarioPorId($resenha->getFk_usuario_id_usuario());
        ?>        
        <div class="resenha">
        <?php 
            if($id_usuario == $resenha->getFk_usuario_id_usuario()){
                echo '<div class="titulo_res">';
                echo '<a class="edicao_resenha" href="">Editar</a>
                <a class="edicao_resenha" href="">Excluir</a> ';
                echo '</div>';
        }
        ?>
            <h4 <?php if($resenha->getFK_usuario_id_usuario() == $id_usuario){echo 'style="order: -1;"';}; ?>></h4>
            <div>
                <?php if(!empty($usuario->getFoto_usu())){ ?>
                <img src="../assets/<?= $usuario->getFoto_usu(); ?>" alt="">
                <?php }else{ ?>   
                <h3><?= substr($usuario->getNome_usu(), 0, 1); ?></h3>
                <?php }; ?>   
                <div>
                <p><?= $usuario->getNome_usu(); ?></p>
                <span><?= $resenha->getDt_hora_res(); ?></span>
                </div>
            </div>
            <h3 class="title"><?= $resenha->getTitulo_res(); ?></h3>
            <?php if(!empty($resenha->getDescricao_res())){ ?>
                <p><?= $resenha->getDescricao_res(); ?></p>
            <?php } ?>  
        </div>
      <?php
        }
        }
      ?>
        
    </section>


</body>
</html>
