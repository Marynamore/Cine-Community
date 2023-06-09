<?php 
require_once __DIR__.'/../conexao.php';
require_once __DIR__.'/../dto/itemDTO.php';

class ItemDAO{
    public $pdo;

    public function __construct()
    {
        $this->pdo = Conexao::getInstance();
    }

    public function cadastrarItem(ItemDTO $itemDTO){
        try{
            $sql = "INSERT INTO item (nome_item, descricao_item, preco_item, qtd_item,imagem_item, fk_id_categoria_item, fk_id_usuario, fk_id_perfil) VALUES (?,?,?,?,?,?,?,?)";
            $cadItem = $this->pdo->prepare($sql); 

            $cadItem->bindValue(1, $itemDTO->getNome_item());
            $cadItem->bindValue(2, $itemDTO->getDescricao_item());
            $cadItem->bindValue(3, $itemDTO->getPreco_item());
            $cadItem->bindValue(4, $itemDTO->getQtd_item());
            $cadItem->bindValue(5, $itemDTO->getImagem_item());
            $cadItem->bindValue(6, $itemDTO->getFk_id_categoria_item());
            $cadItem->bindValue(7, $itemDTO->getFk_id_usuario());
            $cadItem->bindValue(8, $itemDTO->getFk_id_perfil());

            return $cadItem->execute();
        }catch(PDOException $exc){
            echo $exc->getMessage();
            die();  
        }
    }

    public function alterarItem(ItemDTO $itemDTO) {
        try {
            $sql = "UPDATE item SET nome_item=?, descricao_item=?, preco_item=?, imagem_item=?, fk_id_categoria_item=?, fk_id_usuario=?, fk_id_perfil=?, qtd_item=? WHERE id_item=?";
    
            $upItem = $this->pdo->prepare($sql);
            $upItem->bindValue(1, $itemDTO->getNome_item());
            $upItem->bindValue(2, $itemDTO->getDescricao_item());
            $upItem->bindValue(3, $itemDTO->getPreco_item());
            $upItem->bindValue(4, $itemDTO->getImagem_item());
            $upItem->bindValue(5, $itemDTO->getFk_id_categoria_item());
            $upItem->bindValue(6, $itemDTO->getFk_id_usuario());
            $upItem->bindValue(7, $itemDTO->getFk_id_perfil());
            $upItem->bindValue(8, $itemDTO->getQtd_item());
            $upItem->bindValue(9, $itemDTO->getId_item());
    
            return $upItem->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
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

    public function listarTodosItens(){
        try{
            $sql = "SELECT i.id_item, i.imagem_item, i.nome_item, i.preco_item, i.qtd_item, ci.categoria_item, u.id_usuario, p.id_perfil FROM item i INNER JOIN categoria_item ci ON i.fk_id_categoria_item = ci.id_categoria_item INNER JOIN usuario u ON i.fk_id_usuario = u.id_usuario INNER JOIN perfil p ON i.fk_id_perfil = p.id_perfil ORDER BY  id_item ";

            $allItem = $this->pdo->prepare($sql);
            $allItem->execute();

            $itens = array();
                while($itemFetch = $allItem->fetch(PDO::FETCH_ASSOC)){
                    $itemDTO = new ItemDTO();
                    $itemDTO->setId_item($itemFetch['id_item']);
                    $itemDTO->setImagem_item($itemFetch['imagem_item']);
                    $itemDTO->setNome_item($itemFetch['nome_item']);
                    $itemDTO->setPreco_item($itemFetch['preco_item']);
                    $itemDTO->setQtd_item($itemFetch['qtd_item']);
                    $itemDTO->setFk_id_categoria_item($itemFetch['categoria_item']);
                    $itemDTO->setFk_id_perfil($itemFetch['id_perfil']);
                    $itemDTO->setFk_id_usuario($itemFetch['id_usuario']);

                    $itens[] = $itemFetch;
                } 
                return $itens;

        }catch(PDOException $exc){
            echo $exc->getMessage();
        }
        
    }

    public function listarTodosItensPorUsuario($id_usuario){
        try {
            $sql = "SELECT i.id_item, i.imagem_item, i.nome_item, i.preco_item, i.qtd_item, i.descricao_item, ci.categoria_item, u.id_usuario, p.id_perfil 
                    FROM item i 
                    INNER JOIN categoria_item ci ON i.fk_id_categoria_item = ci.id_categoria_item 
                    INNER JOIN usuario u ON i.fk_id_usuario = u.id_usuario 
                    INNER JOIN perfil p ON i.fk_id_perfil = p.id_perfil 
                    WHERE u.id_usuario = :id_usuario 
                    ORDER BY id_item DESC";

            $allItem = $this->pdo->prepare($sql);
            $allItem->bindValue(':id_usuario', $id_usuario, PDO::PARAM_INT);
            $allItem->execute();

            $itens = array();
            while ($itemFetch = $allItem->fetch(PDO::FETCH_ASSOC)) {
                $itemDTO = new ItemDTO();
                $itemDTO->setId_item($itemFetch['id_item']);
                $itemDTO->setImagem_item($itemFetch['imagem_item']);
                $itemDTO->setNome_item($itemFetch['nome_item']);
                $itemDTO->setPreco_item($itemFetch['preco_item']);
                $itemDTO->setQtd_item($itemFetch['qtd_item']);
                $itemDTO->setFk_id_categoria_item($itemFetch['categoria_item']);
                $itemDTO->setDescricao_item($itemFetch['descricao_item']);
                $itemDTO->setFk_id_perfil($itemFetch['id_perfil']);
                $itemDTO->setFk_id_usuario($itemFetch['id_usuario']);

                $itens[] = $itemFetch;
            }
            return $itens;

        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }


    public function obterItemCarPorId($id_item){
        try{
        $sql = "SELECT i.*, ci.id_categoria_item, u.id_usuario, p.id_perfil FROM item i INNER JOIN usuario u ON i.fk_id_usuario = u.id_usuario INNER JOIN categoria_item ci ON i.fk_id_categoria_item = ci.id_categoria_item INNER JOIN perfil p ON i.fk_id_perfil = p.id_perfil WHERE i.id_item=?";
            $preItem = $this->pdo->prepare($sql);
            $preItem->bindValue(1, $id_item);
            $preItem->execute([$id_item]);
            
            
            if ($preItem->rowCount() > 0) {
                while ($itemFetch = $preItem->fetch(PDO::FETCH_ASSOC)) {
                    $itemDTO = new ItemDTO();
                    
                    $itemDTO->setId_item($itemFetch['id_item']);
                    $itemDTO->setImagem_item($itemFetch['imagem_item']);
                    $itemDTO->setNome_item($itemFetch['nome_item']);
                    $itemDTO->setPreco_item($itemFetch['preco_item']);
                    $itemDTO->setQtd_item($itemFetch['qtd_item']);
                    $itemDTO->setDescricao_item($itemFetch['descricao_item']);
                    $itemDTO->setFk_id_categoria_item($itemFetch['id_categoria_item']);
                    $itemDTO->setFk_id_perfil($itemFetch['id_perfil']);
                    $itemDTO->setFk_id_usuario($itemFetch['id_usuario']);

                    $itens[] = $itemDTO;
                    return $itemDTO;
                } 
            }
        }catch(PDOException $exc){
            echo $exc->getMessage();
        }
    }

    public function obterItemPorId($id_item){
        try{
            $sql = "SELECT i.*, ci.categoria_item, u.nome_usu, p.id_perfil FROM item i INNER JOIN usuario u ON i.fk_id_usuario = u.id_usuario INNER JOIN categoria_item ci ON i.fk_id_categoria_item = ci.id_categoria_item INNER JOIN perfil p ON i.fk_id_perfil = p.id_perfil WHERE i.id_item=? LIMIT 1";
                $preItem = $this->pdo->prepare($sql);
                $preItem->bindValue(1, $id_item);
                $preItem->execute([$id_item]);

                $itens = array();
                if($preItem->rowCount() > 0){
                    while ($itemFetch = $preItem->fetch(PDO::FETCH_ASSOC)) {
                        $itemDTO = new ItemDTO();
                        
                        $itemDTO->setId_item($itemFetch['id_item']);
                        $itemDTO->setNome_item($itemFetch['nome_item']);
                        $itemDTO->setDescricao_item($itemFetch['descricao_item']);
                        $itemDTO->setPreco_item($itemFetch['preco_item']);
                        $itemDTO->setImagem_item($itemFetch['imagem_item']);
                        $itemDTO->setQtd_item($itemFetch['qtd_item']);
                        $itemDTO->setFk_id_categoria_item($itemFetch['categoria_item']);
                        $itemDTO->setFk_id_perfil($itemFetch['id_perfil']);
                        $itemDTO->setFk_id_usuario($itemFetch['nome_usu']);             
                        $itens[] = $itemFetch;

                        return $itemDTO;

                    } return $itens;
                }else{
                    echo '<p>Nenhum Item adicionado ainda!</p>';
                }
                }catch(PDOException $exc){
                echo $exc->getMessage();
        }
    }

    public function obterItemCar($id_item){
        try{
            $sql = "SELECT i.*, ci.categoria_item, u.nome_usu, p.id_perfil FROM item i INNER JOIN usuario u ON i.fk_id_usuario = u.id_usuario INNER JOIN categoria_item ci ON i.fk_id_categoria_item = ci.id_categoria_item INNER JOIN perfil p ON i.fk_id_perfil = p.id_perfil WHERE i.id_item=? LIMIT 1";
            $itemFetch = $this->pdo->prepare($sql);
            $itemFetch->bindValue(1, $id_item);
            $itemFetch->execute([$id_item]);

            return $itemFetch;
        }catch(PDOException $exc){
        echo $exc->getMessage();
        }
    }

   public function buscarPorID($id) {
    try {
        if (!$id) {
            throw new Exception("ID do item não fornecido.");
        }
        
        $sql = "SELECT i.*, u.id_usuario, p.id_perfil FROM item i INNER JOIN usuario u ON i.fk_id_usuario = u.id_usuario INNER JOIN perfil p ON i.fk_id_perfil = p.id_perfil INNER JOIN categoria_item c ON i.fk_id_categoria_item = c.id_categoria_item WHERE id_item=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();

        $item = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($item) {
            $itemDTO = new itemDTO();
            $itemDTO->setId_item($item["id_item"]);
            $itemDTO->setImagem_item($item["imagem_item"]);
            $itemDTO->setNome_item($item["nome_item"]);
            $itemDTO->setDescricao_item($item["descricao_item"]);
            $itemDTO->setPreco_item($item["preco_item"]);
            $itemDTO->setFk_Id_categoria_item($item["fk_id_categoria_item"]);
            $itemDTO->setQtd_item($item["qtd_item"]);
            $itemDTO->setFk_id_usuario($item["id_usuario"]);
            $itemDTO->setFk_id_perfil($item["id_perfil"]);

            return $itemDTO;
        } else {
            return null;
        }
    } catch (PDOException $exc) {
        echo $exc->getMessage();
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }
}


}

                