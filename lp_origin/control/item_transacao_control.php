<?php
require_once '../model/dao/compraDAO.php';
require_once '../model/dao/carrinhoDAO.php';
require_once '../model/dao/itemDAO.php';

$compraDAO = new CompraDAO();
$carrinhoDAO = new CarrinhoDAO();
$itemDAO = new ItemDAO();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $method = strip_tags($_POST['tipo_pagamento']);
    $preco_item = strip_tags($_POST["preco_item"]);
    $id_item = strip_tags($_POST["id_item"]);
    $id_perfil = isset($_POST['id_perfil']) ? $_POST['id_perfil'] : null;
    $id = $_POST["id_usuario"];
    $qtd_compra = strip_tags($_POST["qtd_compra"]);

    $carrinhoFetch = $carrinhoDAO->obterItemCarPorId($id, $id_perfil);

    if (isset($_GET['id_item'])) {
        $itemFetch = $itemDAO->obterItemPorId($_GET['id_item']);

        if ($itemFetch) {
            // Salvar a compra no banco de dados
            $compraFetch = $compraDAO->adicionarCompra($id_usuario, $quant_compra, $preco_compra, $dt_hora_compra, $status_compra, $tipo_pagamento, $id_item, $id_perfil);
            header('location: ../view/meus_pedidos.php');
        } else {
            echo 'Algo deu errado!';
        }
    } elseif ($carrinhoFetch->rowCount() > 0) {
        while ($carrinho = $carrinhoFetch->fetch(PDO::FETCH_ASSOC)) {
            
            // Salvar a compra no banco de dados
            $compraFetch = $compraDAO->adicionarCompra($id_usuario, $quant_compra, $preco_compra, $dt_hora_compra, $status_compra, $tipo_pagamento, $id_item, $id_perfil);
        }
    }


    if ($compraFetch) {
        echo "<script>location.href='../view/meus_pedidos.php';</script>";
    } else {
        echo "<script>location.href='../view/transacao.php?erro=Erro ao criar transação';</script>";
    }
} else {
    echo "<script>location.href='../view/detalhe_item.php?erro=Requisição inválida';</script>";
}