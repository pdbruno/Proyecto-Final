<?php

class Help extends Controller {

  function __construct() {
    parent::__construct();
  }

  function index($sujeto) {
    $this->view->sujeto = $sujeto;
    $this->view->render('abmsecundario/index');
  }
  function tablas($sujeto) {
    $this->view->sujeto = $sujeto;
    $this->view->render('tablas/index');
  }
  function traerTabla($tabla){
    $this->model->traerTabla($tipo);
  }
  function addColumna($tabla){
    $data = json_decode($_POST['data'], TRUE);
    $this->model->addColumna($tabla, $data);
  }
  function editarColumna($tabla){
    $data = json_decode($_POST['data'], TRUE);
    $this->model->editarColumna($tabla, $data);
  }
  public function listarColumnas($tipo) {
    echo $datos = $this->model->listarColumnas($tipo);
  }
  public function traerColumna($tipo) {
    $data = $_POST['data'];
    echo $datos = $this->model->traerColumna($tipo, $data);
  }
}
