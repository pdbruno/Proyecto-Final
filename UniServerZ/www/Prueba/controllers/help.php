<?php

class Help extends Controller {

  function __construct() {
    parent::__construct();
  }

  function index($sujeto) {
    $this->view->sujeto = $sujeto;
    $this->view->render('abmsecundario/index');
  }
}
