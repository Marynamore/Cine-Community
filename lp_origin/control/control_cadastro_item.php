<?php

require_once "../model/dao/filmeDAO.php";
require_once "../model/dto/filmeDTO.php";

$nome_filme             = filter_input(INPUT_POST, 'nome_filme');
$dt_de_lancamento_filme = date_create($_POST['dt_de_lancamento_filme'])->format('Y-m-d'); 
$duracao_filme          = filter_input(INPUT_POST, 'duracao_filme');
$sinopse_filme          = filter_input(INPUT_POST, 'sinopse_filme');
$classificacao_filme    = filter_input(INPUT_POST,'classificacao_filme');
$id_categoria_filme     = isset($_POST['fk_id_categoria_filme']) ? $_POST['fk_id_categoria_filme'] : null;
$id_canal_filme         = isset($_POST['fk_id_canal_filme']) ? $_POST['fk_id_canal_filme'] : null;
$id_usuario             = isset($_POST['fk_id_usuario']) ? $_POST['fk_id_usuario'] : null;
$id_perfil              = isset($_POST['fk_id_perfil']) ? $_POST['fk_id_perfil'] : null;
$capa_filme = $_FILES['capa_filme'];

if ($capa_filme['error'] === UPLOAD_ERR_OK) {
    $nome_arquivo = $capa_filme['name'];
    $caminho_temporario = $capa_filme['tmp_name'];
    $caminho_destino = '../assets/' . $nome_arquivo;
    move_uploaded_file($caminho_temporario, $caminho_destino);
    
    $FilmeDTO = new FilmeDTO();
    $FilmeDTO->setNome_filme($nome_filme);
    $FilmeDTO->setDt_de_lancamento_filme($dt_de_lancamento_filme);
    $FilmeDTO->setDuracao_filme($duracao_filme);
    $FilmeDTO->setSinopse_filme($sinopse_filme);
    $FilmeDTO->setFk_id_categoria_filme($id_categoria_filme);
    $FilmeDTO->setClassificacao_filme($classificacao_filme);
    $FilmeDTO->setCapa_filme($nome_arquivo);
    $FilmeDTO->setFk_id_canal_filme($id_canal_filme);
    $FilmeDTO->setFk_id_usuario($id_usuario);
    $FilmeDTO->setFk_id_perfil($id_perfil);
    
    $FilmeDAO = new FilmeDAO();
    if ($FilmeDAO->cadastrarFilme($FilmeDTO)) {
        header("Location: ../view/adm/listafilmemod.php");
        exit;
    } else {
        echo "Erro ao cadastrar o filme no banco de dados.";
        exit;
    }
} else {
    echo "Erro ao fazer upload da imagem da capa do filme.";
    exit;
}
