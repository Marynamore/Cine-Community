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

    
    public function cadastrarFilme(FilmeDTO $FilmeDTO)
    {
        try {
            $sql = "INSERT INTO filme (nome_filme, dt_de_lancamento_filme, duracao_filme, sinopse_filme, fk_id_categoria_filme,
            fk_id_canal_filme, classificacao_filme, capa_filme, trailer_filme, fk_id_usuario, fk_id_perfil) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            
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
    
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Erro ao cadastrar o filme no banco de dados: " . $e->getMessage();
            return false;
        }
    }
    

/*
*atualizar(FilmeDTO $filme): 
*atualiza os dados de um filme no banco de dados com base nos dados do objeto FilmeDTO passado como parâmetro;
*/

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

public function pesquisarFilmes($nome_filme){
    try{
        $sql = "SELECT f.*, c.categoria_filme, cn.canal_filme, p.perfil_usu, u.id_usuario FROM filme f INNER JOIN categoria_filme c ON f.fk_id_categoria_filme = c.id_categoria_filme INNER JOIN canal_filme cn ON f.fk_id_canal_filme = cn.id_canal_filme INNER JOIN perfil p ON f.fk_id_perfil = p.id_perfil INNER JOIN usuario u ON f.fk_id_usuario = u.id_usuario WHERE nome_filme LIKE ?";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, '%' . $nome_filme . '%');
        $stmt->execute();
        $filmesDTO = array();
        while ($filmeFetch = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $FilmeDTO = new FilmeDTO();
            $FilmeDTO->setId_filme($filmeFetch['id_filme']);
            $FilmeDTO->setNome_filme($filmeFetch['nome_filme']);
            $FilmeDTO->setFk_id_categoria_filme($filmeFetch['categoria_filme']);
            $FilmeDTO->setCapa_filme($filmeFetch['capa_filme']);
            $filmesDTO[] = $FilmeDTO;
        } 
        return $filmesDTO;
    } catch(PDOException $exc){
        echo $exc->getMessage();
    }  
}


public function selecionarFilmesComCategoria($id_filme) {
    try{
        $sql = "SELECT f.*, u.nome_usu, c.categoria_filme, cn.canal_filme FROM filme f INNER JOIN usuario u ON f.fk_id_usuario = u.id_usuario INNER JOIN categoria_filme c 
        ON f.fk_id_categoria_filme = c.id_categoria_filme INNER JOIN canal_filme cn 
        ON f.fk_id_canal_filme = cn.id_canal_filme WHERE f.id_filme=? LIMIT 1";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1,$id_filme);
        $stmt->execute([$id_filme]);

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
                return $FilmeDTO;
                
            } return $filmes;
        }else{
            echo '<p>Nenhum Filme adicionado ainda!</p>';
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
    
public function obterFilmeId($id_filme)
{
    try {
        $sql = "SELECT * FROM filme WHERE id_filme = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $id_filme);
        $stmt->execute();

        $filme = null;

        if ($stmt->rowCount() > 0) {
            $filmeFetch = $stmt->fetch(PDO::FETCH_ASSOC);
            $filme = new FilmeDTO();
            $filme->setId_filme($filmeFetch['id_filme']);
            $filme->setNome_filme($filmeFetch['nome_filme']);
            $filme->setFk_id_categoria_filme($filmeFetch['fk_id_categoria_filme']);
            $filme->setCapa_filme($filmeFetch['capa_filme']);
            // Defina outras propriedades do objeto FilmeDTO conforme necessário
        }

        return $filme;
    } catch(PDOException $exc) {
        echo $exc->getMessage();
        return null;
    }
}



}