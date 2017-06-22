<?php

class Help_Model extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function nuevoObjeto($data, $tipo) {
        $obj['id'.$tipo] = $data[0];
        $obj['Nombre'] = $data[1];
        return $obj;
    }

    public function listado($tipo) {

        $sql = "SELECT ?n as id, Nombre FROM ?n";
        $outp = $this->db->getAll($sql, 'id' . $tipo, strtolower($tipo));
        echo json_encode($outp);
    }

    public function traerFila($tipo, $id) {
        $sql = "SELECT ?n as id, Nombre FROM ?n WHERE ?n = ?i";
        $outp = $this->db->getAll($sql, 'id' . $tipo, strtolower($tipo), 'id' . $tipo, $id);
        echo json_encode($outp);
    }

    public function eliminarFila($tipo, $id) {
        $sql = "DELETE FROM ?n WHERE ?n = ?i";
        $outp = $this->db->getAll($sql, strtolower($tipo), 'id' . $tipo, $id);
        $this->db->query($sql);
    }

    public function agregarModificarFila($data, $tipo) {
        $sql = "INSERT INTO ?n SET ?u ON DUPLICATE KEY UPDATE ?u";
        $this->db->query($sql, strtolower($tipo), $data, $data);
    }

}
