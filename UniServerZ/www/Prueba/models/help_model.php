<?php

class Help_Model extends Model {

    private $con;

    public function __construct() {
        require 'models/Conexion_Model.php';
        $this->con = new Conexion_Model();
    }

    public function listado($tipo) {

        $sql = "SELECT id$tipo as id, Nombre FROM " . strtolower($tipo);

        $outp = $this->con->consultaRetorno($sql);
        foreach ($outp as $indice => $elemento) {
            foreach ($elemento as $key => $value) {
                $output[$indice][$key] = preg_replace_callback("/(&#[0-9]+;)/", function($m) {
                    return mb_convert_encoding($m[1], "UTF-8", "HTML-ENTITIES");
                }, $value);
            }
        }

        echo json_encode($output);
    }

    public function traerFila($tipo, $id) {
        $sql = "SELECT id$tipo as id, Nombre FROM " . strtolower($tipo) . " WHERE id$tipo = $id";

        $outp = $this->con->consultaRetorno($sql);
        foreach ($outp as $indice => $elemento) {
            foreach ($elemento as $key => $value) {
                $output[$indice][$key] = preg_replace_callback("/(&#[0-9]+;)/", function($m) {
                    return mb_convert_encoding($m[1], "UTF-8", "HTML-ENTITIES");
                }, $value);
            }
        }

        echo json_encode($output);
    }

    public function eliminarFila($tipo, $id) {
        $sql = "DELETE FROM " . strtolower($tipo) . " WHERE id$tipo = $id";
        $this->con->consultaSimple($sql);
    }

    public function agregarModificarFila($info, $tipo) {
        $caca = json_decode($info, TRUE);
        foreach ($caca as $indice => $elemento) {
            $data[$indice] = htmlentities($elemento, ENT_QUOTES);
        }
        $data[1] = "'" . $data[1] . "'";
        if ($data[0] == '') {
            $sql = "INSERT INTO " . strtolower($tipo) . "(Nombre) VALUES($data[1])";
        } else {
            $sql = "UPDATE " . strtolower($tipo) . " SET Nombre = $data[1] WHERE id$tipo=$data[0]";
        }
        $this->con->consultaSimple($sql);
    }

}
