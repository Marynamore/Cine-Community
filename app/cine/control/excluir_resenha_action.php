<?php
session_start();

require_once "../model/dao/ResenhaDAO.php";

if (isset($_GET["id_resenha"])) {

    $id_resenha = $_GET["id_resenha"];
    
    $ResenhaDAO = new ResenhaDAO();
    $retorno = $ResenhaDAO->excluirResenhaById($id_resenha);

    if($retorno){
        $id_perfil = $_SESSION["id_perfil"];

        if (in_array($id_perfil, [3, 4])) {
            header("location:../view/filme_resenha.php?msg=success&action=excluirRes");
            exit;
        }
    }
}else{
    header("Location: ../index.php?msg=error&action=excluirRes");
}


