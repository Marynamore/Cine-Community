<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/boleto.css">
    <title>Gerador de Boletos</title>
</head>
<body>
  <br>
  <br>
  <br>
  <br>
    <div class="container">
        <h1>Gerador de Boletos</h1>
  
        <div class="form-group">
            <label for="valor">Valor:</label>
            <input type="number" id="valor" step="0.01">
        </div>
  
        <div class="form-group">
            <label for="vencimento">Data de Vencimento:</label>
            <input type="date" id="vencimento">
        </div>
  
        <div class="form-group">
            <button onclick="gerarBoleto()">Gerar Boleto</button>
        </div>
  
        <div class="boleto" id="boleto">
            <h2>Boleto Gerado:</h2>
            <p id="valor-gerado"></p>
            <p id="vencimento-gerado"></p>
            <img id="codigo-gerado" src="" alt="Código de barras">
        </div>
    </div>
  
    <script src="boleto.js"></script>
</body>
</html>
