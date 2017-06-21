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
        if (isset($_POST['data'])) {
            $data = $_POST['data'];
        } else {
            require 'controllers/error_.php';
            $error = new Error_();
            $error->index("Hubo un error en la transferencia de datos");
        }
        $caca = json_decode($data, TRUE);
        $cliente = $this->model->nuevoObjeto($caca);
        $this->model->agregarModificarCliente($cliente);
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
