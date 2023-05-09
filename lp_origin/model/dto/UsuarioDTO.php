<?php
/*
 * Essa classe representa o modelo da tabela.
 * DTO - Data Transfer Object
 */
class  UsuarioDTO {
    private $id_usuario;
    private $nome_usu;
    private $nickname_usu;
    private $genero_usu;
    private $dt_de_nasci_usu;
    private $email_usu;
    private $senha_usu;
    private $perfil_usu;
    private $situacao_usu;
    private $foto_usu;
    

    public function getId_usuario() {
        return $this->id_usuario;
    }

    public function getNome_usu() {
        return $this->nome_usu;
    }

    public function getNickname_usu() {
        return $this->nickname_usu;
    }
    public function getGenero_usu() {
        return $this->genero_usu;
    }
    public function getDt_de_nasci_usu() {
        return $this->dt_de_nasci_usu;
    }

    public function getEmail_usu() {
        return $this->email_usu;
    }

    public function getSenha_usu() {
        return $this->senha_usu;
    }

    public function getPerfil_usu() {
        return $this->perfil_usu;
    }

    public function getSituacao_usu() {
        return $this->situacao_usu;
    }
    
    public function getFoto_usu() {
        return $this->foto_usu;
    }

    
    public function setId_usuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }

    public function setNome_usu($nome_usu) {
        $this->nome_usu = $nome_usu;
    }

    public function setNickname_usu($nickname_usu) {
        $this->nickname_usu = $nickname_usu;
    }
    public function setGenero_usu($genero_usu) {
        $this->genero_usu	 = $genero_usu;
    }
    public function setDt_de_nasci_usu($dt_de_nasci_usu) {
        $this->dt_de_nasci_usu = $dt_de_nasci_usu;
    }

    public function setEmail_usu($email_usu) {
        $this->email_usu = $email_usu;
    }

    public function setSenha_usu($senha_usu) {
        $this->senha_usu = $senha_usu;
    }

    public function setPerfil_usu($perfil_usu) {
        $this->perfil_usu = $perfil_usu;
    }

    public function setSituacao_usu($situacao_usu) {
        $this->situacao_usu = $situacao_usu;
    }
    
    public function setFoto_usu($foto_usu) {
        $this->foto_usu = $foto_usu;
    }

    
}
