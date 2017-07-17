<?php

class producto extends Controller {

  public function listadoProductos() {
    $datos = $this->model->listadoProductos();
    echo $datos;
  }

  public function listadoDropdowns() {
    $datos = $this->model->listadodropdowns();
    echo $datos;
  }

  public function traerProducto() {
    $idProductos = $_POST['data'];
    $datos = $this->model->traerProducto($idProductos);
    echo $datos;
  }

  public function agregarModificarProducto() {
    $caca = json_decode($_POST['data'], TRUE);
    $producto = $this->model->nuevoObjeto($caca);
    //        VALIDAR
    //        $producto['Precio']
    //        $producto['Stock']
    //        $producto['Avisar']


    $this->model->agregarModificarProducto($producto);
  }

  public function eliminarProducto() {
    $idProductos = $_POST['data'];
    $this->model->eliminarProducto($idProductos);
  }

  function index() {
    $this->view->render('abmproductos/index');
  }

  function ingresostock() {
    $this->view->render('ingresostock/index');
  }

  function egresostock() {
    $this->view->render('egresostock/index');
  }

  function dropdown() {
    $datos = $this->model->dropdown();
    echo $datos;
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
