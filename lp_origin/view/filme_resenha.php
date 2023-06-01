<?php
session_start();
require_once '../model/dao/filmeDAO.php';
require_once '../model/dao/resenhaDAO.php';
require_once '../model/dao/UsuarioDAO.php';

if (isset($_GET['get_id'])) {
    $get_id = $_GET['get_id'];
} else {
    $get_id = '';
    header('location:../index.php');
}

$FilmeDAO = new FilmeDAO();
$ResenhaDAO = new ResenhaDAO();
$UsuarioDAO = new UsuarioDAO();

$nickname_usu = isset($_SESSION["nickname_usu"]) ? $_SESSION["nickname_usu"] : '';
$id_usuario = isset($_SESSION['id_usuario']) ? $_SESSION['id_usuario'] : '';
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
    <script>
        function funcEditarRes() {
            alert("Em breve:\nA função EDITAR estará disponível");
        }

        function funcExcluirRes() {
            alert("Em breve:\nA função EXCLUIR estará disponível");
        }
    </script>
</head>
<body>
    <header class="header">
        <a href="../index.php" class="logo"><img src="../assets/logoinicio.png" alt="index.php"></a>
        <nav class="navbar" style="-i:1;">
            <a href="#" style="-i:2;"><i class="fa-solid fa-house"></i>INICIO</a>
            <a href="../view/cadastro.php" style="-i:3;"><i class="fa-solid fa-user"></i>CADASTRO</a>
            <a href="../view/login.php" style="-i:4;"><i class="fa-solid fa-user"></i><?= $nickname_usu; ?></a>
        </nav>
    </header>
    <div id="all">
        <div class="titulo">
            <h1>Resenha Filme</h1>
            <a href="../index.php" class="criar_resenha">Voltar Filmes</a>
        </div>

    <?php
    $filmeFetch = $FilmeDAO->selecionarFilmesComCategoria($get_id);
    if ($filmeFetch) {
    ?>
        <div class="dados-filme">
            <img src="../assets/<?= $filmeFetch->getCapa_filme(); ?>" alt="" class="poster">
            <div>
                <h1><?= $filmeFetch->getNome_filme(); ?></h1>
                <h3>Lançamento:<br><?= $filmeFetch->getDt_de_lancamento_filme(); ?></h3>
                <h3>Duração:<br><?= $filmeFetch->getDuracao_filme(); ?></h3>
                <h3>Categoria:<br><?= $filmeFetch->getFk_id_categoria_filme(); ?></h3>
                <h3>Classificação indicativa:<br><?= $filmeFetch->getClassificacao_filme(); ?></h3>
                <h3><a href="">Trailer</a><?= $filmeFetch->getTrailer_filme(); ?></h3>
                <h3>Sinopse:<br><?= $filmeFetch->getSinopse_filme(); ?></h3>
            </div>
        </div>
    </div>

    <?php 
    } else {
        echo '<p>Nenhum Filme Adicionado!</p>';
    }
    ?>

    <section class="resenha">
        <div class="titulo">
            <h1>Resenhas:</h1> 
            <a href="resenha.php?get_id=<?= $get_id; ?>" class="criar_resenha">Criar Resenha</a>
            <input type="hidden" name="fk_id_perfil" id="Usuario" value="4">
            <input type="hidden" name="fk_id_usuario" value="<?= $id_usuario; ?>">
        </div>

        <?php
        $resenhas = $ResenhaDAO->verificarResenha($get_id);

        if (!empty($resenhas)) {
            foreach ($resenhas as $resenha) {
                $usuario = $UsuarioDAO->dadosUsuarioPorId($resenha->getFk_id_usuario());
        ?>

        <div class="resenha">
            <div class="titulo_res">
                <?php
                if ($id_usuario == $resenha->getFk_id_usuario()) {
                    echo '<a href="./alterar_resenha.php?id_resenha=' . $resenha->getId_resenha() . '" class="edicao_resenha">Editar</a>';
                    echo '<a href="../control/excluir_resenha.php?id_resenha=' . $resenha->getId_resenha() . '" class="edicao_resenha">Excluir</a>';
                }
                ?>
            </div>
            <h4 <?php if ($resenha->getFK_id_usuario() == $id_usuario) ?>></h4>
            <div>
                <?php if (!empty($usuario)) { ?>
                    <img src="../assets/<?= $usuario['foto_usu']; ?>" alt="">
                <?php } else { ?>
                    <h3><?= substr($usuario->getNome_usu(), 0, 1); ?></h3>
                <?php } ?>

                <div>
                    <p><?= $usuario['nome_usu']; ?></p>
                    <span><?= $resenha->getDt_hora_res(); ?></span>
                </div>
            </div>

            <h3><?= $resenha->getTitulo_res(); ?></h3>
            
            <?php if (!empty($resenha->getDescricao_res())) { ?>
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