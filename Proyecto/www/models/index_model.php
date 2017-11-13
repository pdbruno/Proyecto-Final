<?php
class index_Model extends Model {
  public function __construct() {
    parent::__construct();
  }
  function porcentajeAsistencias($mes)
  {
    $act = $this->db->getAll("SELECT `idActividades`, `Nombre` FROM `actividades`");
    for ($i = 0; $i < count($act); $i++) {
      $cosa = $this->db->getAll("SELECT idActividades, CONCAT(clientes.Nombres,' ',clientes.Apellidos) AS Nombres, IFNULL((SELECT COUNT(*) FROM `asistencias` WHERE YEAR(Fecha) = YEAR(CURDATE()) AND MONTH(Fecha) = ?i AND idActividades = ?i AND idClientes = clientesactividades.idClientes) / (SELECT COUNT(*) FROM `asistencias` WHERE YEAR(Fecha) = YEAR(CURDATE()) AND MONTH(Fecha) = ?i AND idActividades = ?i) * 100, 0) AS Porcentaje FROM `clientesactividades` INNER JOIN clientes on clientes.idClientes = clientesactividades.idClientes WHERE idActividades = ?i", $mes, $act[$i]["idActividades"], $mes, $act[$i]["idActividades"], $act[$i]["idActividades"]);
      if(count($cosa) != 0){
        $outp[$act[$i]['Nombre']] = $cosa;
      }
    }
    echo json_encode($outp);
  }
  function graficoSexoActividad($id)
  {
    if (strlen($id) == 11) {
      $res = $this->db->getAll("SELECT sexos.Nombre as Sexo, Actividad, count(0) as Cantidad FROM (SELECT clientes.idSexos, actividades.Nombre as Actividad FROM `clientesactividades` INNER JOIN clientes on clientesactividades.idClientes = clientes.idClientes INNER JOIN actividades on clientesactividades.idActividades = actividades.idActividades WHERE clientesactividades.idActividades = ?i) asd INNER JOIN sexos on asd.idSexos = sexos.idSexos GROUP BY sexos.Nombre", $id);
    }else {
      $res = $this->db->getAll("SELECT sexos.Nombre as Sexo, Actividad, count(0) as Cantidad FROM (SELECT clientes.idSexos, actividades.Nombre as Actividad FROM `asistencias` INNER JOIN clientes on asistencias.idClientes = clientes.idClientes INNER JOIN actividades on asistencias.idActividades = actividades.idActividades WHERE asistencias.idSubactividades = ?i) asd INNER JOIN sexos on asd.idSexos = sexos.idSexos GROUP BY sexos.Nombre", $id);
    }
    $outp[0]['Actividad'] = $res[0]['Actividad'];
    $outp[0]['CantHom'] = $res[0]['Cantidad'];
    $outp[0]['CantMuj'] = $res[1]['Cantidad'];
    echo json_encode($outp);
  }
  function graficoEdadActividad($id)
  {
    if (strlen($id) == 11) {
      $Muj = $this->db->getAll("SELECT TIMESTAMPDIFF(YEAR,clientes.FechaNacimiento,CURDATE()) AS Edad, COUNT(0) AS CantidadMuj FROM `clientesactividades` INNER JOIN clientes on clientesactividades.idClientes = clientes.idClientes WHERE idActividades = ?i AND clientes.idSexos = 1 GROUP BY TIMESTAMPDIFF(YEAR,clientes.FechaNacimiento,CURDATE())", $id);
      $Hom = $this->db->getAll("SELECT TIMESTAMPDIFF(YEAR,clientes.FechaNacimiento,CURDATE()) AS Edad, COUNT(0) AS CantidadHom FROM `clientesactividades` INNER JOIN clientes on clientesactividades.idClientes = clientes.idClientes WHERE idActividades = ?i AND clientes.idSexos = 2 GROUP BY TIMESTAMPDIFF(YEAR,clientes.FechaNacimiento,CURDATE())", $id);
    }else {
      $Muj = $this->db->getAll("SELECT TIMESTAMPDIFF(YEAR,clientes.FechaNacimiento,CURDATE()) AS Edad, COUNT(0) AS CantidadMuj FROM `asistencias` INNER JOIN clientes on asistencias.idClientes = clientes.idClientes WHERE idSubactividades = ?i AND clientes.idSexos = 1 GROUP BY TIMESTAMPDIFF(YEAR,clientes.FechaNacimiento,CURDATE())", $id);
      $Hom = $this->db->getAll("SELECT TIMESTAMPDIFF(YEAR,clientes.FechaNacimiento,CURDATE()) AS Edad, COUNT(0) AS CantidadHom FROM `asistencias` INNER JOIN clientes on asistencias.idClientes = clientes.idClientes WHERE idSubactividades = ?i AND clientes.idSexos = 2 GROUP BY TIMESTAMPDIFF(YEAR,clientes.FechaNacimiento,CURDATE())", $id);
    }
    $outp = array_merge_recursive($Muj,$Hom);
    for ($i=0; $i < count($outp); $i++) {
      $outp[$i]["Edad"] = intval($outp[$i]["Edad"]);
      if (!isset($outp[$i]["CantidadMuj"])) {
        $outp[$i]["CantidadMuj"] = 0;
        $outp[$i]["CantidadHom"] = intval($outp[$i]["CantidadHom"]);
      }
      if (!isset($outp[$i]["CantidadHom"])) {
        $outp[$i]["CantidadHom"] = 0;
        $outp[$i]["CantidadMuj"] = intval($outp[$i]["CantidadMuj"]);
      }
    }
    echo json_encode($outp);
  }
  function morososMatricula()
  {
    $outp = $this->db->getAll("SELECT `idClientes`, CONCAT(`Nombres`,' ',`Apellidos`) AS Nombres FROM `clientesactivos` WHERE YEAR(CURDATE()) - YEAR(`PagoMatricula`) != 0");
    echo json_encode($outp);
  }
  function between($data, $con = "AND")
  {
    if ($data['Fecha1'] == "" && $data['Fecha2'] == "" ) {
      return "";
    }else {
      return $this->db->parse(" $con `Fecha` BETWEEN ?s AND ?s", $data['Fecha1'], $data['Fecha2']);
    }
  }

  function productosVentas($corte = "")
  {
    $outp = $this->db->getAll("SELECT productos.Nombre, COUNT(0) AS Cantidad FROM `registroventas` INNER JOIN productos on registroventas.idProductos = productos.idProductos ?p GROUP BY registroventas.idProductos ORDER BY Cantidad DESC", $corte);
    echo json_encode($outp);
  }

  function graficoExamen($corte)
  {
    $outp = $this->db->getAll("SELECT categorias.Nombre, COUNT(0) AS Cantidad FROM `registroexamenes` INNER JOIN categorias ON registroexamenes.idCategorias = categorias.idCategorias ?p GROUP BY categorias.Nombre ORDER BY registroexamenes.idCategorias ", $corte);
    echo json_encode($outp);
  }

  function productosGanancias($corte = "")
  {
    $outp = $this->db->getAll("SELECT productos.Nombre, SUM(Monto) AS Monto FROM `registroventas` INNER JOIN productos on registroventas.idProductos = productos.idProductos ?p GROUP BY registroventas.idProductos ORDER BY SUM(Monto) DESC", $corte);
    echo json_encode($outp);
  }

  function morososExceso($mes)
  {
    $outp = $this->db->getAll("SELECT * FROM excesoasistencia WHERE MONTH(Fecha) = ?i", $mes);
    echo json_encode($this->formatDeuda($outp));
  }

  public function descartarexceso()
  {
    $this->model->descartarexceso($_POST['data']);
  }

  function traerFondos()
  {
    $outp = $this->db->getAll("SELECT * FROM fondos");
    return $outp;
  }
  function morososActividad()
  {
    $outp = $this->db->getAll("SELECT * FROM deudas");
    echo json_encode($this->formatDeuda($outp));
  }
  function finanzasBalance($idFondos, $corte = "")
  {
    $outp = $this->db->getAll("SELECT Nombre, Monto, Fecha, CONVERT(Tipo USING utf8) AS Tipo FROM `egresosbrutos` WHERE idFondos = ?i ?p UNION SELECT Nombre, Monto, Fecha, CONVERT(Tipo USING utf8) AS Tipo FROM `ingresosbrutos` WHERE idFondos = ?i ?p ORDER BY Fecha DESC", $idFondos, $corte, $idFondos, $corte);
    return $outp;
  }
  function finanzasEgresos($idFondos, $corte = "")
  {
    $outp = $this->db->getAll("SELECT Nombre, Monto, Fecha, Tipo FROM `egresosbrutos` WHERE idFondos = ?i ?p", $idFondos, $corte);
    return $outp;
  }
  function finanzasEgresosTotal($idFondos, $corte = "")
  {
    $outp = $this->db->getInd('Tipo',"SELECT Tipo, SUM(Monto) as Total FROM `egresosbrutos` WHERE idFondos = ?i ?p GROUP BY Tipo", $idFondos, $corte);
    return $outp;
  }
  function finanzasIngresosTotal($idFondos, $corte = "")
  {
    $outp = $this->db->getInd('Tipo',"SELECT Tipo, SUM(Monto) as Total FROM `ingresosbrutos` WHERE idFondos = ?i ?p GROUP BY Tipo", $idFondos, $corte);
    return $outp;
  }
  function finanzasIngresos($idFondos, $corte = "")
  {
    $outp = $this->db->getAll("SELECT Nombre, Monto, Fecha, Tipo FROM `ingresosbrutos` WHERE idFondos = ?i ?p", $idFondos, $corte);
    return $outp;
  }
}
