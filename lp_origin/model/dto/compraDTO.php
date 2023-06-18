<?php
// Essa classe representa o modelo da tabela

class CompraDTO{
// Adicionando os atributos para classe
    private $id_compra;
    private $quant_compra;
    private $preco_compra;
    private $dt_hora_compra;
    private $status_compra;
    private $tipo_pagamento;
    private $fk_id_item;
    private $fk_id_usuario;
    private $fk_id_perfil;
    

public function getId_compra(){
    return $this->id_compra;
}
public function getQuant_compra(){
    return $this->quant_compra;
}
public function getPreco_compra(){
    return $this->preco_compra;
}
public function getDt_hora_compra(){
    return $this->dt_hora_compra;
}
public function getStatus_compra(){
    return $this->status_compra;
}
public function getTipo_pagamento(){
    return $this->tipo_pagamento;
}
public function getFk_id_item() {
    return $this->fk_id_item;
}
public function getFk_id_usuario() {
    return $this->fk_id_usuario;
}
public function getFk_id_perfil() {
    return $this->fk_id_perfil;
}

public function setId_compra($id_compra) {
    $this->id_compra = $id_compra;
}
public function setQuant_compra($quant_compra) {
    $this->quant_compra = $quant_compra;
}
public function setDt_hora_compra($dt_hora_compra) {
    $this->dt_hora_compra = $dt_hora_compra;
}
public function setPreco_compra($preco_compra) {
    $this->preco_compra = $preco_compra; 
}
public function setStatus_compra($status_compra){
    $this->status_compra = $status_compra;
}
public function setTipo_pagamento($tipo_pagamento){
    $this->tipo_pagamento = $tipo_pagamento;
}
public function setFk_id_item($fk_id_item) {
    $this->fk_id_item = $fk_id_item;
}
public function setFk_id_usuario($fk_id_usuario){
    $this->fk_id_usuario = $fk_id_usuario;
}
public function setFk_id_perfil($fk_id_perfil) {
    $this->fk_id_perfil = $fk_id_perfil;
}
}

?>