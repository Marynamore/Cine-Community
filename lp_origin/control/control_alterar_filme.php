<?php
session_start();

require_once "../model/dao/filmeDAO.php";
require_once "../model/dto/filmeDTO.php";

$id_filme               = filter_input(INPUT_POST, 'id_filme');
$nome_filme             = filter_input(INPUT_POST, 'nome_filme');
$dt_de_lancamento_filme = filter_input(INPUT_POST, 'dt_de_lancamento_filme');
$duracao_filme          = filter_input(INPUT_POST, 'duracao_filme');
$sinopse_filme          = filter_input(INPUT_POST, 'sinopse_filme');
$classificacao_filme    = filter_input(INPUT_POST, 'classificacao_filme');
$capa_filme             = filter_input(INPUT_POST, 'capa_filme');
$id_categoria_filme     = isset($_POST['fk_id_categoria_filme']) ? $_POST['fk_id_categoria_filme'] : null;
$id_canal_filme         = isset($_POST['fk_id_canal_filme']) ? $_POST['fk_id_canal_filme'] : null;
$id_usuario             = isset($_POST['id_usuario']) ? $_POST['id_usuario'] : null;
$id_perfil              = isset($_POST['id_perfil']) ? $_POST['id_perfil'] : null;

if ($_SESSION['fk_id_perfil'] == 2) {
    $FilmeDTO = new FilmeDTO();

    $FilmeDTO->setId_filme($id_filme);
    $FilmeDTO->setNome_filme($nome_filme);
    $FilmeDTO->setDt_de_lancamento_filme($dt_de_lancamento_filme);
    $FilmeDTO->setDuracao_filme($duracao_filme);
    $FilmeDTO->setSinopse_filme($sinopse_filme);
    $FilmeDTO->setFk_id_categoria_filme($id_categoria_filme);
    $FilmeDTO->setClassificacao_filme($classificacao_filme);
    $FilmeDTO->setCapa_filme($capa_filme);
    $FilmeDTO->setFk_id_canal_filme($id_canal_filme);
    $FilmeDTO->setFk_id_usuario($id_usuario);
    $FilmeDTO->setFk_id_perfil($id_perfil);
    
    $FilmeDAO = new FilmeDAO();
    $success = $FilmeDAO->alterarFilme($FilmeDTO);

    if ($success) {
        $msg = "Filme alterado com sucesso!";
    } else {
        $msg = "Erro ao alterar o filme";
    }
} else {
    $msg = "Permissão negada para alterar o filme";
}

header("Location: ../view/dashboard/listafilmemod.php?msg=" . urlencode($msg));
?>

