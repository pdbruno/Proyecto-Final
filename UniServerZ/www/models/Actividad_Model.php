<?php
class actividad_Model extends Model {

  public function __construct() {
    parent::__construct();
  }

  public function eliminarElemento($tipo, $idActividades) {
    $this->db->query("DELETE FROM actividadesaranceles WHERE idActividades = ?i", $idActividades);
    $this->eliminar("Actividades", $idActividades);
  }
  public function traerEventos($data, $servicio) {
    $optParams = array(
      'orderBy' => 'startTime',
      'singleEvents' => TRUE,
      'timeMax' => $data['timeMax'],
      'timeMin' => $data['timeMin']
    );
    $results = $servicio->events->listEvents('primary', $optParams);
    if (count($results->getItems()) == 0) {
      $datos = "no papu";
    } else {
      foreach ($results->getItems() as $event) {
        $evento['idActividades'] = substr($event['id'], 0, 11);
        $evento['Nombre'] = $event->getSummary();
        $evento["Fecha"] = substr($event->getStart()->dateTime,0,10);
        $datos[] = $evento;
      }
      $evento = [];
    }
    return json_encode($datos);
  }

  public function asignarModalidades($modalidades, $idActividades) {
    $this->db->query("DELETE FROM actividadesaranceles WHERE idActividades = ?i", $idActividades);
    $modalidades = array_unique($modalidades);
    for ($i = 0; $i < count($modalidades); $i++) {
      $this->db->query("INSERT INTO actividadesaranceles SET `idActividades`= ?i, `idModalidades`= ?i", $idActividades, $modalidades[$i]);
    }
  }
  public function traerElemento($tipo, $idActividades) {
    $sql = "SELECT actividades.*, fondos.Nombre as idFondos FROM actividades
    LEFT JOIN fondos ON fondos.idFondos = actividades.idFondos WHERE idActividades=?i";
    $outp[] = $this->db->getAll($sql, $idActividades);
    $sql = "SELECT modalidades.Nombre as NombreMod, actividadesaranceles.idModalidades as idModalidades FROM `actividadesaranceles`
    LEFT JOIN modalidades ON actividadesaranceles.idModalidades = modalidades.idModalidades
    WHERE `idActividades` = ?i";
    $res = $this->db->getAll($sql, $idActividades);
    $outp[] = $res;
    echo json_encode($outp);
  }
  public function traerAnotados($idActividades, $Fecha)
  {
    $idActividades = substr($idActividades,0,11);
    $outp = $this->db->getAll("SELECT CONCAT(clientes.`Nombres`,' ',clientes.`Apellidos`) AS name FROM `asistencias` LEFT JOIN clientes ON clientes.idClientes = asistencias.idClientes WHERE `idActividades` = ?i AND `Fecha` = ?s", $idActividades, $Fecha);
    if (count($outp) == 0) {
      $UsersFinal[] = $this->db->getAll("SELECT `idClientes`, CONCAT(`Nombres`,' ',`Apellidos`) AS name FROM `clientesactivos` WHERE `idClientes` IN (SELECT `idClientes` FROM `clientesactividades` WHERE `idActividades` = ?i)", $idActividades);
      if (count($UsersFinal) == 0) {
        $UsersFinal[0] = $this->db->getAll("SELECT `idClientes`, CONCAT(`Nombres`,' ',`Apellidos`) AS name FROM `clientesactivos`");
      }
      $UsersFinal[] = $this->db->getAll("SELECT `idClientes`, CONCAT(`Nombres`,' ',`Apellidos`) AS name FROM `clientesactivos` WHERE `EsInstructor` = 1");
    }else {
      $UsersFinal[] = $outp;
      $UsersFinal[] = "nana";
    }
    return json_encode($UsersFinal);
  }

  public function mostrar($idActividades, $servicio)
  {
    $event = $servicio->events->get('primary', $idActividades);
    $datos["Nombre"] = $event->getSummary();
    $datos["idActividades"] = $idActividades;
    $datos["Finalizacion"] = substr($event->getEnd()->dateTime,11,8);
    $datos["Inicio"] = substr($event->getStart()->dateTime,11,8);
    $datos["Fecha"] = substr($event->getStart()->dateTime,0,10);
    $datos["Recurrencia"] = $event->getRecurrence();
    return json_encode($datos);
  }

  public function format($data)
  {
    $evento = array(
      'id' => $data["idActividades"],
      'summary' => $data["Nombre"],
      'start' => array(
        'dateTime' => $data["Inicio"],
        'timeZone' => 'America/Buenos_Aires',
      ),
      'end' => array(
        'dateTime' => $data["Finalizacion"],
        'timeZone' => 'America/Buenos_Aires',
      )
    );
    if ($data["Recurrencia"]!="no") {
      $evento['recurrence'] = array($data["Recurrencia"]);
    }
    return $evento;
  }

  public function editarEvento($data, $id, $servicio)
  {
    $event = new Google_Service_Calendar_Event($data);
    echo $updatedEvent = $servicio->events->update('primary', $id, $event);
    echo $updatedEvent->getUpdated();
  }

  public function asignarProfes($data, $idActividades, $fecha)
  {
    for ($i = 0; $i < count($data); $i++) {
      $this->db->query("INSERT INTO `eventosinstructores` SET `idClientes`= ?i, `idActividades`= ?s, `Fecha`= ?s", $data[$i], $idActividades, $fecha);
    }
  }

  public function asignarAsistencia($data, $idActividades, $fecha)
  {
    for ($i = 0; $i < count($data); $i++) {
      echo $this->db->query("INSERT INTO `asistencias` SET `idClientes`= ?i, `idActividades`= ?s, `Fecha`= ?s", $data[$i], $idActividades, $fecha);
    }
  }

  public function agregarEvento($data, $servicio)
  {
    $event = new Google_Service_Calendar_Event($data);
    $event = $servicio->events->insert('primary', $event);
  }

}
