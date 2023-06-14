<?php

require_once __DIR__ .'/../conexao.php';
require_once __DIR__ .'/../dto/filmeDTO.php';

class CompraDAO{
    public $pdo;

    public function __construct()
    {
        $this->pdo = Conexao::getInstance();
    }

    
    public function adicionarCompra(CompraDTO $compraDTO)
    {
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
    

    public function alterarFilme(FilmeDTO $FilmeDTO) {
        try {
            $sql = "UPDATE filme SET nome_filme=?, dt_de_lancamento_filme=?, duracao_filme=?, sinopse_filme=?, fk_id_categoria_filme=?, fk_id_canal_filme=?,
            classificacao_filme=?, capa_filme=?, trailer_filme=?, fk_id_usuario=?, fk_id_perfil=? WHERE id_filme=?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $FilmeDTO->getNome_filme());
            $stmt->bindValue(2, $FilmeDTO->getDt_de_lancamento_filme());
            $stmt->bindValue(3, $FilmeDTO->getDuracao_filme());
            $stmt->bindValue(4, $FilmeDTO->getSinopse_filme());
            $stmt->bindValue(5, $FilmeDTO->getFk_id_categoria_filme());
            $stmt->bindValue(6, $FilmeDTO->getFk_id_canal_filme());
            $stmt->bindValue(7, $FilmeDTO->getClassificacao_filme());
            $stmt->bindValue(8, $FilmeDTO->getCapa_filme());
            $stmt->bindValue(9, $FilmeDTO->getTrailer_filme());
            $stmt->bindValue(10, $FilmeDTO->getFk_id_usuario());
            $stmt->bindValue(11, $FilmeDTO->getFk_id_perfil());
            $stmt->bindValue(12, $FilmeDTO->getId_filme());
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }    
    }

/**
 * excluir($id): exclui um filme do banco de dados com base no seu id.
 */
public function excluirfilmeById($id_filme) {
    try {
        $sql = "DELETE FROM filme WHERE id_filme=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $id_filme);
        $stmt->execute();

        return true;
    } catch (PDOException $e) {
        echo $e->getMessage();
        return false;
    }
}




public function listarTodos(){
    try{
        $sql = "SELECT f.id_filme, f.nome_filme, f.capa_filme, c.categoria_filme, cn.canal_filme, p.perfil_usu FROM filme f INNER JOIN categoria_filme c ON f.fk_id_categoria_filme = c.id_categoria_filme INNER JOIN canal_filme cn ON f.fk_id_canal_filme = cn.id_canal_filme INNER JOIN perfil p ON f.fk_id_perfil = p.id_perfil ORDER BY id_categoria_filme, f.nome_filme ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();   
        $filmesDTO = array();
        while ($filmeFetch = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $FilmeDTO = new FilmeDTO();
            $FilmeDTO->setId_filme($filmeFetch['id_filme']);
            $FilmeDTO->setNome_filme($filmeFetch['nome_filme']);
            $FilmeDTO->setFk_id_categoria_filme($filmeFetch['categoria_filme']);
            $FilmeDTO->setCapa_filme($filmeFetch['capa_filme']);
            $filmesDTO[] = $filmeFetch;
        } 
        return $filmesDTO;
    }catch(PDOException $exc){
        echo $exc->getMessage();
    }  
}

public function obterIdUsuario($id_usuario){
    try{
        $sql = "SELECT c.*, p.perfil_usu, u.id_usuario FROM compra c INNER JOIN perfil p ON f.fk_id_perfil = p.id_perfil INNER JOIN usuario u ON f.fk_id_usuario = u.id_usuario WHERE u.id_usuario=? ORDER BY dt_hora_compra DESC";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id_usuario]);  

        $compras = array();
        if($stmt->rowCount() > 0){
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
                $item = $this->selecionarItem();
                $compras[] = $compraFetch;
                return $compraDTO;
                
            } return $compras;
        }else{
            echo '<p>Nenhuma Compra adicionado ainda!</p>';
        }
        }catch(PDOException $exc){
        echo $exc->getMessage();
    }
}

    public function selecionarItem(){
        try{
        $sql = "SELECT * FROM item WHERE id_item=?";
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


public function listarTodosFilme() {
    try{
        $sql = "SELECT f.*, u.nome_usu, c.categoria_filme, cn.canal_filme FROM filme f INNER JOIN usuario u ON f.fk_id_usuario = u.id_usuario INNER JOIN categoria_filme c 
        ON f.fk_id_categoria_filme = c.id_categoria_filme INNER JOIN canal_filme cn 
        ON f.fk_id_canal_filme = cn.id_canal_filme ORDER BY id_filme DESC ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        $filmes = array();
        if($stmt->rowCount() > 0){
            while ($filmeFetch = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $FilmeDTO = new FilmeDTO();
                $FilmeDTO->setId_filme($filmeFetch['id_filme']);
                $FilmeDTO->setNome_filme($filmeFetch['nome_filme']);
                $FilmeDTO->setDt_de_lancamento_filme($filmeFetch['dt_de_lancamento_filme']);
                $FilmeDTO->setDuracao_filme($filmeFetch['duracao_filme']);
                $FilmeDTO->setSinopse_filme($filmeFetch['sinopse_filme']);
                $FilmeDTO->setFk_id_categoria_filme($filmeFetch['categoria_filme']);
                $FilmeDTO->setFk_id_usuario($filmeFetch['nome_usu']);
                $FilmeDTO->setClassificacao_filme($filmeFetch['classificacao_filme']);
                $FilmeDTO->setCapa_filme($filmeFetch['capa_filme']);
                $FilmeDTO->setTrailer_filme($filmeFetch['trailer_filme']);
                $FilmeDTO->setFk_id_canal_filme($filmeFetch['canal_filme']);
                $filmes[] = $filmeFetch;
                
            } return $filmes;
        }else{
            echo '<p>Nenhum Filme adicionado ainda!</p>';
        }
        }catch(PDOException $exc){
        echo $exc->getMessage();
    }
}

/**
 * busca um filme no banco de dados pelo seu id e retorna um objeto FilmeDTO com os dados do filme encontrado;
 */

public function recuperarPorID($get_id) {
    try {
        $sql = "SELECT f.*, cn.canal_filme, c.categoria_filme FROM filme f INNER JOIN canal_filme cn ON f.fk_id_canal_filme = cn.canal_filme INNER JOIN categoria_filme c 
        ON f.fk_id_categoria_filme = c.id_categoria_filme WHERE f.id_filme=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1,$get_id);
        $stmt->execute();
        $filmeFetch = $stmt->fetch(PDO::FETCH_ASSOC);

        if($filmeFetch != NULL){
            $FilmeDTO = new FilmeDTO();
            $FilmeDTO->setId_filme($filmeFetch["id_filme"]);
            $FilmeDTO->setNome_filme($filmeFetch["nome_filme"]);
            $FilmeDTO->setDt_de_lancamento_filme($filmeFetch["dt_de_lancamento_filme"]);
            $FilmeDTO->setDuracao_filme($filmeFetch ["duracao_filme"]);
            $FilmeDTO->setSinopse_filme($filmeFetch["sinopse_filme"]);
            $FilmeDTO->setFk_id_categoria_filme($filmeFetch['id_categoria_filme']);
            $FilmeDTO->setClassificacao_filme($filmeFetch["classificacao_filme"]);
            $FilmeDTO->setCapa_filme($filmeFetch["capa_filme"]);
            $FilmeDTO->setTrailer_filme($filmeFetch["trailer_filme"]);
            $FilmeDTO->setFk_id_canal_filme($filmeFetch['id_canal_filme']);
        return $FilmeDTO;
    }
        return null;
    } catch (PDOException $exc) {
        echo $exc->getMessage();
    }
}//fim do recuperarPorID  

public function buscarPorID($id) {
    try {
        $sql = "SELECT f.*, u.id_usuario, p.id_perfil FROM filme f INNER JOIN usuario u ON f.fk_id_usuario = u.id_usuario INNER JOIN perfil p ON f.fk_id_perfil = p.id_perfil INNER JOIN categoria_filme c ON f.fk_id_categoria_filme = c.id_categoria_filme INNER JOIN canal_filme i ON f.fk_id_canal_filme = i.id_canal_filme WHERE id_filme=?  ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();

        $filmeFetch = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($filmeFetch) == 1) {
            $filme = $filmeFetch[0];
            $FilmeDTO = new FilmeDTO();
            $FilmeDTO->setId_filme($filme["id_filme"]);
            $FilmeDTO->setNome_filme($filme["nome_filme"]);
            $FilmeDTO->setDt_de_lancamento_filme($filme["dt_de_lancamento_filme"]);
            $FilmeDTO->setDuracao_filme($filme["duracao_filme"]);
            $FilmeDTO->setSinopse_filme($filme["sinopse_filme"]);
            $FilmeDTO->setFk_Id_categoria_filme($filme["fk_id_categoria_filme"]);
            $FilmeDTO->setClassificacao_filme($filme["classificacao_filme"]);
            $FilmeDTO->setCapa_filme($filme["capa_filme"]);
            $FilmeDTO->setTrailer_filme($filme["trailer_filme"]);
            $FilmeDTO->setFk_Id_canal_filme($filme["fk_id_canal_filme"]);
            $FilmeDTO->setFk_id_usuario($filme["id_usuario"]);
            $FilmeDTO->setFk_id_perfil($filme["id_perfil"]);

            return $FilmeDTO;
        } else {
            return null;
        }
    } catch (PDOException $exc) {
        echo $exc->getMessage();
    }
}

}