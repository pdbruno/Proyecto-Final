<?php

class Help extends Controller {

  function __construct() {
    parent::__construct();
  }

  function index($sujeto) {
    $this->view->sujeto = $sujeto;
    $this->view->render('abmsecundario/index');
  }

  public function listado($tipo) {
    $datos = $this->model->listado($tipo);
    echo $datos;
  }

  public function traerFila($tipo) {
    $datos = $this->model->traerFila($tipo, $id);
    echo $datos;
  }
  public function eliminarFila($tipo) {
    $id = $_POST['data'];
    $this->model->eliminarFila($tipo, $id);
  }

  public function agregarModificarFila($tipo) {
    $caca = json_decode($_POST['data'], TRUE);
    $cosa = $this->model->nuevoObjeto($caca, $tipo);
    $this->model->agregarModificarFila($cosa, $tipo);
  }

}
