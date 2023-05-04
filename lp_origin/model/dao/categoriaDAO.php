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

        $sql = "SELECT * FROM genero_filme ORDER BY id_genero_filme";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $categoria = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $categoria;
    }catch(PDOException $exc){
        echo $exc->getMessage();
    }
        
}

public function selecionarCategoria($id_categoria){
    try{
        $sql = "SELECT genero_filme FROM categoria_filme WHERE id_filme= $id_categoria";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt;
        return $result;
    }catch(PDOException $exc){
        echo $exc->getMessage();
    }
}
}

class categoriaFilmeDAO {
    public $pdo;

    public function __construct()
    {
        $this->pdo = Conexao::getInstance();
    }

    public function listar() {
        $stmt = $this->pdo->prepare("SELECT * FROM categoria_filme");
        $stmt->execute();

        $categorias = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $categoria = new categoriaFilmeDTO($row['id_categoria_filme'], $row['categoria_filme']);
            $categorias[] = $categoria;
        }

        return $categorias;
    }
}
