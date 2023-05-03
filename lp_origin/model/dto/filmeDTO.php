<?php
// Essa classe representa o modelo da tabela.//
class FilmeDTO{
// Adicionando os atributos para classe.//
    private $id_filme;
    private $nome_filme;
    private $dt_de_lancamento_filme;
    private $duracao_filme;
    private $sinopse_filme;
    private $genero_filme;
    private $classificacao_filme;
    private $capa_filme;
    private $trailer_filme;
    private $canal_filme;
    private $fk_usuario_id_usuario;
    

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
public function getGenero_filme() {
    return $this->genero_filme;
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
public function getCanal_filme() {
    return $this->canal_filme;
}

public function getFk_usuario_id_usuario() {
    return $this->fk_usuario_id_usuario;
}

public function setId_filme($id_filme) {
    $this->id_filme = $id_filme;
}
public function setNome_filme($nome_filme) {
    $this->nome_filme = $nome_filme;
}
//configure a area padrão da data
public function setDt_de_lancamento_filme($dt_de_lancamento_filme) {
    $this->dt_de_lancamento_filme = $dt_de_lancamento_filme;//d {dia numérico} e D {dia da Semana}
}
public function setDuracao_filme($duracao_filme) {
    // Timezone do Brazil GMT-3
    $this->duracao_filme = $duracao_filme; // G{hora} i{minuto} s{segundos} T{timezone = facha de horario mundial} CET/UTC(dentre outras){configuração do servidor}
}
public function setSinopse_filme($sinopse_filme){
    $this->sinopse_filme = $sinopse_filme;
}
public function setGenero_filme($genero_filme) {
    $this->genero_filme = $genero_filme;
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
public function setCanal_filme($canal_filme) {
    $this->canal_filme = $canal_filme;
}
public function setFk_usuario_id_usuario($fk_usuario_id_usuario) {
    $this->fk_usuario_id_usuario = $fk_usuario_id_usuario;
}


}

?>