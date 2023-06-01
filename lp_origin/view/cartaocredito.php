<!DOCTYPE html>
<link rel="stylesheet" href="../css/cartaocredito.css">

<html>
<head>
  <title>Página de Pagamento</title>

</head>
<body>
  <br>
  <br>
  <br>
  <br>
  <br>
  <a class="voltarcartao" href="../view/formapagamento.php">Voltar</a>
  <div class="container">
    <h2>Adicionar Cartão de Crédito</h2>
    <form>
      <div class="form-group">
        <label for="nome">Nome no Cartão:</label>
        <input type="text" id="nome" name="nome" required>
      </div>
      <div class="form-group">
        <label for="numero">Número do Cartão:</label>
        <input type="number" id="numero" name="numero" required>
      </div>
      <div class="card-info">
        <div class="form-group">
          <label for="validade">Data de Validade:</label>
          <input type="text" id="validade" name="validade" required>
        </div>
        <div class="form-group">
          <label for="cvv">CVV:</label>
          <input type="number" id="cvv" name="cvv" required>
        </div>
      </div>
      <div class="form-group">
        <label for="bandeira">Bandeira:</label>
        <select id="bandeira" name="bandeira" required>
          <option value="">Selecione</option>
          <option value="visa">Visa</option>
          <option value="mastercard">Mastercard</option>
          <option value="mastercard">Hipercard</option>
          <option value="amex">Amex</option>
          <option value="amex">Diners</option>
          <option value="amex">Elo</option>
          <option value="amex">Cartão MercadoLivre</option>
        </select>
      </div>
      <div class="form-group">
        <button class="adicionar" type="submit">Pagar</button>
      </div>
    </form>
  </div>
</body>
</html>