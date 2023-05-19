<?php
session_start();

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Painel de Administração</title>
    <link rel="stylesheet" href="../../css/stylelista.css">
</head>
<body>
    <header class="center">
        <menu class="menu-wrapper flex">
            <div class="logo">
                <img src="assets/logoinicio.png" alt="logo">
            </div><!--logo-->
            <section class="input-search">
                <div class="search-box">
                    <input type="text" class="search-txt" placeholder="Pesquisar"><!--search-text-->
                    <a href="#">
                        <img src="./lp/img/loupe.png" alt="Lupa">
                    </a>
                </div><!--search-box-->                    
                <form action="" method="POST">
                </form><!--POST-->                    
            </section><!--input-search-->        
            <div class="information flex">
                <a href="http://" target="_blank"><i class="fa-solid fa-headphones"><br>AJUDA</i></a><i class="fa-solid fa-grip-lines-vertical"></i><a href="./pages/login_cadastro/login.php"><i class="fa-solid fa-user"><br>LOGIN</i></a> 
            </div><!--information center-->
        </menu><!--menu-wrapper center-->
        <nav class="nav-pages flex">
            <li><a href="../index.php"><i class="fa-solid fa-house"></i><br>INICIO</a></li>
            <li><a href="#"><i class="fa-sharp fa-solid fa-plane"></i><br>PASSAGENS AÉREAS</a></li>
            <li><a href="../index.php"><i class="fa-solid fa-comment-dots"></i><br>COMENTÁRIOS</a></li>
            <li><a href="../index.php"><i class="fa-solid fa-users"></i><br>SOBRE NÓS</a></li>
        </nav><!--nav-page center-->
    </header>
    <header>
        <h1>Painel de Administração</h1>
    </header>
    <nav>
        <ul>
            <li><a href="#usuario">Usuários</a></li>
            <li><a href="#filmes">Filmes</a></li>
			<li><a href="#">Configurações</a></li>
			<li><a href="../../">Logout</a></li>
        </ul>
    </nav>
    <main>
        <h2>Bem-vindo à página de administração!</h2>
        <center><p><h2>Olá, <?php echo $_SESSION["perfil_usu"]; ?>!</h2></p></center>
<?php

   require_once '../../model/dao/UsuarioDAO.php';
   require_once '../../model/dao/filmeDAO.php';
   $UsuarioDAO = new UsuarioDAO();
   $usuario = $UsuarioDAO->listarTodos();

   $FilmeDAO = new FilmeDAO();
   $filme = $FilmeDAO->listarFilmesComCategoria();

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
                            <th>Nome</th>
                            <th>Data de lançamento</th>
                            <th>Classificação</th>
                            <th>Categoria</th>
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
                            <td><?=$filme["categoria_filme"]?></td>
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

