<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/pix.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
      <h1>Pagamento com Pix</h1>
  
      <div class="payment-code">
        <p>Código de Pagamento:</p>
        <p id="code"></p>
      </div>
  
      <div class="payment-instructions">
        <p>1. Abra o aplicativo do seu banco ou carteira digital.</p>
        <p>2. Selecione a opção "Pagamento Pix" ou similar.</p>
        <p>3. Escaneie o código QR abaixo ou digite o código de pagamento manualmente.</p>
        <p>4. Confirme o pagamento.</p>
      </div>
  
      <div class="payment-amount">
        <p>Valor:</p>
        <input type="number" id="amount" placeholder="Digite o valor" step="0.01">
      </div>
  
      <div class="payment-button">
        <button onclick="generateCode()">Gerar Código de Pagamento</button>
      </div>
    </div>
    <script src="pix.js"></script>
</body>
</html>