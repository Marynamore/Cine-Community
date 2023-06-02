<!DOCTYPE html>
<html>
<head>
  <title>Detalhes do Produto</title>
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" type="text/css" href="../css/itensselecionado.css">
  <meta charset="utf-8">
</head>
<body>

  <div id="container">
    <header class="header" >
        <a href="index.php" class="logo"><img src="../assets/logoinicio.png" alt="index.php"></a>
        <nav class="navbar" style="-i:1;">
            <a href="../view/todos_itens.php" style="-i:2;"><i class="fa-solid fa-house"></i>Voltar</a>

        </nav>
    </header>
    <hr>

  <section id="product-details">
    <div class="product">
      <img src="../assets/bonecorambo.webp" alt="Produto 1">

    </div>

    <div class="product-info">
      <h2>Boneco Rambo</h2>
      <h2>Detalhes do Produto</h2>
      <p>Este é um boneco do rambo colecionável.</p>
      <ul>
        <li>Característica 1</li>
        <li>Característica 2</li>
        <li>Característica 3</li>
      </ul>

      
      <form action="../control/control_carrinho_add.php" method="POST">
                                        <a href="../view/itemseleciondo.php"><img src="../assets/imagensprodutos/<?= $itemFetch['imagem_item'] ?>"></a>
                                        <h2><?= $itemFetch['nome_item'] ?></h2>
                                        <input type="hidden" name="id_item" value="<?= $itemFetch['id_item'] ?>"><br>
                                        <div>
                                            <p><i class="fas fa-brazilian-real-sign"></i> <?= $itemFetch['preco_item'] ?></p>
                                            <input type="number" name="qtd_item" required min="1" value="1" max="99" maxlength="2">
                                        </div><br>
                                        <input type="submit" name="item_adicionado" value="Adicionar" class="submit">
                                        <a href="transacao.php?get_id=<?= $itemFetch['id'] ?>">Comprar</a>
                                    </form>
  </section>
<hr>
  <footer>
    <p>Todos os direitos reservados &copy; 2023</p>
  </footer>
</body>
</html>
