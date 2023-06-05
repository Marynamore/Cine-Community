<?php
require_once '../model/dao/transacaoDAO.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
    $method         = strip_tags($_POST['payment-method-id']);
    $id_perfil = isset($_POST['id_perfil']) ? $_POST['id_perfil'] : null;
    $description = $_POST["description"];
    $id_usuario = $_POST["id_usuario"];

    // Cria uma instância da classe TransacaoDAO
    $transacaoDAO = new TransacaoDAO();

    // Primeiro, obtenha o token do cartão de crédito
    $card_token = $transacaoDAO->tokenDoCartao();

    // Verifique se o token do cartão foi obtido com sucesso
    if ($card_token !== false) {
        // Monta o array de dados com os valores do formulário
        $dados = array(
            'items' => array(
                array(
                    'description' => $description['description'],
                )
            ),
            'payer' => array(
                'email' => $email_mercado_pago['email'],
                'first_name' => $nome['nome'],
                'identification' => array(
                    'type' => $cpf_cnpj['cpf'],
                    'number' => $cpf_cnpj['cpf']
                )
            ),
            'installments' => $parcelas,
            'payment_method_id' => $method['payment-method-id'],
            'issuer_id' => $id_perfil['id_perfil'], // Adicione o issuer_id aqui
            'token' => $card_token,
            'transaction_amount' => $valor_total
        );

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
}

