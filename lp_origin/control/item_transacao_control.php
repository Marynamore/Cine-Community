<?php
require_once '../model/dao/transacaoDAO.php';
require_once '../model/dao/compraDAO.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $method         = strip_tags($_POST['pix']);

    $preco_item    = strip_tags($_POST["preco_item"]);
    $id_compra     = strip_tags($_POST["id_compra"]);
    $id_carrinho   = strip_tags($_POST["id_carrinho"]);
    $id_item       = strip_tags($_POST["id_item"]);
    $id_perfil = isset($_POST['id_perfil']) ? $_POST['id_perfil'] : null;
    $id_usuario = $_POST["id_usuario"];
    $qtd_trans     = strip_tags($_POST["qtd_item"]);
    
    $transacaoDAO = new TransacaoDAO();
    $compraDAO = new CompraDAO();

    $itemFetch = $itemDAO->obterItemPorId($id_item);

    $dados = [
        'pixKey' => $this->chavePix,
        'merchantName' => 'Nome do estabelecimento',
        'merchantCity' => 'Cidade do estabelecimento',
        'amount' => number_format($this->valor, 2, '.', ''),
        'txid' => uniqid(), // Identificador único da transação
    ];

    // Verificar o método de pagamento selecionado
    if ($method === 'pix') {
        $qrCodeData->lerCodigoQR($qrCodeUrl);
        
        if ($qrCodeData !== false) {
            // Processar os dados do código QR
            // ...
    
            // Exemplo: exibir o conteúdo decodificado
            echo "Conteúdo do código QR: " . $qrCodeData;
        } else {
            echo "Não foi possível ler o código QR.";
        }
    } else {
        echo "<script>location.href='../view/transacao.php?ERRO ao Acessar o Metodo';</script>";
    }

    // Salvar a compra no banco de dados
    $compraDAO->adicionarCompra($id_usuario, $id_transacao, $method, $preco_item, $id_compra,$id_carrinho,$id_item,$id_perfil,$id_usuario, $qtd_trans);

    // Salvar a transação no banco de dados
    $transacaoDAO->criarTransacao($id_usuario, $id_transacao, $method, $preco_item, $id_compra,$id_carrinho,$id_item,$id_perfil,$id_usuario, $qtd_trans);

    if ($transacaoDAO) {
        //Buscar essa transacao no banco
        $transacaoDAO->obterTransacaoPorRef($ref_mp);
        echo "<script>location.href='../view/transacao.php?id_transacao=$id_transacao';</script>";
    } else {
        echo "<script>location.href='../view/transacao.php?ERRO';</script>";
    }

}else{
    echo "<script>location.href='../view/detalhe_item.php?ERRO';</script>";
}


