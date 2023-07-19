<?php

require_once "../model/dao/filmeDAO.php";
$id_filme = $_GET["id"];
$FilmeDAO = new FilmeDAO();
$retorno = $FilmeDAO->excluirFilmeById($id_filme);
$msg="";
if($retorno){
    $msg="filme excluido com sucesso!";
}else{
    $msg="Erro ao excluir o filme";
}
header("location:../crud_filme/lista.php?msg=$msg");

