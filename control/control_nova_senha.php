<?php
require_once '../model/dto/UsuarioDTO.php';
require_once '../model/conexao.php';

$chave = trim(filter_input(INPUT_POST, 'chave'));
$email_usu = trim(filter_input(INPUT_POST, 'email_usu', FILTER_VALIDATE_EMAIL));
$senha_usu = trim(filter_input(INPUT_POST, 'senha_usu'));

if ($senha_usu === $senha_usu) {
    $senha_usu = md5($senha_usu);

    $pdo = Conexao::getInstance();
    $sql = $pdo->prepare("SELECT * FROM usuario WHERE email_usu = :email_usu");
    $sql->bindValue(':email_usu', $email_usu);
    $sql->execute();

    $user = $sql->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $chaveCorreta = sha1($user["id_usuario"] . $user["senha_usu"]);
        if ($chaveCorreta == $chave) {
            $userId = $user["id_usuario"];
        } else {
            header('location:../View/nova_senha.php?chave=' . $chave);
            die;
        }
    }

    if ($userId) {
        $sql = $pdo->prepare("UPDATE usuario SET senha_usu = :senha_usu WHERE id_usuario = :id_usuario");
        $sql->bindValue(':senha_usu', $senha_usu);
        $sql->bindValue(':id_usuario', $userId);
        $sql->execute();
    }

    header('location:../View/login.php?msg=Senha alterada com sucesso.');
} else {
    header('location:../View/alterarSenha.php?chave=' . $chave);
}
?>
