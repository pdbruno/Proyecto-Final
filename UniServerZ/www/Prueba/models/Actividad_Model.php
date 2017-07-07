<?php
class actividad_Model extends Model {

  public function __construct() {
    parent::__construct();
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
      $datos = "No hay eventos para ese día";
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

  public function traerAnotados($datos, $servicio)
  {
    switch ($datos[0]) {
      case "Taekwon-Do":
      switch ($datos[1]) {
        case 'Inicial':
        $sql = " `idActividadesModalidadesNiveles` = 1 OR `idActividadesModalidadesNiveles` = 5";
        break;
        case 'Infantiles A':
        $sql = " `idActividadesModalidadesNiveles` = 2 OR `idActividadesModalidadesNiveles` = 6";
        break;
        case 'Infantiles B':
        $sql = " `idActividadesModalidadesNiveles` = 3 OR `idActividadesModalidadesNiveles` = 7";
        break;
        case 'Juveniles y Adultos':
        $sql = " `idActividadesModalidadesNiveles` = 4 OR `idActividadesModalidadesNiveles` = 8";
        break;
        default:
        $sql= " `idActividadesModalidadesNiveles` BETWEEN 1 AND 8";
      }
      break;

      case "Funcional":
      switch ($datos[1]) {
        case 'Mañana':
        $sql = " `idActividadesModalidadesNiveles` = 9";
        break;
        case 'Tarde':
        $sql = " `idActividadesModalidadesNiveles` = 13";
        break;
        case 'Noche':
        $sql = " `idActividadesModalidadesNiveles` = 14";
      }
      break;
      default:
      $sql = "";
    }
    $UsersCond = "";
    if ($sql != "") {
      $UsersCond = $this->db->parse(" WHERE `idClientes` IN (SELECT `idClientes` FROM `clientesactividades` WHERE ?p)", $sql);
    }
    $UsersFinal = $this->db->getAll("SELECT `idClientes`, CONCAT(`Nombres`,' ',`Apellidos`) AS name FROM `clientes` ?p", $UsersCond);
    return json_encode($UsersFinal) ;
  }

  public function mostrar($idActividades, $servicio)
  {
    $event = $servicio->events->get('primary', $idActividades);
    $datos["Nombre"] = $event->getSummary();
    $datos["idActividades"] = $idActividades;
    $datos["Finalizacion"] = $event->getEnd();
    $datos["Inicio"] = $event->getStart();
    $datos["Recurrencia"] = $event->getRecurrence();
    return json_encode($datos);
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
  public function editarEvento($data, $id, $servicio)
  {
    $event = new Google_Service_Calendar_Event($data);
    return $updatedEvent = $servicio->events->update('primary', $id, $event);
  }
  public function agregarEvento($data, $servicio)
  {
    $event = new Google_Service_Calendar_Event($data);
    $event = $servicio->events->insert('primary', $event);
  }
  public function traerActividades() {
    $sql = "SELECT actividades.Nombre as actNombre, niveles.Nombre as nivNombre FROM actividadesmodalidadesniveles LEFT JOIN actividades ON actividadesmodalidadesniveles.idActividades = actividades.idActividades LEFT JOIN niveles ON actividadesmodalidadesniveles.idNiveles = niveles.idNiveles WHERE actividades.idActividades != 3 GROUP BY `nivNombre` ";
    $outp = $this->db->getAll($sql);
    echo json_encode($outp);
  }

}
