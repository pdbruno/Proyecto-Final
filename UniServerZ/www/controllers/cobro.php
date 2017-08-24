<?php
require_once 'controllers/calendar.php';
class cobro extends calendar {

  public function modArancel() {
    $Arancel = json_decode($_POST['data'], TRUE);
    $this->model->modArancel($Arancel);
  }

  public function modSueldo() {
    $Sueldo = json_decode($_POST['data'], TRUE);
    $this->model->modSueldo($Sueldo);
  }

  public function index() {
    $this->manejar("cobro","index");
    $this->view->render('cobro');
  }

  public function listarSueldos(){
    echo $this->model->listarSueldos();
  }

  public function aranceles() {
    $this->view->render('aranceles');
  }
  public function sueldos() {
    $this->view->render('sueldos');
  }

  public function egresos() {
    $this->view->render('egresos');
  }

  public function __construct() {
    parent::__construct();
  }

}
