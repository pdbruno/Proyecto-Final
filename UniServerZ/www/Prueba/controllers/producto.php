<?php

class producto extends Controller {

  function index() {
    $this->view->render('abmproductos/index');
  }

  function ingresostock() {
    $this->view->render('ingresostock/index');
  }

  function egresostock() {
    $this->view->render('egresostock/index');
  }

  function registrarCompra() {
    $caca = json_decode($_POST['data'], TRUE);
    //        VALIDAR
    //        $caca['Fecha']
    //        $caca['idProductos']
    //        $caca['MontoInd']
    //        $caca['Cantidad']

    $datos = $this->model->registrarCompra($caca);
  }

  function registrarVenta() {
    $caca = json_decode($_POST['data'], TRUE);
    //        VALIDAR
    //        $caca['Fecha']
    //        $caca['idProductos']
    //        $caca['Monto']
    //        $caca['Cantidad']
    $datos = $this->model->registrarVenta($caca);
    echo $datos;
  }

  public function __construct() {
    parent::__construct();
  }

}
