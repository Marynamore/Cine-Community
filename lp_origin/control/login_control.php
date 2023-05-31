<?php
session_start();

require_once '../model/conexao.php';
require_once '../model/dto/UsuarioDTO.php';
require_once '../model/dao/UsuarioDAO.php';

$email_usu = strip_tags($_POST["email_usu"]);
$senha_usu = $_POST["senha_usu"];

$UsuarioDAO = new UsuarioDAO();
$usuarioLogado = $UsuarioDAO->logar($email_usu, $senha_usu);

if (!empty($usuarioLogado)) {
    $_SESSION['id_usuario'] = $usuarioLogado['id_usuario'];
    $_SESSION['nickname_usu'] = $usuarioLogado['nickname_usu'];
    $_SESSION['nome_usu'] = $usuarioLogado['nome_usu'];
    $_SESSION['fk_id_perfil'] = $usuarioLogado['fk_id_perfil'];
    

    $id_perfil = $_SESSION['fk_id_perfil'];

    if (in_array($id_perfil, [2, 3, 4])) {
        header('Location:../index.php');
        exit();
    } elseif(in_array($id_perfil, [1])){
        header('Location:../view/dashboard/painel_adm.php');
        exit();
    }
} else {
    header("Location:../index.php?msg=Usuário e/ou senha inválidos");
    exit;
}
?>
