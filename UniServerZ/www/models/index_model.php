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

  function corteProd($data)
  {
    return $this->db->parse(" WHERE `Fecha` BETWEEN ?s AND ?s", $data['Fecha1'], $data['Fecha2']);
  }

  function productosVentas($corte = "")
  {
    $outp = $this->db->getAll("SELECT productos.Nombre, COUNT(0) AS Cantidad FROM `registroventas` LEFT JOIN productos on productos.idProductos = registroventas.idProductos ?p GROUP BY registroventas.idProductos ORDER BY Cantidad DESC", $corte);
    echo json_encode($outp);
  }

  function productosGanancias($corte = "")
  {
    $outp = $this->db->getAll("SELECT productos.Nombre, SUM(Monto) AS Monto FROM `registroventas` LEFT JOIN productos on productos.idProductos = registroventas.idProductos ?p GROUP BY registroventas.idProductos ORDER BY SUM(Monto) DESC", $corte);
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
