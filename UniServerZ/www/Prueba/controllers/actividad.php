<?php
require_once 'controllers/calendar.php';
class actividad extends calendar {

  function __construct() {
    parent::__construct();
  }

  function calendario() {
    $this->manejar("actividad","actividades");
    $this->view->render('calendario/index');
  }
  function index() {
    $this->view->render('abmactividades/index');
  }
  public function tomarlista() {
    $this->manejar("actividad","tomarlista");
    $this->view->render('tomarlista/index');
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
    $data = json_decode($_POST['data'], TRUE);
    $id = trim($_POST['data2']);
    // $service = $this->getService();
    echo $this->model->asignarAsistencia($data,$id);
  }
  public function traerAnotados() {
    $data = $_POST['data'];
    echo $this->model->traerAnotados($data);
  }
  public function traerActividad() {
    $data = $_POST['data'];
    echo $this->model->traerActividad($data);
  }
  public function agregarModificarActividad() {
    $caca = json_decode($_POST['data'], TRUE);
    $caca = $this->model->nuevoObjeto($caca);
    $this->model->agregarModificarActividad($caca);
  }

  public function eliminarActividad() {
    $caca = $_POST['data'];
    $this->model->eliminarActividad($caca);
  }
  public function traerActividades() {
    echo $this->model->traerActividades();
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
