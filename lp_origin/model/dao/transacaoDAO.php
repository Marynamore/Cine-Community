<?php 
require_once __DIR__.'/../conexao.php';
require_once __DIR__.'/../dto/transacaoDTO.php';

class TransacaoDAO{
    public $pdo;

    public function __construct()
    {
        $this->pdo = Conexao::getInstance();
    }

    public function cadastrarTransacao(TransacaoDTO $transacaoDTO){
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
        include_once '../../apiMP/config.php';
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

        // Fecha a conexão cURL
        curl_close($curl);

        return $response;
    }

    public function tokenDoCartao() {

        // Dados do cartão de crédito
        $card_data = array(
            'card_number' => '************',
            'cardholder' => 'Nome do Titular',
            'expiration_month' => 'MM',
            'expiration_year' => 'AAAA',
            'security_code' => 'CVV',
        );

        // Faz uma requisição para obter o token do cartão
        $token_request = $this->fazerRequisicaoToken($card_data);

        // Verifica se a requisição foi bem-sucedida e retorna o token do cartão
        if ($token_request['status'] === 'success') {
            return $token_request['card_token'];
        } else {
            // Trate o erro adequadamente
            return false;
        }
    }

    public function fazerRequisicaoToken($card_data) {
        include_once '../../apiMP/config.php';

        // Dados da requisição para obter o token do cartão
        $request_dados = array(
            'card_number' => $card_data['card_number'],
            'cardholder' => $card_data['cardholder'],
            'expiration_month' => $card_data['expiration_month'],
            'expiration_year' => $card_data['expiration_year'],
            'security_code' => $card_data['security_code'],
        );

        // Configuração da requisição cURL
        $curl = curl_init();

        $options = array(
            CURLOPT_URL => URL_TOKECARD,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_POSTFIELDS => http_build_query($request_dados),
            CURLOPT_POST => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded',
                'Authorization: Bearer ' . TOKEN_MERCADOPAGO
            )
        );

        // Configura as opções do cURL
        curl_setopt_array($curl, $options);

        // Executa a requisição e obtém a resposta
        $response = curl_exec($curl);

        // Verifica se a requisição foi bem-sucedida
        $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if ($http_code === 201) {
            // A requisição foi bem-sucedida, analisa a resposta da API
            $decoded_response = json_decode($response, true);

            // Verifica se o token do cartão foi retornado na resposta
            if (isset($decoded_response['id'])) {
                // Token do cartão obtido com sucesso
                $card_token = $decoded_response['id'];

                // Retorna o token do cartão
                return $card_token;
            } else {
                // A resposta da API não contém o token do cartão
                // Trate o erro adequadamente
                return false;
            }
        } else {
            // A requisição não foi bem-sucedida
            // Trate o erro adequadamente
            return false;
        }

        // Fecha a conexão cURL
        curl_close($curl);
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

