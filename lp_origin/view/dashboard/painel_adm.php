<?php
session_start();

// Verifica se a página foi atualizada
if (isset($_POST['refresh'])) {
    // Define o conteúdo do dashboard como a opção selecionada
    $_SESSION['pagina_inicial'] = 'dashboard';
}

// Obtém a página inicial da sessão ou define como dashboard por padrão
$paginaInicial = isset($_SESSION['pagina_inicial']) ? $_SESSION['pagina_inicial'] : 'dashboard';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/styleadm.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <link rel="apple-touch-icon" sizes="180x180" href="favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon_io/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <title>Dashboard</title>
    <script>
        // Função para exibir o conteúdo do botão clicado e armazenar a seleção
        function mostrarConteudo(id) {
            // Oculta todos os conteúdos
            var conteudos = document.getElementsByClassName('conteudo');
            for (var i = 0; i < conteudos.length; i++) {
                conteudos[i].style.display = 'none';
            }

            // Remove a classe 'ativo' de todos os botões
            var a = document.getElementsByClassName('menu-item');
            for (var i = 0; i < a.length; i++) {
                a[i].classList.remove('ativo');
            }

            // Exibe o conteúdo correspondente ao ID do botão clicado
            var conteudo = document.getElementById(id);
            if (conteudo) {
                conteudo.style.display = 'block';
            }

            // Adiciona a classe 'ativo' ao botão clicado
            var a = document.getElementById('a-' + id);
            if (a) {
                a.classList.add('ativo');
            }

            // Armazena a seleção no Local Storage
            localStorage.setItem('pagina_inicial', id);
        }

        // Função para definir o conteúdo inicial ao carregar a página
        function definirConteudoInicial() {
            var paginaInicial = localStorage.getItem('pagina_inicial');
            if (paginaInicial) {
                mostrarConteudo(paginaInicial);
            }
        }
    </script>
</head>
<body onload="definirConteudoInicial()">
<header class="header" >
        <a href="../../index.php" class="logo"><img src="../../assets/logoinicio.png" alt="index.php"></a>
        <nav class="navbar">
            <a href="../../index.php"><i class="fa-solid fa-house"></i>Voltar</a>
        </nav>
    </header>
<header>
        <h1>Dashboard</h1>
    </header>
    <nav class="sidebar">
        <div class='painel_adm'>
            <div class="menu-item ativo" id="botao-dashboard">
                <button onclick="mostrarConteudo('dashboard')">Dashboard</button>
            </div>
            <div class="menu-item">
                <button onclick="mostrarConteudo('filmes')">Filmes</button>
            </div>
            <div class="menu-item">
                <button onclick="mostrarConteudo('resenhas')">Resenhas</button>
            </div>
            <div class="menu-item">
                <button onclick="mostrarConteudo('usuarios')">Usuários</button>
            </div>
            <div class="menu-item">
                <button onclick="mostrarConteudo('itens')">Itens</button>
            </div>
            <div class="menu-item">
                <button onclick="mostrarConteudo('carrinho')">Carrinho de Compra</button>
            </div>
            <div class="menu-item">
                <button onclick="mostrarConteudo('transacoes')">Transações</button>
            </div>
        </div>
    </nav>
    <main class="painel_adm">
        <div class="conteudo" id="dashboard">
            <h2>Olá, <?php echo $_SESSION["nome_usu"]; ?>!</h2>
        </div>
        <div class="conteudo" id="filmes">
            <h2>Filmes</h2>
            <?php
            require_once '../../model/dao/filmeDAO.php';

            $FilmeDAO = new FilmeDAO();
            $filme = $FilmeDAO->listarTodosFilme();

            ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Data de Lançamento</th>
                        <th>Duração</th>
                        <th>Categoria</th>
                        <th>Classificação</th>
                        <th>Capa</th>
            <!--            <th>Trailer</th>
                        <th>Canal</th>-->
                        <th>Ação</th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <?php
                        foreach($filme as $filmeFetch){
                    ?>
                        <td><?=$filmeFetch["id_filme"]?></td>
                        <td><?=$filmeFetch["nome_filme"]?></td>
                        <td><?=$filmeFetch["dt_de_lancamento_filme"] ?></td>
                        <td><?=$filmeFetch["duracao_filme"]?></td>
                        <td><?=$filmeFetch["categoria_filme"]?></td>
                        <td><?=$filmeFetch["classificacao_filme"] ?></td>
                        <td><?=$filmeFetch["capa_filme"]?></td>
                        <td>
                            <a href="../alterar_filme.php?get_id=<?=$filmeFetch["id_filme"]?>"title="ALTERAR" class="editar"> Alterar<i class="bi bi-pencil"></i></a>
                            <a href="../excluir.php?get_id=<?=$filmeFetch["id_filme"]?>" title="EXCLUIR">Excluir<i class="fa fa-trash fa-lg"></i></a>
                        </td>
                    </tr>
                <?php
                    }
                ?>
                </tbody>    
            </table>    
        </div>

        <div class="conteudo" id="resenhas">
            <h2>Resenhas</h2>
            <!-- Conteúdo da seção de Resenhas -->
        </div>

        <div class="conteudo" id="usuarios">
            <h2>Usuários</h2>
            <?php

            require_once '../../model/dao/UsuarioDAO.php';
            $UsuarioDAO = new UsuarioDAO();

            ?>
                <?php
                if(isset($_GET["msg"])){
                    echo "<center>".$_GET["msg"]."</center>";
                }
                ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Nickname</th>
                        <th>Data de Nascimento</th>
                        <th>Gênero</th>
                        <th>E-mail</th>
                        <th>Senha</th>
                        <th>Foto</th>
                        <th>Ação</th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php
                        $usuario = $UsuarioDAO->listarTodos();
                        foreach($usuario as $usuario){
                        ?>
                        <td><?=$usuario["id_usuario"]?></td>
                        <td><?=$usuario["nome_usu"]?></td>
                        <td><?=$usuario["nickname_usu"] ?></td>
                        <td><?=$usuario["genero_usu"] ?></td>
                        <td><?=$usuario["dt_de_nasci_usu"]?></td>
                        <td><?=$usuario["email_usu"]?></td>
                        <td><?=$usuario["senha_usu"]?></td>
                        <td><?=$usuario["foto_usu"]?></td>
                        <td>
                            <a href="../alterar_usuario.php?id=<?=$usuario["id_usuario"]?>"title="ALTERAR"> Alterar<i class="bi bi-pencil"></i></a></button>
                            <a href="../control/excluir.php?id=<?=$usuario["id_usuario"]?>" title="EXCLUIR">Excluir<i class="fa fa-trash fa-lg"></i></a></button>
                        </td>
                    </tr>
                    <?php
                        }
                    ?>
                <!-- adicione mais linhas conforme necessário -->
                </tbody>
            </table>
        </div>

        <div class="conteudo" id="itens">
            <h2>Itens</h2>
            <!-- Conteúdo da seção de Itens -->
        </div>

        <div class="conteudo" id="carrinho">
            <h2>Carrinho de Compra</h2>
            <!-- Conteúdo da seção do Carrinho de Compra -->
        </div>

        <div class="conteudo" id="transacoes">
            <h2>Transações</h2>
            <!-- Conteúdo da seção de Transações -->
        </div>
    </div>    
    </main>
    <form method="post">
            <input type="hidden" name="refresh" value="true">
            <button type="submit" style="display: none;"></button>
    </form>
</body>
</html>