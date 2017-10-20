<?php
class actividad_Model extends Model {

  public function __construct() {
    parent::__construct();
  }

  public function eliminarElemento($tipo, $idActividades) {
    $this->eliminar("Actividades", $idActividades);
  }


  public function listCals($servicio) {
    $calendarList = $servicio->calendarList->listCalendarList();

    while(true) {
      foreach ($calendarList->getItems() as $calendarListEntry) {
        $datos[] = $calendarListEntry['id'];
      }
      $pageToken = $calendarList->getNextPageToken();
      if ($pageToken) {
        $optParams = array('pageToken' => $pageToken);
        $calendarList = $servicio->calendarList->listCalendarList($optParams);
      } else {
        break;
      }
    }
    return $datos;
  }


  public function traerEventos($data, $servicio, $calendar) {
    $optParams = array(
      'orderBy' => 'startTime',
      'singleEvents' => TRUE,
      'timeMax' => $data['timeMax'],
      'timeMin' => $data['timeMin']
    );
    $results = $servicio->events->listEvents($calendar, $optParams);
    foreach ($results->getItems() as $event) {
      $evento['idEvento'] = $event['recurringEventId'];
      $evento['idEvento'] = ($event['recurringEventId']) ? $event['recurringEventId'] : $event['id'];
      $evento['idActividades'] = $event['description'];
      $evento['Nombre'] = $event['summary'];
      $evento["Fecha"] = substr($event['start']['dateTime'],0,10);
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
    $Clientes = $this->db->getAll("SELECT CONCAT(clientes.`Nombres`,' ',clientes.`Apellidos`) AS name FROM `asistencias` INNER JOIN clientes ON asistencias.idClientes = clientes.idClientes WHERE `idActividades` = ?i AND `Fecha` = ?s", $idActividades, $Fecha);
    $Found = true;
    if (count($Clientes) == 0) {
      $Found = false;
      $Clientes = $this->db->getAll("SELECT `idClientes`, CONCAT(`Nombres`,' ',`Apellidos`) AS name FROM `clientesactivos` WHERE `idClientes` IN (SELECT `idClientes` FROM `clientesactividades` WHERE `idActividades` = ?i)", $idActividades);
      if (count($Clientes) == 0) {
        $Clientes = $this->db->getAll("SELECT `idClientes`, CONCAT(`Nombres`,' ',`Apellidos`) AS name FROM `clientesactivos`");
      }
    }
    echo json_encode([$Clientes, $Found]);
  }

  public function traerInstructores()
  {
    echo json_encode($this->db->getAll("SELECT `idClientes`, CONCAT(`Nombres`,' ',`Apellidos`) AS name FROM `clientesactivos` WHERE `EsInstructor` = 1"));
  }

  public function traerSubactividades($idActividades)
  {
    return $this->db->getCol("SELECT Nombre FROM `subactividades` WHERE `idActividades` = ?i", $idActividades);
  }
  public function traeridCalendario($idActividades)
  {
    return $this->db->getOne("SELECT IFNULL(idCalendario, 'primary') FROM `actividades`  WHERE `idActividades` = ?i", $idActividades);
  }
  public function asignarCalendario($idActividades, $CalendarId)
  {
    $this->db->query("UPDATE `actividades` SET idCalendario = ?s  WHERE `idActividades` = ?i", $CalendarId, $idActividades);
  }

  public function setidEvento($actividad)
  {
    $this->db->query("UPDATE `subactividades` SET idEvento = ?s  WHERE `Nombre` = ?s", $actividad['idEvento'], $actividad['Nombre']);
  }

  public function traerEvento($idActividades, $servicio)
  {
    $event = $servicio->events->get('primary', $idActividades);
    return $this->getFormat($event);
  }


  public function crearCalendario($Nombre, $servicio)
  {
    $calendar = new Google_Service_Calendar_Calendar();
    $calendar->setSummary($Nombre);
    $calendar->setTimeZone('America/Buenos_Aires');
    $createdCalendar = $servicio->calendars->insert($calendar);
    return $createdCalendar->getId();
  }


  public function traerCalendario($CalendarId, $servicio)
  {
    $results = $servicio->events->listEvents($CalendarId);
    if (count($results->getItems()) == 0) {
      return "no papu";
    } else {
      foreach ($results->getItems() as $event) {
        $datos[] = $this->getFormat($event);
      }
    }
    return $datos;
  }

  private function getFormat($event)
  {
    $evento["Nombre"] = $event['summary'];
    $evento["idEvento"] = $event['id'];
    $evento["idActividades"] = $event['description'];
    $evento["Finalizacion"] = substr($event['end']['dateTime'],11,8);
    $evento["Inicio"] = substr($event['start']['dateTime'],11,8);
    $evento["Fecha"] = substr($event['start']['dateTime'],0,10);
    $evento["Recurrencia"] = $event['recurrence'];
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

  public function editarEvento($data, $servicio, $calendar)
  {
    $event = new Google_Service_Calendar_Event($data);
    try {
      $servicio->events->update($calendar, $data['id'], $event);
    } catch (Exception $e) {
      var_dump($data);
    }

  }

  public function asignarProfes($data, $idActividades, $fecha)
  {
    for ($i = 0; $i < count($data); $i++) {
      $this->db->query("INSERT INTO `eventosinstructores` SET `idClientes`= ?i, `idActividades`= ?s, `Fecha`= ?s", $data[$i], $idActividades, $fecha);
    }
  }

  public function asignarAsistencia($data, $idActividades, $fecha, $idEvento)
  {
    for ($i = 0; $i < count($data); $i++) {
      echo $this->db->query("INSERT INTO `asistencias` SET `idClientes`= ?i, `idActividades`= ?s, `Fecha`= ?s, idSubactividades = (SELECT idSubactividades FROM `subactividades` WHERE `idEvento` = ?s)", $data[$i], $idActividades, $fecha, $idEvento);
    }
  }

  public function agregarEvento($data, $servicio, $calendar)
  {
    $event = new Google_Service_Calendar_Event($data);
    try {
      $servicio->events->insert($calendar, $event);
    } catch (Exception $e) {
      var_dump($data);
    }
  }

}
