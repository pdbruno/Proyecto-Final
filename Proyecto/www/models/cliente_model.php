<?php


class cliente_Model extends Model {

  public function __construct() {
    parent::__construct();
  }

  public function listadoInstructores() {
    echo json_encode($this->db->getAll("SELECT `idClientes` as id, CONCAT(`Nombres`,' ',`Apellidos`) AS Nombre, idCategorias FROM `clientesactivos` WHERE `EsInstructor` = 1"));
  }

  public function posponerExamen($idClientes) {
    $outp = $this->db->getOne("SELECT SemestresRestraso FROM clientes WHERE idClientes = ?i", $idClientes);
    if ($outp) {
      $this->db->query("UPDATE clientes SET SemestresRestraso = ?i WHERE idClientes = ?i", $outp + 1, $idClientes);
    }else {
      $this->db->query("UPDATE clientes SET SemestresRestraso = ?i WHERE idClientes = ?i", 1, $idClientes);
    }
  }

  public function listadoPlanillitaEsteban() {
    echo json_encode($this->db->getAll("SELECT
      idClientes,
      CONCAT(Nombres, ' ', Apellidos) AS Nombre,
      (SELECT MAX(Fecha) FROM registroexamenes WHERE registroexamenes.idClientes = clientesactivos.idClientes) AS UltimoExamen ,
      DATE_ADD((SELECT MAX(Fecha) FROM registroexamenes WHERE registroexamenes.idClientes = clientesactivos.idClientes), INTERVAL IF(SemestresRestraso IS NULL, (idCategorias - 9) * 12, (idCategorias - 9) * 12 + SemestresRestraso * 6) MONTH) AS ProximoExamen
      FROM `clientesactivos` WHERE idCategorias > 9 "));
  }

  public function cantidadBloques($idClientes, $mes) {
    echo $this->db->getOne("SELECT Count(*) FROM `eventosinstructores` WHERE idClientes = ?i AND MONTH(Fecha) = ?i", $idClientes, $mes);
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
    $datos = $this->model->eliminar('Clientes',$idClientes);
  }

  public function updateCategoria($data) {
    $this->db->query("UPDATE clientes SET idCategorias = ?i, SemestresRestraso  = NULL WHERE idClientes = ?i", $data['idCategorias'], $data['idClientes']);
  }

  public function asignarActividades($actividades, $idClientes) {


    if ($idClientes == "") {
      $idClientes = $this->db->insertId();
    }

    $this->db->query("DELETE FROM clientesactividades WHERE idClientes = ?i", $idClientes);
    $actividades = $this->unique_multidim_array($actividades, "idActividades");
    for ($i = 0; $i < count($actividades); $i++) {
      if ($actividades[$i]['idModalidades'] == "") {
        $actividades[$i]['idModalidades'] = null;
      }
      $this->db->query("INSERT INTO clientesactividades SET idActividades = ?i , idModosDePago = ?i , idModalidades = ?i, idClientes = ?i", $actividades[$i]['idActividades'],$actividades[$i]['idModosDePago'],$actividades[$i]['idModalidades'], $idClientes);
      $outp = $this->db->getAll("SELECT * FROM actividadesaranceles WHERE idActividades = ?i AND idModosDePago = ?i AND idModalidades = ?i", $actividades[$i]['idActividades'],$actividades[$i]['idModosDePago'],$actividades[$i]['idModalidades']);
      if (count($outp) == 0) {
        $this->db->query("INSERT INTO actividadesaranceles SET idActividades = ?i , idModosDePago = ?i , idModalidades = ?i", $actividades[$i]['idActividades'],$actividades[$i]['idModosDePago'],$actividades[$i]['idModalidades']);
      }
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
    $sql = "SELECT actividades.Nombre as NombreAct, actividades.idActividades as idActividades, actividades.XSemestre, modalidades.Nombre as NombreMod, modalidades.idModalidades as idModalidades, modosdepago.Nombre as NombrePag, modosdepago.idModosDePago as idModosDePago FROM `clientesactividades`
    INNER JOIN actividades ON clientesactividades.idActividades = actividades.idActividades
    INNER JOIN modosdepago ON clientesactividades.idModosDePago = modosdepago.idModosDePago
    LEFT JOIN modalidades ON clientesactividades.idModalidades = modalidades.idModalidades
    WHERE `idClientes` = ?i";
    $res[] = $this->db->getAll($sql, $idClientes);
    $res[] = $this->formatDeuda($this->db->getAll("SELECT * FROM `deudas` WHERE idClientes = ?i", $idClientes));
    return $res;
  }
  public function traerElemento($tipo, $idClientes) {
    $sql = "SELECT clientes.* , localidades.Nombre as idLocalidades, grupofactorsanguineo.Nombre as idGrupoFactorSanguineo,
    categorias.Nombre as idCategorias, sedes.Nombre as idSedes, sexos.Nombre as idSexos
    FROM clientes
    INNER JOIN sexos ON clientes.idSexos = sexos.idSexos
    LEFT JOIN categorias ON clientes.idCategorias = categorias.idCategorias
    LEFT JOIN grupofactorsanguineo ON clientes.idGrupoFactorSanguineo = grupofactorsanguineo.idGrupoFactorSanguineo
    LEFT JOIN localidades ON clientes.idLocalidades = localidades.idLocalidades
    INNER JOIN sedes ON clientes.idSedes = sedes.idSedes
    WHERE idClientes=?i";
    $outp[] = $this->db->getAll($sql, $idClientes);
    $outp[] = $this->actCliente($idClientes);
    echo json_encode($outp);
  }
}
