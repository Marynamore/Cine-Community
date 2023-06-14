<?php
session_start();
if ($_SESSION['id_perfil'] == 3) {
require_once "../model/dao/ItemDAO.php";
require_once "../model/dto/ItemDTO.php";

$nome_item             = filter_input(INPUT_POST, 'nome_item');
$descricao_item = filter_input(INPUT_POST, 'descricao_item'); 
$preco_item          = filter_input(INPUT_POST, 'preco_item');
$qtd_item          = filter_input(INPUT_POST, 'qtd_item');
$id_categoria_item     = isset($_POST['fk_id_categoria_item']) ? $_POST['fk_id_categoria_item'] : null;
$id_usuario         = isset($_POST['fk_id_usuario']) ? $_POST['fk_id_usuario'] : null;
$id_perfil              = isset($_POST['fk_id_perfil']) ? $_POST['fk_id_perfil'] : null;


if (isset($_FILES['imagem_item']) && $_FILES['imagem_item']['error'] === UPLOAD_ERR_OK) {
    $imagem_item = $_FILES['imagem_item'];
    $nome_arquivo = $imagem_item['name'];
    $caminho_temporario = $imagem_item['tmp_name'];
    $caminho_destino = '../assets/imagensprodutos/' . $nome_arquivo;
    move_uploaded_file($caminho_temporario, $caminho_destino);
} else {
    // Caso contrário, define uma imagem padrão
    $nome_arquivo = 'foto_padrao.jpg'; // Substitua pelo nome do arquivo da imagem padrão
}
    
    $ItemDTO = new ItemDTO();
    $ItemDTO->setNome_item($nome_item);
    $ItemDTO->setDescricao_item($descricao_item);
    $ItemDTO->setPreco_item($preco_item);
    $ItemDTO->setQtd_item($qtd_item);
    $ItemDTO->setfk_id_categoria_item($id_categoria_item);
    $ItemDTO->setImagem_item($nome_arquivo);
    $ItemDTO->setFk_id_usuario($id_usuario);
    $ItemDTO->setFk_id_perfil($id_perfil);
    
    $ItemDAO = new ItemDAO();
    $success = $ItemDAO->cadastrarItem($ItemDTO);

    if ($success) {
        $msg = "item cadastrador com sucesso!";
    } else {
        $msg = "Erro ao cadastrar o item";
    }
    
    if ($_SESSION['id_perfil'] == 3) {
        header("Location: ../view/todos_itens.php?msg=" . urlencode($msg));
} else {
    $msg = "Permissão negada para cadastrar o item";
    header("Location: ../view/dashboard/pagina_de_erro.php?msg=" . urlencode($msg));
   }
 }