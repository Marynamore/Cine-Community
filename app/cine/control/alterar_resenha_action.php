<?php
session_start();

require_once "../model/dao/resenhaDAO.php";
require_once "../model/dto/resenhaDTO.php";

$id_resenha = filter_input(INPUT_POST, 'id_resenha');
$avaliacao_res = filter_input(INPUT_POST, 'avaliacao_res');
$descricao_res = filter_input(INPUT_POST, 'descricao_res');
$titulo_res = filter_input(INPUT_POST, 'titulo_res');
$dt_hora_res = filter_input(INPUT_POST, 'dt_hora_res');
$denuncia_res = filter_input(INPUT_POST, 'denuncia_res');
$situacao_res = filter_input(INPUT_POST, 'situacao_res');
$id_filme = isset($_POST['fk_id_filme']) ? $_POST['fk_id_filme'] : null;
$id_usuario = isset($_POST['fk_id_usuario']) ? $_POST['fk_id_usuario'] : null;
$id_perfil = isset($_POST['fk_id_perfil']) ? $_POST['fk_id_perfil']: null;

$ResenhaDTO = new ResenhaDTO();

$ResenhaDTO->setAvaliacao_res($avaliacao_res);
$ResenhaDTO->setTitulo_res($titulo_res);
$ResenhaDTO->setDescricao_res($descricao_res);
$ResenhaDTO->setDt_hora_res($dt_hora_res);
$ResenhaDTO->setDenuncia_res($denuncia_res);
$ResenhaDTO->setSituacao_res($situacao_res);
$ResenhaDTO->setFk_id_filme($id_filme);
$ResenhaDTO->setFk_id_usuario($id_usuario);
$ResenhaDTO->setFk_id_perfil($id_perfil);
$ResenhaDTO->setId_resenha($id_resenha);


$resenhaDAO = new ResenhaDAO();
$success = $resenhaDAO->alterarResenha($ResenhaDTO);

if ($success) {
    if($id_perfil = $_SESSION["id_perfil"]){
        header("Location: ../view/filme_resenha.php?msg=success&action=alterarRes");
        exit;
    } else {
        header("Location: ../view/filme_resenha.php?msg=error&action=alterarRes");
        exit;
    }
}else {
    header("Location: ../view/filme_resenha.php?msg=error&action=alterarRes");
    exit;
}
