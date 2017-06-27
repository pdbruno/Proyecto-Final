<?php
class actividad_Model extends Model {

  public function __construct() {
    parent::__construct();
  }
  public $calendar;
  public function setServicio($servicio)
  {
    $this->calendar = $servicio;
  }
  public function mostrar($idActividades)
  {
    $event = $this->calendar->events->get('primary', $idActividades);
    return $event->getSummary();
    //var_dump($results);
  }
  public function nuevoEvento($service, $data)
  {
    $event = new Google_Service_Calendar_Event(array(
      'summary' => $data["titulo"],
      'description' => "",
      'start' => array(
        'dateTime' => $data["inicio"], //'2015-05-28T09:00:00-07:00'
        'timeZone' => 'America/Buenos_Aires',
      ),
      'end' => array(
        'dateTime' => $data["fin"], //'2015-05-28T09:00:00-07:00'
        'timeZone' => 'America/Buenos_Aires',
      ),
      'recurrence' => array(
        'RRULE:FREQ=DAILY;COUNT=2'
      ),
      'attendees' => array(
        array('email' => 'lpage@example.com'),
        array('email' => 'sbrin@example.com'),
      ),
      'reminders' => array(
        'useDefault' => FALSE,
        'overrides' => array(
          array('method' => 'email', 'minutes' => 24 * 60),
          array('method' => 'popup', 'minutes' => 10),
        ),
      ),
    ));
    $calendarId = 'primary';
    $event = $service->events->insert($calendarId, $event);

  }
  public function traerActividades() {
    $sql = "SELECT actividades.Nombre as actNombre, niveles.Nombre as nivNombre FROM actividadesmodalidadesniveles LEFT JOIN actividades ON actividadesmodalidadesniveles.idActividades = actividades.idActividades LEFT JOIN niveles ON actividadesmodalidadesniveles.idNiveles = niveles.idNiveles WHERE actividades.idActividades != 3 GROUP BY `nivNombre` ";
    $outp = $this->db->getAll($sql);
    echo json_encode($outp);
  }

}
