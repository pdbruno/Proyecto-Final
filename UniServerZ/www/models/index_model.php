<?php

class index_Model extends Model {
  public function __construct() {
    parent::__construct();
  }

  function porcentajeAsistencias()
  {
    $act = $this->db->getAll("SELECT `idActividades`, `Nombre` FROM `actividades`");
    for ($i = 0; $i < count($act); $i++) {
      $cosa = $this->db->getAll("SELECT idActividades, CONCAT(clientes.Nombres,' ',clientes.Apellidos) AS Nombres, IFNULL((SELECT COUNT(*) FROM `asistencias` WHERE MONTH(Fecha) = MONTH(CURDATE()) AND idActividades = ?i) / (SELECT COUNT(*) FROM `asistencias` WHERE MONTH(Fecha) = MONTH(CURDATE()) AND idActividades = ?i AND idClientes = clientesactividades.idClientes) * 100, 0) AS Porcentaje FROM `clientesactividades`LEFT JOIN clientes on clientes.idClientes = clientesactividades.idClientes WHERE idActividades = ?i", $act[$i]["idActividades"], $act[$i]["idActividades"], $act[$i]["idActividades"]);
      if(count($cosa) != 0){
        $outp[$act[$i]['Nombre']] = $cosa;
      }
    }
    echo json_encode($outp);
  }

  function morososMatricula()
  {
    $outp = $this->db->getAll("SELECT `idClientes`, CONCAT(`Nombres`,' ',`Apellidos`) AS Nombres FROM `clientesactivos` WHERE YEAR(CURDATE()) - YEAR(`PagoMatricula`) != 0");
    echo json_encode($outp);
  }

  function corteProd($data)
  {
    if ($data['Fecha1'] == "" && $data['Fecha2'] == "" ) {
      return "";
    }else {
      return $this->db->parse(" WHERE `Fecha` BETWEEN ?s AND ?s", $data['Fecha1'], $data['Fecha2']);
    }
  }

  function productosVentas($corte = "")
  {
    $outp = $this->db->getAll("SELECT productos.Nombre, COUNT(0) AS Cantidad FROM `registroventas` LEFT JOIN productos on registroventas.idProductos = productos.idProductos ?p GROUP BY registroventas.idProductos ORDER BY Cantidad DESC", $corte);
    echo json_encode($outp);
  }

  function productosGanancias($corte = "")
  {
    $outp = $this->db->getAll("SELECT productos.Nombre, SUM(Monto) AS Monto FROM `registroventas` LEFT JOIN productos on registroventas.idProductos = productos.idProductos ?p GROUP BY registroventas.idProductos ORDER BY SUM(Monto) DESC", $corte);
    echo json_encode($outp);
  }

  function finanzasEgresos($corte = "")
  {
    $outp = $this->db->getAll("SELECT fuentesdeegresos.Nombre, Monto, Fecha, 'Egreso' AS Tipo FROM `egresos` LEFT JOIN fuentesdeegresos on egresos.idFuentesDeEgresos = fuentesdeegresos.idFuentesDeEgresos ?p UNION SELECT productos.Nombre AS Nombre, MontoInd * Cantidad AS Monto, Fecha, 'Egreso' AS Tipo FROM registrocompras  LEFT JOIN productos on registrocompras.idProductos = productos.idProductos ?p  ORDER BY Fecha DESC", $corte, $corte);
    echo json_encode($outp);
  }

  function finanzasEgresosTotal($corte = "")
  {
    $outp = $this->db->getAll("SELECT SUM(Monto) FROM `egresos` ?p UNION SELECT SUM(MontoInd) FROM registrocompras ?p", $corte, $corte);
    echo json_encode($outp);
  }

  function finanzasIngresosTotal($corte = "")
  {
    $outp = $this->db->getAll("SELECT SUM(Monto) FROM `cobros` ?p UNION SELECT SUM(Monto) FROM registroventas ?p", $corte, $corte);
    echo json_encode($outp);
  }

  function finanzasIngresos($corte = "")
  {
    $outp = $this->db->getAll("SELECT Fecha, Monto, actividades.Nombre AS Nombre, 'Ingreso' AS Tipo FROM cobros LEFT JOIN actividades on cobros.idActividades = actividades.idActividades ?p UNION SELECT Fecha, Monto, productos.Nombre AS Nombre, 'Ingreso' AS Tipo FROM registroventas LEFT JOIN productos on registroventas.idProductos = productos.idProductos ?p ORDER BY Fecha DESC", $corte, $corte);
    echo json_encode($outp);
  }

  function morososExceso()
  {
    $outp = $this->db->getAll("SELECT * FROM excesoasistencia");
    echo json_encode($this->formatDeuda($outp));
  }

  function morososActividad()
  {
    $outp = $this->db->getAll("SELECT * FROM deudas");
    echo json_encode($this->formatDeuda($outp));
  }
}
