<?php

class Controller {

  function __construct($LoginController = false) {
    $this->view = new View();
    if (!$LoginController) {
      if (!isset($_SESSION['logueado']) || $_SESSION['logueado'] == false) {
        $this->destroySession();
        $this->view->titpag = "No en mi guardia";
        $this->view->msg = "Te podés loguear porfis? Gracias";
        $this->view->render('error');
        exit;
      }
    }

  }

  protected function destroySession(){
    session_unset();
    session_destroy();
  }

  protected function checkRol($MaxPrivilegio){
    if (isset($_SESSION['rol']) && $_SESSION['rol'] && $MaxPrivilegio < $_SESSION['rol']) {
      $this->view->titpag = "Dónde pensas que vas bebé?";
      $this->view->msg = "Usted no tiene permiso para acceder a esta página. JAJA.";
      $this->view->render('error');
      exit;
    }
  }

  public function eliminarElemento($Tipo) {
    $this->checkRol(2);
    $this->model->eliminar($Tipo,  $_POST['data']);
  }

  public function listarElementos($tipo) {
    echo $datos = $this->model->listado($tipo);
  }

  public function loadModel($name) {
    $path = 'models/' . $name . '_model.php';
    if (file_exists($path)) {
      require $path;
      $modelName = $name . '_Model';
      $this->model = new $modelName();
    }
  }

  public function tabla($tipo) {
    $this->model->tabla($tipo);
  }

  function Dropdown($tipo) {
    $this->model->Dropdown($tipo);
  }

  public function agregarModificarElemento($tipo) {
    $this->checkRol(2);
    $this->model->agregarModificar($tipo, json_decode($_POST['data'], TRUE));
  }

  public function traerElemento($tipo) {
    if ($tipo != "Arancel") {
      $this->checkRol(2);
    }
    echo $datos = $this->model->traerElemento($tipo, $_POST['data']);
  }

}
