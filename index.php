<?php
session_start();

if (isset($_SESSION["id_usuario"])) {
    $usuarioLogado = $_SESSION["nickname_usu"];
    $id_usuarioLogado = $_SESSION["id_usuario"];
    $id_perfil = $_SESSION["id_perfil"];
} else {
    $usuarioLogado = null;
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <link rel="apple-touch-icon" sizes="180x180" href="favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon_io/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <title>Cine Community</title>
    <script>
        function exibirAlerta(tipo, mensagem) {
            let title;
            if (tipo === 'success') {
                if (mensagem === 'Login realizado com Sucesso!') {
                    title = 'Login realizado com Sucesso!';
                } else if (mensagem === 'Usuário realizado com Sucesso!') {
                    title = 'Usuário realizado com Sucesso!';
                } else if (mensagem === 'Cadastro realizado com Sucesso!') {
                    title = 'Cadastro realizado com Sucesso!';
                }
            } else {
                title = 'OPS! Email e/ou Senha Inválidos';
            }

            Swal.fire({
                icon: tipo,
                title: title,
                text: mensagem,
            });
        }
    </script>
</head>

<body>
    <div id="container">
        <header class="header">
            <a href="index.php" class="logo">
                <img src="assets/logoinicio.png" alt="index.php">
            </a>
            <nav class="navbar">
                <a href="index.php"><i class="fa-solid fa-house"></i>INICIO</a>
                <?php
                if (!empty($usuarioLogado)) {
                    if ($id_perfil == 1) {
                        echo '<a href="./view/dashboard/painel_adm.php"><i class="fa-solid fa-user"></i>Painel Administrador</a>';
                        echo '<a class="border1" href="./control/control_sair.php" class="item_menu"><i class="fa-solid fa-right-from-bracket"></i>SAIR</a>';
                    } elseif ($id_perfil == 2) {
                        echo '<a href="./view/dashboard/painel_moderador.php"><i class="fa-solid fa-users"></i> PAINEL MODERADOR</a>';
                        echo '<a class="border1" href="./control/sair_usu_action.php" class="item_menu"><i class="fa-solid fa-right-from-bracket"></i>SAIR</a>';
                    } elseif ($id_perfil == 3 || $id_perfil == 4) {
                        echo '<a href="./view/perfil_usuario.php?id_usuario=' . $id_usuarioLogado . '" onclick="funcPerfil()"><i class="fa-solid fa-user"></i>' . $usuarioLogado . '</a>';
                        echo '<a class="border1" href="./control/sair_usu_action.php" class="item_menu"><i class="fa-solid fa-right-from-bracket"></i>SAIR</a>';
                    }
                } else {
                    echo '<a href="./view/cadastro_usu.php"><i class="fa-solid fa-user"></i>CADASTRO</a>';
                    echo '<a href="./view/login.php"><i class="fa-solid fa-user"></i>LOGIN</a>';
                }
                ?>
            </nav>
        </header>
        <?php
            if (isset($_GET['msg'])) {
                if ($_GET['msg'] === 'success') {
                    $tipo = 'success';
                    if ($_GET['action'] === 'login') {
                        $mensagem = 'Login realizado com Sucesso!';
                    } elseif ($_GET['action'] === 'alterar') {
                        $mensagem = 'Atualização feita com Sucesso!';
                    } elseif ($_GET['action'] === 'cadastro') {
                        $mensagem = 'Cadastro realizado com Sucesso!';
                    }  elseif ($_GET['action'] === 'excluir') {
                        $mensagem = 'Usuário excluido com Sucesso!';
                    }else {
                        // Ação desconhecida
                        $tipo = 'error';
                        $mensagem = 'Ação desconhecida';
                    }
                }else if ($_GET['msg'] === 'warning') {
                    $tipo = 'warning';
                    if ($_GET['action'] === 'perfil') {
                        $mensagem = 'OPS! É necessário fazer Login';
                    } elseif ($_GET['action'] === 'alterar') {
                        $mensagem = 'OPS! Algo deu errado ao altera Usuário!';
                    } elseif ($_GET['action'] === 'cadastro') {
                        $mensagem = 'OPS! Algo deu errado ao cadastar Usuário!';
                    }elseif ($_GET['action'] === 'excluir') {
                        $mensagem = 'OPS! Algo deu errado ao excluir Usuário!';
                    } else {
                        // Valor não esperado em $_GET['msg']
                        $tipo = 'error';
                        $mensagem = 'Mensagem de erro desconhecida';
                    }
                }else if ($_GET['msg'] === 'error') {
                    $tipo = 'error';
                    if ($_GET['action'] === 'login') {
                        $mensagem = 'ERRO! Email e/ou Senha Inválidos';
                    } elseif ($_GET['action'] === 'alterar') {
                        $mensagem = 'ERRO ao altera Usuário!';
                    } elseif ($_GET['action'] === 'cadastro') {
                        $mensagem = 'ERRO ao cadastar Usuário!';
                    }elseif ($_GET['action'] === 'excluir') {
                        $mensagem = 'ERRO ao excluir Usuário!';
                    } else {
                        $tipo = 'error';
                        $mensagem = 'Mensagem de erro desconhecida';
                    }
                }
            } else {
                // $_GET['msg'] não está definida
                $tipo = null;
                $mensagem = null;
            }
        ?>
        <script>
            function exibirAlerta(tipo, titulo, mensagem) {
                Swal.fire({
                    icon: tipo,
                    title: titulo,
                    text: mensagem,
                });
            }
            <?php if ($tipo && $mensagem): ?>
            exibirAlerta("<?php echo $tipo; ?>", "<?php echo $mensagem; ?>");
            <?php endif; ?>
        </script>
        <section>
            <div class="box">
                <div class="box-image"><img src="./assets/banner/imagemsite.png"></div>
                <div class="box-image"><img src='./assets/banner/Banner loja virtual cosméticos black friday .png'></div>
                <div class="box-image"><img src="./assets/banner/avatar.jpeg"></div>
                <div class="box-image"><img src='./assets/banner/creed3.jpg'></div>
                <div class="box-image"><img src="./assets/banner/Indiana-Jones.jpg"></div>
                <div class="box-image"><img src='./assets/banner/guardians-galaxy.jpg'></div>
                <div class="box-image"><img src='./assets/banner/oppenheimer.jpg'></div>
                <div class="box-image"><img src='./assets/banner/supermario.jpg'></div>
                <div class="box-image"><img src='./assets/banner/velozesefuriososx.png'></div>
            </div>
        </section>
        <div class="container-filme">
            <div class="container-galeria">
                <?php
            require_once './model/dao/favoritoDAO.php';
            require_once './model/dao/filmeDAO.php';
            
            $filmeDAO = new FilmeDAO();
            $favoritoDAO = new FavoritoDAO();
            
            $filmes = $filmeDAO->listarTodos();
            $categorias = array();
            
            // Obter todas as categorias dos filmes
            foreach ($filmes as $filmeFetch) {
                $categoria = $filmeFetch['categoria_filme'];
                if (!in_array($categoria, $categorias)) {
                    $categorias[] = $categoria;
                }
            }
            
            // Exibir os filmes agrupados por categoria
            foreach ($categorias as $categoria) {
                echo '<div class="categoria">';
                echo '<h2>' . $categoria . '</h2>';
                echo '<div class="filme-carousel">';
            
                foreach ($filmes as $filmeFetch) {
                    if ($filmeFetch['categoria_filme'] === $categoria) {
                        $id_filme = $filmeFetch['id_filme'];
                        $favoritoDTO = new FavoritoDTO();
                        $favoritoDTO->setFk_id_filme($id_filme);
                        if (isset($_SESSION['id_usuario'])) {
                            $favoritoDTO->setFk_id_usuario($_SESSION['id_usuario']);
                        } else {
                            // Defina um valor padrão ou faça outra ação apropriada
                            $favoritoDTO->setFk_id_usuario(0); // Por exemplo, 0 indica que o usuário não está logado
                        }
                        $isFavorito = $favoritoDAO->verificarFavorito($favoritoDTO);
                        ?>
                        <div class="filme-item">
                            <a href="./view/filme_resenha.php?get_id=<?= $filmeFetch['id_filme']; ?>"></a>
                            <?php if ($isFavorito) { ?>
                                <a href="./control/favoritar.php?id_filme=<?= $filmeFetch['id_filme']; ?>&remover=1" class="favorito">
                                    <button><i class="fa fa-star" style="color: #0959e1;"></i></button>
                                </a>
                            <?php } else { ?>
                                <a href="./control/favoritar.php?id_filme=<?= $filmeFetch['id_filme']; ?>" class="favorito">
                                    <button><i class="fa fa-star" style="color: #ccc;"></i></button>
                                </a>
                            <?php } ?>
                            <a href="./view/filme_resenha.php?get_id=<?= $filmeFetch['id_filme']; ?>">
                                <img src="assets/<?= $filmeFetch['capa_filme']; ?>" alt="Capa do filme <?= $filmeFetch['nome_filme']; ?>">
                            </a>
                        </div>
                    <?php
                    }
                }
            
                echo '</div>';
                echo '</div>';
            }
            
            
                ?>
            </div>
    </div>
    <br>
    <hr>

    <!-- INICIO TELA COLECIONÁVEIS -->
    <section class="sessaocompras">
        <br>
        <div class="compras">
            <h1>Compre e/ou Venda Itens Colecionáveis</h1><br>
            <p>Encontre os itens mais raros e exclusivos para completar sua coleção. Nosso site oferece uma ampla variedade de itens colecionáveis. Explore a nossa seleção e participe da comunidade de colecionadores!</p>

            <div class="product-list">
                <div class="product-item">
                    <img src="../lp_origin/assets/boneco-coringa.jpg" alt="Produto 1">
                    <div class="title">Produto 1</div>
                    <div class="price">$10.00</div>
                    <div class="description">Descrição do Produto 1</div>
                </div>

                <div class="product-item">
                    <img src="../lp_origin/assets/bonecojason.webp" alt="Produto 2">
                    <div class="title">Produto 2</div>
                    <div class="price">$15.00</div>
                    <div class="description">Descrição do Produto 2</div>
                </div>

                <div class="product-item">
                    <img src="../lp_origin/assets/bonecorambo.webp" alt="Produto 3">
                    <div class="title">Produto 3</div>
                    <div class="price">$20.00</div>
                    <div class="description">Descrição do Produto 3</div>
                </div>

            </div>
        </div>
        <center><a href="../lp_origin/view/todos_itens.php" class="checkout-btn">Explorar Itens</a>
            </div>
        </center>

    </section>

    <!-- FIM TELA COLECIONÁVEIS -->
    <hr>
    <footer>
        <center>
            <h3>O lugar perfeito para os amantes do cinema!</h3>
        </center>
        <center>
            <h5>Nos siga!</h5>
        </center>

        <div class="rodapeinicio">
            <div class="rodapesocial">
                <button class="botaorodape"> <a href="https://www.youtube.com/watch?v=W4VTq0sa9yg" class="social">Instagram<i class="fab fa-instagram"></i></a></button>
                <button class="botaorodape"><a href="https://www.youtube.com/watch?v=Sx86-18V3m8" class="social">Twitter<i class="fab fa-twitter"></i></a></button>
                <button class="botaorodape"><a href="https://www.youtube.com/watch?v=YKdgcYZy1rQ" class="social">Facebook<i class="fab fa-facebook-f"></i></a></button>
            </div>

            <div class="rodapefim">
                <p>Todos os direitos reservados &copy; 2023</p>
            </div>

        </div>
    </footer>
    </div>
    <script src="./js/search.js"></script>
    <script src="./js/carrossel.js"></script>
    <script src="./js/script.js"></script>
    <!-- Inclua o arquivo JavaScript do jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Inclua o arquivo JavaScript do Slick Carousel -->
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel/slick/slick.min.js"></script>
    <script>
        function favoritarFilme(event) {
            event.preventDefault();
            const button = event.target;

            // Adicione ou remova a classe 'favorito-ativo' para alterar a cor do ícone
            button.classList.toggle('favorito-ativo');
        }
    </script>

</body>

</html>