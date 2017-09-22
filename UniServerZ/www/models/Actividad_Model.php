<?php
class actividad_Model extends Model {

  public function __construct() {
    parent::__construct();
  }

  public function eliminarElemento($tipo, $idActividades) {
    $this->eliminar("Actividades", $idActividades);
  }
  public function traerEventos($data, $servicio, $calendar = 'primary') {
    $optParams = array(
      'orderBy' => 'startTime',
      'singleEvents' => TRUE,
      'timeMax' => $data['timeMax'],
      'timeMin' => $data['timeMin']
    );
    $results = $servicio->events->listEvents($calendar, $optParams);
    foreach ($results->getItems() as $event) {
      $evento['idEvento'] = $event['recurringEventId'];
      $evento['idActividades'] = $event['extendedProperties']['private']['idActividades'];
      $evento['Nombre'] = $event->getSummary();
      $evento["Fecha"] = substr($event->getStart()->dateTime,0,10);
      $datos[] = $evento;
    }
    return $datos;
  }

  public function asignarSubactividades($subactividades, $idActividades) {
    $this->db->query("DELETE FROM subactividades WHERE idActividades = ?i", $idActividades);
    $modalidades = array_unique($subactividades);
    for ($i = 0; $i < count($subactividades); $i++) {
      $this->db->query("INSERT INTO subactividades SET `idActividades`= ?i, `Nombre`= ?s", $idActividades, $subactividades[$i]);
    }
  }
  public function traerElemento($tipo, $idActividades) {
    $sql = "SELECT actividades.*, fondos.Nombre as idFondos FROM actividades
    LEFT JOIN fondos ON actividades.idFondos = fondos.idFondos WHERE idActividades=?i";
    $outp[] = $this->db->getAll($sql, $idActividades);
    $sql = "SELECT idSubactividades, Nombre from subactividades WHERE idActividades = ?i";
    $res = $this->db->getAll($sql, $idActividades);
    $outp[] = $res;
    echo json_encode($outp);
  }
  public function traerAnotados($idActividades, $Fecha)
  {
    $idActividades = substr($idActividades,0,11);
    $outp = $this->db->getAll("SELECT CONCAT(clientes.`Nombres`,' ',clientes.`Apellidos`) AS name FROM `asistencias` INNER JOIN clientes ON asistencias.idClientes = clientes.idClientes WHERE `idActividades` = ?i AND `Fecha` = ?s", $idActividades, $Fecha);
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

  public function traerSubactividades($idActividades)
  {
    return $this->db->getCol("SELECT Nombre FROM `subactividades` WHERE `idActividades` = ?i", $idActividades);
  }

  public function traerEvento($idActividades, $servicio)
  {
    $event = $servicio->events->get('primary', $idActividades);
    return $this->getFormat($event, $idActividades);
  }


  public function getCalendarId($Nombre, $servicio)
  {
    $calendarList = $servicio->calendarList->listCalendarList();
    while(true) {
      foreach ($calendarList->getItems() as $calendarListEntry) {
        if ($Nombre == $calendarListEntry->getSummary()) {
          return $calendarListEntry->getId();
        }
      }
      $pageToken = $calendarList->getNextPageToken();
      if ($pageToken) {
        $optParams = array('pageToken' => $pageToken);
        $calendarList = $service->calendarList->listCalendarList($optParams);
      } else {
        return;
      }
    }
  }



  public function crearCalendario($Nombre, $servicio)
  {
    $calendar = new Google_Service_Calendar_Calendar();
    $calendar->setSummary($Nombre);
    $calendar->setTimeZone('America/Buenos_Aires');
    $createdCalendar = $servicio->calendars->insert($calendar);
    return $createdCalendar->getId();
  }


  public function traerCalendario($idActividades, $CalendarId, $servicio)
  {
    $results = $servicio->events->listEvents($CalendarId);
    if (count($results->getItems()) == 0) {
      return "no papu";
    } else {
      foreach ($results->getItems() as $event) {
        $datos[] = $this->getFormat($event, $idActividades);
      }
    }
    return $datos;
  }

  private function getFormat($event, $idActividades)
  {
    $evento["Nombre"] = $event->getSummary();
    $evento["idEvento"] = $event['id'];
    $evento["idActividades"] = $idActividades;
    $evento["Finalizacion"] = substr($event->getEnd()->dateTime,11,8);
    $evento["Inicio"] = substr($event->getStart()->dateTime,11,8);
    $evento["Fecha"] = substr($event->getStart()->dateTime,0,10);
    $evento["Recurrencia"] = $event->getRecurrence();
    return $evento;
  }

  public function setFormat($data)
  {
    $evento = array(
      'id' => $data["idEvento"],
      'summary' => $data["Nombre"],
      'description' => $data["idActividades"],
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

  public function editarEvento($data, $servicio, $calendar = 'primary')
  {
    $event = new Google_Service_Calendar_Event($data);
    try {
      $servicio->events->update($calendar, $data['id'], $event);
    } catch (Exception $e) {
      var_dump($e);
    }

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

  public function agregarEvento($data, $servicio, $calendar)
  {
    $event = new Google_Service_Calendar_Event($data);
    try {
      $servicio->events->insert($calendar, $event);
    } catch (Exception $e) {
      var_dump($calendar);
      var_dump($data);
    }
  }

}
