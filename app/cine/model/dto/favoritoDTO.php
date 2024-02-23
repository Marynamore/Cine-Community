<?php

Class FavoritoDTO{

    private $id_favorito;
    private $favorito;
    private $fk_id_usuario;
    private $fk_id_perfil;
    private $fk_id_filme;

    public function getId_favorito(){
        return $this->id_favorito;
    }
    public function getFavorito(){
        return $this->favorito;
    }
    public function getFk_id_usuario() {
        return $this->fk_id_usuario;
    }
    public function getFk_id_perfil() {
        return $this->fk_id_perfil;
    }
    public function getFk_id_filme() {
        return $this->fk_id_filme;
    }

    public function setId_favorito($id_favorito){
        $this->id_favorito = $id_favorito;
    }
    public function setFavorito($favorito){
        $this->favorito = $favorito;
    }
    public function setFk_id_usuario($fk_id_usuario){
        $this->fk_id_usuario = $fk_id_usuario;
    }
    public function setFk_id_perfil($fk_id_perfil) {
        $this->fk_id_perfil = $fk_id_perfil;
    }
    public function setFk_id_filme($fk_id_filme){
        $this->fk_id_filme = $fk_id_filme;
    }
}







?>