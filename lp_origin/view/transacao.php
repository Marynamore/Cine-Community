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
        <button><a href="../view/alterar_usuario.php" target="_blank">ALTERAR</a></button>
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
    <div class="payment-methods">
        <a href="cartaocredito.php"><button class="credit-card">Cartão de Crédito/Débito</button></a>
        <a href="pix.php"><button class="debit-card">Pix</button></a>
        <a href="boleto.php"><button class="bank-slip">Boleto Bancário</button></a>
    </div>
<script src="../js/transacao.js"></script>
</body>
</html>


