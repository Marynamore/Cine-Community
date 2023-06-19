<?php
require_once '../model/dao/compraDAO.php';
require_once '../model/dao/carrinhoDAO.php';
require_once '../model/dao/itemDAO.php';

$compraDAO = new CompraDAO();
$carrinhoDAO = new CarrinhoDAO();
$itemDAO = new ItemDAO();

$method = isset($_POST['tipo_pagamento']) ? strip_tags($_POST['tipo_pagamento']) : '';
$id_usuario = filter_input(INPUT_POST, 'id_usuario');
$id_perfil = filter_input(INPUT_POST, 'id_perfil');
$status_compra = "Pendente"; // Defina o status da compra
$tipo_pagamento = strip_tags($_POST["tipo_pagamento"]);

if (isset($_GET['id_item']) && isset($_POST['tipo_pagamento'])) {
    $itemFetch = $itemDAO->obterItemPorId($_GET['id_item']);

    if ($itemFetch) {
        // Salvar a compra no banco de dados
        $compraFetch = $compraDAO->adicionarCompra($id_usuario, $itemFetch['qtd_compra'], $itemFetch['preco'], $status_compra, $tipo_pagamento, $itemFetch['fk_id_item'], $id_perfil);

        header('location: ../view/meus_pedidos.php');
    } else {
        echo "<script>location.href='../view/todos_itens.php?erro=Erro ao criar transação';</script>";
    }
} else {
    // Chama o método para obter os itens do carrinho
    $carrinhoFetch = $carrinhoDAO->obterItemCarPorId($id_usuario, $id_perfil);

    if ($carrinhoFetch) {
        foreach ($carrinhoFetch as $carrinho) {
            $itemFetch = $itemDAO->obterItemPorId($carrinho->getFk_id_item());

            if ($itemFetch) {
                // Salvar a compra no banco de dados
                $compraFetch = $compraDAO->adicionarCompra($id_usuario, $carrinho->getQtd_compra(), $carrinho->getPreco(), $status_compra, $tipo_pagamento, $carrinho->getFk_id_item(), $id_perfil);
            } else {
                echo "<script>location.href='../view/todos_itens.php?erro=Erro ao criar transação';</script>";
            }
        }
    } else {
        echo 'Carrinho vazio!';
    }
    '<pre>';
    var_dump($compraDAO);
    '</pre>';
}
// if ($compraFetch) {
//             header('Location: ../view/meus_pedidos.php');
//             exit(); // Adicione esta linha para interromper a execução do código restante
//         } else {
//             echo "<script>location.href='../view/todos_itens.php?erro=Erro ao criar transação';</script>";
//             exit(); // Adicione esta linha para interromper a execução do código restante
//         }
