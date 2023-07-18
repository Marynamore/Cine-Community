<?php 

class CarrinhoDTO{
    private $id_carrinho;
    private $qtd_compra;
    private $dt_hora_car;
    private $preco;
    private $fk_id_item;
    private $fk_id_usuario;
    private $fk_id_perfil;

    public function getId_carrinho() {
        return $this->id_carrinho;
    }

    public function setId_carrinho($id_carrinho) {
        $this->id_carrinho = $id_carrinho;
    }

    public function getQtd_compra() {
        return $this->qtd_compra;
    }

    public function setQtd_compra($qtd_compra) {
        $this->qtd_compra = $qtd_compra;
    }

    public function getDt_hora_car() {
        return $this->dt_hora_car;
    }

    public function setDt_hora_car($dt_hora_car) {
        $this->dt_hora_car = $dt_hora_car;
    }

    public function getPreco() {
        return $this->preco;
    }

    public function setPreco($preco) {
        $this->preco = $preco;
    }

    public function getFk_id_item() {
        return $this->fk_id_item;
    }

    public function setFk_id_item($fk_id_item) {
        $this->fk_id_item = $fk_id_item;
    }
    
    public function getFk_id_suario() {
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

