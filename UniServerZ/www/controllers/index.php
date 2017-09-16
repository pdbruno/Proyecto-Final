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

  function corteFinan()
  {
    $sql = $this->model->corteProd(json_decode($_POST['data'], TRUE));
    $this->model->finanzasEgresos($sql);
    echo "_";
    $this->model->finanzasIngresos($sql);
    echo "_";
    $this->model->finanzasEgresosTotal($sql);
    echo "_";
    $this->model->finanzasIngresosTotal($sql);
  }

  function porcentajeAsistencias()
  {
    $this->model->porcentajeAsistencias();
  }

  function finanzasEgresos()
  {
    $this->model->finanzasEgresos();
  }

  function finanzasEgresosTotal()
  {
    $this->model->finanzasEgresosTotal();
  }

  function finanzasIngresos()
  {
    $this->model->finanzasIngresos();
  }

  function finanzasIngresosTotal()
  {
    $this->model->finanzasIngresosTotal();
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
