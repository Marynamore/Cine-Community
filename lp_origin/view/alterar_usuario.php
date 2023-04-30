<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/formulariofilme.css">
    <title>Alterar usuario</title>
    
</head>
<?php
    require_once '../model/dao/UsuarioDAO.php';
    
    $id = $_GET["id"];
    $usuarioDAO = new UsuarioDAO();
    $usuario = $usuarioDAO->recuperarPorId($id);

    echo'<pre>';
    print_r($usuario);
    echo'</pre>';

?>
<body>
    <h1>Alterar usuario</h1>
    <div class="borda">
        <form  action="../control/control_alterar_usuario.php" method="post">
            <input type="hidden" name="id_usuario" value="<?=$usuario->getId_usuario();?>">
            <!--Poster do usuario-->
            <!--<input type="file" name="capa_usuario" value="<//$usuario->foto_usu();?>"><br><br>-->    
            Nome do usuario:
            <input type="text"  name="nome_usu" placeholder="Nome" value="<?=$usuario->getNome_usu();?>"> <br>  <br>
            Nickname: 
            <input type="text"  name="nickname_usu" placeholder="Nickname" value="<?=$usuario->getNickname_usu();?>"><br><br>
       
            <label for="cars">Gênero:</label>

            <select name="genero_usu" id="cars">
                <option value="Masculino">Masculino</option>
                <option value="Feminino">Feminino</option>
               
            </select>
           
            Data de nascimento: 
            <input type="text" name="dt_de_nasci_usu" placeholder="00/00/0000" value="<?=$usuario->getDt_de_nasci_usu();?>"> <br><br>
            Email: 
            <input type="email" name="email_usu" placeholder="Email" value="<?=$usuario->getEmail_usu();?>"><br><br>     
           Senha : 
            <input type="password" name="senha_usu" value="<?=$usuario->getSenha_usu();?>"><br><br>     
            
            
            <input type="submit" value="Alterar">
        </form>
    </div>
     
 </form><br>
</body>
</html>