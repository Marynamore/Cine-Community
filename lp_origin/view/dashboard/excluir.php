<?php
require_once "../../model/dao/filmeDAO.php";

if (isset($_GET["id_filme"])) {
    $id_filme = $_GET["id_filme"];
    $FilmeDAO = new FilmeDAO();
    $retorno = $FilmeDAO->excluirFilmeById($id_filme);
    $msg = ($retorno) ? "Filme excluído com sucesso!" : "Erro ao excluir o filme";
} else {
    $msg = "ID do filme não fornecido";
}

header("Location: ./listafilmemod.php?msg=" . urlencode($msg));
exit;
?>