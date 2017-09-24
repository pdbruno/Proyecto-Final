<?php
require_once 'controllers/calendar.php';
class cobro extends calendar {

  public function addArancel() {
    $Arancel = json_decode($_POST['data'], TRUE);
    $this->model->addArancel($Arancel);
  }

  public function addCobro() {
    $data = json_decode($_POST['data'], TRUE);
    $this->model->agregarModificar('Cobros', $data);
    $this->model->updateAsistencias($data);
  }

  public function modSueldo() {
    $Sueldo = json_decode($_POST['data'], TRUE);
    $this->model->modSueldo($Sueldo);
  }

  public function traerSueldos() {
    $this->model->traerSueldos();
  }

  public function index() {
    $this->manejar("cobro","index");
    $this->view->lista = URL . "cliente/listarElementos/Clientes";
    $this->view->th = "<th data-field='Nombres' data-sortable='true'>Nombres</th><th data-field='Apellidos' data-sortable='true'>Apellidos</th>";
    $this->view->renderTabla('cobro');
  }
  public function pagosueldos() {
    $this->view->tit = "Pagar Sueldo";
    $this->view->renderTempSimple('pagosueldos','form');
  }

  public function listarSueldos(){
    echo $this->model->listarSueldos();
  }

  public function aranceles() {
    $this->view->tit = "Listado de Aranceles";
    $this->view->th = "<th class='hidden'>idActividadesAranceles</th>
              <th>Actividad</th>
              <th>Modo de Pago</th>
              <th>Modalidad</th>
              <th>Precio</th>";
    $this->view->renderTempSimple('aranceles', 'tablatonta');
  }
  public function sueldos() {
    $this->view->tit = "Listado de Sueldos";
    $this->view->th = "<th class='hidden'>idCategoriasSueldos</th>
              <th>Categoría</th>
              <th>Monto por Bloque</th>";
    $this->view->renderTempSimple('sueldos', 'tablatonta');
  }

  public function egresos() {
    $this->view->tit = "Registrar Egreso";
    $this->view->renderTempSimple('egresos', 'form');
  }

  public function __construct() {
    parent::__construct();
  }

}
