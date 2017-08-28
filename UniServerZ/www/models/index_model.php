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

  function morososActividad()
  {
    $outp = $this->db->getAll("SELECT DISTINCT CONCAT(clientes.Nombres,' ',clientes.Apellidos) AS Nombres, actividades.Nombre as NombreAct, IF(actividades.XMes = 1, MONTHNAME(Fecha), Fecha) as Fecha FROM `asistencias` \
    LEFT JOIN clientes ON asistencias.idClientes = clientes.idClientes
    LEFT JOIN actividades ON asistencias.idActividades = actividades.idActividades
    WHERE `Abonado` = 0 ");
    echo json_encode($outp);
  }
}
