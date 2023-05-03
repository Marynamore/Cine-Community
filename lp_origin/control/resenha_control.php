<?php
require_once "../model/dto/resenhaDTO.php";
require_once "../model/dao/resenhaDAO.php";


$id = idUnico();
$titulo_res    = filter_input( INPUT_POST, 'titulo_res');
$descricao_res = filter_input( INPUT_POST, 'descricao_res');
$id_usuario    = filter_input( INPUT_POST, 'fk_usuario_id_usuario');
$id_filme      = filter_input( INPUT_POST, 'fk_filme_id_filme');


$resenhaDTO = new ResenhaDTO(); 
$resenhaDTO->setTitulo_res($titulo_res);
$resenhaDTO->setDescricao_res( $descricao_res );
$resenhaDTO->setFk_usuario_id_usuario( $id_usuario );
$resenhaDTO->setFk_filme_id_filme( $id_filme );

$resenhaDAO = new ResenhaDAO();
$resenhaDAO->cadastrarResenha($resenhaDTO);


if (isset( $resenhaDAO ) ) {
    header( "Location:../view/filme_resenha.php" );
    exit;
} else {
    header( "Location:../view/resenha.php" );
    exit;
}

