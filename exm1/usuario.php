<?php
class Usuario {

    function __construct() {
    }

    public function setUsuario($usuario = '') {
        try {
            if (empty(trim($usuario)) && strlen($usuario) <= 6) {
                throw new Exception(sprintf(Modelo::MIN_LENGHT, 'Usuario', 6));
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            exit();
        }
        $this->usuario = $usuario;
        return $this;
    }

    public function getUsuario() {
        return $this->usuario;
    }

    public function setClave($clave = '') {
        try {
            if (empty(trim($clave)) && strlen($clave) <= 4) {
                throw new Exception(sprintf(Modelo::MIN_LENGHT, 'Clave', 4));
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            exit();
        }
        $this->clave = $clave;
        return $this;
    }

    public function getClave() {
        return $this->clave;
    }

    public function setEdad($edad = 0, $limite_edad = 0) {
        try {
            if (empty(trim($edad)) && strlen($edad) <= 1) {
                throw new Exception(sprintf(Modelo::MIN_LENGHT, 'Edad', 1));
            }

            if (!is_numeric($edad)) {
                throw new Exception(sprintf(Modelo::NUMERIC, 'Edad'));
            }

            if ($edad > $limite_edad) {
                throw new Exception('Edad limite debe ser mayor a ' . $limite_edad);
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            exit();
        }
        $this->edad = $edad;
        return $this;
    }

    public function getEdad() {
        return $this->edad;
    }
}