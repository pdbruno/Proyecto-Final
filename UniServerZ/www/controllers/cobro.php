<?php
require 'controllers/calendar.php';
class Cobro extends calendar {

  public function __construct() {
    parent::__construct(2);
  }

  public function addCobro() {
    $data = json_decode($_POST['data'], TRUE);
    $this->model->agregarModificar('Cobros', $data);
    $this->model->updateAsistencias($data);
  }

  public function modSueldo() {
    $this->checkRol(2);
    $Sueldo = json_decode($_POST['data'], TRUE);
    $this->model->modSueldo($Sueldo);
  }

  public function traerSueldos() {
    $this->checkRol(2);
    $this->model->traerSueldos();
  }

  public function index() {
    $this->manejar("cobro","index");
    $this->view->titpag = "Cobro";
    $this->view->lista = URL . "cliente/listarElementos/Clientes";
    $this->view->th = "<th data-field='Nombres' data-sortable='true'>Nombres</th><th data-field='Apellidos' data-sortable='true'>Apellidos</th>";
    $this->view->renderTabla('cobro');
  }

  public function pagosueldos() {
    $this->checkRol(2);
    $this->view->tit = "Pagar Sueldo";
    $this->view->titpag = "Pagar Sueldo";
    $this->view->renderTempSimple('pagosueldos','form');
  }

  public function aranceles() {
    $this->checkRol(2);
    $this->view->titpag = "Aranceles";
    $this->view->tit = "Listado de Aranceles";
    $this->view->th = "<th class='hidden'>idActividadesAranceles</th>
    <th>Actividad</th>
    <th>Modo de Pago</th>
    <th>Modalidad</th>
    <th>Precio</th>";
    $this->view->renderTempSimple('aranceles', 'tablatonta');
  }

  public function egresos() {
    $this->checkRol(2);
    $this->view->titpag = "Egresos";
    $this->view->tit = "Registrar Egreso";
    $this->view->Tabla = "egresos";
    $this->view->Alta = "help/agregarModificarElemento/Egresos";
    $this->view->renderTempSimple('egresos', 'form', true);
  }

  public function cobroescuelas() {
    $this->checkRol(2);
    $this->view->tit = "Cobro a Escuelas";
    $this->view->titpag = "Cobro a Escuelas";
    $this->view->Tabla = "cobrosescuelas";
    $this->view->Alta = "help/agregarModificarElemento/CobrosEscuelas";
    $this->view->renderTempSimple('cobroescuelas','form', true);
  }

}
