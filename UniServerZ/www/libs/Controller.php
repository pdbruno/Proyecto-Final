<?php

class Controller {

  function __construct() {
    $this->view = new View();
  }

  public function eliminarElemento($Tipo) {
    $this->model->eliminar($Tipo,  $_POST['data']);
  }

  public function listarElementos($tipo) {
    echo $datos = $this->model->listado($tipo);
  }

  public function loadModel($name) {
    $path = 'models/' . $name . '_model.php';
    if (file_exists($path)) {
      require $path;
      $modelName = $name . '_Model';
      $this->model = new $modelName();
    }
  }

  public function tabla($tipo) {
    $this->model->tabla($tipo);
  }

  public function agregarModificarElemento($tipo) {
    $this->model->agregarModificar($tipo, json_decode($_POST['data'], TRUE));
  }

  public function traerElemento($tipo) {
    echo $datos = $this->model->traerElemento($tipo, $_POST['data']);
  }

}
