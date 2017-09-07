<?php

class Help extends Controller {

  function __construct() {
    parent::__construct();
  }

  function index($sujeto) {
    $this->view->lista = URL . "help/listarElementos/" . $sujeto;
    $this->view->tabla = URL . "help/tabla/" . $sujeto;
    $this->view->agregarModificar = URL . "help/agregarModificarElemento/" . $sujeto;
    $this->view->eliminar = URL . "help/eliminarElemento/" . $sujeto;
    $this->view->traer = URL . "help/traerElemento/" . $sujeto;
    $this->view->titmodal = ucfirst(substr($sujeto, 0, -1));
    $this->view->th = "<th data-field='Nombre' data-sortable='true'>Nombre</th>";
    $this->view->renderTabla(null, true);
  }

  function Dropdown($tipo) {
    $this->model->Dropdown($tipo);
  }

  function tablas() {
    $this->view->lista = URL . "help/listarTablas/";
    $this->view->titmodal ="Columna";
    $this->view->th = "<th data-field='Tables_in_dbproyectofinal' data-sortable='true'>Nombre</th>";
    $this->view->render2modales('tablas');
  }

  function listarTablas(){
    $this->model->listarTablas();
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
