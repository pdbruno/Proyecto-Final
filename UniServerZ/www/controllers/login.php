<?php

class LogIn extends Controller {

  function __construct() {
    parent::__construct(true);
  }

  public function index() {
    $this->view->render('login');
  }

  public function logIn() {
    $this->model->logIn(json_decode($_POST['data']));
  }

  public function checkContra() {
    $this->model->checkContra($_POST['data']);
  }

  public function logOut() {
    Session::destroy();
    $this->view->render('login');
  }

}
