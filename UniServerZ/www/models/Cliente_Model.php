<?php

//namespace Models;

class cliente_Model extends Model {

  public function __construct() {
    parent::__construct();
  }

  public function listado($tipo) {
    $sql = "SELECT idClientes, Nombres, Apellidos FROM clientes";
    $outp = $this->db->getAll($sql);
    echo json_encode($outp);
  }

  public function repetitivaQuery($sql) {
    for ($index = 0; $index < count($sql); $index++) {
      $outp = $this->db->getAll($sql[$index]);
      $todo[] = $outp;
    }
    return $todo;
  }

  public function eliminarElemento($tipo, $idClientes) {
    $this->model->db->query("DELETE FROM clientesactividades WHERE idClientes = ?i", $idClientes);
    $datos = $this->model->eliminar('Clientes',$idClientes);
  }

  public function asignarActividades($actividades, $idClientes) {
    $this->db->query("DELETE FROM clientesactividades WHERE idClientes = ?i", $idClientes);
    $actividades = $this->unique_multidim_array($actividades, "idActividades");
    for ($i = 0; $i < count($actividades); $i++) {
      $this->db->query("INSERT INTO clientesactividades SET `idClientes`= ?i, `idActividades`= ?i, `idModalidades` = ?s", $idClientes, $actividades[$i]["idActividades"], $actividades[$i]["idModalidades"]);
    }
  }
  public function unique_multidim_array($array, $key) {
    $temp_array = array();
    $i = 0;
    $key_array = array();

    foreach($array as $val) {
      if (!in_array($val[$key], $key_array)) {
        $key_array[$i] = $val[$key];
        $temp_array[$i] = $val;
      }
      $i++;
    }
    return $temp_array;
  }
  public function actCliente($idClientes) {
    $sql = "SELECT actividades.Nombre as NombreAct, actividades.idActividades as idActividades, actividades.XClase, actividades.XMes, actividades.XSemestre, modalidades.Nombre as NombreMod, modalidades.idModalidades as idModalidades FROM `clientesactividades`
    LEFT JOIN actividades ON clientesactividades.idActividades = actividades.idActividades
    LEFT JOIN modalidades ON clientesactividades.idModalidades = modalidades.idModalidades
    WHERE `idClientes` = ?i";
    $res[] = $this->db->getAll($sql, $idClientes);
    $res[] = $this->formatDeuda($this->db->getAll("SELECT * FROM `deudas` WHERE idClientes = ?i", $idClientes));
    return $res;
  }
  public function traerElemento($tipo, $idClientes) {
    $sql = "SELECT clientes.* , localidades.Nombre as idLocalidades, grupofactorsanguineo.Nombre as idGrupoFactorSanguineo,
    categorias.Nombre as idCategorias, sedes.Nombre as idSedes
    FROM clientes
    LEFT JOIN categorias ON clientes.idCategorias = categorias.idCategorias
    LEFT JOIN grupofactorsanguineo ON clientes.idGrupoFactorSanguineo = grupofactorsanguineo.idGrupoFactorSanguineo
    LEFT JOIN localidades ON clientes.idLocalidades = localidades.idLocalidades
    LEFT JOIN sedes ON clientes.idSedes = sedes.idSedes
    WHERE idClientes=?i";
    $outp[] = $this->db->getAll($sql, $idClientes);
    $outp[] = $this->actCliente($idClientes);
    echo json_encode($outp);
  }
}
