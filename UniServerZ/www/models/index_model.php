<?php

class index_Model extends Model {
  public function __construct() {
    parent::__construct();
  }

  function morososMatricula()
  {
    $outp = $this->db->getAll("SELECT `idClientes`, CONCAT(`Nombres`,' ',`Apellidos`) AS Nombres FROM `clientes` WHERE `Activo` = 1 AND YEAR(CURDATE()) - YEAR(`PagoMatricula`) != 0");
    echo json_encode($outp);
  }
}
