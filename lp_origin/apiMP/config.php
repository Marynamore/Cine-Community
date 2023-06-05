<?php

/**
 * Credenciais de teste
 * As credenciais-teste permitem que você teste o funcionamento das suas
 * integrações e simule pagamentos ao usá-las com cartões de crédito de teste.
 */

// Chave de acesso da API 
    define('TOKEN_MERCADOPAGO', 'TEST-2693371656980428-060311-5f3be53dc3618eb0c775ee045101a16e-805162849');

// Chave de acesso da API 
    define('CHAVE_PUB', 'TEST-0eaaf3f2-cd31-4db5-ad05-b2355fa18a78');

// URL da API do Mercado Pago CRIAR PAGAMENTO
    define('URL_CRIARPAG', 'https://api.mercadopago.com/v1/payments/');

// URL da API do Mercado Pago CRIAR PAGAMENTO
    define('URL_TOKECARD', 'https://api.mercadopago.com/v1/card_tokens');

// URL da API do Mercado Pago BUSCAR PAGAMENTO    
    define('URL_BUSCPAG','https://api.mercadopago.com/v1/payments/search?sort=date_created&criteria=desc&external_reference=ID_REF&range=date_created&begin_date=NOW-30DAYS&end_date=NOW');

// URL da API do Mercado Pago TESTE USER
    define('URL_TESTE','https://api.mercadopago.com/users/test');

