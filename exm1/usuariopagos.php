<?php
class UsuarioPagos {

    function __construct() {
    }

    public function setCodigoUsuario($usuario = '') {
        try {
            if (empty(trim($usuario)) && strlen($usuario) <= 1) {
                throw new Exception(sprintf(Modelo::MIN_LENGHT, 'Usuario', 1));
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            exit();
        }
        $this->codigousuario = $usuario;
        return $this;
    }

    public function getCodigoUsuario() {
        return $this->codigousuario;
    }

    public function setCodigoPago($usuario = '') {
        try {
            if (empty(trim($usuario)) && strlen($usuario) <= 1) {
                throw new Exception(sprintf(Modelo::MIN_LENGHT, 'Usuario favorito', 1));
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            exit();
        }
        $this->codigopago = $usuario;
        return $this;
    }

    public function getCodigoPago() {
        return $this->codigopago;
    }
}