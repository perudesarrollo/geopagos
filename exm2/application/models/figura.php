<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . '/interfaces/ifigura.php';

class Figura extends CI_Model implements IFigura {

    public function getAltura() {
        return NULL;
    }
    public function getBase() {
        return NULL;
    }
    public function getDiametro() {
        return NULL;
    }
    public function getSuperficie() {
        return NULL;
    }
    public function getTipo() {
        return NULL;
    }

    public static function crear($tipo, $opcion = 0) {
        try {
            $modelo = "figura_" . $tipo;
            $path   = APPPATH . 'models/' . $modelo . '.php';
            require_once $path;
            if (class_exists($modelo)) {
                return new $modelo($opcion);
            } else {
                throw new Exception("{$path} Modulo Invalido.");
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            exit();
        }
    }
}

/* End of file figura.php */
/* Location: ./application/models/figura.php */