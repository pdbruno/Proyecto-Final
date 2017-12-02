<?php
class Index extends Controller {
  function __construct() {
    parent::__construct();
  }

  function index() {
    $this->checkRol(2);
    $this->view->titpag = "Home Sistema BBG";
    $this->view->render('inicio');
  }

}
