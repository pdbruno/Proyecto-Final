<?php
require_once 'controllers/calendar.php';
class cobro extends calendar {

  public function listadoAranceles() {
    $datos = $this->model->listadoAranceles();
    echo $datos;
  }

  public function addCobro()
  {
    $cobro = json_decode($_POST['data'], TRUE);
    date_default_timezone_set("America/Buenos_Aires");
    $cobro['Fecha'] =  date("Y-m-d");
    echo $this->model->addCobro($cobro);
  }

  public function modArancel() {
    $Arancel = json_decode($_POST['data'], TRUE);
    $this->model->modArancel($Arancel);
  }

  public function traerArancel() {
    $datos = json_decode($_POST['data'], TRUE);
    echo $this->model->traerArancel($datos);
  }

  public function eliminarArancel() {
    $idAranceles = $_POST['data'];
    $this->model->eliminarArancel($idAranceles);
  }

  function index() {
    $this->manejar("cobro","index");
    $this->view->render('cobro/index');
  }
  function aranceles() {
    $this->view->render('aranceles/index');
  }
  public function __construct() {
    parent::__construct();
  }

}
