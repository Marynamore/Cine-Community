<?php
require_once __DIR__.'/../conexao.php';
require_once __DIR__.'/../dto/carrinhoDTO.php';

class CarrinhoDAO {
    public $pdo;

    public function __construct() {
        $this->pdo = Conexao::getInstance();
    }

public function countItemCarrinho($id_usuario) {
    try {
        $sql = "SELECT COUNT(*) AS total_itens FROM carrinho c 
                INNER JOIN usuario u ON c.fk_id_usuario = u.id_usuario
                INNER JOIN item i ON c.fk_id_item = i.id_item
                INNER JOIN perfil p ON c.fk_id_perfil = p.id_perfil
                WHERE u.id_usuario=?";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id_usuario]);
        $total_itens = $stmt->fetchColumn();

        $sql = "SELECT c.*, i.id_item, u.id_usuario, p.id_perfil FROM carrinho c 
                INNER JOIN usuario u ON c.fk_id_usuario = u.id_usuario
                INNER JOIN item i ON c.fk_id_item = i.id_item
                INNER JOIN perfil p ON c.fk_id_perfil = p.id_perfil
                WHERE u.id_usuario=?";
                
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id_usuario]);
        $carrinho_itens = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return [
            'total_itens' => $total_itens,
            'carrinho_itens' => $carrinho_itens
        ];
    } catch (PDOException $exc) {
        echo $exc->getMessage();
    }
}

    
    public function adicionarItemCar($id_usuarioLogado, $id_item, $qtd_compra, $id_perfil) {
        try {
            $sqlCar = "SELECT c.*, i.id_item, u.id_usuario, p.id_perfil FROM carrinho c 
                    INNER JOIN usuario u ON c.fk_id_usuario = u.id_usuario 
                    INNER JOIN item i ON c.fk_id_item = i.id_item 
                    INNER JOIN perfil p ON c.fk_id_perfil = p.id_perfil 
                    WHERE (u.id_usuario=? OR p.id_perfil=?) AND i.id_item=?";
            $verificaCarItem = $this->pdo->prepare($sqlCar);
            $verificaCarItem->execute([$id_usuarioLogado, $id_perfil, $id_item]);

            $sqlMaxCar = "SELECT c.*, u.id_usuario, p.id_perfil FROM carrinho c 
                        INNER JOIN usuario u ON c.fk_id_usuario = u.id_usuario 
                        INNER JOIN perfil p ON c.fk_id_perfil = p.id_perfil 
                        WHERE u.id_usuario=?";
            $maxCarItem = $this->pdo->prepare($sqlMaxCar);
            $maxCarItem->execute([$id_usuarioLogado]);

            if ($verificaCarItem->rowCount() > 0) {
                return 'Já adicionado ao carrinho';
            } elseif ($maxCarItem->rowCount() == 10) {
                return 'O carrinho está cheio';
            } else {
                $sqlItem = "SELECT * FROM item WHERE id_item = ? LIMIT 1";
                $preItem = $this->pdo->prepare($sqlItem);
                $preItem->execute([$id_item]);
                $precoFetch = $preItem->fetch(PDO::FETCH_ASSOC);

                $sql = "INSERT INTO carrinho (fk_id_usuario, fk_id_item, preco, qtd_compra, fk_id_perfil) VALUES (?,?,?,?,?)";
                $adItemCar = $this->pdo->prepare($sql);
                $adItemCar->bindValue(1, $id_usuarioLogado);
                $adItemCar->bindValue(2, $id_item);
                $adItemCar->bindValue(3, $precoFetch['preco_item']);
                $adItemCar->bindValue(4, $qtd_compra);
                $adItemCar->bindValue(5, $id_perfil);
                $adItemCar->execute();

                return 'Item Adicionado ao Carrinho';
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            die();
        }
    }

    public function esvaziarCar($id_usuario) {
        try {
            $sqlItemCar = "SELECT * FROM carrinho WHERE fk_id_usuario=?";
            $preItemCar = $this->pdo->prepare($sqlItemCar);
            $preItemCar->execute([$id_usuario]);

            if ($preItemCar->rowCount() > 0) {
                $sql = "DELETE FROM carrinho WHERE fk_id_usuario=?";
                $exItem = $this->pdo->prepare($sql);
                $exItem->execute([$id_usuario]);

                return true;
            } else {
                return 'Carrinho já está vazio';
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function altualizarQtdCar($qtd_compra,$id_carrinho) {
        try {
            $sql = "UPDATE carrinho SET qtd_compra=? WHERE id_carrinho=?";
            $upCar = $this->pdo->prepare($sql);
            $upCar->bindValue(1, $qtd_compra);
            $upCar->bindValue(2, $id_carrinho);
            $carrinhoDTO = $upCar->execute([$qtd_compra, $id_carrinho]);

            return $carrinhoDTO;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function excluirItemCar($id_carrinho) {
        try {
            $sqlItemCar = "SELECT * FROM carrinho WHERE id_carrinho=?";
            $preItemCar = $this->pdo->prepare($sqlItemCar);
            $preItemCar->execute([$id_carrinho]);

            if($preItemCar->rowCount() > 0){

            $sql = "DELETE FROM carrinho WHERE id_carrinho=?";
            $exItem = $this->pdo->prepare($sql);
            $exItem->bindValue(1, $id_carrinho);

            return $exItem->execute([$id_carrinho]);

            }else {
                return 'Item do Carrinho já excluído';
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function obterItemCarPorUsuarioID($id_usuario) {
        try {
            $sql = "SELECT c.*, i.id_item, i.preco_item, u.id_usuario, p.id_perfil FROM carrinho c 
                    INNER JOIN usuario u ON c.fk_id_usuario = u.id_usuario 
                    INNER JOIN item i ON c.fk_id_item = i.id_item 
                    INNER JOIN perfil p ON c.fk_id_perfil = p.id_perfil 
                    WHERE u.id_usuario=?";
            $carItem = $this->pdo->prepare($sql);
            $carItem->bindValue(1,$id_usuario);
            $carItem->execute([$id_usuario]);

            $carItens = array();
            if ($carItem->rowCount() > 0) {
                while ($carrinhoFetch = $carItem->fetch(PDO::FETCH_ASSOC)) {
                    $carrinhoDTO = new CarrinhoDTO();

                    $carrinhoDTO->setId_carrinho($carrinhoFetch['id_carrinho']);
                    $carrinhoDTO->setFk_id_item($carrinhoFetch['id_item']);
                    $carrinhoDTO->setDt_hora_car($carrinhoFetch['dt_hora_car']);
                    $carrinhoDTO->setPreco($carrinhoFetch['preco_item']);
                    $carrinhoDTO->setQtd_compra($carrinhoFetch['qtd_compra']);
                    $carrinhoDTO->setFk_id_usuario($carrinhoFetch['id_usuario']);
                    $carrinhoDTO->setFk_id_perfil($carrinhoFetch['id_perfil']);

                    $carItens[] = $carrinhoDTO;
                }
                return $carItens;
            }
            return $carItens;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function obterItemCarPorId($id_usuario,$id_perfil) {
        try {
            $sql = "SELECT c.*, i.id_item, i.preco_item, u.id_usuario, p.id_perfil FROM carrinho c 
                    INNER JOIN usuario u ON c.fk_id_usuario = u.id_usuario 
                    INNER JOIN item i ON c.fk_id_item = i.id_item 
                    INNER JOIN perfil p ON c.fk_id_perfil = p.id_perfil 
                    WHERE u.id_usuario=? AND p.id_perfil=?";
            $preCar = $this->pdo->prepare($sql);
            $preCar->execute([$id_usuario,$id_perfil]);

            $carrinho = array();
            if($preCar->rowCount() > 0){
                while ($carrinhoFetch = $preCar->fetch(PDO::FETCH_ASSOC)) {
                    $carrinhoDTO = new CarrinhoDTO();
                    
                    $carrinhoDTO->setId_carrinho($carrinhoFetch['id_carrinho']);
                    $carrinhoDTO->setQtd_compra($carrinhoFetch['qtd_compra']);
                    $carrinhoDTO->setPreco($carrinhoFetch['preco']);
                    $carrinhoDTO->setDt_hora_car($carrinhoFetch['dt_hora_car']);
                    $carrinhoDTO->setFk_id_item($carrinhoFetch['id_item']);
                    $carrinhoDTO->setFk_id_perfil($carrinhoFetch['id_perfil']);
                    $carrinhoDTO->setFk_id_usuario($carrinhoFetch['id_usuario']);             
                    $carrinho[] = $carrinhoDTO;

                } return $carrinho;
            }else{
                echo '<p>Nenhum Item adicionado no carrinho ainda!</p>';
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function obterItemCar($id_item) {
        try {
            $sql = "SELECT c.*, u.id_usuario, p.id_perfil FROM carrinho c 
                    INNER JOIN usuario u ON c.fk_id_usuario = u.id_usuario  
                    INNER JOIN perfil p ON c.fk_id_perfil = p.id_perfil 
                    WHERE c.fk_id_item=?";
            $carItem = $this->pdo->prepare($sql);
            $carItem->execute([$id_item]);

            $carItens = array();
            if ($carItem->rowCount() > 0) {
                while ($carrinhoFetch = $carItem->fetch(PDO::FETCH_ASSOC)) {
                    $carrinhoDTO = new CarrinhoDTO();

                    $carrinhoDTO->setId_carrinho($carrinhoFetch['id_carrinho']);
                    $carrinhoDTO->setDt_hora_car($carrinhoFetch['dt_hora_car']);
                    $carrinhoDTO->setQtd_compra($carrinhoFetch['qtd_compra']);
                    $carrinhoDTO->setFk_id_usuario($carrinhoFetch['id_usuario']);
                    $carrinhoDTO->setFk_id_perfil($carrinhoFetch['id_perfil']);
                    $carrinhoDTO->setFk_id_item($carrinhoFetch['id_item']);
                    $carItens[] = $carrinhoDTO;
                }
            }
            return $carItens;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            return array(); // Retornar um array vazio em caso de erro
        }
    }


}
