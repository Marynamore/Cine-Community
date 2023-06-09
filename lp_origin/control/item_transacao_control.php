<?php
require_once '../model/dao/transacaoDAO.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $method         = strip_tags($_POST['payment_method_id']);

    // Obtém os valores do formulário
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
    $nome_card   = strip_tags($_POST['cardholderName']);
    $numero_card   = strip_tags($_POST['cardNumber']);
    $validade_card = strip_tags($_POST['expirationDate']);
    $cvv           = strip_tags($_POST['securityCode']);
    $id_perfil = isset($_POST['id_perfil']) ? $_POST['id_perfil'] : null;
    $descricao = $_POST["descricao_item"];
    $id_usuario = $_POST["id_usuario"];
    
    // Cria uma instância da classe TransacaoDAO
    $transacaoDAO = new TransacaoDAO();

    // Dados do cartão de crédito
    $card_dados = array(
        'card_number' => $numero_card,
        'cardholder' => $nome_card,
        'expiration_month' => $validade_card,
        'expiration_year' => $validade_card,
        'security_code' => $cvv,
        'cardholder' => array(
            'name' => $nome,
            'identification' => array(
                'type' => 'CPF',
                'number' => $cpf_cnpj
            )
        ),
        'email' => $email_mercado_pago
    );

    // Monta o array de dados com os valores do formulário
    $dados = array(
        'items' => array(
            array(
                'description' => $description,
            )
        ),
        'payer' => array(
            'email' => $email_mercado_pago,
            'first_name' => $nome,
            'identification' => array(
                'type' => $cpf_cnpj,
                'number' => $cpf_cnpj
            )
        ),
        'installments' => 1,
        'payment_method_id' => $method,
        'issuer_id' => $id_perfil, // Adicione o issuer_id aqui
        'token' => $card_token,
        'transaction_amount' => $valor_total,
        'notification_url' => "https://www.suaurl.com/notificacoes/"
    );

    // Dados do pagamento com o método Pix
    $dados_pix = array(
        'transaction_amount' => $valor_total,
        'description' => $descricao,
        'external_reference' => 'M002F1',
        'payment_method_id' => 'pix',
        'payer' => array(
            'email' => 'test@test.com'
        ),
        'installments' => 1,
        'notification_url' => "https://www.suaurl.com/notificacoes/"
    );

    // Verificar o método de pagamento selecionado
    if ($method === 'pix') {
        // Chame a função pixMethod() do TransacaoDAO passando os dados de pagamento
        $transacaoDAO->pixMethod($dados_pix);

    } elseif ($method === 'tickte') {

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

