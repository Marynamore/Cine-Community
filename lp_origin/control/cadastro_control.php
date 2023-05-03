<?php

require_once __DIR__ . "/../model/dao/UsuarioDAO.php";
require_once __DIR__ . "/../model/dto/UsuarioDTO.php";

$nome_usu     = $_POST['nome_usu'];
$nickname_usu = $_POST['nickname_usu'];
$dt_de_nasci_usu  =  $_POST['dt_de_nasci_usu'];
 $Result=explode('/', $dt_de_nasci_usu);
 $dia = $Result[0];
 $mes = $Result[1];
 $ano = $Result[2];
$dt_de_nasci_usu = $ano.'-'.$mes.'-'.$dia;
$fk_genero_usu_id_genero_usu  = $_POST['fk_genero_usu_id_genero_usu'];
$email_usu    = $_POST['email_usu'];
$senha_usu    = $_POST['senha_usu'];
$perfil_usu   = $_POST['perfil_usu'];

$usuarioDTO = new UsuarioDTO();

$usuarioDTO->setNome_usu( $nome_usu );
$usuarioDTO->setNickname_usu( $nickname_usu );
$usuarioDTO->setDt_de_nasci_usu( $dt_de_nasci_usu );
$usuarioDTO->setFk_genero_usu_id_genero_usu( $fk_genero_usu_id_genero_usu );
$usuarioDTO->setEmail_usu( $email_usu );
$usuarioDTO->setSenha_usu( $senha_usu );
$usuarioDTO->setPerfil_usu($perfil_usu);

$usuarioDAO = new UsuarioDAO();
$usuarioDAO->cadastrarUsuario( $usuarioDTO );

if ( isset( $usuarioDAO ) ) {
    header( "Location:../index.php" );
    exit;
} else {
    header( "Location:../view/cadastro.php" );
    exit;
}


