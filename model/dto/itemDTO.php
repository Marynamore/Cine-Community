<?php 

class ItemDTO{
    private $id_item;
    private $nome_item;
    private $descricao_item;
    private $preco_item;
    private $imagem_item;
    private $qtd_item;
    private $fk_id_categoria_item;
    private $fk_id_usuario;
    private $fk_id_perfil;

    public function getId_item() {
        return $this->id_item;
    }

    public function setId_item($id_item) {
        $this->id_item = $id_item;
    }

    public function getNome_item() {
        return $this->nome_item;
    }

    public function setNome_item($nome_item) {
        $this->nome_item = $nome_item;
    }

    public function getDescricao_item() {
        return $this->descricao_item;
    }

    public function setDescricao_item($descricao_item) {
        $this->descricao_item = $descricao_item;
    }

    public function getPreco_item() {
        return $this->preco_item;
    }

    public function setPreco_item($preco_item) {
        $this->preco_item = $preco_item;
    }

    public function getImagem_item() {
        return $this->imagem_item;
    }

    public function setImagem_item($imagem_item) {
        $this->imagem_item = $imagem_item;
    }

    public function getQtd_item() {
        return $this->qtd_item;
    }

    public function setQtd_item($qtd_item) {
        $this->qtd_item = $qtd_item;
    }

    public function getFk_id_categoria_item() {
        return $this->fk_id_categoria_item;
    }

    public function setFk_id_categoria_item($fk_id_categoria_item) {
        $this->fk_id_categoria_item = $fk_id_categoria_item;
    }

    public function getFk_id_usuario() {
        return $this->fk_id_usuario;
    }

    public function setFk_id_usuario($fk_id_usuario) {
        $this->fk_id_usuario = $fk_id_usuario;
    }

    public function getFk_id_perfil() {
        return $this->fk_id_perfil;
    }

    public function setFk_id_perfil($fk_id_perfil) {
        $this->fk_id_perfil = $fk_id_perfil;
    }
}
