<?php

//namespace Models;

class cliente_Model extends Model {

  public function nuevoObjeto($data) {
    $obj['idClientes'] = $data[0];
    $obj['Nombres'] = $data[1];
    $obj['Apellidos'] = $data[2];
    $obj['FechaNacimiento'] = $data[3];
    $obj['DNI'] = $data[4];
    $obj['Domicilio'] = $data[5];
    $obj['IdLocalidades'] = $data[6];
    $obj['CPostal'] = $data[7];
    $obj['TelCel'] = $data[8];
    $obj['Ocupacion'] = $data[9];
    $obj['Email'] = $data[10];
    $obj['Facebook'] = $data[11];
    $obj['AutorizaWeb'] = $data[12];
    $obj['AptoMedico'] = $data[13];
    $obj['CoberturaMedica'] = $data[14];
    $obj['NumSocioMed'] = $data[15];
    $obj['TelEmergencias'] = $data[16];
    $obj['IdGrupoFactorSanguineo'] = $data[17];
    $obj['Alergia'] = $data[18];
    $obj['Patologia'] = $data[19];
    $obj['IntQuirurgica'] = $data[20];
    $obj['Lesion'] = $data[21];
    $obj['Medicacion'] = $data[22];
    $obj['Observaciones'] = $data[23];
    $obj['PadMadTut'] = $data[24];
    $obj['TelPadMadTut'] = $data[25];
    $obj['CelPadMadTut'] = $data[26];
    $obj['EmailPadMadTut'] = $data[27];
    $obj['SeVaSolo'] = $data[28];
    $obj['Retirar1NomAp'] = $data[29];
    $obj['Retirar1DNI'] = $data[30];
    $obj['Retirar2NomAp'] = $data[31];
    $obj['Retirar2DNI'] = $data[32];
    $obj['Retirar3NomAp'] = $data[33];
    $obj['Retirar3DNI'] = $data[34];
    $obj['Activo'] = $data[35];
    $obj['EsInstructor'] = $data[36];
    $obj['IdCategorias'] = $data[37];
    $obj['IdSedes'] = $data[38];
    return $obj;
  }

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
    $sql = "SELECT clientes.idClientes,clientes.Nombres,clientes.Apellidos,clientes.FechaNacimiento,clientes.DNI,clientes.Domicilio, localidades.Nombre as locNombre,clientes.CPostal,clientes.TelCel,clientes.Ocupacion,clientes.Email,clientes.Facebook,clientes.AutorizaWeb,clientes.AptoMedico,clientes.CoberturaMedica,clientes.NumSocioMed,clientes.TelEmergencias, grupofactorsanguineo.Nombre as sangNombre,clientes.Alergia,clientes.Patologia,clientes.IntQuirurgica,clientes.Lesion,clientes.Medicacion,clientes.Observaciones,clientes.PadMadTut,clientes.TelPadMadTut,clientes.CelPadMadTut,clientes.EmailPadMadTut,clientes.SeVaSolo,clientes.Retirar1NomAp,clientes.Retirar1DNI,clientes.Retirar2NomAp,clientes.Retirar2DNI,clientes.Retirar3NomAp,clientes.Retirar3DNI,clientes.Activo,clientes.EsInstructor,
    categorias.Nombre as catNombre, sedes.Nombre as sedNombre
    FROM clientes
    LEFT JOIN categorias ON clientes.idCategorias = categorias.idCategorias
    LEFT JOIN grupofactorsanguineo ON clientes.IdGrupoFactorSanguineo = grupofactorsanguineo.idGrupoFactorSanguineo
    LEFT JOIN localidades ON clientes.IdLocalidades = localidades.idLocalidades
    LEFT JOIN sedes ON clientes.IdSedes = sedes.idSedes
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
