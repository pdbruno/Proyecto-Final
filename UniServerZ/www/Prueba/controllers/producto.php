<?php

class producto extends Controller {

    public function listadoProductos() {
        $datos = $this->model->listadoProductos();
        $this->model->cerrarConexion();
        echo $datos;
    }

    public function listadoDropdowns() {
        $datos = $this->model->listadodropdowns();
        $this->model->cerrarConexion();
        echo $datos;
    }

    public function traerProducto() {
        if (isset($_POST['data'])) {
            $idProductos = $_POST['data'];
        } else {
            require 'controllers/error_.php';
            $error = new Error_();
            $error->index("Hubo un error en la transferencia de datos");
        }
        $datos = $this->model->traerProducto($idProductos);
        $this->model->cerrarConexion();
        echo $datos;
    }

    public function agregarModificarProducto() {
        if (isset($_POST['data'])) {
            $data = $_POST['data'];
        } else {
            require 'controllers/error_.php';
            $error = new Error_();
            $error->index("Hubo un error en la transferencia de datos");
        }
        $this->model->agregarModificarProducto($data);
        $this->model->cerrarConexion();
    }

    public function eliminarProducto() {
        if (isset($_POST['data'])) {
            $idProductos = $_POST['data'];
        } else {
            require 'controllers/error_.php';
            $error = new Error_();
            $error->index("Hubo un error en la transferencia de datos");
        }
        $this->model->eliminarProducto($idProductos);
        $this->model->cerrarConexion();
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
        $this->model->cerrarConexion();
        echo $datos;
    }

    function registrarCompra() {
        if (isset($_POST['data'])) {
            $data = $_POST['data'];
        } else {
            require 'controllers/error_.php';
            $error = new Error_();
            $error->index("Hubo un error en la transferencia de datos");
        }
        $this->model->registrarCompra($data);
        $this->model->cerrarConexion();
    }

    function registrarVenta() {
        if (isset($_POST['data'])) {
            $data = $_POST['data'];
        } else {
            require 'controllers/error_.php';
            $error = new Error_();
            $error->index("Hubo un error en la transferencia de datos");
        }
        $datos = $this->model->registrarVenta($data);
        echo $datos;
        $this->model->cerrarConexion();
    }

    public function __construct() {
        parent::__construct();
    }

}
