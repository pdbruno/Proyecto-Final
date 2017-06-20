<?php

//namespace Models;

class Conexion_Model extends Model {

    private $datos = array(
        'host' => 'localhost',
        'user' => 'root',
        'password' => 12345,
        'db' => 'dbproyectofinal'
    );
    private $mysqli;

    public function __construct() {
        $this->mysqli = new mysqli($this->datos['host'], $this->datos['user'], $this->datos['password'], $this->datos['db']);
    }

    public function cerrarConexion() {
        $this->mysqli->close();
    }

    public function consultaSimple($sql) {
        $resultado = $this->mysqli->query($sql);
        if (!$resultado) {
            die("Connection failed: " . $this->mysqli->connect_error);
        }
    }

    public function consultaRetorno($sql) {
        $resultado = $this->mysqli->query($sql);
        if (!$resultado) {
            
        } else {
            $outp = $resultado->fetch_all(MYSQLI_ASSOC);
            return $outp;
        }
    }

    public function multiQuery($sql) {
        $todo = array();
        if ($this->mysqli->multi_query($sql)) {
            do {
                if ($result = $this->mysqli->store_result()) {
                    while ($row = $result->fetch_row()) {
                        $elemento['id'] = htmlentities($row[0]);
                        $elemento['Nombre'] = htmlentities($row[1]);
                        $dropdown[] = $elemento;
                    }
                    $result->free();
                }
                if ($this->mysqli->more_results()) {
                    $todo[] = $dropdown;
                    $dropdown = array();
                }
            } while ($this->mysqli->next_result());
            $todo[] = $dropdown;
            return $todo;
        } else {
            die("Connection failed: " . $this->mysqli->connect_error);
        }
    }

}
