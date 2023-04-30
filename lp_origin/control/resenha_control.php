<?php
require_once "../model/dto/resenha_dto.php";
require_once "../model/dao/resenha_dao.php";

$descricao_res = filter_input( INPUT_POST, 'descricao_res' );
$id_usuario    = filter_input( INPUT_POST, 'id_usuario' );
$id_filme      = filter_input( INPUT_POST, 'id_filme' );


$resenhaDTO = new ResenhaDTO();

$resenhaDTO->setDescricao_res( $descricao_res );
$resenhaDTO->setFk_usuario_id_usuario( $id_usuario );
$resenhaDTO->setFk_filme_id_filme( $id_filme );
$resenhaDTO->setDt_hora_res(date("d/m/Y H:i:s"));

$resenhaDAO = new ResenhaDAO();
$resenhaDAO->CadastrarResenha( $resenhaDTO );
//header( 'Location:../View/verMais.php?id='.$postagemId );



