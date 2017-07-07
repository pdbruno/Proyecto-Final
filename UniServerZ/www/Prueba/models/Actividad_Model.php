<?php
class actividad_Model extends Model {

  public function __construct() {
    parent::__construct();
  }
  private $calendar;
  public function setServicio($servicio)
  {
    $this->calendar = clone $servicio;

  }
  public function traerEventos($data) {
    $optParams = array(
      'orderBy' => 'startTime',
      'singleEvents' => TRUE,
      'timeMax' => $data['timeMax'],
      'timeMin' => $data['timeMin']
    );
    $results = $this->calendar->events->listEvents('primary', $optParams);
    if (count($results->getItems()) == 0) {
      $datos = "No hay eventos para ese día";
    } else {
      foreach ($results->getItems() as $event) {
        $evento['idEvento'] =  $event->getId();
        $evento['Nombre'] = $event->getSummary();
      }
      $datos[] = $evento;
      $evento = [];
    }
    return $datos;
  }

  public function traerAnotados($datos)
  {




    switch ($datos[0]) {
      case "Taekwon-Do":
      //hacer otro switch
      break;

      case "Funcional":
      //hacer otro switch
      break;

      default:
    }
  }

  public function mostrar($idActividades)
  {
    var_dump($this->calendar);
    $event = $this->calendar->events->get('primary', $idActividades);
    $datos["Nombre"] = $event->getSummary();
    $datos["idActividades"] = $idActividades;
    $datos["Finalizacion"] = $event->getEnd();
    $datos["Inicio"] = $event->getStart();
    $datos["Recurrencia"] = $event->getRecurrence();
    return $datos;
  }
  public function format($data)
  {
    $evento = array(
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
      $evento['recurrence'] = $data["Recurrencia"];
    }
    return $evento;
  }
  public function editarEvento($data)
  {
    $event = new Google_Service_Calendar_Event($data);
    $updatedEvent = $this->calendar->events->update('primary', $data["idActividades"], $event);
  }
  public function agregarEvento($data)
  {
    $event = new Google_Service_Calendar_Event($data);
    $event = $this->calendar->events->insert('primary', $event);
  }
  public function traerActividades() {
    $sql = "SELECT actividades.Nombre as actNombre, niveles.Nombre as nivNombre FROM actividadesmodalidadesniveles LEFT JOIN actividades ON actividadesmodalidadesniveles.idActividades = actividades.idActividades LEFT JOIN niveles ON actividadesmodalidadesniveles.idNiveles = niveles.idNiveles WHERE actividades.idActividades != 3 GROUP BY `nivNombre` ";
    $outp = $this->db->getAll($sql);
    echo json_encode($outp);
  }

}
