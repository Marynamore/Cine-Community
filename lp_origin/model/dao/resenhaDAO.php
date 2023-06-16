<?php

require_once __DIR__ . '/../conexao.php';
require_once __DIR__ . '/../dto/resenhaDTO.php';

class ResenhaDAO {

    public $pdo;

    public function __construct()
    {
        $this->pdo = Conexao::getInstance();
    }

    public function cadastrarResenha(ResenhaDTO $resenhaDTO) {
        try {
            $sql = "INSERT INTO resenha (fk_id_filme, fk_id_usuario, titulo_res, descricao_res, dt_hora_res, denuncia_res, situacao_res, avaliacao_res, fk_id_perfil) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $cadastrarResenha = $this->pdo->prepare($sql);
            $cadastrarResenha->bindValue(1, $resenhaDTO->getFK_id_filme());
            $cadastrarResenha->bindValue(2, $resenhaDTO->getFK_id_usuario());
            $cadastrarResenha->bindValue(3, $resenhaDTO->getTitulo_res());
            $cadastrarResenha->bindValue(4, $resenhaDTO->getDescricao_res());
            $cadastrarResenha->bindValue(5, $resenhaDTO->getDt_hora_res());
            $cadastrarResenha->bindValue(6, $resenhaDTO->getDenuncia_res());
            $cadastrarResenha->bindValue(7, $resenhaDTO->getSituacao_res());
            $cadastrarResenha->bindValue(8, $resenhaDTO->getAvaliacao_res());
            $cadastrarResenha->bindValue(9, $resenhaDTO->getFK_id_perfil());
            return $cadastrarResenha->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
    }

    public function verificarResenha($get_id) {
        try {
            $sql = "SELECT r.*, u.nome_usu, u.foto_usu, u.id_usuario, p.id_perfil FROM resenha r INNER JOIN usuario u ON r.fk_id_usuario = u.id_usuario INNER JOIN perfil p ON r.fk_id_perfil = p.id_perfil WHERE r.fk_id_filme = ?";
            
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$get_id]);
            
            $resenhas = array();
            if ($stmt->rowCount() > 0) {
                while ($resenhaFetch = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $ResenhaDTO = new ResenhaDTO();
                    $ResenhaDTO->setId_resenha($resenhaFetch['id_resenha']);
                    $ResenhaDTO->setTitulo_res($resenhaFetch['titulo_res']);
                    $ResenhaDTO->setDescricao_res($resenhaFetch['descricao_res']);
                    $ResenhaDTO->setDt_hora_res($resenhaFetch['dt_hora_res']);
                    $ResenhaDTO->setSituacao_res($resenhaFetch['situacao_res']);
                    $ResenhaDTO->setFk_id_usuario($resenhaFetch['id_usuario']);
                    $ResenhaDTO->setFk_id_perfil($resenhaFetch['id_perfil']);
                    $resenhas[] = $ResenhaDTO;
                }
                return $resenhas;
            } else {
                return array(); // Retorna um array vazio se não houver resenhas
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            return array(); // Retorna um array vazio em caso de exceção
        }
    }
    
    

    public function alterarResenha(ResenhaDTO $ResenhaDTO) {
        try {
            $sql = "UPDATE resenha SET avaliacao_res=?, titulo_res=?, descricao_res=?,
            dt_hora_res=?, denuncia_res=?, situacao_res=?, fk_id_usuario=?, fk_id_perfil=? WHERE id_resenha=?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $ResenhaDTO->getAvaliacao_res());
            $stmt->bindValue(2, $ResenhaDTO->getTitulo_res());
            $stmt->bindValue(3, $ResenhaDTO->getDescricao_res());
            $stmt->bindValue(4, $ResenhaDTO->getDt_hora_res());
            $stmt->bindValue(5, $ResenhaDTO->getDenuncia_res());
            $stmt->bindValue(6, $ResenhaDTO->getSituacao_res());
            $stmt->bindValue(7, $ResenhaDTO->getFk_id_usuario());
            $stmt->bindValue(8, $ResenhaDTO->getFk_id_perfil());
            $stmt->bindValue(9, $ResenhaDTO->getId_resenha());
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }    
    }
    

public function excluirResenhaById($id_resenha){
        try{
            $sql = "DELETE FROM resenha WHERE id_resenha=?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $id_resenha);
            $stmt->execute();
           
            return true;
    } catch (PDOException $e) {
        echo $e->getMessage();
        return false;
    }

    }
 
    public function buscarPorID($id) {
        try {
            $sql = "SELECT f.*, u.id_usuario, p.id_perfil FROM resenha f 
                    INNER JOIN usuario u ON f.fk_id_usuario = u.id_usuario 
                    INNER JOIN perfil p ON f.fk_id_perfil = p.id_perfil 
                    WHERE id_resenha = ?";
            
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$id]);
    
            $resenhaFetch = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($resenhaFetch) {
                $ResenhaDTO = new ResenhaDTO();
                $ResenhaDTO->setId_resenha($resenhaFetch['id_resenha']);
                $ResenhaDTO->setTitulo_res($resenhaFetch['titulo_res']);
                $ResenhaDTO->setDescricao_res($resenhaFetch['descricao_res']);
                $ResenhaDTO->setDt_hora_res($resenhaFetch['dt_hora_res']);
                $ResenhaDTO->setSituacao_res($resenhaFetch['situacao_res']);
                $ResenhaDTO->setFk_id_usuario($resenhaFetch['id_usuario']);
                $ResenhaDTO->setFk_id_perfil($resenhaFetch['id_perfil']);
    
                return $ResenhaDTO;
            } else {
                return null;
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
    
    public function denunciarResenha($id_resenha, $denuncia_res) {
        try {
            $sql = "UPDATE resenha SET denuncia_res = denuncia_res + 1 WHERE id_resenha = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $id_resenha);
            $stmt->execute();
    
            // Inserir a denúncia na tabela de denúncias
            $sqlDenuncia = "INSERT INTO resenha (id_resenha, denuncia_res) VALUES (?, ?)";
            $stmtDenuncia = $this->pdo->prepare($sqlDenuncia);
            $stmtDenuncia->bindValue(1, $id_resenha);
            $stmtDenuncia->bindValue(2, $denuncia_res);
            $stmtDenuncia->execute();
    
            // Chamar a função para enviar a notificação de denúncia para o administrador
            // $this->enviarNotificacaoDenunciaResenha($id_resenha, $denuncia_res);
    
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    
    // public function enviarNotificacaoDenunciaResenha($id_resenha, $denuncia_res) {
    //     // Aqui você pode implementar o código para enviar a notificação para o administrador,
    //     // por exemplo, enviando um e-mail com as informações relevantes da denúncia.
    //     // Certifique-se de configurar corretamente o envio de e-mails na sua aplicação.
    // }
    
    public function buscarResenhasDenunciadas() {
        try {
            $sql = "SELECT * FROM resenha WHERE denuncia_res > 0";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            
            $denuncias = array();
            while ($resenhaFetch = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $ResenhaDTO = new ResenhaDTO();
                $ResenhaDTO->setId_resenha($resenhaFetch['id_resenha']);
                $ResenhaDTO->setTitulo_res($resenhaFetch['titulo_res']);
                $ResenhaDTO->setDt_hora_res($resenhaFetch['dt_hora_res']);
                $ResenhaDTO->setDenuncia_res($resenhaFetch['denuncia_res']);
                $ResenhaDTO->setSituacao_res($resenhaFetch['situacao_res']);
                $ResenhaDTO->setFk_id_usuario($resenhaFetch['fk_id_usuario']);
                $ResenhaDTO->setFk_id_perfil($resenhaFetch['fk_id_perfil']);
                
                $denuncias[] = $ResenhaDTO;
            }
            
            return $denuncias;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            return array(); // Retorna um array vazio em caso de exceção
        }
    }
    
}
?>
