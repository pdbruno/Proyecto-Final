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
        $evento['idEvento'] =  $event->getId();
        $evento['Nombre'] = $event->getSummary();
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

  public function traerAnotados($idActividades)
  {
    $idActividades = substr($idActividades,0,11);
    $UsersFinal = $this->db->getAll("SELECT `idClientes`, CONCAT(`Nombres`,' ',`Apellidos`) AS name FROM `clientes` WHERE `Activo` = 1 AND `idClientes` IN (SELECT `idClientes` FROM `clientesactividades` WHERE `idActividades` = ?i)", $idActividades);
    return json_encode($UsersFinal) ;
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
    var_dump($data);
    $event = new Google_Service_Calendar_Event($data);
    $updatedEvent = $servicio->events->update('primary', $id, $event);
    return $updatedEvent->getUpdated();
  }

  public function asignarAsistencia($data, $id)
  {
    // $evento = array(
    //   'extendedProperties' => array(
    //     'private' => array(
    //       'asistencia' => json_encode($data)
    //     )
    //   )
    // );
    // $event = new Google_Service_Calendar_Event($evento);
    // return $servicio->events->patch('primary', $id, $event);
    for ($i = 0; $i < count($data); $i++) {
      $this->db->query("INSERT INTO `asistencias` SET `idClientes`= ?i, `idEvento`= ?s", $data[$i], $id);
    }
  }

  public function agregarEvento($data, $servicio)
  {
    $event = new Google_Service_Calendar_Event($data);
    $event = $servicio->events->insert('primary', $event);
  }

  public function nuevoObjeto($data) {
    $obj['idActividades'] = $data[0];
    $obj['Nombre'] = $data[1];
    $obj['XClase'] = $data[2];
    $obj['XMes'] = $data[3];
    $obj['XSemestre'] = $data[4];
    return $obj;
  }

}
