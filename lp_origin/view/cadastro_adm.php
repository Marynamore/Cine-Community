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
</head>

<body>
    <center>
    <div class="container">  
        <form id="contact" action="../control/cadastro_control.php" method="post">
          <h3>Cadastro</h3>
            <input placeholder="Nome" type="text" name="nome_usu" id="">
            <input placeholder="Email" type="email" tabindex="3" name="email_usu" id="" required>
            <input placeholder="Senha" type="password" tabindex="4" name="senha_usu" id="" required>
			<input placeholder="Confirmar Senha" type="password" tabindex="4" name="csenha_usu" id="" required>
			<input type="text" name="dt_de_nasci_usu" id="" placeholder="00/00/0000" required>
			<p>Gênero:</p>
			<select name="genero_usu" id="">
				<option value="---">Selecione</option>
				<option value="feminino">Feminino</option>
				<option value="masculino">Masculino</option>
			</select>
			<p>Perfil:</p>
			<input type="file" id="myfile" name="myfile">
            <input type="hidden" name="perfil_usu" id="Administrador" value="administrador" selected>
            <input type="submit" value="Enviar">     
        </form>
                 <button onclick="javascript:history.go(-1)">Voltar</button>
  </div>
    </center>
             
 </body>
 </html>