<?php
require_once "../model/dao/filmeDAO.php";
require_once "../model/dto/filmeDTO.php";

$id_filme               = filter_input(INPUT_POST,'id_filme');
$nome_filme             = filter_input(INPUT_POST,'nome_filme');
//$dt_de_lancamento_filme = filter_input(INPUT_POST,'dt_de_lancamento_filme');
//$duracao_filme          = filter_input(INPUT_POST,'duracao_filme'); 
$sinopse_filme          = filter_input(INPUT_POST,'sinopse_filme');
$genero_filme           = filter_input(INPUT_POST,'genero_filme');
$classificacao_filme    = filter_input(INPUT_POST,'classificacao_filme');
//$capa_filme             = filter_input(INPUT_POST,'capa_filme');
$canal_filme            = filter_input(INPUT_POST,'canal_filme');

$FilmeDTO = new FilmeDTO();

$FilmeDTO->setNome_filme($nome_filme);
//$FilmeDTO->setDt_de_lancamento_filme($dt_de_lancamento_filme);
//$FilmeDTO->setDuracao_filme($duracao_filme);
$FilmeDTO->setSinopse_filme($sinopse_filme);
$FilmeDTO->setGenero_filme($genero_filme);
$FilmeDTO->setClassificacao_filme($classificacao_filme);
$FilmeDTO->setCapa_filme($capa_filme);
//$FilmeDTO->setTrailer_filme($trailer_filme);
$FilmeDTO->setCanal_filme($canal_filme);
$FilmeDTO->setId_filme($id_filme);

$FilmeDAO = new FilmeDAO();
$FilmeDAO->alterarFilme($FilmeDTO);

echo'<pre>';
var_dump($FilmeDAO);
echo'</pre>';

$msg="filme alterado com sucesso!";
header("location:../view/lista.php?msg=$msg");






?>