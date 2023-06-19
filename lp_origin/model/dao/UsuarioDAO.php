<?php
require_once __DIR__ . '/../conexao.php';
require_once __DIR__ . '/../dto/UsuarioDTO.php';

class UsuarioDAO
{

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
            $stmt->bindValue(6, MD5($usuarioDTO->getSenha_usu()));
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


    public function recuperarUsuarioPorID($id)
    {
        try {
            $sql = "SELECT * FROM usuario WHERE id_usuario = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
            return $usuario;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }





    public function listarTodosUsuario() {
        try{
             $sql = "SELECT * FROM usuario u INNER JOIN perfil p ON u.fk_id_perfil = p.id_perfil ORDER BY id_usuario DESC ";
    
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
    
            $usuarios = array();
            if($stmt->rowCount() > 0){
                while ($usuarioFetch = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $usuarioDTO = new usuarioDTO();
                    $usuarioDTO->setId_usuario($usuarioFetch['id_usuario']);
                    $usuarioDTO->setNome_usu($usuarioFetch['nome_usu']);
                    $usuarioDTO->setDt_de_nasci_usu($usuarioFetch['dt_de_nasci_usu']);
                    $usuarioDTO->setNickname_usu($usuarioFetch['nickname_usu']);
                    $usuarioDTO->setGenero_usu($usuarioFetch['genero_usu']);
                    $usuarioDTO->setEmail_usu($usuarioFetch['email_usu']);
                    $usuarioDTO->setSenha_usu($usuarioFetch['senha_usu']);
                    $usuarioDTO->setFoto_usu($usuarioFetch['foto_usu']);
                    $usuarioDTO->setTelefone($usuarioFetch['telefone']);
                    $usuarioDTO->setCpf_cnpj($usuarioFetch['cpf_cnpj']);
                    $usuarioDTO->setComplemento($usuarioFetch['complemento']);
                    $usuarioDTO->setNumero($usuarioFetch['numero']);
                    $usuarioDTO->setCpf_cnpj($usuarioFetch['cpf_cnpj']);
                    $usuarioDTO->setBairro($usuarioFetch['bairro']);
                    $usuarioDTO->setCidade($usuarioFetch['cidade']);
                    $usuarioDTO->setCep($usuarioFetch['cep']);
                    $usuarioDTO->setUf($usuarioFetch['uf']);
                    $usuarioDTO->setFk_id_perfil($usuarioFetch['perfil_usu']);
                    $usuarios[] = $usuarioFetch;
                    
                } return $usuarios;
            }else{
                echo '<p>Nenhum usuario adicionado ainda!</p>';
            }
            }catch(PDOException $exc){
            echo $exc->getMessage();
        }
    }


    public function alterarUsuario(UsuarioDTO $UsuarioDTO){
        try {
            $sql = "UPDATE usuario SET nome_usu=?, nickname_usu=?, genero_usu=?, dt_de_nasci_usu=?,
                    foto_usu=?, telefone=?, cpf_cnpj=?, endereco=?, numero=?, complemento=?, bairro=?,
                    cidade=?, cep=?, uf=?, email_usu=?, senha_usu=?, fk_id_perfil=? WHERE id_usuario=?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $UsuarioDTO->getNome_usu());
            $stmt->bindValue(2, $UsuarioDTO->getNickname_usu());
            $stmt->bindValue(3, $UsuarioDTO->getGenero_usu());
            $stmt->bindValue(4, $UsuarioDTO->getDt_de_nasci_usu());
            $stmt->bindValue(5, $UsuarioDTO->getFoto_usu());
            $stmt->bindValue(6, $UsuarioDTO->getTelefone());
            $stmt->bindValue(7, $UsuarioDTO->getCpf_cnpj());
            $stmt->bindValue(8, $UsuarioDTO->getEndereco());
            $stmt->bindValue(9, $UsuarioDTO->getNumero());
            $stmt->bindValue(10, $UsuarioDTO->getComplemento());
            $stmt->bindValue(11, $UsuarioDTO->getBairro());
            $stmt->bindValue(12, $UsuarioDTO->getCidade());
            $stmt->bindValue(13, $UsuarioDTO->getCep());
            $stmt->bindValue(14, $UsuarioDTO->getUf());
            $stmt->bindValue(15, $UsuarioDTO->getEmail_usu());
            $stmt->bindValue(16, md5($UsuarioDTO->getSenha_usu()));
            $stmt->bindValue(17, $UsuarioDTO->getFk_id_perfil());
            $stmt->bindValue(18, $UsuarioDTO->getId_usuario());
            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
    }



    public function excluirUsuarioById($id_usuario)
    {
        try {
            $sql = "DELETE FROM usuario WHERE id_usuario=?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $id_usuario);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    public function dadosUsuario($id_usuario)
    {
        try {
            $sql  = "SELECT * FROM usuario WHERE id_usuario=? LIMIT 1";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $id_usuario);
            $stmt->execute();
            $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $usuarios;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function dadosUsuarioPorId($id)
    {
        try {
            $sql = "SELECT * FROM usuario WHERE id_usuario=?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $id);
            $stmt->execute();
            $usuarioFetch = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($usuarioFetch) {
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
    } //fim do recuperarPorID  

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
                $usuario->setFoto_usu($usuarioFetch["foto_usu"]);
                $usuario->setTelefone($usuarioFetch["telefone"]);
                $usuario->setCpf_cnpj($usuarioFetch["cpf_cnpj"]);
                $usuario->setEndereco($usuarioFetch["endereco"]);
                $usuario->setNumero($usuarioFetch["numero"]);
                $usuario->setComplemento($usuarioFetch["complemento"]);
                $usuario->setBairro($usuarioFetch["bairro"]);
                $usuario->setCidade($usuarioFetch["cidade"]);
                $usuario->setCep($usuarioFetch["cep"]);
                $usuario->setfk_id_perfil($usuarioFetch["fk_id_perfil"]);
                $usuario->setSituacao_usu($usuarioFetch["situacao_usu"]);

                return $usuario;
            }

            return null;
        } catch (PDOException $e) {
            echo $e->getMessage();
            //die() = usado para parar a execução - retirar na versão de produção
            die();
        }
    }

    public function encontraPorId($id)
    {
        try {
            $sql = "SELECT * FROM usuario WHERE id_usuario=?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $id);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $usuarioFetch = $stmt->fetch(PDO::FETCH_ASSOC);

                $usuarioDTO = new UsuarioDTO();
                $usuarioDTO->setId_usuario($usuarioFetch["id_usuario"]);
                $usuarioDTO->setNome_usu($usuarioFetch["nome_usu"]);
                $usuarioDTO->setEmail_usu($usuarioFetch["email_usu"]);
                $usuarioDTO->setSenha_usu($usuarioFetch["senha_usu"]);
                $usuarioDTO->setfk_id_perfil($usuarioFetch["fk_id_perfil"]);
                $usuarioDTO->setSituacao_usu($usuarioFetch["situacao_usu"]);
                $usuarioDTO->setTelefone($usuarioFetch["telefone"]);
                $usuarioDTO->setCpf_cnpj($usuarioFetch["cpf_cnpj"]);
                $usuarioDTO->setEndereco($usuarioFetch["endereco"]);
                $usuarioDTO->setNumero($usuarioFetch["numero"]);
                $usuarioDTO->setComplemento($usuarioFetch["complemento"]);
                $usuarioDTO->setBairro($usuarioFetch["bairro"]);
                $usuarioDTO->setCidade($usuarioFetch["cidade"]);
                $usuarioDTO->setFoto_usu($usuarioFetch["foto_usu"]);
                $usuarioDTO->setCep($usuarioFetch["cep"]);
                $usuarioDTO->setUf($usuarioFetch["uf"]);

                return $usuarioDTO;
            }
            return false;
        } catch (PDOException $e) {
            echo $e->getMessage();
            //die() = usado para parar a execução - retirar na versão de produção
            die();
        }
    }


    public function geraChaveAcesso(UsuarioDTO $usuarioDTO)
{
    try {
        $sql = "SELECT * FROM usuario WHERE email_usu = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $usuarioDTO->getEmail_usu());
        $stmt->execute();
        $usu = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usu) {
            $chave = sha1($usu['id_usuario'] . $usu['senha_usu']);
            return $chave;
        }

    } catch (PDOException $e) {
        echo $e->getMessage();
        die();
    }
}

}
