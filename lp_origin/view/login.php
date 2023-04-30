<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="apple-touch-icon" sizes="180x180" href="favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon_io/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <title>Login - Cine Community </title>
</head>
<body>
    <header class="header" >
        <a href="index.php" class="logo"><img src="assets/Captura de tela 2023-03-17 164726.png" alt=""></a>
    
        <nav class="navbar" style="-i:1;">
            <a href="../index.php" style="-i:2;">Inicio</a>
            <a href="./cadastro.php" style="-i:3;">Cadastro</a>
            <a href="./login.php" style="-i:4;">Login</a>
        </nav>
    </header>
    <div class="main-login">
        <div class="left-login">
            <h1>As melhores resenhas da comunidade estão aqui!</h1>
          <img src="../assets/Captura de tela 2023-03-17 164726.png" class="left-login-image" alt="Cadastro">
        </div>
        <form action="../control/login_control.php" method="post">
            <div class="right-login">
                <div class="card-login">
                    <h1>Login</h1>
                    <div class="textfield">
                    </div>
                    <div class="textfield">
                        <label for="email"></label>
                        <input  type="email" name="email_usu" placeholder="Email">
                    </div>
                    <div class="textfield">
                        <a href=""></a>
                        <label for="senha"></label>
                        <input type="password" name="senha_usu" placeholder="senha">
                    </div>
                    <input type="submit" value="Enviar" class="btn-login">
                
                    Não tem conta? <a style="color:#3095a7;" href="cadastro.php">Cadastrar-se</style></a>
                </div>
            </div>
        </form>
       </div> 
       
</body>
</html>