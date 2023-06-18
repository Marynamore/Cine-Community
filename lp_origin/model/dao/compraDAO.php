<?php
require_once __DIR__ .'/../conexao.php';
require_once __DIR__ .'/../dto/compraDTO.php';

class CompraDAO {
    public $pdo;

    public function __construct() {
        $this->pdo = Conexao::getInstance();
    }
   
    public function adicionarCompra($id_usuario, $quant_compra, $preco_compra, $dt_hora_compra, $status_compra, $tipo_pagamento, $id_item, $id_perfil) {
        try {
            $sql = "INSERT INTO compra (quant_compra, preco_compra, dt_hora_compra, status_compra, tipo_pagamento, fk_id_item, fk_id_usuario, fk_id_perfil) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            
            $compraFetch = $this->pdo->prepare($sql);
            $compraFetch->execute([$id_usuario, $quant_compra, $preco_compra, $dt_hora_compra, $status_compra, $tipo_pagamento, $id_item, $id_perfil]);
            return $compraFetch;
        } catch (PDOException $e) {
            echo "Erro ao adicionar a compra no banco de dados: " . $e->getMessage();
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


    public function cancelarPedido($id_carrinho) {
        try {
            $sql = "UPDATE compra SET status_compra=? WHERE id_compra=?";
            $upCar = $this->pdo->prepare($sql);
            $compraDTO = $upCar->execute(['Cancelada', $id_carrinho]);

            return $compraDTO;
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
