<?php
require_once '../model/dao/transacaoDAO.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $method         = strip_tags($_POST['payment_method_id']);

    $nome           = strip_tags($_POST["nome_usu"]);
    $cpf_cnpj       = strip_tags($_POST["cpf_cnpj"]);
    $email = strip_tags($_POST["email_usu"]);
    $email_mercado_pago = $email;
    $telefone       = strip_tags($_POST["telefone"]);
    $endereco       = strip_tags($_POST["endereco"]);
    $numero         = strip_tags($_POST["numero"]);
    $complemento    = strip_tags($_POST["complemento"]); 
    $bairro         = strip_tags($_POST["bairro"]); 
    $cidade         = strip_tags($_POST["cidade"]); 
    $uf             = strip_tags($_POST["uf"]); 
    $cep            = strip_tags($_POST["cep"]); 
    $preco_item    = strip_tags($_POST["preco_item"]);
    $valor_total   = $preco_item;
    $id_perfil = isset($_POST['id_perfil']) ? $_POST['id_perfil'] : null;
    $descricao = $_POST["descricao_item"];
    $id_usuario = $_POST["id_usuario"];
    
    $transacaoDAO = new TransacaoDAO();

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

    } elseif ($method === 'ticket_url') {

        //$transacaoDAO->boletoMethod($dados);

    } elseif ($method === 'credit_card' || $method === 'debit_card') {
        // // Primeiro, obtenha o token do cartão de crédito
        // $card_token = $transacaoDAO->tokenDoCartao($card_dados);

        // // Verifique se o token do cartão foi obtido com sucesso
        // if ($card_token !== false) {
        //     // Envia a requisição para a API do Mercado Pago
        //     $response = $transacaoDAO->enviarRequisicao($dados);

        //     // Analisa a resposta da API e obtém o ID do pagamento
        //     $idPagamento = $transacaoDAO->obterPagamentoPorID($response);

        //     // Verifique se o ID do pagamento foi obtido com sucesso
        //     if ($idPagamento !== false) {
        //         // Faça o que for necessário com o ID do pagamento
        //         echo "ID do pagamento: " . $idPagamento;
        //         header("Location: ../view/pedidos.php");
        //         exit;
        //     } else {
        //         echo "Erro ao obter o ID do pagamento";
        //         header("Location: ../view/transacao.php");
        //         exit;
        //     }
        // } else {
        //     echo "Erro ao obter o token do cartão";
        //     header("Location: ../view/transacao.php");
        //     exit;
        // }
    } else {
        echo "<script>location.href='../view/transacao.php?ERRO ao Acessar o Metodo';</script>";
    }

    // Salvar a transação no banco de dados
    $transacaoDAO->criarTransacao($id_usuario, $id_transacao, $ref_mp);

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


