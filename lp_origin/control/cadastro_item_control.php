<?php

require_once __DIR__ . "/../model/dao/itemDAO.php";
require_once __DIR__ . "/../model/dto/itemDTO.php";

$nome_item     = filter_input(INPUT_POST, 'nome_item');
$descricao_res  = filter_input(INPUT_POST, 'descricao_res');
$qtd_item   = filter_input(INPUT_POST, 'qtd_item');
$preco_item   = filter_input(INPUT_POST, 'preco_item');
$id_categoria_item = isset($_POST['fk_id_categoria_item']) ? $_POST['fk_id_categoria_item'] : null;
$id_usuario = isset($_POST['fk_id_usuario']) ? $_POST['fk_id_usuario'] : null;
$id_perfil = isset($_POST['fk_id_perfil']) ? $_POST['fk_id_perfil'] : null;

$imagem_item = $_FILES['imagem_item'];

if ($imagem_item['error'] === UPLOAD_ERR_OK) {
    $nome_arquivo = $imagem_item['name'];
    $caminho_temporario = $imagem_item['tmp_name'];
    $caminho_destino = '../assets/imagensprodutos/' . $nome_arquivo;
    move_uploaded_file($caminho_temporario, $caminho_destino);


$itemDTO = new ItemDTO();
$itemDTO->setImagem_item($nome_arquivo);
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
}else {
    echo "Erro ao fazer upload da imagem do item.";
    exit;
}