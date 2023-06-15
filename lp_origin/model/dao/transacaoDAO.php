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
            $sql = "INSERT INTO transacao (tipo_trans, dt_hora_trans, status_trans, valor_total, fk_id_item, tipo_pagamento_trans, qtd_trans, fk_id_usuario, fk_id_perfil) VALUES (?,?,?,?,?,?,?,?,?)";
            $cadTransacao = $this->pdo->prepare($sql); 

            $cadTransacao->bindValue(1, $transacaoDTO->getTipo_trans());
            $cadTransacao->bindValue(2, $transacaoDTO->getDt_hora_trans());
            $cadTransacao->bindValue(3, $transacaoDTO->getStatus_trans());
            $cadTransacao->bindValue(4, $transacaoDTO->getValor_total());
            $cadTransacao->bindValue(5, $transacaoDTO->getFk_id_item());
            $cadTransacao->bindValue(6, $transacaoDTO->getTipo_pagamento_trans());
            $cadTransacao->bindValue(7, $transacaoDTO->getQtd_trans());
            $cadTransacao->bindValue(8, $transacaoDTO->getFk_id_usuario());
            $cadTransacao->bindValue(9, $transacaoDTO->getFk_id_perfil());

            return $cadTransacao->execute();
        }catch(PDOException $exc){
            echo $exc->getMessage();
            die();
        }
    }

    public function obterTransacaoPorRef($ref_mp){
        try{
            $sql = "SELECT * FROM transacao WHERE ref_mp='$ref_mp' LIMIT 1";
            $preTransacao = $this->pdo->prepare($sql);
            $preTransacao->execute();
            $transacaoFetch = $preTransacao->fetch(PDO::FETCH_ASSOC);
                
            return $transacaoFetch;
        }catch(PDOException $exc){
            echo $exc->getMessage();
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

    public function buscarTransacaoPorRef($id_transacao){
        try{
            $sql = "SELECT * FROM transacao WHERE ref_mp='$id_transacao' LIMIT 1";
            $preTransacao = $this->pdo->prepare($sql);
            $preTransacao->execute();
            $transacaoFetch = $preTransacao->fetch(PDO::FETCH_ASSOC);

            return $transacaoFetch;
        }catch(PDOException $exc){
            echo $exc->getMessage();
        }
    }



    // public function enviarRequisicao($dados) {
    //     include_once '../apiMP/config.php';
    //     $curl = curl_init();

    //     $options = array(
    //         CURLOPT_URL => URL_CRIARPAG,
    //         CURLOPT_RETURNTRANSFER => true,
    //         CURLOPT_FOLLOWLOCATION => true,
    //         CURLOPT_POSTFIELDS => json_encode($dados),
    //         CURLOPT_POST => true,
    //         CURLOPT_SSL_VERIFYPEER => false,
    //         CURLOPT_HTTPHEADER => array(
    //             'Authorization: Bearer ' . TOKEN_MERCADOPAGO
    //         )
    //     );
        
    //     curl_setopt_array($curl, $options);

    //     $response = curl_exec($curl);

    //     // Verifica se ocorreu algum erro na requisição para criar o pagamento
    //     if ($response === false) {
    //         echo 'Erro na requisição de pagamento: ' . curl_error($curl);
    //     } else {
    //         // Decodifica a resposta JSON do pagamento
    //         $response_dados = json_decode($response, true); 

    //         // Verifica se ocorreu algum erro ao criar o pagamento
    //         if (isset($response_dados['status']) && $response_dados['status'] === 201) {
    //             // Pagamento criado com sucesso
    //             echo 'Pagamento criado com sucesso!';
    //             echo 'ID do pagamento: ' . $response_dados['id'];
    //             return $response;
    //         } else {
    //             // Erro ao criar o pagamento
    //             echo 'Erro ao criar o pagamento: ' . $response;
    //             return $false;
    //         }
    //     }

    //     curl_close($curl);
    // }

    // public function tokenDoCartao($card_dados) {
    //     include_once '../apiMP/config.php';
    //     $curl = curl_init();

    //     $optionsToken = array(
    //         CURLOPT_URL => URL_TOKECARD,
    //         CURLOPT_RETURNTRANSFER => true,
    //         CURLOPT_POSTFIELDS => json_encode($card_dados),
    //         CURLOPT_POST => true,
    //         CURLOPT_SSL_VERIFYPEER => false,
    //         CURLOPT_HTTPHEADER => array(
    //             'Content-Type: application/json',
    //             'Authorization: Bearer ' . TOKEN_MERCADOPAGO
    //         )
    //     );

    //     curl_setopt_array($curl, $optionsToken);

    //     $responseToken = curl_exec($curl);

    //     // Verifica se a requisição foi bem-sucedida
    //     if ($responseToken === false) {
    //         echo 'Erro na requisição do token do cartão: ' . curl_error($curl);
    //         return false;
    //     }

    //     // Decodifica a resposta JSON do token do cartão
    //     $decoded_response = json_decode($responseToken, true);

    //     // Verifica o status da resposta do token do cartão
    //     if (isset($decoded_response['status']) && $decoded_response['status'] === 201) {
    //         // Token do cartão obtido com sucesso
    //         $card_dados = $decoded_response['id'];

    //         $request = $this->enviarRequisicao($card_dados);
            
    //         // Trate a resposta da requisição adequadamente
    //         $responseDados = json_decode($request, true);
    //         if ($responseDados['status'] && $responseDados['status'] === 'success') {
    //             return $responseDados['card_token'];
    //         } else {
    //             echo 'Erro na requisição do token do cartão: ' . $responseDados['status_detail'];
    //             return false;
    //         }
    //     } else {
    //         echo 'Erro ao obter o token do cartão: ' . $responseToken;
    //         return false;
    //     }

    //     curl_close($curl);
    // }

    // public function gerarQRCode(){
    
    //     $payloadJson = json_encode($payload);
    
    //     // Prefixo '000201' indica o início do payload PIX
    //     // Demais campos correspondem às informações do payload
    //     $codigoPix = '000201' . str_pad(strlen($payloadJson), 2, '0', STR_PAD_LEFT) . $payloadJson . '6304';
    
    //     // Base64 do código PIX
    //     $base64Pix = base64_encode($codigoPix);
    
    //     // Monta a URL do QR Code
    //     $qrcodeUrl = 'https://api.qrserver.com/v1/create-qr-code/?data=' . urlencode($base64Pix);
    
    //     return $qrcodeUrl;
    // }
    
    

    public function lerCodigoQR($qrCodeUrl) {

        $apiUrl = 'http://api.qrserver.com/v1/read-qr-code/?fileurl=' . urlencode($qrCodeUrl);
        $response = file_get_contents($apiUrl);
        $data = json_decode($response);
    
        if ($data && isset($data[0]->symbol[0]->data)) {
            return $data[0]->symbol[0]->data;
        } else {
            return false;
        }
    }

    // public function pixMethod($pix) {
    //     include_once '../apiMP/config.php';

    //     $request = $this->enviarRequisicao($pix);

    //     // Verifica se ocorreu algum erro na requisição para criar o pagamento
    //     if ($request !== false) {

    //         // Decodifica a resposta JSON do pagamento
    //         $responseDados = json_decode($request);

    //         // Verifica se ocorreu algum erro ao criar o pagamento
    //         if (isset($responseDados['status']) && $responseDados['status'] === 201) {
    //             // Pagamento criado com sucesso
    //             echo 'Pagamento criado com sucesso!';
    //             echo 'ID do pagamento: ' . $responseDados['id'];

    //             echo '<img id="base64image" src="data:image/jpeg;base64,' . $responseDataPayment['point_of_interaction']['transaction_data']['qr_code_base64'] . '">';

    //             echo '<strong>Copie:</strong>';
    //             echo $responseDataPayment['point_of_interaction']['transaction_data']['qr_code'];

    //         } else {
    //             // Erro ao criar o pagamento
    //             echo 'Erro ao criar o pagamento: ' . $request;
    //         }
    //     }

    // }


    // public function obterPagamentoPorID($response) {
    //     $decoded_response = json_decode($response, true);
    //     if (isset($decoded_response['id'])) {
    //         return $decoded_response['id'];
    //     } else {
    //         return false;
    //     }
    // }

}


