<?php
require_once 'controllers/calendar.php';
class cobro extends calendar {

  public function modArancel() {
    $Arancel = json_decode($_POST['data'], TRUE);
    $this->model->modArancel($Arancel);
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
