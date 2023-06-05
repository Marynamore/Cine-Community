<?php
    session_start();
    require_once '../model/dao/UsuarioDAO.php';
    require_once '../model/dao/itemDAO.php';

    $usuarioDAO = new UsuarioDAO();
    $itemDAO = new ItemDAO();
?>
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
    <?php

    if (isset($_SESSION["id_usuario"]) && $_SESSION["id_usuario"] !== null) {
        $id_perfil = $_SESSION["id_perfil"];
        $id = $_SESSION["id_usuario"];

        $usuario = $usuarioDAO->encontraPorId($id);
// echo '<pre>';
// print_r($usuario);
// echo '</pre>';
    ?>
    <form action="../control/item_transacao_control.php" method="POST">
        <input type="hidden" name="id_usuario" value="<?= $usuario->getId_usuario() ?>">
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
                $item = $itemDAO->obterItemPorId($id_tem);
                foreach ($item as $itemFetch) {
                ?>
                <section id="product-details">
                    <div class="product">
                        <img src="../assets/imagensprodutos/<?= $itemFetch['imagem_item'] ?>">
                    </div>
                    <input type="hidden" name="id_item" value="<?= $itemFetch['id_item'] ?>"><br>
                    <div class="product-info">
                        <h2><?= $itemFetch['nome_item'] ?></h2>
                    </div>
                    <div class="product-info">
                        <input type="text" name="description" value="<?=$itemFetch['descricao_item'] ?>">
                    </div>        
                    <div>
                        <p><i class="fas fa-brazilian-real-sign"></i> <?= $itemFetch['preco_item'] ?></p>
                        <input type="number" name="qtd_item" required min="1" value="1" max="99" maxlength="2">
                    </div>
                </section>
                </form>
                <?php }?>
                </div>
            </div>
        </div>
        <div class="container">
            <h2>VALOR TOTAL:</h2>
        </div>
        <button><a href="../view/alterar_usuario.php" target="_blank">ALTERAR</a></button>
    <h2>Formas de Pagamento:</h2>
    <div class="payment-options container modal-link">
        <aside class="payment_methods">
            <input type="radio" id="pix-form" name="payment-method-id" value="pix" >
            <label for="pix-form">PIX</label>
        </aside>
        <aside class="payment_methods">
            <input type="radio" id="boleto-form" name="payment-method-id" value="boleto">
            <label for="boleto-form">Boleto</label>
        </aside>
        <aside class="payment_methods">
            <input type="radio" id="cartao-credito-form" name="payment-method-id" value="credit_card">
            <label for="cartao-credito-form">Cartão de Crédito</label>
        </aside>
        <aside class="payment_methods">
            <input type="radio" id="cartao-debito-form" name="payment-method-id" value="debit_card">
            <label for="cartao-debito-form">Cartão de Débito</label>
        </aside>
    </div>

    <input type="submit" value="Finalizar Compra">
</form>

<!-- INICIO POP LOGIN -->
<div class="overlay"></div>
<div class="modal">
    <div class="login">
        <button class="close-btn" onclick="fecharModal()">&#10005;</button>

        <form action="" method="get" id="pix-form-data">
            <h1>Pix</h1>
            <p><strong>Código do Pix:</strong> <span id="pix-code"></span></p>
            <button class="botao">Enviar</button>
        </form>

        <form action="" method="get" id="boleto-form">
            <h1>Boleto</h1>
            <p><strong>Código de Barras:</strong> <span id="boleto-code"></span></p>
            <input type="text" placeholder="Usuário" class="input">
            <br><br>
            <input type="password" placeholder="Senha" class="input">
            <br><br>
            <button class="botao">Enviar</button>
        </form>
        
        <form action="" method="get" id="cartao-credito-form" class="formulario">
            <!-- Formulário de Cartão de Crédito -->
        </form>

        <form action="" method="get" id="cartao-debito-form" class="formulario">
            <!-- Formulário de Cartão de Débito -->
        </form>
    </div>
</div>
<!-- FIM POP LOGIN -->

 
    <?php
        } else {
            echo "Usuário não encontrado.";
        }
    ?>
<script src="../js/transacao.js"></script>
</body>
</html>
