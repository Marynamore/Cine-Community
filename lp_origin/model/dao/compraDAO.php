<?php
require_once __DIR__ .'/../conexao.php';
require_once __DIR__ .'/../dto/compraDTO.php';

class CompraDAO {
    public $pdo;

    public function __construct() {
        $this->pdo = Conexao::getInstance();
    }
   
    public function adicionarCompra(CompraDTO $compraDTO) {
        try {
            $sql = "INSERT INTO compra (quant_compra, preco_compra, dt_hora_compra, status_compra, fk_id_carrinho,
            fk_id_item, fk_id_usuario, fk_id_perfil) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $compraDTO->getQuant_compra());
            $stmt->bindValue(2, $compraDTO->getPreco_compra());
            $stmt->bindValue(3, $compraDTO->getDt_hora_compra());
            $stmt->bindValue(4, $compraDTO->getStatus_compra());
            $stmt->bindValue(5, $compraDTO->getFk_id_carrinho());
            $stmt->bindValue(6, $compraDTO->getFk_id_item());
            $stmt->bindValue(7, $compraDTO->getFk_id_usuario());
            $stmt->bindValue(8, $compraDTO->getFk_id_perfil());
    
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Erro ao adicionar a compra no banco de dados: " . $e->getMessage();
            return false;
        }
    }

    public function obterComprasPorUsuario($id_usuario) {
        try {
            $sql = "SELECT c.*, p.perfil_usu, u.id_usuario FROM compra c INNER JOIN perfil p ON c.fk_id_perfil = p.id_perfil INNER JOIN usuario u ON c.fk_id_usuario = u.id_usuario WHERE u.id_usuario=? ORDER BY dt_hora_compra DESC";

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$id_usuario]);  

            $compras = array();
            if ($stmt->rowCount() > 0) {
                while ($compraFetch = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $compraDTO = new CompraDTO();
                    $compraDTO->setId_compra($compraFetch['id_compra']);
                    $compraDTO->setQuant_compra($compraFetch['quant_compra']);
                    $compraDTO->setPreco_compra($compraFetch['preco_compra']);
                    $compraDTO->setDt_hora_compra($compraFetch['dt_hora_compra']);
                    $compraDTO->setStatus_compra($compraFetch['status_compra']);
                    $compraDTO->setFk_id_carrinho($compraFetch['fk_id_carrinho']);
                    $compraDTO->setFk_id_item($compraFetch['fk_id_item']);
                    $compraDTO->setFk_id_usuario($compraFetch['id_usuario']);
                    $compraDTO->setFk_id_perfil($compraFetch['fk_id_perfil']);

                    $compras[] = $compraDTO;
                }
                return $compras;
            } else {
                echo '<p>Nenhuma Compra adicionada ainda!</p>';
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function buscarItem($id_item) {
        try {
            $sql = "SELECT * FROM item WHERE id_item=?";
            $preItem = $this->pdo->prepare($sql);
            $preItem->bindValue(1, $id_item);
            $preItem->execute();
            $itemFetch = $preItem->fetch(PDO::FETCH_ASSOC);

            if ($itemFetch) {
                return $itemFetch;
            }
            return null;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function recuperaCompraId($id_item) {
        try {
            $sql = "SELECT c.*, p.perfil_usu, u.id_usuario FROM compra c INNER JOIN perfil p ON c.fk_id_perfil = p.id_perfil INNER JOIN usuario u ON c.fk_id_usuario = u.id_usuario WHERE c.id_compra=? LIMIT 1";

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$id_item]);  

            if ($stmt->rowCount() > 0) {
                $compraFetch = $stmt->fetch(PDO::FETCH_ASSOC);
                $compraDTO = new CompraDTO();
                $compraDTO->setId_compra($compraFetch['id_compra']);
                $compraDTO->setQuant_compra($compraFetch['quant_compra']);
                $compraDTO->setPreco_compra($compraFetch['preco_compra']);
                $compraDTO->setDt_hora_compra($compraFetch['dt_hora_compra']);
                $compraDTO->setStatus_compra($compraFetch['status_compra']);
                $compraDTO->setFk_id_carrinho($compraFetch['fk_id_carrinho']);
                $compraDTO->setFk_id_item($compraFetch['fk_id_item']);
                $compraDTO->setFk_id_usuario($compraFetch['id_usuario']);
                $compraDTO->setFk_id_perfil($compraFetch['fk_id_perfil']);

                return $compraDTO;
            } else {
                echo '<p>Nenhuma Compra adicionada ainda!</p>';
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function selecionarItem($id_item) {
        try {
            $sql = "SELECT * FROM item WHERE id_item=? LIMIT 1";
            $preItem = $this->pdo->prepare($sql);
            $preItem->bindValue(1, $id_item);
            $preItem->execute();
            $itemFetch = $preItem->fetch(PDO::FETCH_ASSOC);

            if ($itemFetch) {
                return $itemFetch;
            }
            return null;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
}
