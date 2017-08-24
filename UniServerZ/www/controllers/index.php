<?php

class index extends Controller {
  function __construct() {
    parent::__construct();
  }

  function index() {
    $this->view->render('inicio');
  }

  function morososMatricula()
  {
    $this->model->morososMatricula();
  }
}
