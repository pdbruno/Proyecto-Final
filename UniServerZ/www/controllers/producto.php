<?php

class producto extends Controller {

  function index() {
    $this->view->titpag = "Productos";
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
    $this->view->titpag = "Registrar Compra";
    $this->view->tit = "Registrar Compra";
    $this->view->renderTempSimple('ingresostock','form');
  }

  function egresostock() {
    $this->view->titpag = "Registrar Venta";
    $this->view->tit = "Registrar Venta";
    $this->view->renderTempSimple('egresostock','form');
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
    $datos = $this->model->registrarVenta($caca);
    echo $datos;
  }

  public function __construct() {
    parent::__construct();
  }

}
