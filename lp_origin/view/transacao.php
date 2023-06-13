<?php
    session_start();
    require_once '../model/dao/UsuarioDAO.php';
    require_once '../model/dao/itemDAO.php';
    require_once '../model/dao/transacaoDAO.php';

    $transacaoDAO = new TransacaoDAO();
    $usuarioDAO = new UsuarioDAO();
    $itemDAO = new ItemDAO();


    if (isset($_SESSION["id_usuario"]) && $_SESSION["id_usuario"] !== null) {
        $id_perfil = $_SESSION["id_perfil"];
        $id = $_SESSION["id_usuario"];
        
        $usuario = $usuarioDAO->encontraPorId($id);

        if (isset($_GET['id_item'])) {
            $id_item = $_GET['id_item'];
        } else {
            $id_item = '';
            header('location:./todos_itens.php');
        }

        $itemFetch = $itemDAO->obterItemPorId($id_item);

    } else {
        echo "Usuário não encontrado.";
        exit;
    }
    
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/transacao.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <link rel="apple-touch-icon" sizes="180x180" href="favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon_io/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <title>Detalhes da Transação</title>
</head>
<body>
    <form action="../control/item_transacao_control.php" method="POST">
        <input type="hidden" name="id_usuario" value="<?= $usuario->getId_usuario() ?>">
        <input type="hidden" name="id_fatura" value="<?= $id_fatura['id_fatura'] ?>">
        <h2>Confira seus dados:</h2>
        <div class="container">
            <div class="item-details">
                <div class="item-address">
                    <p><strong>Nome:</strong> <?= $usuario->getNome_usu()?></p>
                    <p><strong>Email:</strong> <?= $usuario->getEmail_usu()?></p>
                    <p><strong>CPF ou CNPJ:</strong> <?= $usuario->getCpf_cnpj()?></p>
                    <p><strong>Telefone:</strong> <?= $usuario->getTelefone()?></p>
                    <p><strong>Endereço:</strong> <?= $usuario->getEndereco()?></p>
                    <p><strong>Nº:</strong> <?= $usuario->getNumero()?></p>
                    <p><strong>Complemento:</strong> <?= $usuario->getComplemento()?></p>
                    <p><strong>Bairro:</strong> <?= $usuario->getBairro()?></p>
                    <p><strong>Cidade:</strong> <?= $usuario->getCidade()?></p>
                    <p><strong>CEP:</strong> <?= $usuario->getCep()?></p>
                    <p><strong>UF:</strong> <?= $usuario->getUF()?></p>
                </div>
            </div>
            <h2>Detalhes Produto:</h2>
            <div class="item-details">
                <div class="item-address">
                <?php 

                if ($itemFetch) {
                ?>

                <section id="product-details">
                    <div class="product">
                        <img src="../assets/imagensprodutos/<?= $itemFetch->getImagem_item() ?>">
                    </div>
                    <input type="hidden" name="id_item" value="<?= $itemFetch->getId_item() ?>"><br>

                    <div class="product-info">
                        <h2><?= $itemFetch->getNome_item() ?></h2>
                    </div>
                    <div class="product-info">
                        <textarea name="descricao_item" id="" cols="30" rows="10"><?=$itemFetch->getDescricao_item() ?></textarea>
                    </div>     

                    <div>
                        <p><i class="fas fa-brazilian-real-sign"></i> <?= $itemFetch->getPreco_item() ?></p>
                        <input type="number" name="qtd_item" required min="1" value="1" max="99" maxlength="2">
                    </div>
                </section>
                <?php }?>
                </div>
            </div>
        </div>
        <div class="container">
            <input type="hidden" name="transaction_amount" value="<?=$itemFetch->getPreco_item()?>">
            <h2>VALOR TOTAL:</h2>
            <p><i class="fas fa-brazilian-real-sign"></i><?= $itemFetch->getPreco_item() ?></p>
        </div>
        <button><a href="../view/alterar_usuario.php" target="_blank">ALTERAR</a></button>
        <h2>Escolha sua Forma de Pagamento:</h2>
        <div class="payment-options container modal-link">
            <aside class="payment_methods">
                <label for="payment-method">Escolha uma forma de pagamento:</label>         
                <select id="opcoes" onchange="mostrarModal()">
                    <option value="">Selecione uma opção</option>
                    <option value="opcao1">Pix</option>
                    <option value="opcao2">Boleto</option>
                    <option value="opcao3">Cartão de crédito</option>
                    <option value="opcao4">Cartão de débito</option>
                </select>
            </aside>
        </div>
        <!-- INICIO POP LOGIN -->
        <div class="modal" id="modal">
            <h2>Modal</h2>
            <p id="opcaoSelecionada"></p>
            <button onclick="fecharModal()">Fechar</button>

            <div id="pixForm">
            <h1>Pix</h1>
            <div class="payment-code">
                <p><strong>Código do Pix:</strong></p>
                <p><span id="pix-code"></span></p>
            </div>
            <div class="payment-instructions">
                <p>1. Abra o aplicativo do seu banco ou carteira digital.</p>
                <p>2. Selecione a opção "Pagamento Pix" ou similar.</p>
                <p>3. Escaneie o código QR abaixo ou digite o código de pagamento manualmente.</p>
                <p>4. Confirme o pagamento.</p>
            </div>
            <button class="botao">Enviar</button>
            </div>

            <div id="boletoForm">
            <h1>Boleto</h1>
            <div class="form-group">
                <label for="vencimento">Data de Vencimento:</label>
                <input type="date" id="vencimento">
            </div>
            <div class="boleto" id="boleto">
                <h2>Boleto Gerado:</h2>
                <p id="valor-gerado"></p>
                <p id="vencimento-gerado"></p>
                <img id="codigo-gerado" src="" alt="Código de barras">
            </div>
            <p><strong>Código de Barras:</strong> <span id="boleto-code"></span></p>
            <input type="text" placeholder="Usuário" class="input">
            <br><br>
            <input type="password" placeholder="Senha" class="input">
            <br><br>
            <button class="botao">Enviar</button>
            </div>

            <div id="cartaoCreditoForm">
            <h1>Cartão de Crédito</h1>
            <form action="" method="get" class="formulario">
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
                    <option value="hipercard">Hipercard</option>
                    <option value="amex">Amex</option>
                    <option value="diners">Diners</option>
                    <option value="elo">Elo</option>
                    <option value="mercadolivre">Cartão MercadoLivre</option>
                </select>
                </div>
                <div class="form-group">
                <button class="adicionar" type="submit">Pagar</button>
                </div>
            </form>
            </div>

            <div id="cartaoDebitoForm">
            <h1>Cartão de Débito</h1>
            <form action="" method="get" class="formulario">
                <div class="form-group">
                <label for="nome">Nome no Cartão:</label>
                <input type="text" id="nome" name="cardholderName" required>
                </div>
                <div class="form-group">
                <label for="numero">Número do Cartão:</label>
                <input type="number" id="numero" name="cardNumber" required>
                </div>
                <div class="card-info">
                <div class="form-group">
                    <label for="validade">Data de Validade:</label>
                    <input type="text" id="validade" name="expirationDate" required>
                </div>
                <div class="form-group">
                    <label for="cvv">CVV:</label>
                    <input type="number" id="cvv" name="securityCode" required>
                </div>
                </div>
                <div class="form-group">
                <label for="bandeira">Bandeira:</label>
                <select id="bandeira" name="bandeira" required>
                    <option value="">Selecione</option>
                    <option value="visa">Visa</option>
                    <option value="mastercard">Mastercard</option>
                    <option value="hipercard">Hipercard</option>
                    <option value="amex">Amex</option>
                    <option value="diners">Diners</option>
                    <option value="elo">Elo</option>
                    <option value="mercadolivre">Cartão MercadoLivre</option>
                </select>
                </div>
                <div class="form-group">
                <button class="adicionar" type="submit">Pagar</button>
                <progress value="0" class="progress-bar">Carregando...</progress>
                </div>
            </form>
            </div>
        </div>
        </div>
        <!-- FIM POP LOGIN -->
    </form>    
<script src="../js/transacao.js"></script>
</body>
</html>


