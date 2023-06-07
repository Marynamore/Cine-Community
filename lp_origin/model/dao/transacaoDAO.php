<?php 
require_once __DIR__.'/../conexao.php';
require_once __DIR__.'/../dto/transacaoDTO.php';

class TransacaoDAO{
    public $pdo;

    public function __construct()
    {
        $this->pdo = Conexao::getInstance();
    }

    public function criarTransacao(TransacaoDTO $transacaoDTO){
        try{
            $sql = "INSERT INTO transacao (tipo_trans, dt_hora_trans, status_trans, valor_total,fk_id_item, tipo_pagamento_trans, fk_id_usuario, fk_id_perfil) VALUES (?,?,?,?,?,?,?,?,)";
            $cadTransacao = $this->pdo->prepare($sql); 

            $cadTransacao->bindValue(1, $transacaoDTO->getTipo_trans());
            $cadTransacao->bindValue(2, $transacaoDTO->getDt_hora_trans());
            $cadTransacao->bindValue(3, $transacaoDTO->getStatus_trans());
            $cadTransacao->bindValue(4, $transacaoDTO->getValor_total());
            $cadTransacao->bindValue(5, $transacaoDTO->getFk_id_item());
            $cadTransacao->bindValue(6, $transacaoDTO->getTipo_pagamento_trans());
            $cadTransacao->bindValue(7, $transacaoDTO->getFk_id_usuario());
            $cadTransacao->bindValue(8, $transacaoDTO->getFk_id_perfil());

            return $cadTransacao->execute();
        }catch(PDOException $exc){
            echo $exc->getMessage();
            die();
        }
    }

    public function alterarTransacao(TransacaoDTO $transacaoDTO){
        try{
            $sql = "UPDATE transacao SET tipo_trans=?, dt_hora_trans=?, status_trans=?, valor_total=?, fk_id_item=?, tipo_pagamento_trans=?, fk_id_usuario=?, fk_id_perfil=? WHERE id_transacao=?";

            $upTransacao = $this->pdo->prepare($sql);
            $upTransacao->bindValue(1, $transacaoDTO->getTipo_trans());
            $upTransacao->bindValue(2, $transacaoDTO->getDt_hora_trans());
            $upTransacao->bindValue(3, $transacaoDTO->getStatus_trans());
            $upTransacao->bindValue(4, $transacaoDTO->getValor_total());
            $upTransacao->bindValue(5, $transacaoDTO->getFk_id_item());
            $upTransacao->bindValue(6, $transacaoDTO->getTipo_pagamento_trans());
            $upTransacao->bindValue(7, $transacaoDTO->getFk_id_usuario());
            $upTransacao->bindValue(8, $transacaoDTO->getFk_id_perfil());
            $upTransacao->bindValue(9, $transacaoDTO->getId_transacao());

            return $upTransacao->execute();

        }catch(PDOException $exc){
            echo $exc->getMessage();
        }
    }

    public function excluirTransacaoPorId($id_transacao){
        try{
            $sql = "DELETE FROM transacao WHERE id_transacao=?";
            $exTransacao = $this->pdo->prepare($sql);

            $exTransacao->bindValue(1, $id_transacao);

            return $exTransacao->execute();

        }catch(PDOException $exc){
            echo $exc->getMessage();
        }
    }

    public function listarTodasTransacoes(){
        try{
            $sql = "SELECT * FROM transacao";

            $allTransacoes = $this->pdo->prepare($sql);
            $allTransacoes->execute();

            $transacoes = array();
            if($allTransacoes->rowCount()>0){
                while($transacaoFetch = $allTransacoes->fetch(PDO::FETCH_ASSOC)){
                    $transacaoDTO = new TransacaoDTO();

                    $transacaoDTO->setId_transacao($transacaoFetch['id_transacao']);
                    $transacaoDTO->setTipo_trans($transacaoFetch['tipo_trans']);
                    $transacaoDTO->setDt_hora_trans($transacaoFetch['dt_hora_trans']);
                    $transacaoDTO->setStatus_trans($transacaoFetch['status_trans']);
                    $transacaoDTO->setValor_total($transacaoFetch['valor_total']);
                    $transacaoDTO->setFk_id_item($transacaoFetch['fk_id_item']);
                    $transacaoDTO->setTipo_pagamento_trans($transacaoFetch['tipo_pagamento_trans']);
                    $transacaoDTO->setFk_id_usuario($transacaoFetch['fk_id_usuario']);
                    $transacaoDTO->setFk_id_perfil($transacaoFetch['fk_id_perfil']);

                    $transacoes[] = $transacaoDTO;
                } 
                return $transacoes;
            }else{
                echo '<p>Nenhuma transação encontrada!</p>';
            }

        }catch(PDOException $exc){
            echo $exc->getMessage();
        }
        
    }

    public function obterTransacaoPorId($id_transacao){
        try{
            $sql = "SELECT * FROM transacao WHERE id_transacao=? LIMIT 1";
            $preTransacao = $this->pdo->prepare($sql);
            $preTransacao->bindValue(1, $id_transacao);
            $preTransacao->execute();
            $transacaoFetch = $preTransacao->fetch(PDO::FETCH_ASSOC);

            return $transacaoFetch;
        }catch(PDOException $exc){
            echo $exc->getMessage();
        }
    }

    public function enviarRequisicao($dados) {
        include_once '../apiMP/config.php';
        // Configuração da requisição cURL
        $curl = curl_init();

        $options = array(
            CURLOPT_URL => URL_CRIARPAG,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_POSTFIELDS => json_encode($dados),
            CURLOPT_POST => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . TOKEN_MERCADOPAGO
            )
        );

        // Configura as opções do cURL
        curl_setopt_array($curl, $options);

        // Executa a requisição e obtém a resposta
        $response = curl_exec($curl);

        // Verifica se ocorreu algum erro na requisição para criar o pagamento
        if ($response === false) {
            echo 'Erro na requisição de pagamento: ' . curl_error($curl);
        } else {
            // Decodifica a resposta JSON do pagamento
            $response_dados = json_decode($response, true); 

            // Verifica se ocorreu algum erro ao criar o pagamento
            if (isset($responseDataPayment['status']) && $response_dados['status'] === 201) {
                // Pagamento criado com sucesso
                echo 'Pagamento criado com sucesso!';
                echo 'ID do pagamento: ' . $response_dados['id'];
            } else {
                // Erro ao criar o pagamento
                echo 'Erro ao criar o pagamento: ' . $response;
            }

        }
        curl_close($curl);
        return $response;
    }

    public function tokenDoCartao($card_dados) {
        include_once '../apiMP/config.php';

        // Configuração da requisição cURL
        $curl = curl_init();

        $optionsToken = array(
            CURLOPT_URL => URL_TOKECARD,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS => json_encode($card_dados),
            CURLOPT_POST => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer ' . TOKEN_MERCADOPAGO
            )
        );

        // Configura as opções do cURL
        curl_setopt_array($curl, $optionsToken);

        // Executa a requisição e obtém a resposta
        $responseToken = curl_exec($curl);

        // Verifica se a requisição foi bem-sucedida
        if ($responseToken === false) {
            echo 'Erro na requisição do token do cartão: ' . curl_error($curl);
            return false;
        }

        // Decodifica a resposta JSON do token do cartão
        $decoded_response = json_decode($responseToken, true);

        // Verifica o status da resposta do token do cartão
        if (isset($decoded_response['status']) && $decoded_response['status'] === 201) {
            // Token do cartão obtido com sucesso
            $card_dados = $decoded_response['id'];

            $request = $this->enviarRequisicao($card_dados);
            
            // Trate a resposta da requisição adequadamente
            if ($request['status'] === 'success') {
                return $request['card_token'];
            } else {
                echo 'Erro na requisição do token do cartão: ' . $request['status_detail'];
                return false;
            }
        } else {
            echo 'Erro ao obter o token do cartão: ' . $responseToken;
            return false;
        }

        curl_close($curl);
    }

    public function pixMethod($pix) {
        include_once '../apiMP/config.php';

        $request = $this->enviarRequisicao($pix);

        // Verifica se ocorreu algum erro na requisição para criar o pagamento
        if ($request === false) {
            echo 'Erro na requisição de pagamento: ' . curl_error($curlPayment);
        } else {
            // Decodifica a resposta JSON do pagamento
            $responseDataPayment = json_decode($request);

            // Verifica se ocorreu algum erro ao criar o pagamento
            if (isset($responseDataPayment->status) && $responseDataPayment->status === 201) {
                // Pagamento criado com sucesso
                echo 'Pagamento criado com sucesso!';
                echo 'ID do pagamento: ' . $responseDataPayment->id;

                echo '<img id="base64image" src="data:image/jpeg;base64,' . $responseDataPayment->point_of_interaction->transaction_data->qr_code_base64 . '">';

                echo '<strong>Copie:</strong>';
                echo $responseDataPayment->point_of_interaction->transaction_data->qr_code;
            } else {
                // Erro ao criar o pagamento
                echo 'Erro ao criar o pagamento: ' . $request;
            }
        }

    }


    public function obterPagamentoPorID($response) {
        $decoded_response = json_decode($response, true);
        if (isset($decoded_response['id'])) {
            return $decoded_response['id'];
        } else {
            return false;
        }
    }

}

