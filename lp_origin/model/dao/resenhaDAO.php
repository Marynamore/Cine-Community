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

    public function verificarResenha($get_id, $id_usuario){
    try{
        $sql = "SELECT r.*, f.id_filme, u.nome_usu, u.foto_usu, u.id_usuario FROM resenha r INNER JOIN filme f ON r.fk_filme_id_filme = f.id_filme INNER JOIN usuario u ON r.fk_usuario_id_usuario = u.id_usuario WHERE f.id_filme=?";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$get_id, $id_usuario]);

        $resenhas = array();
        if($stmt->rowCount() > 0){
            while ($resenhaFetch = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $ResenhaDTO = new ResenhaDTO();
                $ResenhaDTO->setId_resenha($resenhaFetch['id_resenha']);
                $ResenhaDTO->setTitulo_res($resenhaFetch['titulo_res']);
                $ResenhaDTO->setDescricao_res($resenhaFetch['descricao_res']);
                $ResenhaDTO->setDt_hora_res($resenhaFetch['dt_hora_res']);
                $ResenhaDTO->setSituacao_res($resenhaFetch['situacao_res']);
                $ResenhaDTO->setFk_filme_id_filme($resenhaFetch['id_filme']);
                $ResenhaDTO->setFk_usuario_id_usuario($resenhaFetch['id_usuario']);
                $resenhas[] = $ResenhaDTO;
                
            } return $resenhas;
        }else{
            echo '<p>Nenhuma Resenha adicionada ainda!</p>';
        }
        }catch(PDOException $exc){
        echo $exc->getMessage();
    }
}
}
?>
