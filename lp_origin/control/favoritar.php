<?php
    session_start();
    require_once '../model/dao/UsuarioDAO.php';
    require_once '../model/dao/filmeDAO.php';
    

    $usuarioDAO = new UsuarioDAO();
    $filmeDAO = new filmeDAO();
    $favoritoDAO = new favoritoDAO();

    // Verifica se o usuário está logado
    if (isset($_SESSION["id_usuario"]) && $_SESSION["id_usuario"] !== null) {
        $id_perfil = $_SESSION["id_perfil"];
        $id_usuario = $_SESSION["id_usuario"];

        // Verifica se foi passado o ID do filme via GET
        if (isset($_GET['id_filme'])) {
            $id_filme = $_GET['id_filme'];

            // Verifica se o filme existe
            $filme = $filmeDAO->obterfilmePorId($id_filme);

            if ($filme) {
                // Verifica se o filme já está marcado como favorito pelo usuário
                $favorito = $filmeDAO->verificarFavorito($id_filme, $id_usuario);

                if ($favorito) {
                    // filme já está marcado como favorito, então desmarca
                    $filmeDAO->removerFavorito($id_filme, $id_usuario);
                    echo "filme removido dos favoritos.";
                } else {
                    // filme não está marcado como favorito, então marca
                    $filmeDAO->marcarFavorito($id_filme, $id_usuario);
                    echo "filme adicionado aos favoritos.";
                }
            } else {
                echo "filme não encontrado.";
            }
        } else {
            echo "ID do filme não fornecido.";
        }
    } else {
        echo "Usuário não encontrado.";
    }
?>
