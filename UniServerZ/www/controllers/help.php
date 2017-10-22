<?php

class Help extends Controller {

  function __construct() {
    parent::__construct();
  }

  function index($sujeto) {
    $this->checkRol(2);
    $this->view->titpag = $sujeto;
    $this->view->lista = URL . "help/listarElementos/" . $sujeto;
    $this->view->tabla = URL . "help/tabla/" . $sujeto;
    $this->view->agregarModificar = URL . "help/agregarModificarElemento/" . $sujeto;
    $this->view->eliminar = URL . "help/eliminarElemento/" . $sujeto;
    $this->view->traer = URL . "help/traerElemento/" . $sujeto;
    $this->view->titmodal = ucfirst(substr($sujeto, 0, -1));
    $this->view->th = "<th data-field='Nombre' data-sortable='true'>Nombre</th>";
    $this->view->renderTabla(null, true);
  }


  function tablas() {
    $this->checkRol(1);
    $this->view->titpag = "Tablas";
    $this->view->lista = URL . "help/listarTablas/";
    $this->view->titmodal ="Columna";
    $this->view->th = "<th data-field='Tables_in_dbproyectofinal' data-sortable='true'>Nombre</th>";
    $this->view->render2modales('tablas');
  }

  function listarTablas(){
    $this->checkRol(1);
    $this->model->listarTablas();
  }

  function traerTabla($tabla){
    $this->checkRol(1);
    $this->model->traerTabla($tipo);
  }
  function addColumna($tabla){
    $this->checkRol(1);
    $data = json_decode($_POST['data'], TRUE);
    $this->model->addColumna($tabla, $data);
  }
  function editarColumna($tabla){
    $this->checkRol(1);
    $data = json_decode($_POST['data'], TRUE);
    $this->model->editarColumna($tabla, $data);
  }
  public function listarColumnas($tipo) {
    $this->checkRol(1);
    echo $datos = $this->model->listarColumnas($tipo);
  }
  public function traerColumna($tipo) {
    $this->checkRol(1);
    $data = $_POST['data'];
    echo $datos = $this->model->traerColumna($tipo, $data);
  }
}
