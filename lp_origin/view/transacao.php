<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/transacao.css">
    <title>Detalhes da Transação</title>
</head>
<body>
    <div class="container">
        <div class="item-details">
            <img src="item_image.jpg" alt="Item Image">
            <div class="item-address">
                <h2>Detalhes do Item</h2>
                <p>Endereço do Item</p>
                <p>Cidade, Estado</p>
                <p>CEP: 12345-678</p>
            </div>
        </div>
        <div class="payment-options">
            <h2>Formas de Pagamento</h2>
            <div class="payment-method">
                <input type="radio" id="pix" name="payment-method" value="pix">
                <label for="pix">PIX</label>
            </div>
            <div class="payment-method">
                <input type="radio" id="boleto" name="payment-method" value="boleto">
                <label for="boleto">Boleto</label>
            </div>
            <div class="payment-method">
                <input type="radio" id="cartao" name="payment-method" value="cartao">
                <label for="cartao">Cartão de Crédito ou Débito</label>
            </div>
        </div>
    </div>
</body>
</html>

