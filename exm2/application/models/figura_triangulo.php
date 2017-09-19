<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Figura_triangulo extends Figura {
    private $base;
    private $altura;
    public function __construct($opcion) {
        $this->base   = $opcion['base'];
        $this->altura = $opcion['altura'];
    }
    public function getAltura() {
        return $this->altura;
    }
    public function getBase() {
        return $this->base;
    }
    public function getSuperficie() {
        return $this->base * $this->altura / 2.0;
    }
    public function getTipo() {
        return 'Triangulo';
    }
}

/* End of file figura_triangulo.php */
/* Location: ./application/models/figura_triangulo.php */