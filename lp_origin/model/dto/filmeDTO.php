<?php
// Essa classe representa o modelo da tabela.//
class FilmeDTO{
// Adicionando os atributos para classe.//
    private $id_filme;
    private $nome_filme;
    private $dt_de_lancamento_filme;
    private $duracao_filme;
    private $sinopse_filme;
    private $classificacao_filme;
    private $capa_filme;
    private $trailer_filme;
    private $fk_id_categoria_filme;
    private $fk_id_canal_filme;
    private $fk_id_usuario;
    private $fk_id_perfil;
    

public function getId_filme(){
    return $this->id_filme;
}
public function getNome_filme(){
    return $this->nome_filme;
}
public function getDt_de_lancamento_filme(){
    return $this->dt_de_lancamento_filme;
}
public function getDuracao_filme(){
    return $this->duracao_filme;
}
public function getSinopse_filme(){
    return $this->sinopse_filme;
}
public function getClassificacao_filme() {
    return $this->classificacao_filme;
}
public function getCapa_filme() {
    return $this->capa_filme;
}
public function getTrailer_filme() {
    return $this->trailer_filme;
}
public function getFk_id_categoria_filme() {
    return $this->fk_id_categoria_filme;
}
public function getFk_id_canal_filme() {
    return $this->fk_id_canal_filme;
}
public function getFk_id_usuario() {
    return $this->fk_id_usuario;
}
public function getFk_id_perfil() {
    return $this->fk_id_perfil;
}

public function setId_filme($id_filme) {
    $this->id_filme = $id_filme;
}
public function setNome_filme($nome_filme) {
    $this->nome_filme = $nome_filme;
}
public function setDt_de_lancamento_filme($dt_de_lancamento_filme) {
    $this->dt_de_lancamento_filme = $dt_de_lancamento_filme;
}
public function setDuracao_filme($duracao_filme) {
    $this->duracao_filme = $duracao_filme; 
}
public function setSinopse_filme($sinopse_filme){
    $this->sinopse_filme = $sinopse_filme;
}
public function setClassificacao_filme($classificacao_filme) {
    $this->classificacao_filme = $classificacao_filme;
}
public function setCapa_filme($capa_filme) {
    $this->capa_filme = $capa_filme;
}
public function setTrailer_filme($trailer_filme) {
    $this->trailer_filme = $trailer_filme;
}
public function setFk_id_categoria_filme($fk_id_categoria_filme) {
    $this->fk_id_categoria_filme = $fk_id_categoria_filme;
}
public function setFk_id_canal_filme($fk_id_canal_filme) {
    $this->fk_id_canal_filme = $fk_id_canal_filme;
}
public function setFk_id_usuario($fk_id_usuario){
    $this->fk_id_usuario = $fk_id_usuario;
}
public function setFk_id_perfil($fk_id_perfil) {
    $this->fk_id_perfil = $fk_id_perfil;
}
}

?>