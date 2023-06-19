<?php
session_start();
require_once '../model/dao/UsuarioDAO.php';
require_once '../model/dao/FilmeDAO.php';
require_once '../model/dao/FavoritoDAO.php';

$usuarioDAO = new UsuarioDAO();
$filmeDAO = new FilmeDAO();
$favoritoDAO = new FavoritoDAO();

// Verifica se o usuário está logado
if (isset($_SESSION["id_usuario"]) && $_SESSION["id_usuario"] !== null) {
    $id_usuario = $_SESSION["id_usuario"];

    // Obtém a lista de filmes favoritos do usuário
    $filmesFavoritos = $favoritoDAO->obterFilmesFavorito($id_usuario);

    if ($filmesFavoritos) {
        // Exibe os filmes favoritos na página
        foreach ($filmesFavoritos as $filme) {
            echo "<img src='../assets/" . $filme->getCapa_filme() . "' alt='Capa do Filme'>";
            echo "<div class='dados-filme'>";
            echo "<p>" . $filme->getNome_filme() . "</p>";
            echo "</div>";
            // Exiba outras informações do filme conforme necessário
        }
    } else {
        echo "Nenhum filme marcado como favorito.";
    }
} else {
    echo "Usuário não encontrado.";
}
?>
