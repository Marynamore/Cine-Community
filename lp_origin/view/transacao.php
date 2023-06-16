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
    <link rel="stylesheet" href="../css/modal.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <link rel="apple-touch-icon" sizes="180x180" href="favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon_io/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <title>Detalhes da Transação</title>
</head>
<body>
<div class="overlay"></div>
    <div class="modal" id="modal-opcoes">
        <div class="div_login">
            <form action="../control/.php" method="post" id="form-opcoes">
                <h1></h1><br>
                <input type="hidden" name="" id="resenha-id">
                <input type="text" name="" placeholder="Titulo da resenha" class="input">
                <br><br>
                <input type="text" name="" placeholder="Motivo" class="input">
                <br><br>
                <button class="button">Enviar</button>
            </form>
            <button class="close-button" onclick="closeModal('modal-opcoes')">&times;</button>
        </div>
    </div>
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
                $grand_total = 0;
            if ($itemFetch) {
            ?>

            <section id="product-details">
                <div class="product">
                    <img src="../assets/imagensprodutos/<?= $itemFetch->getImagem_item() ?>">
                </div>
                <div class="product-info">
                    <h2><?= $itemFetch->getNome_item() ?></h2>
                    <?php
                    if($id_perfil == 4){
                    echo '<p>Quantidade: '.$itemFetch->getQtd_item().'</p>';
                    }
                    ?>
                </div>    
                <div class="container">
                    <h2>VALOR TOTAL:</h2>
                    <h3><i class="fas fa-brazilian-real-sign"></i> <strong><?= $itemFetch->getPreco_item() ?></strong></h3>
                </div>
            </section>
            <select id="opcoes">
            <option value="">Selecione uma opção</option>
            <option value="opcao1">Pix</option>
            <option value="opcao2">Boleto</option>
            <option value="opcao3">Cartão de crédito</option>
            <option value="opcao4">Cartão de débito</option>
            </select>
            <a href="meus_pedidos.php?id_item=<?= $item["id_item"] ?>>"> <button class="close-button" onclick="mostrarModal('modal')">Finalizar Comprar</button></a>
            <!-- <button class="close-button" onclick="mostrarModal('modal')">Finalizar Comprar</button> -->
            <?php }?>
            </div>
        </div>
    </div>
    <div class="modal" id="modal">
    <h2>Modal</h2>
    <p id="opcaoSelecionada"></p>
    <button onclick="fecharModal()">Fechar</button>
</div>

    <form action="../control/item_transacao_control.php" method="post">
        <input type="hidden" name="fk_id_compra" value="<?= $id_compra->getFk_id_compra() ?>">  
         <input type="hidden" name="id_item" value="<?= $itemFetch->getId_item() ?>">
        <input type="hidden" name="id_usuario" value="<?= $usuario->getId_usuario() ?>">
        <input type="hidden" name="id_transacao" value="<?= $id_transcao->getId_transacao() ?>">  
        <input type="hidden" name="compra" value="<?= $id_transcao->getTipo_trans()?>">      
        <input type="hidden" name="dt_hora_trans" value="<?= $id_transcao->getTipo_trans() ?>">  
        <input type="hidden" name="valor_total" value="<?=$itemFetch->getPreco_item()?>">
        <a href="https://mpago.la/2YV27jN"><button class="credit-card">Mercado Pago</button></a>
    </form>
<script src="../js/transacao.js"></script>

<<script>
    function mostrarModal() {
        var selectElement = document.getElementById("opcoes");
        var selectedOption = selectElement.options[selectElement.selectedIndex].value;
        var modal = document.getElementById("modal");

        if (selectedOption === "opcao1") {
            // Exibir o modal para a opção 1 (Pix)
            modal.style.display = "block";
        } else if (selectedOption === "opcao2") {
            // Exibir o modal para a opção 2 (Boleto)
            modal.style.display = "block";
        } else if (selectedOption === "opcao3") {
            // Exibir o modal para a opção 3 (Cartão de crédito)
            modal.style.display = "block";
        } else if (selectedOption === "opcao4") {
            // Exibir o modal para a opção 4 (Cartão de débito)
            modal.style.display = "block";
        } else {
            // Ocultar o modal se nenhuma opção for selecionada
            modal.style.display = "none";
        }
    }
</script>

</body>
</html>



