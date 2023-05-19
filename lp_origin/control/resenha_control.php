<?php
require_once "../model/dto/resenhaDTO.php";
require_once "../model/dao/resenhaDAO.php";

session_start();

if(isset($_SESSION['id_usuario'])) {
$id_usuario    = filter_input( INPUT_POST, 'fk_usuario_id_usuario',FILTER_SANITIZE_NUMBER_INT);
$titulo_res    = filter_input( INPUT_POST, 'titulo_res');
$descricao_res = filter_input( INPUT_POST, 'descricao_res');
$id_filme      = filter_input( INPUT_POST, 'fk_filme_id_filme');
$dt_hora =  date_create($_POST['dt_hora_res'])->format('Y-m-d H:i:s');


$resenhaDTO = new ResenhaDTO(); 
$resenhaDTO->setTitulo_res($titulo_res);
$resenhaDTO->setDescricao_res( $descricao_res );
$resenhaDTO->setFk_usuario_id_usuario( $id_usuario );
$resenhaDTO->setDt_hora_res($dt_hora);
$resenhaDTO->setFk_filme_id_filme( $id_filme );


$ResenhaDAO = new ResenhaDAO();
$ResenhaDAO->cadastrarResenha($resenhaDTO);

if (isset( $ResenhaDAO ) ) {
    header( "Location:../view/filme_resenha.php" );

} else {
    header( "Location:../view/resenha.php" );

}
}else{
    echo 'Usuario não encontrado!';
}