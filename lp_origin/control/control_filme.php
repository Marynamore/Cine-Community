<?php

require_once "../model/dao/filmeDAO.php";
require_once "../model/dto/filmeDTO.php";

$nome_filme             = $_POST['nome_filme'];
//$dt_de_lancamento_filme = filter_input(INPUT_POST,'dt_de_lancamento_filme');
//$duracao_filme          = filter_input(INPUT_POST,'duracao_filme');
$sinopse_filme          = $_POST['sinopse_filme'];
$genero_filme           = $_POST['genero_filme'];
$classificacao_filme    = $_POST['classificacao_filme'];
$capa_filme             = $_POST['capa_filme'];
//$canal_filme            = filter_input(INPUT_POST,'canal_filme');

$FilmeDTO = new FilmeDTO();

$FilmeDTO->setNome_filme( $nome_filme );
//$FilmeDTO->setDt_de_lancamento_filme( $dt_de_lancamento_filme );
//$FilmeDTO->setDuracao_filme( $duracao_filme );
$FilmeDTO->setSinopse_filme( $sinopse_filme );
$FilmeDTO->setGenero_filme( $genero_filme );
$FilmeDTO->setClassificacao_filme( $classificacao_filme );
$FilmeDTO->setCapa_filme( $capa_filme );
//$FilmeDTO->setCanal_filme( $canal_filme );

$FilmeDAO = new FilmeDAO();
$FilmeDAO->CadastrarFilme($FilmeDTO);
header( "Location:../view/lista.php" );

?>