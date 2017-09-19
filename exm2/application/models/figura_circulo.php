<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Figura_circulo extends Figura {
    private $diametro;
    public function __construct($diametro = 0) {
        $this->diametro = $diametro;
    }
    public function getDiametro() {
        return $this->diametro;
    }
    public function getSuperficie() {
        echo $radio = $this->diametro / 2.0;
        return pi() * $radio * $radio;
    }
    public function getTipo() {
        return 'Circulo';
    }
}

/* End of file figura_circulo.php */
/* Location: ./application/models/figura_circulo.php */