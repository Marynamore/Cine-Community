<?php
session_start();
require_once '../model/dao/UsuarioDAO.php';
require_once '../model/dao/itemDAO.php';
require_once '../model/dao/transacaoDAO.php';
require_once '../model/dao/carrinhoDAO.php';

$transacaoDAO = new TransacaoDAO();
$usuarioDAO = new UsuarioDAO();
$itemDAO = new ItemDAO();
$carrinhoDAO = new CarrinhoDAO();

if (isset($_SESSION["id_usuario"])) {
    $usuarioLogado = $_SESSION["nickname_usu"];
    $id_usuarioLogado = $_SESSION["id_usuario"];
    $id_perfil = $_SESSION["id_perfil"];

    $usuario = $usuarioDAO->encontraPorId($id_usuarioLogado);

} else {
    header("Location: ../view/todos_itens.php?msg=Usuário não encontrado");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/pedidos.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
  <link rel="apple-touch-icon" sizes="180x180" href="favicon_io/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="favicon_io/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="favicon_io/favicon-16x16.png">
  <link rel="manifest" href="/site.webmanifest">
  <title>Detalhes da Transação</title>
</head>
<body>
    <header class="header">
        <a href="index.php" class="logo"><img src="../assets/logoinicio.png" alt="index.php"></a>
        <nav class="navbar" style="-i:1;">
            <a href="./view/alterar_usuario.php?id_usuario=<?= $id_usuarioLogado?>" onclick="funcPerfil()"><i class="fa-solid fa-user"></i><?= $_SESSION["nickname_usu"]; ?></a>
            <?php
            if (isset($carrinhoData['total_itens']) && isset($carrinhoData['carrinho_itens'])) {
                // echo '';
                // print_r($carrinhoData['total_itens']) && isset($carrinhoData['carrinho_itens']);
                // echo '';
                $total_itens = $carrinhoData['total_itens'];
                $carrinho_itens = $carrinhoData['carrinho_itens'];
                if (!empty($carrinho_itens)) {
                foreach ($carrinho_itens as $carrinhoItem) {
                    echo '<a href="carrinho.php"><i class="fa-solid fa-cart-plus"></i>Carrinho<span>' . $total_itens . '</span></a>';
                }
                }
            } else {
                echo '<a href="carrinho.php"><i class="fa-solid fa-cart-plus"></i>Carrinho<span>0</span></a>';
            }
            ?>
            <a href="../view/todos_itens.php" style="-i:2;"><i class="fa-solid fa-house"></i>Voltar</a>
        </nav>
    </header>
    <section class="container">
        <div class="item-details">
            <div class="flex">
                <div class="item-address">
                    <h2>Confira seus dados:</h2>
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
                    <button><a href="./alterar_usuario.php?id_usuario=<?= $usuario->getId_usuario() ?>" target="_blank">ALTERAR</a></button>
                </div>
            </div>
            <div class="item-detalhe">
                <h2>Detalhes Item:</h2>
                <?php 
                    $total_itens = 0;
                    if (isset($_GET['id_item'])) {
                        $id_item = $_GET['id_item'];
                        $itemFetch = $itemDAO->obterItemCarPorId($id_item);
                        if ($itemFetch) {
                ?>
                <form action="../control/item_transacao_control.php" method="POST">
                    <input type="hidden" name="preco_item" value="<?= $itemFetch->getPreco_item() ?>">
                    <input type="hidden" name="qtd_compra" value="1">
                    <input type="hidden" name="id_perfil" value="<?= $id_perfil ?>">
                    <input type="hidden" name="id_usuario" value="<?= $id_usuarioLogado ?>">
                    <div class="flex">
                        <img src="../assets/imagensprodutos/<?= $itemFetch->getImagem_item() ?>" class="image">
                        <div>
                            <h2><?= $itemFetch->getNome_item() ?></h2>
                            <?php
                            if($id_perfil == 4){
                                echo '<p>Quantidade: '.$itemFetch->getQtd_item().'</p>';
                            }
                            ?>
                            <p class="price"><i class="fas fa-brazilian-real-sign"></i> <?= $itemFetch->getPreco_item()?> x 1</p>
                        </div>    
                    </div>
                    <?php 
                        }
                    } else {
                        if (isset($_SESSION["id_usuario"])) {
                            $carrinhoData = $carrinhoDAO->obterItemCarPorUsuarioID($_SESSION["id_usuario"]);
                            if ($carrinhoData) {
                                foreach ($carrinhoData as $carrinhoFetch) {
                                    $itemFetch = $itemDAO->obterItemCarPorId($carrinhoFetch->getFk_id_item());
                                    if ($itemFetch) {
                                        $sub_total = ($carrinhoFetch->getQtd_compra() * $itemFetch->getPreco_item());
                                        $total_itens += $sub_total;
                                        ?>
                    <div class="flex">
                        <img src="../assets/imagensprodutos/<?= $itemFetch->getImagem_item()?>" class="image">
                        <h3><?= $itemFetch->getNome_item() ?></h3>
                        <div>
                            <p class="price">
                                <i class="fas fa-brazilian-real-sign"></i> <?= $carrinhoFetch->getPreco() ?> x <?= $carrinhoFetch->getQtd_compra() ?>
                            </p>
                        </div>
                    </div>
                    <?php
                                    } else {
                                        echo '<p>Item não encontrado</p>';
                                    }
                                }
                            }
                        }
                    }
                    ?>
                    <div class="grand-total">
                        <h3>VALOR TOTAL:</h3>
                        <h3><i class="fas fa-brazilian-real-sign"></i> <strong><?= $total_itens ?></strong></h3>
                    </div>
                    <div>
                        <select name="tipo_pagamento" id="">
                            <option value="PIX">PIX</option>
                            <option value="Boleto">Boleto</option>
                            <option value="cc">Cartão de Crédito</option>
                            <option value="cd">Cartão de Débito</option>
                        </select>
                        <input type="submit" value="Finalizar Compra">
                    </div>
                </form>
            </div>
        </div>
    </section>
</body>
</html>


