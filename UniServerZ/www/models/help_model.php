<?php

class Help_Model extends Model {
    public function __construct() {
        parent::__construct();
    }
    public function listarColumnas($tabla) {
      $sql = "SELECT COLUMN_NAME, COLUMN_COMMENT FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'dbproyectofinal' AND TABLE_NAME = ?s";
      $outp = $this->db->getAll($sql, $tabla);
      echo json_encode($outp);
    }
    public function traerColumna($tipo, $col) {
      $sql = "SELECT COLUMN_NAME, DATA_TYPE, COLUMN_COMMENT, IS_NULLABLE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'dbproyectofinal' AND TABLE_NAME = ?s AND COLUMN_NAME = ?s";
      $outp = $this->db->getAll($sql, $tipo, $col);
      echo json_encode($outp);
    }

    function addColumna($tabla, $data){
      $sql = "ALTER TABLE ?n ADD ?n";
      if ($data['DATA_TYPE'] == 'int' || $data['DATA_TYPE'] == 'text' || $data['DATA_TYPE'] == 'tinyint' ||$data['DATA_TYPE'] == 'date' || $data['DATA_TYPE'] == 'decimal') {
        $sql = $sql . ' ' . $data['DATA_TYPE'];
        if ($data['IS_NULLABLE'] == 'NOT NULL ' || $data['IS_NULLABLE'] == '') {
          $sql = $sql . ' ' . $data['IS_NULLABLE'] . 'COMMENT ?s';
          $outp = $this->db->query($sql, $tabla, $data['COLUMN_NAME'], $data['COLUMN_COMMENT']);
        }
      }
    }
    function editarColumna($tabla, $data){
      $sql = "ALTER TABLE ?n CHANGE ?n ?n";
      if ($data['DATA_TYPE'] == 'int' || $data['DATA_TYPE'] == 'text' || $data['DATA_TYPE'] == 'tinyint' ||$data['DATA_TYPE'] == 'date' || $data['DATA_TYPE'] == 'decimal') {
        $sql = $sql . ' ' . $data['DATA_TYPE'];
        if ($data['IS_NULLABLE'] == 'NOT NULL ' || $data['IS_NULLABLE'] == '') {
          $data['IS_NULLABLE'] = ($data['IS_NULLABLE'] == '') ? "NULL DEFAULT NULL " : 'NOT NULL ';
          $sql = $sql . ' ' . $data['IS_NULLABLE'] . 'COMMENT ?s';
          $outp = $this->db->query($sql, $tabla, $data['COLUMN_NAME'], $data['NombrePrevio'], $data['COLUMN_COMMENT']);
        }
      }
    }
}
