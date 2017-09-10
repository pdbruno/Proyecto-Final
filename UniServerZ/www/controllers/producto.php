<?php

class producto extends Controller {

  function index() {
    $this->view->lista = URL . "producto/listarElementos/Productos";
    $this->view->tabla = URL . "producto/tabla/productos";
    $this->view->agregarModificar = URL . "producto/agregarModificarElemento/Productos";
    $this->view->eliminar = URL . "producto/eliminarElemento/Productos";
    $this->view->traer = URL . "producto/traerElemento/Productos";
    $this->view->titmodal ="Producto";
    $this->view->th = "<th data-field='Nombre' data-sortable='true'>Nombre</th>";
    $this->view->renderTabla(null, true);
  }

  function ingresostock() {
    $this->view->tit = "Registrar Compra";
    $this->view->renderForm('ingresostock');
  }

  function egresostock() {
    $this->view->tit = "Registrar Venta";
    $this->view->renderForm('egresostock');
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
