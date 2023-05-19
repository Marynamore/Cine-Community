<?php 
 session_start();
 if(!isset($_SESSION["id_usuario"])){
	header ("location:../usuariologado.php?msg=Usuário e/ou senha inválida");
   exit; 
}

if(!isset($_GET["id_usuario"])){
	header("location:../usuariologado.php?msg=Usuario não Encontrado!");
 exit;
}
// Pesquisar no banco o usuario a ser alterado

$usuarioLogado =$_SESSION["nome_usu"];
$usuarioLogado = $_SESSION["id_usuario"];
$usuarioLogado = $_SESSION["perfil_usu"];

require_once "../model/dto/UsuarioDTO.php";
require_once "../model/dao/UsuarioDAO.php";

$UsuarioDAO = new UsuarioDAO();
$id_usuario = $_GET["id_usuario"];

$usuario = $UsuarioDAO->recuperarPorID($id_usuario);

if($usuario == Null){
	header("location:../usuariologado.php?msg=Usuario não encontrado");
	exit;
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Perfil do Usuário</title>
	<link rel="stylesheet" type="text/css" href="../css/perfilusu.css">
</head>
<body>
    
	<div 
       
	
class="profile-card">
		<div class="profile-header">
			<h1>Perfil do Usuário</h1>
			<img src="profile-pic.jpg" alt="Imagem de perfil">
		</div>
		<div class="profile-info">
			<h3>Informações Pessoais</h3>
            <form action="../control/control_alterar_usuario.php">
				<input type="hidden" name="id_usuario" value="<?=$usuario['id_usuario']?>">
			<ul>
				<li><strong>Nome:</strong><input type="text" name="nome_usu" value="<?=$usuario['nome_usu']?>"></li> 
				<li><strong>Nickname:</strong><input type="text" name="nickname_usu" value="<?=$usuario['nickname_usu']?>"></li>
				<li><strong>Gênero:</strong><input type="text" name="genero_usu" value="<?=$usuario['genero_usu']?>"></li>
				<li><strong>Data de Nascimento:</strong><input type="text" name="dt_de_nasci_usu" value="<?=$usuario['dt_de_nasci_usu']?>"></li>
            </ul>
            <h3>Login</h3>    
			<ul>
				<li><strong>Email:</strong><input type="email" name="email_usu" value="<?=$usuario['email_usu']?>"></li>
				<li><strong>Senha:</strong><input type="password" name="senha_usu" value="<?=$usuario['senha_usu']?>"></li>
			</ul>
			<input type="submit" value="Alterar">
        </form>
		</div>
	</div>
   
   
</body>
</html>