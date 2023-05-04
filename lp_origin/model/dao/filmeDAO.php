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

    
public function cadastrarFilme(FilmeDTO $FilmeDTO){
    try{
    $sql = "INSERT INTO  filme  (nome_filme,dt_de_lancamento_filme,duracao_filme, sinopse_filme, genero_filme, classificacao_filme,capa_filme,trailer_filme, fk_usuario_id_usuario, fk_categoria_filme_id_categoria_filme, fk_canal_filme_id_canal_filme) values (?,?,?,?,?,?,?,?,?,?,?)";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(1, $FilmeDTO->getNome_filme());
    $stmt->bindValue(2, $FilmeDTO->getDt_de_lancamento_filme());
    $stmt->bindValue(3, $FilmeDTO->getDuracao_filme());
    $stmt->bindValue(4, $FilmeDTO->getSinopse_filme());
    $stmt->bindValue(5, $FilmeDTO->getGenero_filme());
    $stmt->bindValue(6, $FilmeDTO->getClassificacao_filme());
    $stmt->bindValue(7, $FilmeDTO->getCapa_filme());
    $stmt->bindValue(8, $FilmeDTO->getTrailer_filme());
    $stmt->bindValue(9, $FilmeDTO->getFk_usuario_id_usuario());
    $stmt->bindValue(10, $FilmeDTO->getFk_categoria_filme_id_categoria_filme());
    $stmt->bindValue(11, $FilmeDTO->getFk_canal_filme_id_canal_filme());

    return $stmt->execute();
    }catch(PDOException $exc) {
    echo $exc->getMessage();
    die();
    }
}

/*
*atualizar(FilmeDTO $filme): 
*atualiza os dados de um filme no banco de dados com base nos dados do objeto FilmeDTO passado como parâmetro;
*/
public function alterarFilme(FilmeDTO $FilmeDTO) {
    try {
        $sql = "UPDATE filme SET nome_filme=?, sinopse_filme=?, genero_filme=?, classificacao_filme=?, capa_filme=?, trailer_filme = ?, fk_usuario_id_usuario = ?, fk_categoria_filme_id_categoria_filme = ?, fk_canal_filme_id_canal_filme = ? WHERE id_filme=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $FilmeDTO->getNome_filme());
        $stmt->bindValue(2, $FilmeDTO->getDt_de_lancamento_filme());
        $stmt->bindValue(3, $FilmeDTO->getDuracao_filme());
        $stmt->bindValue(2, $FilmeDTO->getSinopse_filme());
        $stmt->bindValue(3, $FilmeDTO->getGenero_filme());
        $stmt->bindValue(4, $FilmeDTO->getClassificacao_filme());
        $stmt->bindValue(5, $FilmeDTO->getCapa_filme());
        $stmt->bindValue(6, $FilmeDTO->getTrailer_filme());
        $stmt->bindValue(7,$FilmeDTO->getFk_usuario_id_usuario());
        $stmt->bindValue(8,$FilmeDTO->getFk_categoria_filme_id_categoria_filme());
        $stmt->bindValue(9,$FilmeDTO->getFk_canal_filme_id_canal_filme());
        $stmt->bindValue(10, $FilmeDTO->getId_filme());
        $FilmeDTO = $stmt->execute();
        return $FilmeDTO;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }    
}

/**
 * excluir($id): exclui um filme do banco de dados com base no seu id.
 */
public function excluirFilmeById($id_filme) {
    try {
        $sql = "DELETE FROM filme WHERE id_filme=?";
         $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(1, $id_filme);

    return $stmt->execute();
   } catch (PDOException $exc) {
    echo $exc->getMessage();
   }
}

public function listarTodos(){
    $sql = "SELECT f.*, u.nome_usuario, c.categoria_filme, cf.nome_canal_filme FROM filme f JOIN usuario u ON f.fk_usuario_id_usuario = u.id_usuario JOIN categoria_filme c ON f.fk_categoria_filme_id_categoria_filme = c.id_categoria_filme JOIN canal_filme cf ON f.fk_canal_filme_id_canal_filme = cf.id_canal_filme";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();   

    $resultado = $stmt->get_result();
    $filmesDTO = array();

while ($filmeFetch = $resultado->fetch_assoc()) {
    $FilmeDTO = new FilmeDTO();
    $FilmeDTO->setId_filme($filmeFetch['id_filme']);
    $FilmeDTO->setNome_filme($filmeFetch['nome_filme']);
    $FilmeDTO->setDt_de_lancamento_filme($filmeFetch['dt_de_lancamento_filme']);
    $FilmeDTO->setDuracao_filme($filmeFetch['duracao_filme']);
    $FilmeDTO->setSinopse_filme($filmeFetch['sinopse_filme']);
    $FilmeDTO->setFk_categoria_filme_id_categoria_filme($filmeFetch['categoria_filme']);
    $FilmeDTO->setClassificacao_filme($filmeFetch['classificacao_filme']);
    $FilmeDTO->setCapa_filme($filmeFetch['capa_filme']);
    $FilmeDTO->setTrailer_filme($filmeFetch['trailer_filme']);
    $FilmeDTO->setFk_canal_filme_id_canal_filme($filmeFetch['fk_canal_filme_id_canal_filme']);

  array_push($filmesDTO, $FilmeDTO);
}

return $filmesDTO;
}

public function listarFilmesComCategoria() {
    $sql = "SELECT f.id_filme, f.nome_filme, f.dt_de_lancamento_filme, f.duracao_filme, f.sinopse_filme, f.classificacao_filme, f.capa_filme, f.trailer_filme, c.categoria_filme
              FROM filme f
              INNER JOIN categoria_filme c ON f.fk_categoria_filme_id_categoria_filme = c.id_categoria_filme";
    
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
            $FilmeDTO->setFk_categoria_filme_id_categoria_filme($filmeFetch['categoria_filme']);
            $FilmeDTO->setClassificacao_filme($filmeFetch['classificacao_filme']);
            $FilmeDTO->setCapa_filme($filmeFetch['capa_filme']);
            $FilmeDTO->setTrailer_filme($filmeFetch['trailer_filme']);
            //$FilmeDTO->setFk_canal_filme_id_canal_filme($filmeFetch['fk_canal_filme_id_canal_filme']);
            $filmes[] = $filmeFetch;
        } return $filmes;
    }else{
        echo '<p>Nenhum Filme adicionado ainda!</p>';
    }
}

public function selecionarFilme($id_filme){
    try{
        $sql = "SELECT * FROM filme WHERE id_filme=? LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $id_filme);
        $stmt->execute([$id_filme]);

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

public function selecionarResenha($id_filme){
    try{
        $sql = "SELECT * FROM resenha WHERE id_filme=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $id_filme);
        $stmt->execute([$id_filme]);

        if($stmt->rowCount() > 0){
            while ($resenhaFetch = $stmt->fetch(PDO::FETCH_ASSOC)){
                $resenhaDTO = new FilmeDTO();
                $resenhaDTO->setId_filme($resenhaFetch['id_filme']);
                $resenhaDTO->setNome_filme($resenhaFetch['nome_filme']);
                $resenhaDTO->setDt_de_lancamento_filme($resenhaFetch['dt_de_lancamento_filme']);
                $resenhaDTO->setDuracao_filme($resenhaFetch['duracao_filme']);
                $resenhaDTO->setSinopse_filme($resenhaFetch['sinopse_filme']);
                $resenhaDTO->setGenero_filme($resenhaFetch['genero_filme']);
                $resenhaDTO->setClassificacao_filme($resenhaFetch['classificacao_filme']);
                $resenhaDTO->setCapa_filme($resenhaFetch['capa_filme']);
                $resenhaDTO->setTrailer_filme($resenhaFetch['trailer_filme']);
                $resenhaDTO->setCanal_filme($resenhaFetch['canal_filme']);
            
            }
            return $resenhaDTO;
        }else{
            echo '<p>Nenhuma resenha adicionado ainda!</p>';
        }
        return null;
    }catch(PDOException $exc){
        echo $exc->getMessage();
    }
}

/**
 * busca um filme no banco de dados pelo seu id e retorna um objeto FilmeDTO com os dados do filme encontrado;
 */

public function buscarPorID($id) {
    try {
        $sql = "SELECT * FROM filme WHERE id_filme=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1,$id);
        $stmt->execute();

        $filmeFetch = $stmt->$stmt->get_result();
    
    if ($filmeFetch->num_rows == 1) {
        $filme = $filmeFetch->fetch_assoc();
        $FilmeDTO = new FilmeDTO();
        $FilmeDTO->setId_filme($filme["id_filme"]);
        $FilmeDTO->setNome_filme($filme["nome_filme"]);
        $FilmeDTO->setDt_de_lancamento_filme($filme["dt_de_lancamento_filme"]);
        $FilmeDTO->setDuracao_filme($filme ["duracao_filme"]);
        $FilmeDTO->setSinopse_filme($filme["sinopse_filme"]);
        $FilmeDTO->setGenero_filme($filme["genero_filme"]);
        $FilmeDTO->setClassificacao_filme($filme["classificacao_filme"]);
        $FilmeDTO->setCapa_filme($filme["capa_filme"]);
        $FilmeDTO->setTrailer_filme($filme["trailer_filme"]);
        $FilmeDTO->setCanal_filme($filme["canal_filme"]);
        
        return $FilmeDTO;
    } else {
        return null;
    }
    }catch (PDOException $exc) {
        echo $exc->getMessage();
    }
}

}

























?>