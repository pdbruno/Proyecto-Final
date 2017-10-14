<?php

class Error_ extends Controller {

  function __construct() {
    parent::__construct();
  }

  function index($error = "Esta pagina no existe :( <img class='img' src=".URL."views/error/apu.jpeg>") {
    $this->view->titpag = "Houston tenemos un problema";
    $this->view->msg = $error;
    $this->view->render('error');
  }

}
