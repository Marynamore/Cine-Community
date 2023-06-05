<?php

//inclui o arquivo config com informações de acesso
include_once './config.php';

// Inicializa o cURL
$curl = curl_init();

$dados = array(
    'items' => array(
        array(
            'title' => 'Produto de Exemplo',
            'description' => 'OBRIGATORIO',
            'quantity' => 1,
            'unit_price' => 10.0,
            'currency_id' => 'BRL'
        )
    ),
    'payment_method_id' => 'pix',
    'issuer_id' => 'ID_DO_EMISSOR', // Adicione o issuer_id aqui
    'payer' => array(
        'email' => 'test@test.com',
        'first_name' => 'Teste',
        'last_name' => 'User',
        'identification' => array(
            'type' => 'CPF',
            'number' => '',
        ),
        'address' => array(
            'zip_code' => '',
            'street_name' => '',
            'street_number' => '',
            'neighbordhood' => '',
            'city' => '',
            'federal_unit' => ''
        )
    )
);


// Configuração da requisição
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

// echo '<pre>';
// var_dump($response);
// echo '</pre>';

// Fecha a conexão cURL
curl_close($curl);

