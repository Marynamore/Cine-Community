<?php
   session_start();
   if(!isset($_SESSION["id_usuario"])) {
    $usuarioLogado = $_SESSION["nickname_usu"];
    $id_usuarioLogado = $_SESSION["id_usuario"];
    $id_perfil =  $_SESSION["id_perfil"];
    //exit;  
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
        function funCad()
        {
        alert("Sua inscrição foi concluída com sucesso.");
        }

    </script>
</head>

<body>
    <center>
    <div class="container">  
        <form id="contact" action="../control/cadastro_control.php" method="post">
            <input type="hidden" name="id_usuario">
          <h3>Cadastro</h3>
            <input placeholder="Nome" type="text" name="nome_usu" id="">
            <input placeholder="Nickname" type="text" tabindex="2" name="nickname_usu" id="" required>
            <input placeholder="Email" type="email" tabindex="3" name="email_usu" id="" required>
            <input placeholder="Senha" type="password" tabindex="4" name="senha_usu" id="" required>
			<input placeholder="Confirmar Senha" type="password" tabindex="4" name="csenha_usu" id="" required>
			<input type="text" name="dt_de_nasci_usu" id="" placeholder="00/00/0000" required>
           <p>Genero:</p>
            <select name="genero_usu" id="">
                <option value="---">Selecione</option>
                <option value="masculino">Masculino</option>
                <option value="feminino">Feminino</option>
                <option value="naoBinario">Não Binário</option>
                <option value="naoDeclarar">Prefiro não Declarar</option>
            </select>
            <p>Perfil:</p>
			<input type="file" id="myfile" name="myfile">
                
            <?php
                //testa se é o administrador 
                if($id_perfil=="1"){
                    //caso seja o usuário administrador, habilita o Perfil e a Situação do Usuário
                    echo '<div class="inputBox">
                    <select id="id_perfil" class="inputUser" name="id_perfil">
                        <option value="1" selected>Administrador</option>
                        <option value="2">Moderador</option>
                        <option value="3">Colecionador</option>
                        <option value="4">Usuario</option>
                    </select>
                    <label for="id_usuario" class="labelInput">Perfil do Usuário:</label>
                    </div><br><br>
                    <div class="inputBox">
                    <select id="situacao_usu" class="inputUser" name="situacao_usu">
                        <option value="Ativo" selected>Ativo</option>
                        <option value="Inativo">Inativo</option>
                        <option value="Bloqueado">Bloqueado</option>
                    </select>
                    <label for="situacao_usu" class="labelInput">Situação do Usuário:</label>
                    </div><br><br>';
                    
                } else {
                    //caso NÃO seja o administrador, esconde o Perfil e a Situação do Usuário 
                    echo '
            <input type="hidden" name="fk_id_perfil" id="Usuario" value="4">
            <input type="hidden" name="situacao_usu" value="Ativo">';
                }
            ?>
            <input type="submit" onclick="funCad()" value="Enviar" class="botao"> 
            <input type="reset" onclick="funCad()" value="Limpar" class="botao"> 
        </form>
            <button onclick="javascript:history.go(-1)" class="botao">Voltar</button>
    </div>
    </center>
             
 </body>
 </html>
 