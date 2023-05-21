<?php
require_once "../model/dto/UsuarioDTO.php";
require_once "../model/dao/UsuarioDAO.php";

// Recebendo os dados do formulário
$id_usuario = filter_input(INPUT_POST, 'id_usuario');
$nome_usu = filter_input(INPUT_POST, 'nome_usu');
$nickname_usu = filter_input(INPUT_POST, 'nickname_usu');
$genero_usu = filter_input(INPUT_POST, 'genero_usu');
$dt_de_nasci_usu = filter_input(INPUT_POST, 'dt_de_nasci_usu');

// Convertendo a data de nascimento para o formato do banco de dados
$Result = explode('/', $dt_de_nasci_usu);
$dia = $Result[0];
$mes = $Result[1];
$ano = $Result[2];
$dt_de_nasci_usu = $ano . '-' . $mes . '-' . $dia;

$email_usu = filter_input(INPUT_POST, 'email_usu', FILTER_VALIDATE_EMAIL);
$senha_usu = md5(filter_input(INPUT_POST, 'senha_usu'));

// Criando um objeto UsuarioDTO e definindo os valores dos atributos
$UsuarioDTO = new UsuarioDTO();
$UsuarioDTO->setId_usuario($id_usuario);
$UsuarioDTO->setNome_usu($nome_usu);
$UsuarioDTO->setNickname_usu($nickname_usu);
$UsuarioDTO->setGenero_usu($genero_usu);
$UsuarioDTO->setDt_de_nasci_usu($dt_de_nasci_usu);
$UsuarioDTO->setEmail_usu($email_usu);
$UsuarioDTO->setSenha_usu($senha_usu);

// Criando um objeto UsuarioDAO e chamando o método para alterar o usuário
$UsuarioDAO = new UsuarioDAO();
$UsuarioDAO->alterarUsuario($UsuarioDTO);

// Redirecionando para a página de perfil com uma mensagem de sucesso
$msg = "Usuário alterado com sucesso!";
header("location:../view/adm/listausuarioadm.php?msg=$msg");
?>