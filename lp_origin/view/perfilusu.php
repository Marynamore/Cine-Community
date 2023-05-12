<!DOCTYPE html>
<html>
<head>
	<title>Perfil do Usuário</title>
	<link rel="stylesheet" type="text/css" href="../css/perfilusu.css">
</head>
<body>
<?php

	require_once '../model/dao/UsuarioDAO.php';
	$get_id = $_GET['id_usuario'];
    $UsuarioDAO = new UsuarioDAO();
    $usuario = $UsuarioDAO->dadosUsuarioPorId($get_id);

    // echo'<pre>';
    // print_r($usuarioFetch);
    // echo'</pre>';
?>
       
	<div class="profile-card">
		<div class="profile-header">
			<h1>Perfil do Usuário</h1>
			<img src="profile-pic.jpg" alt="Imagem de perfil">
		</div>
		<div class="profile-info">
			<h3>Informações Pessoais</h3>
            <form action="../control/control_alterar_usuario.php">
				<input type="hidden" name="id_usuario" value="<?=$usuarioFetch->getId_usuario()?>">
			<ul>
				<li><strong>Nome:</strong><input type="text" name="nome_usu" value="<?=$usuarioFetch->getNome_usu()?>"></li> 
				<li><strong>Nickname:</strong><input type="text" name="nickname_usu" value="<?=$usuarioFetch->getNickname_usu() ?>">  </li>
				<li><strong>Gênero:</strong><input type="text" name="genero_usu" value="<?=$usuarioFetch->getGenero_usu() ?>">  </li>
                <li><strong>Data de Nascimento:</strong><input type="text" name="dt_de_nasci_usu" value="<?=$usuarioFetch->getDt_de_nasci_usu()?>"></li>


            <h3>Login</h3>    
				<li><strong>Email:</strong><input type="email" name="email_usu" value=" <?=$usuarioFetch->getEmail_usu()?>">  </li>
				<li><strong>Senha:</strong><input type="password" name="senha_usu" value="<?=$usuarioFetch->getSenha_usu()?>">   </li>
				
                <input type="submit" value="Alterar">
			</ul>
        </form>
		</div>

	</div>
    
</body>
</html>