<?php
require_once __DIR__ . '/../conexao.php';
require_once __DIR__ . '/../dto/FavoritoDTO.php';

class FavoritoDAO {
    private $pdo;

    public function __construct()
    {
        $this->pdo = Conexao::getInstance();
    }

    public function verificarFavorito(FavoritoDTO $favoritoDTO)
{
    try {
        $id_usuario = $favoritoDTO->getFk_id_usuario();
        $id_filme = $favoritoDTO->getFk_id_filme();

        $sql = "SELECT * FROM favorito WHERE fk_id_usuario = ? AND fk_id_filme = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $id_usuario);
        $stmt->bindValue(2, $id_filme);
        $stmt->execute();

        return $stmt->rowCount() > 0;
    } catch(PDOException $exc) {
        echo $exc->getMessage();
        return false;
    }
}


public function removerFavorito(FavoritoDTO $favoritoDTO)
{
    try {
        $id_usuario = $favoritoDTO->getFk_id_usuario();
        $id_filme = $favoritoDTO->getFk_id_filme();

        $sql = "DELETE FROM favorito WHERE fk_id_usuario = ? AND fk_id_filme = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $id_usuario);
        $stmt->bindValue(2, $id_filme);
        $stmt->execute();

        return $stmt->rowCount() > 0;
    } catch(PDOException $exc) {
        echo $exc->getMessage();
        return false;
    }
}


    public function marcarFavorito(FavoritoDTO $favoritoDTO)
{
    try {
        $favorito = $favoritoDTO->getFavorito();
        $id_usuario = $favoritoDTO->getFk_id_usuario();
        $id_perfil = $favoritoDTO->getFk_id_perfil();
        $id_filme = $favoritoDTO->getFk_id_filme();

        if ($this->verificarFavorito($favoritoDTO)) {
            return false;
        }

        $sql = "INSERT INTO favorito (favorito, fk_id_usuario, fk_id_perfil, fk_id_filme) VALUES (?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $favorito);
        $stmt->bindValue(2, $id_usuario);
        $stmt->bindValue(3, $id_perfil);
        $stmt->bindValue(4, $id_filme);
        $stmt->execute();

        return $stmt->rowCount() > 0;
    } catch(PDOException $exc) {
        echo $exc->getMessage();
        return false;
    }
}


    public function obterFilmesFavorito($id_usuario)
    {
        try {
            $sql = "SELECT filme.* FROM filme INNER JOIN favorito ON filme.id_filme = favorito.fk_id_filme WHERE favorito.fk_id_usuario = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $id_usuario);
            $stmt->execute();
    
            $filmesFavoritos = array();
    
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $filme = new FilmeDTO();
                $filme->setId_filme($row['id_filme']);
                $filme->setNome_filme($row['nome_filme']);
                // Preencha outras informações do filme conforme necessário
    
                $filmesFavoritos[] = $filme;
            }
    
            return $filmesFavoritos;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            return array();
        }
    }
    
}

?>
