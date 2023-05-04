<?php
session_start();
require_once __DIR__ . "/../model/dao/UsuarioDAO.php";
require_once __DIR__ . "/../model/dto/UsuarioDTO.php";

$email_usu = trim( filter_input( INPUT_POST, 'email_usu', FILTER_VALIDATE_EMAIL ) );
$senha_usu = trim( filter_input( INPUT_POST, 'senha_usu' ) );

$usuarioDTO = new UsuarioDTO();
$usuarioDTO->setEmail_usu( $email_usu );
$usuarioDTO->setSenha_usu( $senha_usu );

$usuarioDAO    = new UsuarioDAO();
$usuarioLogado = $usuarioDAO->logar( $usuarioDTO );

if (isset($usuarioLogado)) {
    $_SESSION["id_usuario"] = $usuarioLogado->getid_usuario();
    $_SESSION["nickname_usu"] = $usuarioLogado->getNickname_usu();
    $_SESSION["perfil_usu"] = $usuarioLogado->getPerfil_usu();
    $_SESSION["nome_usu"] = $usuarioLogado->getNome_usu();
    
    
    if($_SESSION["perfil_usu"] == 'administrador'){
        header("Location:../view/adm/painel_adm.php");
    }elseif($_SESSION["perfil_usu"] == 'moderador'){
        header("Location:../adm_usu.php");
    }elseif($_SESSION["perfil_usu"] == 'usuario'){
        header( "Location:../index.php");
    }
} else {
    header( "location:../view/login.php?msg=usuário e/ou senha inválidos" );
}
echo '<pre>';
print_r($usuarioLogado);
echo '</pre>';