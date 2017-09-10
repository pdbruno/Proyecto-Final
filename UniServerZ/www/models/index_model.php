<?php

class index_Model extends Model {
  public function __construct() {
    parent::__construct();
  }

  function morososMatricula()
  {
    $outp = $this->db->getAll("SELECT `idClientes`, CONCAT(`Nombres`,' ',`Apellidos`) AS Nombres FROM `clientesactivos` WHERE YEAR(CURDATE()) - YEAR(`PagoMatricula`) != 0");
    echo json_encode($outp);
  }

  function morososExceso()
  {
    $outp = $this->traerTodo('excesoasistencia');
    echo json_encode($this->formatDeuda($outp));
  }


  function morososActividad()
  {
    $outp = $this->traerTodo('deudas');
    echo json_encode($this->formatDeuda($outp));
  }
}
