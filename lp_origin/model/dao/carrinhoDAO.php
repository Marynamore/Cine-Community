<?php 
require_once __DIR__.'/../conexao.php';
require_once __DIR__.'/../dto/carrinhoDTO.php';

class CarrinhoDAO{
    public $pdo;

    public function __construct()
    {
        $this->pdo = Conexao::getInstance();
    }

public function countItemCarrinho($id_usuario)
{
    try {
        $sql = "SELECT COUNT(*) AS total_itens FROM carrinho WHERE id_usuario=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id_usuario]);
        $total_itens = $stmt->fetchColumn();

        $sql = "SELECT * FROM carrinho WHERE id_usuario=?";
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


public function adicionarItemCar($id_usuarioLogado, $id_item, $qtd_compra, $id_perfil)
{
    try {
        $sqlCar = "SELECT c.*, i.id_item, u.id_usuario, p.id_perfil FROM carrinho c INNER JOIN usuario u ON c.fk_id_usuario = u.id_usuario
                    INNER JOIN item i ON c.fk_id_item = i.id_item
                    INNER JOIN perfil p ON c.fk_id_perfil = p.id_perfil
                    WHERE u.id_usuario=? AND i.id_item=?";
        $verificaCarItem = $this->pdo->prepare($sqlCar);
        $verificaCarItem->execute([$id_usuarioLogado, $id_item]);

        $sqlMaxCar = "SELECT c.*, i.id_item, u.id_usuario, p.id_perfil FROM carrinho c
                    INNER JOIN usuario u ON c.fk_id_usuario = u.id_usuario
                    INNER JOIN item i ON c.fk_id_item = i.id_item
                    INNER JOIN perfil p ON c.fk_id_perfil = p.id_perfil
                    WHERE u.id_usuario=?";
        $maxCarItem  = $this->pdo->prepare($sqlMaxCar);
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

            $sql = "INSERT INTO carrinho (fk_id_usuario, fk_id_item, preco_item, qtd_compra, fk_id_perfil) VALUES (?,?,?,?,?)";
            $adItemCar = $this->pdo->prepare($sql);
            $adItemCar->bindValue(1, $id_usuarioLogado->getFk_id_usuario());
            $adItemCar->bindValue(5, $id_perfil->getFk_id_perfil());
            $adItemCar->execute([$id_usuarioLogado, $id_item, $precoFetch['preco_item'], $qtd_compra, $id_perfil]);

            return 'Item Adicionado ao Carrinho';
        }
    } catch (PDOException $exc) {
        echo $exc->getMessage();
        die();
    }
}


    public function alterarItem(ItemDTO $itemDTO){
        try{
            $sql = "UPDATE item SET nome=?";

            $upItem = $this->pdo->prepare($sql);
            $upItem->bindValue(1, $itemDTO->getNome_item());
            $itemDTO = $upItem->execute();

            return $itemDTO;

        }catch(PDOException $exc){
            echo $exc->getMessage();
        }
    }

    public function excluirItemPorId($id_item){
        try{
        $sql = "DELETE FROM item WHERE id_item=?";
        $exItem = $this->pdo->prepare($sql);

        $exItem->bindValue(1, $id_item);

        return $exItem->execute();

        }catch(PDOException $exc){
            echo $exc->getMessage();
        }
    }

public function obterItemCarPorUsuarioID($id_usuario){
    try{
        $sql = "SELECT c.*, i.id_item, i.preco_item, u.id_usuario, p.id_perfil FROM carrinho c INNER JOIN usuario u ON c.fk_id_usuario = u.id_usuario INNER JOIN item i ON c.fk_id_item = i.id_item INNER JOIN perfil p ON c.fk_id_perfil = p.id_perfil WHERE u.id_usuario=?";
        $carItem = $this->pdo->prepare($sql);
        $carItem->execute([$id_usuario]);

        $carItens = array();
        if($carItem->rowCount() > 0){
            while($carrinhoFetch = $carItem->fetch(PDO::FETCH_ASSOC)){
                $carrinhoDTO = new CarrinhoDTO();

                $carrinhoDTO->setId_carrinho($carrinhoFetch['id_carrinho']);
                $carrinhoDTO->setFk_id_item($carrinhoFetch['fk_id_item']);
                $carrinhoDTO->setDt_hora_car($carrinhoFetch['dt_hora_car']);
                $carrinhoDTO->setQtd_compra($carrinhoFetch['qtd_compra']);
                $carrinhoDTO->setFk_id_usuario($carrinhoFetch['id_usuario']);
                $carrinhoDTO->setFk_id_perfil($carrinhoFetch['fk_id_perfil']);

                $carItens[] = $carrinhoDTO;
            }
        }
        return $carItens;
    } catch(PDOException $exc){
        echo $exc->getMessage();
    }
}

}
