<?php

require_once __DIR__ . '/../conexao.php';
require_once __DIR__ . '/../dto/resenha_dto.php';

class ResenhaDAO {

    public function CadastrarResenha( ResenhaDTO $resenhaDTO ) {
        try {
            $con = Conexao::getInstance();
            $sql = "INSERT INTO resenha (descricao_res, dt_hora_res, denuncia_res, situacao_res, avaliacao_res) ";
            $sql .= " VALUES(?, ?, ?, ?, ?)";
            $cadastrarResenha = $con->prepare( $sql );
            $cadastrarResenha->bindValue( 1, $resenhaDTO->getDescricao_res() );
            $cadastrarResenha->bindValue( 2, $resenhaDTO->getDt_hora_res());//date("d/m/Y H:i:s")
            $cadastrarResenha->bindValue( 3, $resenhaDTO->getDenuncia_res() );
            $cadastrarResenha->bindValue( 4, $resenhaDTO->getSituacao_res() );
            $cadastrarResenha->bindValue( 5, $resenhaDTO->getAvaliacao_res() );

            return $cadastrarResenha->execute();

        } catch ( PDOException $e ) {
            echo $e->getMessage();
            die();
        }
    }

}

?>
