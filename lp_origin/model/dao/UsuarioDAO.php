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

    public function logar($email_usu,$senha_usu){
        try{
            $sql = "SELECT u.id_usuario, u.nome_usu, u.nickname_usu, u.email_usu, u.senha_usu, u.fk_id_perfil, p.perfil_usu FROM usuario u INNER JOIN perfil p ON u.fk_id_perfil = p.id_perfil WHERE email_usu=? AND senha_usu =?";

            $stmt = $this->pdo->prepare($sql);   
            $stmt->bindValue(1, $email_usu);
            $stmt->bindValue(2, MD5($senha_usu));
            $stmt->execute();
            $usuarioLogado = $stmt->fetch(PDO::FETCH_ASSOC);
            return $usuarioLogado;
        }catch(PDOException $e){
            echo $e->getMessage();
            //die() = usado para parar a execução - retirar na versão de produção
            die();
        }    
    }

    public function cadastrarUsuario(UsuarioDTO $UsuarioDTO){
        try{
            $sql = "INSERT INTO usuario (nome_usu,nickname_usu,genero_usu,dt_de_nasci_usu,email_usu,fk_id_perfil,situacao_usu,senha_usu) 
             VALUES (?, ?, ?, ?, ?, ?,?,?)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $UsuarioDTO->getNome_usu());
            $stmt->bindValue(2, $UsuarioDTO->getNickname_usu());
            $stmt->bindValue(3, $UsuarioDTO->getGenero_usu	());
            $stmt->bindValue(4, $UsuarioDTO->getDt_de_nasci_usu());
            $stmt->bindValue(5, $UsuarioDTO->getEmail_usu());
            $stmt->bindValue(6, $UsuarioDTO->getFk_id_perfil());
            $stmt->bindValue(7, $UsuarioDTO->getsituacao_usu());
            $stmt->bindValue(8, MD5($UsuarioDTO->getSenha_usu()));
            return  $stmt->execute();
        }catch(PDOException $e){
            echo $e->getMessage();
        die();    
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
            $sql = "UPDATE usuario SET nome_usu=?, nickname_usu=?, genero_usu=?, dt_de_nasci_usu=?, email_usu=?, senha_usu=? WHERE id_usuario=?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $UsuarioDTO->getNome_usu());
            $stmt->bindValue(2, $UsuarioDTO->getNickname_usu());
            $stmt->bindValue(3, $UsuarioDTO->getGenero_usu());
            $stmt->bindValue(4, $UsuarioDTO->getDt_de_nasci_usu());
            $stmt->bindValue(5, $UsuarioDTO->getEmail_usu());
            $stmt->bindValue(6, md5($UsuarioDTO->getSenha_usu()));
            $stmt->bindValue(7, $UsuarioDTO->getId_usuario());
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
            $sql  = "SELECT * FROM usuario WHERE id_usuario=?";
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
            $usuario->setSenha_usu($usuarioFetch["senha_usu"]);
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
            $usuario->setDt_de_nasci_usu($usuarioFetch["dt_nasci_usu"]);
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
