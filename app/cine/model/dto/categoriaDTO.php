<?php 

class categoriaFilmeDTO {
    private $id_categoria_filme;
    private $categoria_filme;

    public function getId_categoria_filme() {
        return $this->id_categoria_filme;
    }

    public function setId_categoria_filme($id_categoria_filme) {
        $this->id_categoria_filme = $id_categoria_filme;
    }

    public function getCategoria_filme() {
        return $this->categoria_filme;
    }

    public function setCategoria_filme($categoria_filme) {
        $this->categoria_filme = $categoria_filme;
    }
}

