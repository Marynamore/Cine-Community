<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
    <link rel="apple-touch-icon" sizes="180x180" href="favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon_io/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <title>Login - Cine Community </title>
</head>
<body>
    <header class="header" >
        <a href="../index.php" class="logo"><img src="../assets/logologin.png" alt="index.php"></a>
        <nav class="navbar" style="-i:1;">
            <a href="../index.php" style="-i:2;"><i class="fa-solid fa-house"></i><br>INICIO</a>
            <a href="../view/cadastro.php" style="-i:3;"><i class="fa-solid fa-user"></i><br>CADASTRO</a>
            <a href="#comment"><i class="fa-solid fa-comment-dots"></i><br>COMENTÁRIOS</a>
            <a href="#about"><i class="fa-solid fa-users"></i><br>SOBRE NÓS</a>
        </nav>
    </header>
    <div class="main-login">
        <div class="left-login">
          
            
            <h1>As melhores resenhas da comunidade estão aqui!</h1>
          <img src="../assets/pngwing.com.png" class="left-login-image" alt="Cadastro">
        </div>
        <form action="../control/login_control.php" method="post">
            <div class="right-login">
                <div class="card-login">
                <br>
             
                    <h1>Login</h1>
                    <div class="textfield">
                    </div>
                    <div class="textfield">
                        <label for="email_usu"></label>
                        <input  type="email" name="email_usu" placeholder="Email">
                    </div>
                    <div class="textfield">
                        <a href=""></a>
                        <label for="senha_usu"></label>
                        <input type="password" name="senha_usu" placeholder="senha">
                    </div>
                    <input type="submit" value="Enviar" class="btn-login">
                    Esqueceu a Senha? <a style="color:#3095a7;" href="./formulario_recuperar.php">Recupera-se</style></a>
                    Não tem conta? <a style="color:#3095a7;" href="cadastro.php">Cadastrar-se</style></a>
                </div>
            </div>
        </form>
       </div> 
       
</body>
</html>