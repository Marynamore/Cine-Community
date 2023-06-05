<?php 
class TransacaoDTO{
    private $id_transacao;
    private $tipo_trans;
    private $dt_hora_trans;
    private $status_trans;
    private $valor_total;
    private $tipo_pagamento_trans;
    private $fk_id_item;
    private $fk_id_usuario;
    private $fk_id_perfil;

    public function getId_transacao() {
        return $this->id_transacao;
    }

    public function setId_transacao($id_transacao) {
        $this->id_transacao = $id_transacao;
    }

    public function getTipo_trans() {
        return $this->tipo_trans;
    }

    public function setTipo_trans($tipo_trans) {
        $this->tipo_trans = $tipo_trans;
    }

    public function getDt_hora_trans() {
        return $this->dt_hora_trans;
    }

    public function setDt_hora_trans($dt_hora_trans) {
        $this->dt_hora_trans = $dt_hora_trans;
    }

    public function getStatus_trans() {
        return $this->status_trans;
    }

    public function setStatus_trans($status_trans) {
        $this->status_trans = $status_trans;
    }

    public function getValor_total() {
        return $this->valor_total;
    }

    public function setValor_total($valor_total) {
        $this->valor_total = $valor_total;
    }

    public function getFk_id_item() {
        return $this->fk_id_item;
    }

    public function setFk_id_item($fk_id_item) {
        $this->fk_id_item = $fk_id_item;
    }

    public function getTipo_pagamento_trans() {
        return $this->tipo_pagamento_trans;
    }

    public function setTipo_pagamento_trans($tipo_pagamento_trans) {
        $this->tipo_pagamento_trans = $tipo_pagamento_trans;
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
