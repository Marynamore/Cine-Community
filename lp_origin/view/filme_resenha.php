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

if (isset($_SESSION["id_usuario"])) {
    $usuarioLogado = $_SESSION["nickname_usu"];
    $id_usuarioLogado = $_SESSION["id_usuario"];
    $id_perfil = $_SESSION["id_perfil"];
} else {
    $id_usuarioLogado = "";
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/resenhas.css">
    <link rel="stylesheet" href="../css/denunciar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <link rel="apple-touch-icon" sizes="180x180" href="favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon_io/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <title>Cine Community</title>
</head>

<body>
    <div class="overlay"></div>
    <div class="modal" id="modal-denunciar">
        <div class="div_login">
            <form action="../control/control_denuncia.php" method="post" id="form-denunciar">
                <h1>Denunciar</h1><br>
                <input type="hidden" name="id_resenha" id="resenha-id">
                <input type="text" name="titulo_res" placeholder="Titulo da resenha" class="input">
                <br><br>
                <input type="text" name="denuncia_res" placeholder="Motivo" class="input">
                <br><br>
                <button class="button">Enviar</button>
            </form>
            <button class="close-button" onclick="closeModal('modal-denunciar')">&times;</button>
        </div>
    </div>
    <header class="header">
        <a href="../index.php" class="logo"><img src="../assets/logoinicio.png" alt="index.php"></a>
        <nav class="navbar" style="-i:1;">
            <a href="../index.php" style="-i:2;"><i class="fa-solid fa-house"></i>INICIO</a>
            <?php
                if (!empty($usuarioLogado)) {
                    if ($id_perfil == 3 || $id_perfil == 4) {
                        echo '<a href="./view/perfil_usuario.php?id_usuario=' . $id_usuarioLogado . '" onclick="funcPerfil()"><i class="fa-solid fa-user"></i>' . $usuarioLogado . '</a>';
                        echo '<a class="border1" href="./control/control_sair.php" class="item_menu"><i class="fa-solid fa-right-from-bracket"></i>SAIR</a>';
                    }
                } else {
                    echo '<a href="./view/cadastro.php"><i class="fa-solid fa-user"></i>CADASTRO</a>';
                    echo '<a href="./view/login.php"><i class="fa-solid fa-user"></i>LOGIN</a>';
                }
                ?>
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
                    <h3>Canal:<br><?= $filmeFetch->getFk_id_canal_filme(); ?></h3>
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
                    if ($id_usuarioLogado == $resenha->getFk_id_usuario()) {
                        echo '<a href="./alterar_resenha.php?id_resenha=' . $resenha->getId_resenha() . '" class="edicao_resenha">Editar</a>';
                        echo '<a href="../control/excluir_resenha.php?id_resenha=' . $resenha->getId_resenha() . '" class="edicao_resenha" onclick="return confirm(\'Quer deletar essa Resenha?\');">Excluir</a>';

                    }
                    ?>
                    <button class="modal-link" onclick="openModal('modal-denunciar', <?php echo $resenha->getId_resenha(); ?>)">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                        </svg>
                    </button>


                    <div class="overlay"></div>
                    <div class="modal" id="modal-denunciar">
                        <div class="div_login">
                            <form action="../control/control_denuncia.php" method="post" id="form-denunciar">
                                <h1>Denunciar</h1><br>
                                <input type="hidden" name="id_resenha" value="<? $id_resenha ?>">
                                <input type="text" name="titulo_res" placeholder="Titulo da resenha" class="input">
                                <br><br>
                                <input type="text" name="denuncia_res" placeholder="Motivo" class="input">
                                <br><br>
                                <button class="button">Enviar</button>
                            </form>
                            <div class="modal" id="modal-denunciar">
                            <button class="close-button" onclick="closeModal('modal-denunciar')">&times;</button>
                            </div>
                        </div>
                    </div>


                </div>
                <h4 <?php if ($resenha->getFK_id_usuario() == $id_usuarioLogado) ?>></h4>
                <div>
                    <?php if (!empty($usuario)) { ?>
                        <img class='profile' src="../assets/pessoas/<?= $usuario['foto_usu']; ?>" alt="">
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
                <button id="like">
                    <div class="curtirresenha">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M8.4 5.25C5.61914 5.25 3.25 7.3293 3.25 10.0298C3.25 11.8927 4.12235 13.4612 5.27849 14.7604C6.43066 16.0552 7.91714 17.142 9.26097 18.0516L11.5796 19.6211C11.8335 19.793 12.1665 19.793 12.4204 19.6211L14.739 18.0516C16.0829 17.142 17.5693 16.0552 18.7215 14.7604C19.8777 13.4612 20.75 11.8927 20.75 10.0298C20.75 7.3293 18.3809 5.25 15.6 5.25C14.1665 5.25 12.9052 5.92214 12 6.79183C11.0948 5.92214 9.83347 5.25 8.4 5.25Z" fill="black" />
                        </svg>
                        Curtir
                    </div>
                    <div class="number" id="number">0</div>
                </button>
            </div>

    <?php
        }
    }
    ?>
</section>

<script src="../js/curtiresenha.js"></script>
<script>
    function openModal(modalId, resenhaId) {
        // Obter o elemento do formulário pelo ID
        var form = document.getElementById('form-denunciar');

        // Remover o campo oculto existente (se houver)
        var existingInput = document.getElementById('resenha-id');
        if (existingInput) {
            form.removeChild(existingInput);
        }

        // Criar um novo campo oculto com o ID da resenha
        var input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'id_resenha';
        input.id = 'resenha-id';
        input.value = resenhaId;

        // Adicionar o novo campo oculto ao formulário
        form.appendChild(input);

        // Abrir o modal
        var modal = document.getElementById(modalId);
        modal.style.display = "block";
    }
        function closeModal(modalId) {
  var modal = document.getElementById(modalId);
  modal.style.display = "none";
}


    
</script>
</body>

</html>