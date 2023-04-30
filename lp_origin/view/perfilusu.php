<!DOCTYPE html>
<html>
<head>
	<title>Perfil do Usuário</title>
	<link rel="stylesheet" type="text/css" href="../css/perfilusu.css">
</head>
<body>
<?php

require_once '../model/dao/UsuarioDAO.php';
$UsuarioDAO = new UsuarioDAO();
$usuario = $UsuarioDAO->listarTodos();

?>
 <?php
     foreach($usuario as $usuario ){
 ?>
                    
    
                
	<div class="profile-card">
		<div class="profile-header">
			<h1>Perfil do Usuário</h1>
			<img src="profile-pic.jpg" alt="Imagem de perfil">
		</div>
		<div class="profile-info">
			<h3>Informações Pessoais</h3>
            <form action="../control/control_alterar_usuario.php">
			<ul>
				<li><strong>Nome:</strong><input type="text" value="<?=$usuario["nome_usu"]?>"></li> 
				<li><strong>Nickname:</strong><input type="text" value="<?=$usuario["nickname_usu"] ?>">  </li>
				<li><strong>Gênero:</strong><input type="text" value="<?=$usuario["genero_usu"] ?>">  </li>
                <!--<li><strong>Data de Nascimento:</strong><input type="date" value="<?=$usuario["dt_de_nasci_usu"]?>"></li>-->


            <h3>Login</h3>    
				<li><strong>Email:</strong><input type="email" value=" <?=$usuario["email_usu"]?>">  </li>
				<li><strong>Senha:</strong><input type="password" value="<?=$usuario["senha_usu"]?>">   </li>
				
                <input type="submit" value="Alterar">
			</ul>
            <?php 
     }
                ?>
        </form>
		</div>

	</div>
    
</body>
</html>