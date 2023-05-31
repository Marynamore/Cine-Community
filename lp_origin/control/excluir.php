<?php
require_once "../model/dao/UsuarioDAO.php";
$id_usuario = $_GET["id"];
$UsuarioDAO = new UsuarioDAO();
$retorno = $UsuarioDAO->excluirUsuarioById($id_usuario);
$msg="";
if($retorno){
    $msg="Usuario excluido com sucesso!";
}else{
    $msg="Erro ao excluir o Usuario";
} 
header("location:../view/listausuarioadm.php?msg=$msg");


