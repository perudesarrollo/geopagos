<?php
class Pago {

    function __construct() {
    }

    public function setImporte($importe = '') {
        try {
            if (empty(trim($importe)) && strlen($importe) <= 1) {
                throw new Exception(sprintf(Modelo::MIN_LENGHT, 'importe', 1));
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            exit();
        }
        $this->importe = $importe;
        return $this;
    }

    public function getImporte() {
        return $this->importe;
    }

    public function setFecha($fecha = '') {
        try {
            if (strlen($fecha) <= 8) {
                throw new Exception(sprintf(Modelo::MIN_LENGHT, 'Fecha', 8));
            }
            if (strtotime($fecha) <= (time() - (60 * 60 * 24))) {
                throw new Exception('fecha no puede ser anterior al día de hoy.');
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            exit();
        }
        $this->fecha = $fecha;
        return $this;
    }

    public function getFecha() {
        return $this->fecha;
    }
}