<?php
session_start();
require_once '../model/dao/UsuarioDAO.php';
require_once '../model/dao/filmeDAO.php';
require_once '../model/dao/favoritoDAO.php';
require_once '../model/dto/favoritoDTO.php';

$usuarioDAO = new UsuarioDAO();
$filmeDAO = new FilmeDAO();
$favoritoDAO = new FavoritoDAO();

// Verifica se o usuário está logado
if (isset($_SESSION["id_usuario"]) && $_SESSION["id_usuario"] !== null) {
    $id_perfil = $_SESSION["id_perfil"];
    $id_usuario = $_SESSION["id_usuario"];

    // Verifica se foi passado o ID do filme via GET
    if (isset($_GET['id_filme'])) {
        $id_filme = $_GET['id_filme'];

        // Verifica se o filme existe
        $filme = $filmeDAO->obterFilmeId($id_filme);

        if ($filme) {
            // Cria um objeto FavoritoDTO
            $favoritoDTO = new FavoritoDTO();
            $favoritoDTO->setFavorito(true);
            $favoritoDTO->setFk_id_usuario($id_usuario);
            $favoritoDTO->setFk_id_perfil($id_perfil);
            $favoritoDTO->setFk_id_filme($id_filme);

            // Verifica se o filme já está marcado como favorito pelo usuário
            $favorito = $favoritoDAO->verificarFavorito($favoritoDTO);

            if ($favorito) {
                // Filme já está marcado como favorito, então desmarca
                $favoritoDAO->removerFavorito($favoritoDTO);
                $_SESSION['msg'] = "Filme removido dos favoritos.";
            } else {
                // Filme não está marcado como favorito, então marca
                $favoritoDAO->marcarFavorito($favoritoDTO);
                $_SESSION['msg'] = "Filme adicionado aos favoritos.";
            }

            // Redireciona para a página inicial
            header("Location: ../view/Filmefavorito.php");
            exit();
        } else {
            $_SESSION['msg'] = "Filme não encontrado.";
            header("Location: ../index.php");
            exit();
        }
    } else {
        $_SESSION['msg'] = "ID do filme não fornecido.";
        header("Location: ../index.php");
        exit();
    }
} else {
    $_SESSION['msg'] = "Usuário não encontrado.";
    header("Location: ../index.php");
    exit();
}
?>