<?php 

class ResenhaDTO{

    private $id_resenha;
    private $avaliacao_res;
    private $descricao_res;
    private $titulo_res;
    private $dt_hora_res;
    private $denuncia_res;
    private $situacao_res;
    private $fk_id_filme;
    private $fk_id_usuario;
    private $fk_id_perfil;
    private $fk_id_categoria_filme;
    private $fk_id_canal_filme;

    public function getId_resenha(){
        return $this->id_resenha;
    }

    public function getAvaliacao_res(){
        return $this->avaliacao_res;
    }

    public function getDescricao_res(){
        return $this->descricao_res;
    }

    public function getTitulo_res(){
        return $this->titulo_res;
    }

    public function getDt_hora_res(){
        return $this->dt_hora_res;
    }

    public function getDenuncia_res(){
        return $this->denuncia_res;
    }

    public function getSituacao_res(){
        return $this->situacao_res;
    }

    public function getFk_id_filme(){
        return $this->fk_id_filme;
    }

    public function getFK_id_usuario(){
        return $this->fk_id_usuario;
    }

    public function getFK_id_perfil(){
        return $this->fk_id_perfil;
    }

    public function getFk_id_categoria_filme(){
        return $this->fk_id_categoria_filme;
    }

    public function getFk_id_canal_filme(){
        return $this->fk_id_canal_filme;
    }

    public function setId_resenha($id_resenha){
        $this->id_resenha = $id_resenha;
    }

    public function setAvaliacao_res($avaliacao_res){
        $this->avaliacao_res = $avaliacao_res;
    }

    public function setDescricao_res($descricao_res){
        $this->descricao_res = $descricao_res;
    }

    public function setTitulo_res($titulo_res){
        $this->titulo_res = $titulo_res;
    }

    public function setDt_hora_res($dt_hora_res){
        $this->dt_hora_res = $dt_hora_res;
    }

    public function setDenuncia_res($denuncia_res){
        $this->denuncia_res = $denuncia_res;
    }

    public function setSituacao_res($situacao_res){
        $this->situacao_res = $situacao_res;
    }

    public function setFk_id_filme($fk_id_filme){
        $this->fk_id_filme = $fk_id_filme;
    }

    public function setFk_id_usuario($fk_id_usuario){
        $this->fk_id_usuario = $fk_id_usuario;
    }

    public function setFk_id_perfil($fk_id_perfil){
        $this->fk_id_perfil = $fk_id_perfil;
    }

    public function setFk_id_categoria_filme($fk_id_categoria_filme){
        $this->fk_id_categoria_filme = $fk_id_categoria_filme;
    }

    public function setFk_id_canal_filme($fk_id_canal_filme){
        $this->fk_id_canal_filme = $fk_id_canal_filme;
    }
}
