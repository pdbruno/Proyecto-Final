<?php

class index extends Controller {
  function __construct() {
    parent::__construct();
  }

  function index() {
    $this->view->render('inicio');
  }

  function corteProd()
  {
    $sql = $this->model->corteProd(json_decode($_POST['data'], TRUE));
    $this->model->productosVentas($sql);
    $this->model->productosGanancias($sql);
  }

  function morososMatricula()
  {
    $this->model->morososMatricula();
  }

  function productosVentas()
  {
    $this->model->productosVentas();
  }

  function productosGanancias()
  {
    $this->model->productosGanancias();
  }

  function morososExceso()
  {
    $this->model->morososExceso();
  }

  function morososActividad()
  {
    $this->model->morososActividad();
  }
}
