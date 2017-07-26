<?php

class Cobro_Model extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function nuevoObjeto($data) {
        $obj['idAranceles'] = $data[0];
        $obj['Nombre'] = $data[1];
        $obj['Precio'] = $data[2];
        return $obj;
    }

    public function listadoAranceles() {
        $sql = "SELECT idAranceles, Nombre FROM Aranceles";
        $outp = $this->db->getAll($sql);
        echo json_encode($outp);
    }

    public function traerArancel($idAranceles) {
        $sql = "SELECT idAranceles, Nombre, Precio FROM Aranceles WHERE idAranceles = ?i";
        $outp = $this->db->getAll($sql, $idAranceles);
        echo json_encode($outp);
    }

    public function agregarModificarArancel($data) {
      $sql = "INSERT INTO aranceles SET ?u ON DUPLICATE KEY UPDATE ?u";
      $this->db->query($sql, (array) $data, (array) $data);
    }
    public function eliminarArancel($idAranceles) {
      $sql = "DELETE FROM aranceles WHERE idAranceles = ?i";
      $this->db->query($sql, $idAranceles);
    }



}
