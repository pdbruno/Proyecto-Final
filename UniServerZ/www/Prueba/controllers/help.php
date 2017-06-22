<?php

class Help extends Controller {

    function __construct() {
        parent::__construct();
    }

    function index($sujeto) {
        $this->view->sujeto = $sujeto;
        $this->view->render('abmsecundario/index');
    }

    public function listado($tipo) {
        $datos = $this->model->listado($tipo);
        echo $datos;
    }

    public function traerFila($tipo) {
        if (isset($_POST['data'])) {
            $id = $_POST['data'];
        } else {
            require 'controllers/error_.php';
            $error = new Error_();
            $error->index("Hubo un error en la transferencia de datos");
        }
        $datos = $this->model->traerFila($tipo, $id);
        echo $datos;
    }

    public function eliminarFila($tipo) {
        if (isset($_POST['data'])) {
            $id = $_POST['data'];
        } else {
            require 'controllers/error_.php';
            $error = new Error_();
            $error->index("Hubo un error en la transferencia de datos");
        }
        $this->model->eliminarFila($tipo, $id);
    }

    public function agregarModificarFila($tipo) {
        if (isset($_POST['data'])) {
            $data = $_POST['data'];
        } else {
            require 'controllers/error_.php';
            $error = new Error_();
            $error->index("Hubo un error en la transferencia de datos");
        }
        $caca = json_decode($data, TRUE);
        $cosa = $this->model->nuevoObjeto($caca, $tipo);
        $this->model->agregarModificarFila($cosa, $tipo);
    }

}
