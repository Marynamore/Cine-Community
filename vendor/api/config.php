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


// CARTÕES DE TESTE

// MASTERCARD 
// NUMERO: 5031 4332 1540 6351
// CVV: 123
// Data de vencimento: 11/25

// VISA 
// NUMERO: 4235 6477 2802 5682
// CVV: 123
// Data de vencimento: 11/25

// American EXPRESS  
// NUMERO: 3753 651535 56885
// CVV: 1234
// Data de vencimento: 11/25


/**
 * Para testar diferentes resultados de pagamento, insira o status desejado no nome do titular do cartão:
 * Status de pagamento	Descrição	Documento de identidade
 * APRO              Pagamento aprovado     (CPF) 12345678909
 * OTHE            Recusado por erro geral  (CPF) 12345678909
 * CONT             Pagamento pendente               - 
 * CALL         Recusado com validação para autorizar -
 * FUND         Recusado por quantia insuficiente     - 
 * SECU       Recusado por código de segurança inválido -
 * EXPI    Recusado por problema com a data de vencimento -
 * FORM       Recusado por erro no formulário
 */

//  País	Identificação da conta	Usuário	Senha	Criado em	
//  Argentina	a description	
//  TETEE31031	
//  helYq7h8hF	03/06/2023	
 
//  Argentina	a description	
//  TEST62899	
//  fLMNKDSjWc	03/06/2023	
 
//  Argentina	a description	
//  TTTEST80586	
//  wWuTSAhat1	03/06/2023	
 
//  Argentina	a description	
//  TETEE44826	
//  UbFSX9HjbI	03/06/2023	
 
//  Argentina	a description	
//  TTTEST39533	
//  1YadXTivfi	03/06/2023	
 
 