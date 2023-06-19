<?php 
session_start();

require_once '../model/dao/carrinhoDAO.php';
require_once '../model/dao/itemDAO.php';
require_once '../model/dao/UsuarioDAO.php';

if (isset($_GET['id_item'])) {
    $id_item = $_GET['id_item'];
} else {
    $id_item = '';
    header('Location: ./todos_itens.php');
    exit();
}

$itemDAO = new ItemDAO();
$carrinhoDAO = new CarrinhoDAO();
$usuarioDAO = new UsuarioDAO();


if (isset($_SESSION["id_usuario"])) {
    $usuarioLogado = $_SESSION["nickname_usu"];
    $id_usuarioLogado = $_SESSION["id_usuario"];
    $id_perfil = $_SESSION["id_perfil"];
} else {
    $usuarioLogado = "";
    header("Location: ../view/todos_itens.php?msg=Usuário não encontrado");
    exit();
}

$itemFetch = $itemDAO->obterItemPorId($id_item);

if ($itemFetch) {
    if (isset($_SESSION['msg'])) {
        $message = $_SESSION['msg'];
        unset($_SESSION['msg']);
    } else {
        $message = "";
    }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" type="text/css" href="../css/itensselecionado.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
  <link rel="apple-touch-icon" sizes="180x180" href="favicon_io/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="favicon_io/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="favicon_io/favicon-16x16.png">
  <link rel="manifest" href="/site.webmanifest">
  <title>Detalhes do Produto</title>
</head>
<body>
  <div id="container">
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
    <hr>
    <form action="../control/control_carrinho_add.php" method="post">
      <section id="product-details">
        <div class="product">
          <img src="../assets/imagensprodutos/<?= $itemFetch->getImagem_item()?>">
        </div>
        <input type="hidden" name="id_item" value="<?= $itemFetch->getId_item() ?>">
        
        <div class="product-info">
          <h2><?= $itemFetch->getNome_item() ?></h2>
          <br>
          <p><?= $itemFetch->getDescricao_item() ?></p>
          <div>
            <input type="hidden" name="preco_item" value="<?= $itemFetch->getPreco_item() ?>"><br>
            <p>Preço Item: <i class="fas fa-brazilian-real-sign"></i> <?= $itemFetch->getPreco_item() ?></p>
            <p>Quantidade em Estoque: <?= $itemFetch->getQtd_item() ?></p>
            <p>Quantidade para Compra: <input type="number" name="qtd_compra" required min="1" max="99" maxlength="2"></p>
          </div><br>
          <input type="submit" name="item_adicionado" value="Adicionar" class="submit">
          <a class="compraritem" href="transacao.php?id_item=<?= $itemFetch->getId_item() ?>">Comprar</a>
        </div>
      </section>
    </form>
    <hr>
    <footer>
      <p>Todos os direitos reservados &copy; 2023</p>
    </footer>
  </div>
</body>
</html>

<?php 
} else {
    echo '<p>Nenhum item encontrado!</p>';
}
?>
