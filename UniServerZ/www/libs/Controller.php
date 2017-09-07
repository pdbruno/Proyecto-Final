<?php

class Controller {

  function __construct() {
    $this->view = new View();
  }

  public function eliminarElemento($Tipo) {
    $idElemento = $_POST['data'];
    $this->model->eliminar($Tipo, $idElemento);
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
    $caca = json_decode($_POST['data'], TRUE);
    $this->model->agregarModificar($tipo, $caca);
  }

  public function traerElemento($tipo) {
    $id = $_POST['data'];
    echo $datos = $this->model->traerElemento($tipo, $id);
  }

}
