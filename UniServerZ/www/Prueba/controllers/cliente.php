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
        if (isset($_POST['data'])) {
            $idClientes = $_POST['data'];
        } else {
            require 'controllers/error_.php';
            $error = new Error_();
            $error->index("Hubo un error en la transferencia de datos");
        }
        $datos = $this->model->traerCliente($idClientes);
        echo $datos;
    }

    public function agregarModificarCliente() {
        if (isset($_POST['data1'])&&isset($_POST['data2'])) {
            $data1 = $_POST['data1'];
            $data2 = $_POST['data2'];
        } else {
            require 'controllers/error_.php';
            $error = new Error_();
            $error->index("Hubo un error en la transferencia de datos");
        }
        $cliente = json_decode($data1, TRUE);
        $actividades = json_decode($data2, TRUE);
        $cliente = $this->model->nuevoObjeto($cliente);
        $this->model->agregarModificarCliente($cliente);
        $this->model->asignarActividades($data2, $cliente["idClientes"]);
    }

    public function eliminarCliente() {
        if (isset($_POST['data'])) {
            $idClientes = $_POST['data'];
        } else {
            require 'controllers/error_.php';
            $error = new Error_();
            $error->index("Hubo un error en la transferencia de datos");
        }
        $datos = $this->model->eliminarCliente($idClientes);
    }

    function index() {

        $this->view->render('abmclientes/index');
    }

    public function __construct() {
        parent::__construct();
    }

}
