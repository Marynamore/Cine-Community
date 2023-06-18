<?php
require_once '../model/dao/transacaoDAO.php';
require_once '../model/dao/compraDAO.php';
require_once '../model/dao/carrinhoDAO.php';

$transacaoDAO = new TransacaoDAO();
$compraDAO = new CompraDAO();
$carrinhoDAO = new CarrinhoDAO();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $method = strip_tags($_POST['pix']);
    $preco_item = strip_tags($_POST["preco_item"]);
    $id_compra = strip_tags($_POST["id_compra"]);
    $id_carrinho = strip_tags($_POST["id_carrinho"]);
    $id_item = strip_tags($_POST["id_item"]);
    $id_perfil = isset($_POST['id_perfil']) ? $_POST['id_perfil'] : null;
    $id_usuario = $_POST["id_usuario"];
    $qtd_trans = strip_tags($_POST["qtd_item"]);

    $carrinhoFetch = $carrinhoDAO->obterItemCarPorId($id_usuario, $id_perfil);

    // if ($method === 'pix') {
    //     // Processar código QR
    //     $qrCodeUrl = processarCodigoQR($dados);
        
    //     if ($qrCodeUrl !== false) {
    //         // Exibir o código QR
    //         echo "Código QR: " . $qrCodeUrl;
    //     } else {
    //         echo "Não foi possível gerar o código QR.";
    //     }
    // } else {
    //     echo "<script>location.href='../view/transacao.php?erro=Método inválido';</script>";
    // }

    if (isset($_GET['id_item'])) {
        $itemFetch = $itemDAO->obterItemPorId($_GET['id_item']);

        if ($itemFetch->rowCount() > 0) {
            while ($item = $itemFetch->fetch(PDO::FETCH_ASSOC)) {

                // Salvar a compra no banco de dados
                $compraFetch = $compraDAO->adicionarCompra($id_usuario, $id_transacao, $method, $preco_item, $id_compra, $id_carrinho, $id_item, $id_perfil, $id_usuario, 1);
                header('location: ../view/meus_pedidos.php');
            }
        } else {
            echo 'Algo deu errado!';
        }
    } elseif ($carrinhoFetch->rowCount() > 0) {
        while ($carrinho = $carrinhoFetch->fetch(PDO::FETCH_ASSOC)) {
            
            // Salvar a compra no banco de dados
            $compraFetch = $compraDAO->adicionarCompra($id_usuario, $id_transacao, $method, $preco_item, $id_compra, $id_carrinho, $id_item, $id_perfil, $id_usuario, $qtd_trans);
        }
    }
    
    

    // // Salvar a transação no banco de dados
    // $transacaoDAO->criarTransacao($id_usuario, $id_transacao, $method, $preco_item, $id_compra, $id_carrinho, $id_item, $id_perfil, $id_usuario, $qtd_trans);

    // if ($transacaoDAO) {
    //     // Buscar essa transacao no banco
    //     $transacao = $transacaoDAO->obterTransacaoPorRef($ref_mp);
    //     echo "<script>location.href='../view/transacao.php?id_transacao=$transacao->id_transacao';</script>";
    // } else {
    //     echo "<script>location.href='../view/transacao.php?erro=Erro ao criar transação';</script>";
    // }
} else {
    echo "<script>location.href='../view/detalhe_item.php?erro=Requisição inválida';</script>";
}



