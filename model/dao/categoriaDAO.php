<?php
// o arquivo desejado será importado apenas uma vez//
require_once __DIR__ .'/../conexao.php';
require_once __DIR__ .'/../dto/categoriaDTO.php';

class categoriaDAO{
//Função para cadastrar os dados do filme no Banco de Dados//
    public $pdo;

    public function __construct()
    {
        $this->pdo = Conexao::getInstance();
    }

public function listarCategoria(){
    try{

        $sql = "SELECT * FROM categoria_filme ORDER BY categoria_filme";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        $categorias = array();
        while ($categoriaFetch = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $CategoriaDTO = new categoriaFilmeDTO();
            $CategoriaDTO->setId_categoria_filme($categoriaFetch['id_categoria_filme']);
            $CategoriaDTO->setCategoria_filme($categoriaFetch['categoria_filme']);
            $categorias[] = $categoriaFetch;

        } return $categorias;

    }catch(PDOException $exc){
        echo $exc->getMessage();
    }
        
}

public function selecionarCategoria($id_categoria){
    try{
        $sql = "SELECT categoria_filme FROM categoria_filme WHERE id_filme= $id_categoria";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt;
        return $result;
    }catch(PDOException $exc){
        echo $exc->getMessage();
    }
}
}

