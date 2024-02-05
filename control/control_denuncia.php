<?php
require_once __DIR__. '/../model/dao/resenhaDAO.php';
require_once __DIR__. '/../model/dto/resenhaDTO.php';

$id_resenha = $_POST['id_resenha'];
$denuncia_res = $_POST['denuncia_res'];
$id_usuario = isset($_POST['fk_id_usuario']) ? $_POST['fk_id_usuario'] : null;

$resenhaDAO = new ResenhaDAO();
$success = $resenhaDAO->denunciarResenha($id_resenha, $denuncia_res, $id_usuario);

if ($success) {
    $msg = "Denúncia enviada com sucesso!";
} else {
    $msg = "Erro ao enviar a denúncia.";
}
var_dump($success);
/*
// Redirecionar para a página de resenha do filme
header("Location: ../view/filme_resenha.php?id_resenha=" . $id_resenha . "&msg=" . $msg);
exit();
?>*/