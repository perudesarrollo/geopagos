<?php

class Modelo {

    protected $dbh;
    const MIN_LENGHT = "El campo %s debe contener al menos %s caracteres de longitud.";
    const NUMERIC    = "El campo %s sólo puede contener números.";
    const REQUIRED   = "El campo %s es obligatorio.";
    const DATA_ISSET = "El campo %s debe contener un valor.";

    public function __construct() {
        self::conectar();
    }

    public function conectar() {
        try {
            $this->dbh = new PDO('mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME, DB_USER, DB_PASS, array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => false,
            ));
        } catch (PDOException $e) {
            echo $e->getMessage();
            return;
        }
    }

    public function select($table = '', $where = '1', $params = array(), $limit = '') {

        $this::existeTabla($table);

        $fields = '*'; //implode(', ', $dbFields);
        $sql    = "SELECT $fields FROM {$table} WHERE $where $limit";
        $stm    = $this->dbh->prepare($sql);

        $stm->execute($params);
        return $stm;
    }

    public function insertar($data = '', $nombre_tabla = '') {

        try {
            if (empty(trim($nombre_tabla))) {
                throw new Exception(sprintf(self::REQUIRED, 'Nombre Tabla'));
            }

            if (!isset($data)) {
                throw new Exception(sprintf(self::DATA_ISSET, 'Data'));
            }

        } catch (Exception $e) {
            echo $e->getMessage();
        }

        $this::existeTabla($nombre_tabla);

        $this->dbh->beginTransaction();
        try {

            $key       = false;
            $value     = false;
            $tmp_value = false;

            foreach ($data as $k => $v) {
                $key[]       = $k;
                $value[]     = $v;
                $tmp_value[] = '?';
                unset($v);
            }
            $campos   = implode(',', $key);
            $values   = implode(',', $tmp_value);
            $sql      = "INSERT INTO " . $nombre_tabla . " (" . $campos . ") VALUES(" . $values . ")";
            $stmt     = $this->dbh->prepare($sql);
            $registro = $stmt->execute($value);

            $this->dbh->commit();
            return $registro;

        } catch (PDOExecption $e) {
            echo $e->getMessage();
            $this->dbh->rollBack();
        }

    }

    function existeTabla($tabla = '') {
        $sql       = "SHOW TABLES LIKE '" . $tabla . "'";
        $resultado = $this->dbh->query($sql);
        if ($resultado->rowCount() == 0) {
            die("Tabla: $tabla no existe");
        }
    }

    public function resultArray() {
        return fetchAll(PDO::FETCH_ASSOC);
    }

    public function resultObject() {
        return fetchAll(PDO::FETCH_OBJ);
    }

    public function resultRow() {
        return fetch(PDO::FETCH_ASSOC);
    }

    public function resultRowObject() {
        fetch(PDO::FETCH_OBJ);
    }
}