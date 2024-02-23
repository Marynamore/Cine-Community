<?php
session_start();

require_once '../model/dao/UsuarioDAO.php';

$usuarioDAO = new UsuarioDAO();

if (isset($_SESSION["id_usuario"])) {
    $id_perfil = $_SESSION["id_perfil"];
    $id = $_SESSION["id_usuario"];

    $usuario = $usuarioDAO->encontraPorId($id);
} else {
    echo "Usuário não encontrado.";
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Perfil</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/perfil_usuario.css">
    
</head>
<body>
<button onclick="javascript:history.go(-1)" class="alterar">Voltar</button>
<a class="alterar" href="./view/filmefavorito.php?id_usuario=' . $id_usuarioLogado . '" onclick="funcPerfil()"><i class="fa-regular fa-camcorder">Filmes Favoritos</i></a>
    <h2>Confira seus dados:</h2>
    <div class="container">
        <div class="item-details">
            <div class="item-address">
                <fieldset>
                    <legend>Dados Pessoais</legend>
                    <?php if (!empty($usuario)) { ?>
                        <img class='profile' src="../assets/pessoas/<?= $usuario->getFoto_usu(); ?>" alt="">
                    <?php } ?>
                    <p><strong>Nome:</strong> <?= $usuario->getNome_usu() ?></p>
                    <p><strong>Nickname:</strong> <?= $usuario->getNickname_usu() ?></p>
                    <p><strong>Gênero:</strong> <?= $usuario->getGenero_usu() ?></p>
                    <p><strong>Data de Nascimento:</strong> <?= $usuario->getDt_de_nasci_usu() ?></p>
                    <p><strong>Telefone:</strong> <?= $usuario->getTelefone() ?></p>
                    <p><strong>Email:</strong> <?= $usuario->getEmail_usu() ?></p>
                    <p><strong>CPF ou CNPJ:</strong> <?= $usuario->getCpf_cnpj() ?></p>
                </fieldset>
                <fieldset>
                    <legend>Endereço</legend>
                    <p><strong>Endereço:</strong> <?= $usuario->getEndereco() ?></p>
                    <p><strong>Nº:</strong> <?= $usuario->getNumero() ?></p>
                    <p><strong>Complemento:</strong> <?= $usuario->getComplemento() ?></p>
                    <p><strong>Bairro:</strong> <?= $usuario->getBairro() ?></p>
                    <p><strong>Cidade:</strong> <?= $usuario->getCidade() ?></p>
                    <p><strong>CEP:</strong> <?= $usuario->getCep() ?></p>
                    <p><strong>UF:</strong> <?= $usuario->getUF() ?></p>
                </fieldset>
                <button><a class="alterar" href="./alterar_usuario.php?id_usuario=<?= $usuario->getId_usuario() ?>">ALTERAR</a></button>
                <button><a class="alterar" href="../control/excluir_usuario_action.php?id_usuario=<?= $usuario->getId_usuario() ?>" onclick="return confirm('Tem certeza de que deseja excluir o usuário?')">EXCLUIR</a></button>

            </div>
        </div>
    </div>

    <script src="" async defer></script>
</body>
</html>
