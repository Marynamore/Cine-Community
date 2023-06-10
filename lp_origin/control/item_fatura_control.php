<?php
require_once '../model/dao/transacaoDAO.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $method  = strip_tags($_POST['payment_method_id']);
    // Cria uma instância da classe TransacaoDAO
    $transacaoDAO = new TransacaoDAO();

    // Verificar o método de pagamento selecionado
    if ($method === 'pix') {
        // Chame a função pixMethod() do TransacaoDAO passando os dados de pagamento
        $transacaoDAO->pixMethod($dados_pix);

    } elseif ($method === 'ticket_url') {

        $transacaoDAO->pixMethod($dados_pix);

    } elseif ($method === 'credit_card' || $method === 'debit_card') {
        // Primeiro, obtenha o token do cartão de crédito
        $card_token = $transacaoDAO->tokenDoCartao($card_dados);

        // Verifique se o token do cartão foi obtido com sucesso
        if ($card_token !== false) {
            // Envia a requisição para a API do Mercado Pago
            $response = $transacaoDAO->enviarRequisicao($dados);

            // Analisa a resposta da API e obtém o ID do pagamento
            $idPagamento = $transacaoDAO->obterPagamentoPorID($response);

            // Verifique se o ID do pagamento foi obtido com sucesso
            if ($idPagamento !== false) {
                // Faça o que for necessário com o ID do pagamento
                echo "ID do pagamento: " . $idPagamento;
                header("Location: ../view/pedidos.php");
                exit;
            } else {
                // Trate o erro adequadamente
                echo "Erro ao obter o ID do pagamento";
                header("Location: ../view/transacao.php");
                exit;
            }
        } else {
            // Trate o erro adequadamente
            echo "Erro ao obter o token do cartão";
            header("Location: ../view/transacao.php");
            exit;
        }
    } else {
        echo "<script>location.href='../view/transacao.php?ERRO ao Acessar o Metodo';</script>";
    }
    // Salvar a transação no banco de dados
    $transacaoDAO->criarTransacao($id_usuario, $id_transacao, $ref_mp,);

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

