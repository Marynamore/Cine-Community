<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../DecoLivre/lp/favicon_io/favicon.ico">
    <link rel="apple-touch-icon" sizes="180x180" href="../DecoLivre/lp/favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../DecoLivre/lp/favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../DecoLivre/lp/favicon_io/favicon-16x16.png">
    <link rel="manifest" href="../DecoLivre/lp/site.webmanifest">
    <link rel="stylesheet" href="../../lp/css/styleLogin.css">
    <title>Cine Community|Nova Senha</title>
</head>
<body>
<?php
$chave = "";
if ($_GET['chave']) {
    $chave = $_GET['chave'];
?>
<div class="main-login">
    <form action="../control/control_nova_senha.php" method="POST" class="card-login">
        <h1 class="titulo">Confirme seu Login</h1>
        <input type="hidden" name="chave" value="<?= $chave?>">
        <div class="textfield">
        <?php
            $msg = isset( $_GET['msg'] ) ? $_GET['msg'] : '';
            echo $msg, "<br>";
            ?>
            <label for="email_usu">Email:</label>
            <input type="email" name="email_usu" required autofocus placeholder="decolivremrr3@gmail.com">
        </div>
        <div class="textfield">
            <label for="senha_usu">Nova Senha:</label>
            <input type="password" name="senha_usu" required placeholder="********">
        </div>
        <button type="submit" class="btn-login">Confirmar</button>

    </form>
    <?php
   }else{
    echo '<h1>Página não encontrada!</h1>';
   }
    ?>
</div>

</body>
</html>
