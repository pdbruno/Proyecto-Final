<?php

class Error_ extends Controller {

    function __construct() {
        parent::__construct();
    }

    function index($error = "Esta pagina no existe, vuelva prontos <img class='img' src=".URL."views/error/apu.jpg>") {
        $this->view->msg = $error;
        $this->view->render('error/index');
    }

}
