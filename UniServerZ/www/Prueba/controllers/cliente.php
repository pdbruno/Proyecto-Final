<?php

//namespace Controllers;
//
//use Models\Cliente as Cliente;

class cliente extends Controller {

  public function listadoClientes() {
    $datos = $this->model->listadoClientes();
    echo $datos;
  }

  public function listadoDropdowns() {
    $datos = $this->model->listadodropdowns();
    echo $datos;
  }

  public function traerCliente() {
    $idClientes = $_POST['data'];
    echo $this->model->traerCliente($idClientes);
  }

  public function agregarModificarCliente() {
    $cliente = json_decode($_POST['data1'], TRUE);
    $actividades = json_decode($_POST['data2'], TRUE);
    $cliente = $this->model->nuevoObjeto($cliente);
    var_dump($cliente);
    $this->model->agregarModificarCliente($cliente);
    $this->model->asignarActividades($actividades, $cliente["idClientes"]);
  }

  public function eliminarCliente() {
    $idClientes = $_POST['data'];
    $datos = $this->model->eliminarCliente($idClientes);
  }

  function index() {
    $this->view->render('abmclientes/index');
  }

  public function __construct() {
    parent::__construct();
  }

}
