<?php
require_once "../model/dto/UsuarioDTO.php";
require_once "../model/dao/UsuarioDAO.php";

$id_usuario            = filter_input(INPUT_POST,'id_usuario');
$nome_usu              = filter_input(INPUT_POST,'nome_usu');
$nickname_usu          = filter_input(INPUT_POST,'nickname_usu');
$genero_usu            = filter_input(INPUT_POST,'genero_usu');
$dt_de_nasci_usu       = filter_input(INPUT_POST,'dt_de_nasci_usu'); 
 $Result=explode('/', $dt_de_nasci_usu);
 $dia = $Result[0];
 $mes = $Result[1];
 $ano = $Result[2];
$dt_de_nasci_usu = $ano.'-'.$mes.'-'.$dia;
$email_usu             = filter_input(INPUT_POST,'email_usu',FILTER_VALIDATE_EMAIL);
$perfil_usu            = filter_input(INPUT_POST,'perfil_usu');
$senha_usu             = md5(filter_input(INPUT_POST,'senha_usu'));

$UsuarioDTO = new UsuarioDTO();

$UsuarioDTO->setNome_usu($nome_usu);
$UsuarioDTO->setNickname_usu($nickname_usu);
$UsuarioDTO->setGenero_usu($genero_usu);
//$UsuarioDTO->setDt_de_nasci_usu($dt_de_nasci_usu);
$UsuarioDTO->setEmail_usu($email_usu);
$UsuarioDTO->setPerfil_usu($perfil_usu);
$UsuarioDTO->setSenha_usu($senha_usu);
$UsuarioDTO->setId_usuario($id_usuario);

$UsuarioDAO = new UsuarioDAO();
$UsuarioDAO->alterarUsuario($UsuarioDTO);

echo'<pre>';
var_dump($UsuarioDAO);
echo'</pre>';
//header( "Location:../pages/listausu.php" );


$msg="Usuario alterado com sucesso!";
header("location:../view/perfilusu.php?msg=$msg");






?>