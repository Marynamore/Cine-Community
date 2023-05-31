<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/assinatura.css">
    <title>Assinatura</title>
    <script >
                function funcao1()
                {
            alert("Assinatura Realizada!");
                }
    </script>
    <style>
        main{
            padding: 0 20em;
            display: flex;

            flex-direction: column;
        }
    </style>
</head>

<body class="fundo">

    <main>
        <form>
            <fieldset>
                <legend>
                    <font size="6" color="white">Adicionar Cartão</font>

                </legend>
                <p style="right: auto;">
                    <h3>Seus Dados Pessoais:</h3>
                </p>
                <p class="dados-nome">
                     Nome: <input class="formulario-nome" type="text" required placeholder="Insira seu nome"> Sobrenome: <input type="text" required placeholder="Insira o seu sobrenome">
                </p>
                <p class="dados-data-de-nascimento">
                    Data de Nascimento: <input type="Date">
                </p>
                <p class="dados-cpf">
                 Insira o CPF: <input type="text" required placeholder="digite seu CPF" pattern="\d{3}.\d{3}.\d{3}-\d{2}" >

                </p>

                <p class="sexo">
                    Insira o seu sexo:<br>
                    <input type="radio" name="sexo"> Masculino
                    <input type="radio" name="sexo"> Feminino <br>
                </p></fieldset><fieldset>
                <p style="position: left;">
                    <h3>Dados do Cartão:</h3>
                <p class="numero-cartao">
                    Número do Cartão: <input type="number" placeholder="Número do cartão"><br>
                    Nome do Titular: <input type="text" placeholder="Nome do titular"><br>
                </p><p class="cvv">
                    Validade:<input type="month">

                    CVV: <input type="text" placeholder="Código do cartão">
                </p> <img class="imagem-formulario" src="../assets/NO_CARTÃO_(1)-transformed.png">

            </fieldset>

                <p  class="botao">
                   <button type="submit" onclick="funcao1()" value="Exibir Alert" > Cadastrar </button>
                </p>

        </form>
    </main>
</body>

</html>