<?php

class producto extends Controller {

  function index() {
    $this->view->render('abmproductos');
  }

  function ingresostock() {
    $this->view->render('ingresostock');
  }

  function egresostock() {
    $this->view->render('egresostock');
  }


  public function listadoPrecio() {
    $this->model->listadoPrecio($caca);
  }

  function agregarRegistro($tipo) {
    $caca = json_decode($_POST['data'], TRUE);
    $this->model->agregarModificar($tipo, $caca);
    $this->model->actualizarStock($caca);
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
