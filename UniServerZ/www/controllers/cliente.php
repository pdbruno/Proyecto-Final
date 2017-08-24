<?php

//namespace Controllers;
//
//use Models\Cliente as Cliente;

class cliente extends Controller {

  public function actCliente() {
    $idClientes = $_POST['data'];
    echo json_encode($this->model->actCliente($idClientes));
  }
  public function agregarModificarCliente() {
    $cliente = json_decode($_POST['data1'], TRUE);
    $actividades = json_decode($_POST['data2'], TRUE);
    $this->model->agregarModificar('Clientes', $cliente);
    $this->model->asignarActividades($actividades, $cliente["idClientes"]);
  }
  function index() {
    $this->view->render('abmclientes');
  }
  public function __construct() {
    parent::__construct();
  }

}
