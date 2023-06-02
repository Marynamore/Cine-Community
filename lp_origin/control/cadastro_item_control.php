<?php

require_once __DIR__ . "/../model/dao/itemDAO.php";
require_once __DIR__ . "/../model/dto/itemDTO.php";

$nome_item     = filter_input(INPUT_POST, 'nome_item');
$imagem_item = filter_input(INPUT_POST, 'imagem_item');
$descricao_res  = filter_input(INPUT_POST, 'descricao_res');
$qtd_item   = filter_input(INPUT_POST, 'qtd_item');
$preco_item   = filter_input(INPUT_POST, 'preco_item');
$id_categoria_item = isset($_POST['fk_id_categoria_item']) ? $_POST['fk_id_categoria_item'] : null;
$id_usuario = isset($_POST['fk_id_usuario']) ? $_POST['fk_id_usuario'] : null;
$id_perfil = isset($_POST['fk_id_perfil']) ? $_POST['fk_id_perfil'] : null;


$itemDTO = new ItemDTO();
$itemDTO->setImagem_item($imagem_item);
$itemDTO->setNome_item($nome_item);
$itemDTO->setDescricao_item($descricao_res);
$itemDTO->setQtd_item($qtd_item);
$itemDTO->setPreco_item($preco_item);
$itemDTO->setFk_id_categoria_item($id_categoria_item);
$itemDTO->setFk_id_usuario($id_usuario);
$itemDTO->setFk_id_perfil($id_perfil);


$itemDAO = new ItemDAO();
$itemDAO->cadastrarItem($itemDTO);


if ($itemDAO) {
    header("Location: ../view/todos_itens.php");
    exit;
} else {
    header("Location: ../view/cadastro_item.php");
    exit;
}