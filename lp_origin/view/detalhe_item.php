<?php 
session_start();
require '../model/dto/carrinhoDTO.php';
require '../model/dao/carrinhoDAO.php';
require_once '../model/dao/itemDAO.php';

$itemDAO = new ItemDAO();
$carrinhoDAO = new CarrinhoDAO();


if (isset($_GET['id_item'])) {
    $id_item = $_GET['id_item'];
} else {
    $id_item = '';
    header('location:./todos_itens.php');
}

$nickname_usu = isset($_SESSION["nickname_usu"]) ? $_SESSION["nickname_usu"] : '';
$id_usuario = isset($_SESSION['id_usuario']) ? $_SESSION['id_usuario'] : '';
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
          <a href="../view/todos_itens.php" style="-i:2;"><i class="fa-solid fa-house"></i>Voltar</a>
        </nav>
    </header>
    <hr>
    <?php 
    $item = $itemDAO->obterItemPorId($id_tem);
echo '<pre>';
var_dump($item);
echo '</pre>';
    foreach ($item as $itemFetch) {
    ?>
    <form action="detalhe_item_control.php" method="post">
      <section id="product-details">
        <div class="product">
          <img src="../assets/imagensprodutos/<?= $itemFetch['imagem_item'] ?>">
        </div>
        <input type="hidden" name="id_item" value="<?= $itemFetch['id_item'] ?>"><br>
        <div class="product-info">
          <h2>Boneco Rambo</h2>
          <h2><?= $itemFetch['nome_item'] ?></h2>
          <ul>
            <li>Característica 1</li>
            <li>Característica 2</li>
            <li>Característica 3</li>
          </ul>
          <div>
            <p><i class="fas fa-brazilian-real-sign"></i> <?= $itemFetch['preco_item'] ?></p>
            <input type="number" name="qtd_item" required min="1" value="1" max="99" maxlength="2">
          </div><br>
          <input type="submit" name="item_adicionado" value="Adicionar" class="submit">
          <a href="transacao.php?get_id=<?= $itemFetch['id'] ?>">Comprar</a>
        </div>
      </section>
    </form>
    <?php }?>
    <hr>
    <footer>
      <p>Todos os direitos reservados &copy; 2023</p>
    </footer>
  </div>
</body>
</html>