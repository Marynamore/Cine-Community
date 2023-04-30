<?php
// o arquivo desejado será importado apenas uma vez//
require_once __DIR__ .'/../conexao.php';
require_once __DIR__ .'/../dto/filmeDTO.php';

class FilmeDAO{
//Função para cadastrar os dados do filme no Banco de Dados//
    public $pdo;

    public function __construct()
    {
        $this->pdo = Conexao::getInstance();
    }

    
public function CadastrarFilme(FilmeDTO $FilmeDTO){
    try{
    $sql = "INSERT INTO  filme  (nome_filme, sinopse_filme, genero_filme, classificacao_filme,capa_filme, canal_filme) values (?,?,?,?,?,?)";
     $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(1, $FilmeDTO->getNome_filme());
    //$stmt->bindValue(2, $filmeDTO->getDt_de_lancamento_filme());
    //$stmt->bindValue(3, $filmeDTO->getDuracao_filme());
    $stmt->bindValue(2, $FilmeDTO->getSinopse_filme());
    $stmt->bindValue(3, $FilmeDTO->getGenero_filme());
    $stmt->bindValue(4, $FilmeDTO->getClassificacao_filme());
    $stmt->bindValue(5, $FilmeDTO->getCapa_filme());
    //$stmt->bindValue(8, $filmeDTO->getTrailer_filme());
    $stmt->bindValue(6, $FilmeDTO->getCanal_filme());

    return $stmt->execute();
    }catch(PDOException $exc) {
    echo $exc->getMessage();
    die();
    }
}

// Função para alterar Dados do filme//
public function alterarFilme(FilmeDTO $FilmeDTO) {
    try {
        $sql = "UPDATE filme SET nome_filme=?, sinopse_filme=?, genero_filme=?, classificacao_filme=?, capa_filme=?, canal_filme=? WHERE id_filme=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $FilmeDTO->getNome_filme());
        //$stmt->bindValue(2, $filmeDTO->getDt_de_lancamento_filme());
        //$stmt->bindValue(3, $filmeDTO->getDuracao_filme());
        $stmt->bindValue(2, $FilmeDTO->getSinopse_filme());
        $stmt->bindValue(3, $FilmeDTO->getGenero_filme());
        $stmt->bindValue(4, $FilmeDTO->getClassificacao_filme());
        $stmt->bindValue(5, $FilmeDTO->getCapa_filme());
        //$stmt->bindValue(8, $filmeDTO->getTrailer_filme());
        $stmt->bindValue(6, $FilmeDTO->getCanal_filme());
        $stmt->bindValue(7, $FilmeDTO->getId_filme());
        $FilmeDTO = $stmt->execute();
        return $FilmeDTO;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }    
}

// Função para Excluir um filme//
public function excluirFilmeById($id_filme) {
    try {
        $sql = "DELETE FROM filme where id_filme=?";
         $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(1, $id_filme);

    return $stmt->execute();
   } catch (PDOException $exc) {
    echo $exc->getMessage();
   }
}
 
public function listarTodos(){
    try{

        $sql = "SELECT * FROM filme ORDER BY nome_filme";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $filme = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $filme;
    }catch(PDOException $exc){
        echo $exc->getMessage();
    }
        
}

public function listarTodosFilmes(){

    $sql = "SELECT * FROM filme ORDER BY id_filme";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();

    if($stmt->rowCount() > 0){
        while ($filmeFetch = $stmt->fetch(PDO::FETCH_ASSOC)){
            $FilmeDTO = new FilmeDTO();
            $FilmeDTO->setId_filme($filmeFetch['id_filme']);
            $FilmeDTO->setNome_filme($filmeFetch['nome_filme']);
            $FilmeDTO->setDt_de_lancamento_filme($filmeFetch['dt_de_lancamento_filme']);
            $FilmeDTO->setDuracao_filme($filmeFetch['duracao_filme']);
            $FilmeDTO->setSinopse_filme($filmeFetch['sinopse_filme']);
            $FilmeDTO->setGenero_filme($filmeFetch['genero_filme']);
            $FilmeDTO->setClassificacao_filme($filmeFetch['classificacao_filme']);
            $FilmeDTO->setCapa_filme($filmeFetch['capa_filme']);
            $FilmeDTO->setTrailer_filme($filmeFetch['trailer_filme']);
            $FilmeDTO->setCanal_filme($filmeFetch['canal_filme']);
        
        }
    }else{
        echo '<p>Nenhum Filme adicionado ainda!</p>';
    }
}

public function selecionarFilme($id_filme){
    try{
        $sql = "SELECT * FROM filme WHERE id_filme=? LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $id_filme);
        $stmt->execute();

        if($stmt->rowCount() > 0){
            while ($filmeFetch = $stmt->fetch(PDO::FETCH_ASSOC)){
                $FilmeDTO = new FilmeDTO();
                $FilmeDTO->setId_filme($filmeFetch['id_filme']);
                $FilmeDTO->setNome_filme($filmeFetch['nome_filme']);
                $FilmeDTO->setDt_de_lancamento_filme($filmeFetch['dt_de_lancamento_filme']);
                $FilmeDTO->setDuracao_filme($filmeFetch['duracao_filme']);
                $FilmeDTO->setSinopse_filme($filmeFetch['sinopse_filme']);
                $FilmeDTO->setGenero_filme($filmeFetch['genero_filme']);
                $FilmeDTO->setClassificacao_filme($filmeFetch['classificacao_filme']);
                $FilmeDTO->setCapa_filme($filmeFetch['capa_filme']);
                $FilmeDTO->setTrailer_filme($filmeFetch['trailer_filme']);
                $FilmeDTO->setCanal_filme($filmeFetch['canal_filme']);
            
            }
            return $FilmeDTO;
        }else{
            echo '<p>Nenhum Filme adicionado ainda!</p>';
        }
        return null;
    }catch(PDOException $exc){
        echo $exc->getMessage();
    }
}


public function recuperarPorID($id) {
    try {
        $sql = "SELECT * FROM filme WHERE id_filme=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1,$id);
        $stmt->execute();
        $filmeFetch = $stmt->fetch(PDO::FETCH_ASSOC);

        if($filmeFetch != NULL){
            $FilmeDTO = new FilmeDTO();
            $FilmeDTO->setId_filme($filmeFetch["id_filme"]);
            $FilmeDTO->setNome_filme($filmeFetch["nome_filme"]);
            //$FilmeDTO->setDt_de_lancamento_filme($filmeFetch["dt_de_lancamento_filme"]);
            //$FilmeDTO->setDuracao_filme($filmeFetch ["duracao_filme"]);
            $FilmeDTO->setSinopse_filme($filmeFetch["sinopse_filme"]);
            $FilmeDTO->setGenero_filme($filmeFetch["genero_filme"]);
            $FilmeDTO->setClassificacao_filme($filmeFetch["classificacao_filme"]);
            $FilmeDTO->setCapa_filme($filmeFetch["capa_filme"]);
            //$FilmeDTO->setTrailer_filme($filmeFetch["trailer_filme"]);
            $FilmeDTO->setCanal_filme($filmeFetch["canal_filme"]);
        return $FilmeDTO;
    }
        return null;
    } catch (PDOException $exc) {
        echo $exc->getMessage();
    }
}//fim do recuperarPorID  



}

























?>