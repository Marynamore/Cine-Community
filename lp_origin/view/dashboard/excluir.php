<?php
require_once "../../model/dao/UsuarioDAO.php";
$id_usuario = $_GET["id"];
$UsuarioDAO = new UsuarioDAO();

$retorno = $UsuarioDAO->excluirUsuarioById($id_usuario);
$msg = "Usuário excluido com sucesso!";

header("location:listausuarioadm.php?msg=$msg");


