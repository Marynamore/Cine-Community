<?php
session_start()
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <link rel="apple-touch-icon" sizes="180x180" href="favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon_io/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="stylesheet" href="../css/recuperarsenha.css">
    <title>Cine Community|Recuperar Senha</title>
</head>
<body>
<center>
    
<div class="main-login">
    <form action="../control/recuperar_senha.php" method="POST" class="card-login">
        <h1 class="titulo">Recuperar Senha</h1>
        <div class="textfield">
            <?php
                $msg = isset( $_GET['msg'] ) ? $_GET['msg'] : '';
                echo $msg, "<br>";
            ?>
            <label class="email" for="email_usu"><strong>Email:<strong></label>
            <input type="email" name="email_usu" autofocus placeholder="exemplo@gmail.com">
        </div>
        <button type="submit" class="btn-login">Recuperar</button>
        <button type="submit" class="btn-login"><a href="../login_cadastro/login.php">Voltar</a></button>
    </form>
    <?php  
        if(isset($_GET["msg"])){
            $msg= $_GET["msg"];
            echo $msg;
        }
    ?>
    
    </center>
</div>

</body>
</html>
