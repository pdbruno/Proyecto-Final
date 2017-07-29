<?php

class Model {

  function __construct() {
    $opts = array(
      'user' => 'root',
      'pass' => '12345',
      'db' => 'dbproyectofinal',
      'charset' => 'utf8'
    );
    $this->db = new SafeMySQL($opts);
  }
  public function listado($tipo) {
    $sql = "SELECT ?n , Nombre FROM ?n";
    $outp = $this->db->getAll($sql, 'id' . $tipo, strtolower($tipo));
    echo json_encode($outp);
  }

  public function traerElemento($tipo, $id) {
    $sql = "SELECT * FROM ?n WHERE ?n = ?i";
    $outp = $this->db->getAll($sql, strtolower($tipo), 'id' . $tipo, $id);
    echo json_encode($outp);
  }

  public function agregarModificar($tipo,$data) {
    $sql = "INSERT INTO ?n SET ?u ON DUPLICATE KEY UPDATE ?u";
    $this->db->query($sql, strtolower($tipo), $data, $data);
  }

  public function eliminar($tipo, $id) {
    $sql = "DELETE FROM ?n WHERE ?n = ?i";
    $outp = $this->db->query($sql, strtolower($tipo), 'id' . $tipo, $id);
  }

}
