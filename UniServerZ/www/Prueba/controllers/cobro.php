<?php
require_once 'controllers/calendar.php';
class cobro extends calendar {

  public function listadoAranceles() {
    $datos = $this->model->listadoAranceles();
    echo $datos;
  }

  public function traerArancel() {
    $idAranceles = $_POST['data'];
    echo $this->model->traerArancel($idAranceles);
  }

  public function agregarModificarArancel() {
    $Arancel = json_decode($_POST['data'], TRUE);
    $Arancel = $this->model->nuevoObjeto($Arancel);
    $this->model->agregarModificarArancel($Arancel);
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
