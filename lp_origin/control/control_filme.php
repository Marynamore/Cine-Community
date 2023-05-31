<?php

require_once "../model/dao/filmeDAO.php";
require_once "../model/dto/filmeDTO.php";

$nome_filme             = $_POST['nome_filme'];
$dt_de_lancamento_filme = date_create($_POST['dt_de_lancamento_filme'])->format('Y-m-d'); 
$duracao_filme          = $_POST['duracao_filme'];
$sinopse_filme = iconv('UTF-8', 'UTF-8//IGNORE', 'sinopse_filme');;
$classificacao_filme    = $_POST['classificacao_filme'];
$id_usuario             =  isset($_POST['fk_usuario_id_usuario']) ? $_POST['fk_usuario_id_usuario'] : null;
$categoria_filme = isset($_POST['fk_categoria_filme_id_categoria_filme']) ? $_POST['fk_categoria_filme_id_categoria_filme'] : null;
$canal_filme = isset($_POST['fk_canal_filme_id_canal_filme']) ? $_POST['fk_canal_filme_id_canal_filme'] : null;

$capa_filme = $_FILES['capa_filme'];
$capa_filme_data = array(
    'name' => $capa_filme['name'],
    'type' => $capa_filme['type'],
    'size' => $capa_filme['size'],
    'tmp_name' => $capa_filme['tmp_name']
);
$nome_arquivo = $capa_filme['name'];
$caminho_temporario = $capa_filme['tmp_name'];
$caminho_destino = '../assets/' . $nome_arquivo;
move_uploaded_file($caminho_temporario, $caminho_destino);
$capa_filme_data = $FilmeDTO->getCapa_filme();
$capa_filme_name = $capa_filme_data['name'];
$capa_filme_tmp_name = $capa_filme_data['tmp_name'];
$capa_filme_error = $capa_filme_data['error'];

if ($capa_filme_error === UPLOAD_ERR_OK) {
    $upload_dir = '../assets/';
    $target_file = $upload_dir . $capa_filme_name;
    move_uploaded_file($capa_filme_tmp_name, $target_file);

    $FilmeDTO->setCapa_filme($capa_filme_name);
} else {
    echo "Erro ao fazer upload da imagem da capa do filme.";
}



$FilmeDTO = new FilmeDTO();

$FilmeDTO->setNome_filme( $nome_filme );
$FilmeDTO->setDt_de_lancamento_filme( $dt_de_lancamento_filme );
$FilmeDTO->setDuracao_filme( $duracao_filme );
$FilmeDTO->setSinopse_filme( $sinopse_filme );
$FilmeDTO->setFk_categoria_filme_id_categoria_filme($categoria_filme );
$FilmeDTO->setClassificacao_filme( $classificacao_filme );
$FilmeDTO->setCapa_filme( $capa_filme_da );
$FilmeDTO->setFk_canal_filme_id_canal_filme( $canal_filme );
$FilmeDTO->setFk_usuario_id_usuario( $id_usuario );

$FilmeDAO = new FilmeDAO();
$FilmeDAO->CadastrarFilme($FilmeDTO);
header( "Location:../view/adm/listafilmesadm.php" );

?>