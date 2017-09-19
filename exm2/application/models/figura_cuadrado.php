<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Figura_cuadrado extends Figura {
    private $lado;
    public function __construct($lado) {
        $this->lado = $lado;
    }
    public function getBase() {
        return $this->lado;
    }
    public function getAltura() {
        return $this->lado;
    }
    public function getSuperficie() {
        return $this->lado * $this->lado;
    }
    public function getTipo() {
        return 'Cuadrado';
    }
}

/* End of file figura_cuadrado.php */
/* Location: ./application/models/figura_cuadrado.php */