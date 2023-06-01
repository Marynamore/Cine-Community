<?php
session_start();
if (isset($_SESSION["id_usuario"])) {
    $usuarioLogado = $_SESSION["nickname_usu"];
    $id_usuarioLogado = $_SESSION["id_usuario"];
    $id_perfil = $_SESSION["fk_id_perfil"];
} else {
    $usuarioLogado = "";
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="180x180" href="favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon_io/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="stylesheet" href="../css/stylecadastrar.css">
    <title>Cadastrar</title>
    <script>
        function funCad() {
            alert("Seu Cadastro foi concluído com sucesso.");
        }
    </script>


</head>

<body>
    <button onclick="javascript:history.go(-1)" class="botao">Voltar</button>
    <center>
        <div class="container">
            <form id="contact" action="../control/cadastro_control.php" method="post">
                <h3>Cadastro Item</h3>

                <!-- Personal Data -->
                <fieldset>
                    <div class="inputBox">
                        <label for="nome_usu">Nome do Item:</label>
                        <input placeholder="Nome do item" type="text" name="nome_item" id="nome_item" required>
                    </div>
                    <div class="form">
                        <textarea name="descricao_res" cols="30" rows="10" placeholder="DEIXE AQUI SUA RESENHA" required></textarea>
                    </div>
                    <div class="inputBox">
                        <label for="imagem_item">Imagem do Item:</label>
                        <input type="file" name="imagem_item" id="imagem_item">
                    </div>
                    <div class="inputBox">
                        <label for="qtd_item">Quantidade em Estoque:</label>
                        <input placeholder="Quantidade em Estoque" type="text" name="qtd_item" id="qtd_item" required>
                    </div>
                    <label for="fk_id_categoria_item">Categoria do Item:</label>
                    <select name="fk_id_categoria_item" id="fk_id_categoria_item">
                        <option value="1">Livros e Revistas</option>
                        <option value="2">Adereços</option>
                        <option value="3">Posters e Pôsteres</option>
                    </select>
                </fieldset>
                <input type="hidden" name="fk_id_usuario" value="<?= $_SESSION['fk_id_usuario']; ?>">
                <input type="hidden" name="fk_id_perfil" value="<?= $_SESSION['fk_id_perfil']; ?>">

                <input type="submit" onclick="funCad()" value="Enviar" class="botao">
                <input type="reset"  value="Limpar" class="botao">
            </form>
        </div>
    </center>
</body>

</html>
