<?php
require_once "../../model/dao/UsuarioDAO.php";
$id_usuario = $_GET["id_usuario"];
$UsuarioDAO = new UsuarioDAO();
$retorno = $UsuarioDAO->excluirUsuarioById($id_usuario);
$msg="";
if($retorno){
    $msg="Usuario excluido com sucesso!";
}else{
    $msg="Erro ao excluir o Usuario";
} 
header("location:listausuarioadm.php?msg=$msg");


