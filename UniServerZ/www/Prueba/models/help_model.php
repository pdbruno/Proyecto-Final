<?php

class Help_Model extends Model {

    private $con;

    public function __construct() {
        parent::__construct();
    }

    public function listado($tipo) {

        $sql = "SELECT ?n as id, Nombre FROM ?n";
        $outp = $this->db->getAll($sql, 'id' . $tipo, strtolower($tipo));
        echo json_encode($outp);
    }

    public function traerFila($tipo, $id) {
        $sql = "SELECT ?n as id, Nombre FROM ?n WHERE ?n = ?i";
        $outp = $this->db->getAll($sql, 'id' . $tipo, strtolower($tipo), 'id' . $tipo, id);
        echo json_encode($outp);
    }

    public function eliminarFila($tipo, $id) {
        $sql = "DELETE FROM ?n WHERE ?n = ?i";
        $outp = $this->db->getAll($sql, strtolower($tipo), 'id' . $tipo, id);
        $this->con->consultaSimple($sql);
    }

    public function agregarModificarFila($info, $data) {
        $sql = "INSERT INTO ?n SET ?u ON DUPLICATE KEY UPDATE ?u";
        $this->con->consultaSimple($sql, strtolower($tipo), $data, $data);
    }

}
