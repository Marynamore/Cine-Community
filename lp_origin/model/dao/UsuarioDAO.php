<?php
require_once __DIR__.'/../conexao.php';
require_once __DIR__.'/../dto/UsuarioDTO.php';

class UsuarioDAO {

//Função para cadastrar os dados do usuario no Banco de Dados//
    public $pdo;

    public function __construct()
    {
        $this->pdo = Conexao::getInstance();
    }

    public function logar($email_usu, $senha_usu)
    {
        try {
            $sql = "SELECT u.id_usuario, u.nome_usu, u.nickname_usu, u.email_usu, u.senha_usu, u.fk_id_perfil, p.perfil_usu FROM usuario u INNER JOIN perfil p ON u.fk_id_perfil = p.id_perfil WHERE email_usu=?";
    
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $email_usu);
            $stmt->execute();
            $usuarioLogado = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($usuarioLogado && $usuarioLogado['senha_usu'] === md5($senha_usu)) {
                return $usuarioLogado;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            //die() = usado para parar a execução - retirar na versão de produção
            die();
        }
    }
    

    


    public function cadastrarUsuario(UsuarioDTO $usuarioDTO) {
        try {
            $sql = "INSERT INTO usuario (nome_usu, nickname_usu, dt_de_nasci_usu, genero_usu, email_usu, senha_usu,
                    situacao_usu, foto_usu, telefone, cpf_cnpj, endereco, numero, complemento, bairro, cidade, cep, uf, fk_id_perfil)  
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->pdo->prepare($sql);
    
            $stmt->bindValue(1, $usuarioDTO->getNome_usu());
            $stmt->bindValue(2, $usuarioDTO->getNickname_usu());
            $stmt->bindValue(3, $usuarioDTO->getDt_de_nasci_usu());
            $stmt->bindValue(4, $usuarioDTO->getGenero_usu());
            $stmt->bindValue(5, $usuarioDTO->getEmail_usu());
            $stmt->bindValue(6, $usuarioDTO->getSenha_usu());
            $stmt->bindValue(7, $usuarioDTO->getSituacao_usu());
            $stmt->bindValue(8, $usuarioDTO->getFoto_usu());
            $stmt->bindValue(9, $usuarioDTO->getTelefone());
            $stmt->bindValue(10, $usuarioDTO->getCpf_cnpj());
            $stmt->bindValue(11, $usuarioDTO->getEndereco());
            $stmt->bindValue(12, $usuarioDTO->getNumero());
            $stmt->bindValue(13, $usuarioDTO->getComplemento());
            $stmt->bindValue(14, $usuarioDTO->getBairro());
            $stmt->bindValue(15, $usuarioDTO->getCidade());
            $stmt->bindValue(16, $usuarioDTO->getCep());
            $stmt->bindValue(17, $usuarioDTO->getUf());
            $stmt->bindValue(18, $usuarioDTO->getFk_id_perfil());
    
            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
    }
    
    
    public function recuperarID(){
        try{
            $sql = "SELECT * FROM perfil ORDER BY  id_perfil limit 1";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
            return $usuario;
        }catch(PDOException $e){
            echo $e->getMessage();
        }
        
    }
    

    
    public function listarTodos(){
        try{
            $sql = "SELECT * FROM usuario ORDER BY nome_usu";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $usuario = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $usuario;
        }catch(PDOException $e){
            echo $e->getMessage();
        }
        
    }
    
    public function alterarUsuario(UsuarioDTO $UsuarioDTO) {
        try {
            $sql = "UPDATE usuario SET nome_usu=?, nickname_usu=?, genero_usu=?,
             dt_de_nasci_usu=?, foto_usu=?, telefone=?, cpf_cnpj=?, endereco=?, numero=?,
              complemento=? bairro=?, cidade=?, cep=?, uf=? email_usu=?, senha_usu=? WHERE id_usuario=?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $UsuarioDTO->getNome_usu());
            $stmt->bindValue(2, $UsuarioDTO->getNickname_usu());
            $stmt->bindValue(3, $UsuarioDTO->getGenero_usu());
            $stmt->bindValue(4, $UsuarioDTO->getDt_de_nasci_usu());
            $stmt->bindValue(5, $UsuarioDTO->getEmail_usu());
            $stmt->bindValue(6, md5($UsuarioDTO->getSenha_usu()));
            $stmt->bindValue(7, $UsuarioDTO->getTelefone());
            $stmt->bindValue(8, $UsuarioDTO->getCpf_cnpj());
            $stmt->bindValue(9, $UsuarioDTO->getEndereco());
            $stmt->bindValue(10, $UsuarioDTO->getNumero());
            $stmt->bindValue(11, $UsuarioDTO->getComplemento());
            $stmt->bindValue(12, $UsuarioDTO->getBairro());
            $stmt->bindValue(13, $UsuarioDTO->getCidade());
            $stmt->bindValue(14, $UsuarioDTO->getFoto_usu());
            $stmt->bindValue(15, $UsuarioDTO->getCep());
            $stmt->bindValue(16, $UsuarioDTO->getUf());
            $stmt->bindValue(17, $UsuarioDTO->getId_usuario());
            $stmt->execute();
            return true;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            die();
        }
    }

    public function excluirUsuarioById($id_usuario){
        try{
            $sql = "DELETE FROM usuario WHERE id_usuario=?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $id_usuario);
            
           
            return $stmt->execute();
        }catch(PDOException $e){
            echo $e->getMessage();
        }


    }
    public function dadosUsuario($id_usuario) {
        try {
            $sql  = "SELECT * FROM usuario WHERE id_usuario=? limit 1";
            $stmt = $this->pdo->prepare( $sql );
            $stmt->bindValue( 1, $id_usuario);
            $stmt->execute();
            $usuarios = $stmt->fetchAll( PDO::FETCH_ASSOC );
            return $usuarios;
        } catch ( PDOException $e ) {
            echo $e->getMessage();
        }
    }
    public function recuperarSenha( UsuarioDTO $UsuarioDTO ) {
        $sql = "SELECT * FROM usuario WHERE email_usu=?";
        $stmt = $this->pdo->prepare( $sql );
        $stmt->bindValue( 1, $UsuarioDTO->getEmail_usu() );
        $stmt->execute();

        $usuarioFetch = $stmt->fetch( PDO::FETCH_ASSOC );

        if ( $usuarioFetch) {
            $chave = sha1($usuarioFetch["id_usuario"].$usuarioFetch["senha_usu"]);
            return $chave;
        }
}
public function dadosUsuarioPorId($id) {
    try {
        $sql = "SELECT * FROM usuario WHERE id_usuario=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1,$id);
        $stmt->execute();
        $usuarioFetch = $stmt->fetch(PDO::FETCH_ASSOC);

        if($usuarioFetch){
/*            $usuario = new UsuarioDTO();
            $usuario->setId_usuario($usuarioFetch["id_usuario"]);
            $usuario->setNome_usu($usuarioFetch["nome_usu"]);
            $usuario->setNickname_usu($usuarioFetch["nickname_usu"]);
            $usuario->setGenero_usu($usuarioFetch["genero_usu"]);
            $usuario->setDt_de_nasci_usu($usuarioFetch["dt_de_nasci_usu"]);
            $usuario->setEmail_usu($usuarioFetch["email_usu"]);
            $usuario->setSenha_usu($usuarioFetch["usu$UsuarioDTO"]);
            $usuario->setPerfil_usu($usuarioFetch["perfil_usu"]);
            $usuario->setSituacao_usu($usuarioFetch["situacao_usu"]);
            $usuario->setFoto_usu($usuarioFetch["foto_usu"]);
*/
            return $usuarioFetch;
        }
        return null;
    } catch (PDOException $exc) {
        echo $exc->getMessage();
    }
}//fim do recuperarPorID  

public function recuperarPorID($id)
{
    try {
        $sql = "SELECT * FROM usuario WHERE id_usuario=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $id);

        $stmt->execute();
        $usuarioFetch = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuarioFetch != null) {
            $usuario = new UsuarioDTO();
            $usuario->setId_usuario($usuarioFetch["id_usuario"]);
            $usuario->setNome_usu($usuarioFetch["nome_usu"]);
            $usuario->setNickname_usu($usuarioFetch["nickname_usu"]);
            $usuario->setGenero_usu($usuarioFetch["genero_usu"]);
            $usuario->setDt_de_nasci_usu($usuarioFetch["dt_de_nasci_usu"]);
            $usuario->setEmail_usu($usuarioFetch["email_usu"]);
            $usuario->setSenha_usu($usuarioFetch["senha_usu"]);
            $usuario->setfk_id_perfil($usuarioFetch["fk_id_perfil"]);
            $usuario->setSituacao_usu($usuarioFetch["situacao_usu"]);

            return $usuarioFetch;
        }
        return null;
    } catch (PDOException $e) {
        echo $e->getMessage();
        //die() = usado para parar a execução - retirar na versão de produção
        die();
    }
}


}