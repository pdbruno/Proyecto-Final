<?php
require_once 'controllers/calendar.php';
class actividad extends calendar {

  function __construct() {
    parent::__construct();
  }

  public function calendario() {
    $this->manejar("actividad","calendario");
    $this->view->render('calendario');
  }

  public function index() {
    $this->view->render('abmactividades');
  }

  public function tomarlista() {
    $this->manejar("actividad","tomarlista");
    $this->view->render('tomarlista');
  }

  public function traerEventos() {
    $data = $_POST['data'];
    $data = json_decode($data, TRUE);
    $service = $this->getService();
    try {
      echo $this->model->traerEventos($data, $service);
    } catch (Exception $e) {
      $this->miCatch($e);
    }
  }

  public function asignarAsistencia()
  {
    $alumnos = json_decode($_POST['data'], TRUE);
    $id = trim($_POST['data2']);
    $fecha = trim($_POST['data4']);
    $profes = json_decode($_POST['data3'], TRUE);
    echo $this->model->asignarAsistencia($alumnos, $id, $fecha);
    echo $this->model->asignarProfes($profes, $id, $fecha);
  }
  public function traerAnotados() {
    $data = $_POST['data'];
    echo $this->model->traerAnotados($data);
  }

  public function agregarModificarActividad() {
    $caca = json_decode($_POST['data1'], TRUE);
    $modalidades = json_decode($_POST['data2'], TRUE);
    $this->model->agregarModificar('Actividades',$caca);
    $this->model->asignarModalidades($modalidades, $caca['idActividades']);
  }

  public function mostrar()
  {
    $service = $this->getService();
    $idActividades = $_POST['data'];
    try {
      echo $this->model->mostrar($idActividades, $service);
    } catch (Exception $e) {
      $this->miCatch($e);
    }
  }

  public function editarActividad() {
    $actividad = json_decode($_POST['data1'], TRUE);
    $evento = $this->model->format($actividad);
    $service = $this->getService();
    try {
      echo $this->model->editarEvento($evento, $actividad["idActividades"], $service);
    } catch (Exception $e) {
      $this->miCatch($e);
    }
  }
  public function addActividad() {
    $actividad = json_decode($_POST['data1'], TRUE);
    $evento = $this->model->format($actividad);
    $service = $this->getService();
    try {
      $this->model->agregarEvento($evento, $service);
    } catch (Exception $e) {
      $this->miCatch($e);
    }
  }

}
