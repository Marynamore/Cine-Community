<?php

require_once __DIR__ . '/../conexao.php';
require_once __DIR__ . '/../dto/resenhaDTO.php';

class ResenhaDAO {

    public $pdo;

    public function __construct()
    {
        $this->pdo = Conexao::getInstance();
    }

    public function cadastrarResenha( ResenhaDTO $resenhaDTO ) {
        try {
            $sql = "INSERT INTO resenha (fk_filme_id_filme,fk_usuario_id_usuario, titulo_res, descricao_res, dt_hora_res, denuncia_res, situacao_res, avaliacao_res) VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
            $cadastrarResenha = $this->pdo->prepare( $sql );
            $cadastrarResenha->bindValue( 1, $resenhaDTO->getFK_filme_id_filme());
            $cadastrarResenha->bindValue( 2, $resenhaDTO->getFK_usuario_id_usuario());
            $cadastrarResenha->bindValue( 3, $resenhaDTO->getTitulo_res());
            $cadastrarResenha->bindValue( 4, $resenhaDTO->getDescricao_res());
            $cadastrarResenha->bindValue( 5, $resenhaDTO->getDt_hora_res());
            $cadastrarResenha->bindValue( 6, $resenhaDTO->getDenuncia_res());
            $cadastrarResenha->bindValue( 7, $resenhaDTO->getSituacao_res());
            $cadastrarResenha->bindValue( 8, $resenhaDTO->getAvaliacao_res());

            return $cadastrarResenha->execute();

        } catch ( PDOException $e ) {
            echo $e->getMessage();
            die();
        }
    }

    public function verificarResenha(ResenhaDTO $resenhaDTO){
        $sql = "SELECT * FROM resenha WHERE fk_filme_id_filme =? AND fk_usuario_id_usuario =?";
        $resenha = $this->pdo->prepare($sql);   
        $resenha->bindValue(1, $resenhaDTO->getFK_filme_id_filme());
        $resenha->bindValue(2, $resenhaDTO->getFK_usuario_id_usuario());
        $resenha->execute();
    }

}

?>
