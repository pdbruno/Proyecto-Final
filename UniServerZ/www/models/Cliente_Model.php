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

  public function listadodropdowns() {
    $sql[0] = "SELECT idLocalidades as id, Nombre FROM localidades;";
    $sql[1] = "SELECT idGrupoFactorSanguineo as id, Nombre FROM grupofactorsanguineo;";
    $sql[2] = "SELECT idCategorias as id, Nombre FROM categorias;";
    $sql[3] = "SELECT idSedes as id, Nombre FROM sedes;";
    $res[] = $this->repetitivaQuery($sql);
    $kk[0] = "SELECT idActividades as id, Nombre FROM actividades;";
    $kk[1] = "SELECT idModalidades as id, Nombre FROM modalidades;";
    $res[] = $this->repetitivaQuery($kk);
    echo json_encode($res);
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
    $res = $this->db->getAll($sql, $idClientes);
    $outp[] = $res;
    echo json_encode($outp);
  }
  public function traerElemento($tipo, $idClientes) {
    $sql = "SELECT clientes.idClientes,clientes.Nombres,clientes.Apellidos,clientes.FechaNacimiento,clientes.DNI,clientes.Domicilio, localidades.Nombre as idLocalidades,clientes.CPostal,clientes.TelCel,clientes.Ocupacion,clientes.Email,clientes.Facebook,clientes.AutorizaWeb,clientes.AptoMedico,clientes.CoberturaMedica,clientes.NumSocioMed,clientes.TelEmergencias, grupofactorsanguineo.Nombre as idGrupoFactorSanguineo,clientes.Alergia,clientes.Patologia,clientes.IntQuirurgica,clientes.Lesion,clientes.Medicacion,clientes.Observaciones,clientes.PadMadTut,clientes.TelPadMadTut,clientes.CelPadMadTut,clientes.EmailPadMadTut,clientes.SeVaSolo,clientes.Retirar1NomAp,clientes.Retirar1DNI,clientes.Retirar2NomAp,clientes.Retirar2DNI,clientes.Retirar3NomAp,clientes.Retirar3DNI,clientes.Activo,clientes.EsInstructor,
    categorias.Nombre as idCategorias, sedes.Nombre as idSedes
    FROM clientes
    LEFT JOIN categorias ON clientes.idCategorias = categorias.idCategorias
    LEFT JOIN grupofactorsanguineo ON clientes.idGrupoFactorSanguineo = grupofactorsanguineo.idGrupoFactorSanguineo
    LEFT JOIN localidades ON clientes.idLocalidades = localidades.idLocalidades
    LEFT JOIN sedes ON clientes.idSedes = sedes.idSedes
    WHERE idClientes=?i";
    $outp[] = $this->db->getAll($sql, $idClientes);
    $sql = "SELECT actividades.Nombre as NombreAct, actividades.idActividades as idActividades, actividades.XClase, actividades.XMes, actividades.XSemestre, modalidades.Nombre as NombreMod, modalidades.idModalidades as idModalidades FROM `clientesactividades`
    LEFT JOIN actividades ON clientesactividades.idActividades = actividades.idActividades
    LEFT JOIN modalidades ON clientesactividades.idModalidades = modalidades.idModalidades
    WHERE `idClientes` = ?i";
    $res = $this->db->getAll($sql, $idClientes);
    $outp[] = $res;
    echo json_encode($outp);
  }
}
