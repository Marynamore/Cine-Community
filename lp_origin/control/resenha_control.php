<?php

session_start();
require_once "../model/dto/resenhaDTO.php";
require_once "../model/dao/resenhaDAO.php";

if (isset($_SESSION['id_usuario'])){
    $titulo_res = filter_input(INPUT_POST, 'titulo_res');
    $descricao_res = filter_input(INPUT_POST, 'descricao_res');
    $id_filme = isset($_POST['fk_id_filme']) ? $_POST['fk_id_filme'] : null;
    $id_usuario = isset($_POST['fk_id_usuario']) ? $_POST['fk_id_usuario'] : null;
    $id_perfil = isset($_POST['fk_id_perfil']) ? $_POST['fk_id_perfil'] : null;
    $dt_hora_res = date('Y-m-d H:i:s');

    $resenhaDTO = new ResenhaDTO();
    $resenhaDTO->setTitulo_res($titulo_res);
    $resenhaDTO->setDescricao_res($descricao_res);
    $resenhaDTO->setFk_id_usuario($id_usuario);
    $resenhaDTO->setFk_id_perfil($id_perfil);
    $resenhaDTO->setDt_hora_res($dt_hora_res);
    $resenhaDTO->setFk_id_filme($id_filme);

    $resenhaDAO = new ResenhaDAO();
    $cadastrado = $resenhaDAO->cadastrarResenha($resenhaDTO);

    var_dump($cadastrado);

    if ($cadastrado) {
        header("Location: ../view/filme_resenha.php");
        exit();
    } else {
        header("Location: ../view/resenha.php");
        exit();
    }
} else {
    echo 'Usuário não encontrado!';
}