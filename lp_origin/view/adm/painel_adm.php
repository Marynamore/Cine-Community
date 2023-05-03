<?php
session_start();
if(!isset($_SESSION["admin"])) {
	header("Location: login.php");
	exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Painel de Administração</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>Painel de Administração</h1>
    </header>
    <nav>
        <ul>
            <li><a href="#usuarios">Usuários</a></li>
            <li><a href="#filmes">Filmes</a></li>
			<li><a href="#">Configurações</a></li>
			<li><a href="#">Logout</a></li>
        </ul>
    </nav>
    <main>
        <h2>Bem-vindo à página de administração!</h2>
        <p>Olá, <?php echo $_SESSION["admin"]; ?>!</p>
<?php

   require_once '../model/dao/UsuarioDAO.php';
   require_once '../model/dao/filmeDAO.php';
   $UsuarioDAO = new UsuarioDAO();
   $usuario = $UsuarioDAO->listarTodos();

   $FilmeDAO = new FilmeDAO();
   $filme = $FilmeDAO->listarTodos();

?>
    <header>
      <center class="cabecalho">
          Lista de usuario <br><br>
          </center>
          <?php
            if(isset($_GET["msg"])){
                echo "<center>".$_GET["msg"]."</center>";
            }
        ?>
    </header>
        <div class="main-content">
            <section id="usuarios">
                <h2>Usuários</h2>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Nickname</th>
                            <th>Gênero</th>
                            <th>Data de nascimento</th>
                            <th>Email</th>
                            <th>Senha</th>  
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="tabela">
                        <?php
                            foreach($usuario as $usuario ){
                        ?>
                        <tr>
                            <td><?php echo $usuario["id_usuario"]?></td>
                            <td><?=$usuario["nome_usu"]?></td>
                            <td><?=$usuario["nickname_usu"] ?></td>
                            <td><?=$usuario["genero_usu"] ?></td>
                            <td><?=$usuario["dt_de_nasci_usu"]?></td>
                            <td><?=$usuario["email_usu"]?></td>
                            <td><?=$usuario["senha_usu"]?></td>
                            <td>
                                <a href="./alterar_usuario.php?id=<?=$usuario["id_usuario"]?>"title="ALTERAR"> Alterar<i class="bi bi-pencil"></i></a>
                                <a href="../control/excluir.php?id=<?=$usuario["id_usuario"]?>" title="EXCLUIR">Excluir<i class="fa fa-trash fa-lg"></i></a>
                        </td>
                        </td>
                        </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>
            </section>
            <section id="filmes">
                <h2>Filmes</h2>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Data de lançamento</th>
                            <th>Classificação</th>
                            <th>Gênero</th>
                            <th>Duração</th>
                            <th>Sinopse</th>
                            <th>Capa</th>
                            <th>Canal</th>             
                            <th>Editar</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="tabela">
                        <?php
                            foreach($filme as $filme ){
                        ?>
                        <tr>
                            <td><?php echo $filme["id_filme"]?></td>
                            <td><?=$filme["nome_filme"]?></td>
                            <td><?=$filme["dt_de_lancamento_filme"] ?></td>
                            <td><?=$filme["classificacao_filme"] ?></td>
                            <td><?=$filme["genero_filme"]?></td>
                            <td><?=$filme["duracao_filme"]?></td>
                            <td><?=$filme["sinopse_filme"]?></td>
                            <td><?=$filme["capa_filme"]?></td>
                            <td><?=$filme["canal_filme"]?></td>
                            <td>
                                <a href="./alterar_filme.php?id=<?=$filme["id_filme"]?>"title="ALTERAR"> Alterar<i class="bi bi-pencil"></i></a>
                                <a href="./excluir.php?id=<?=$filme["id_filme"]?>" title="EXCLUIR">Excluir<i class="fa fa-trash fa-lg"></i></a>
                        </td>
                        </td>
                        </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>
            </section>
        </div>
    </main>
</body>
</html>

