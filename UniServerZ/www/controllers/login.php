<?php

class LogIn extends Controller {

  function __construct() {
    parent::__construct();
  }

  public function index() {
    $this->view->render('login');
  }

  public function logIn() {
    $this->model->logIn(json_decode($_POST['data']));
  }

}
