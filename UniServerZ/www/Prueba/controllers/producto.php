<?php
class producto extends Controller {

    public function listadoProductos() {
        $datos = $this->model->listadoProductos();
        echo $datos;
    }

    public function listadoDropdowns() {
        $datos = $this->model->listadodropdowns();
        echo $datos;
    }

    public function traerProducto() {
        if (isset($_POST['data'])) {
            $idProductos = $_POST['data'];
        }else{
            require 'controllers/error_.php';
            $error = new Error_();
            $error->index("Hubo un error en la transferencia de datos");
        }
        $datos = $this->model->traerProducto($idProductos);
        echo $datos;
    }

    public function agregarModificarProducto() {
        if (isset($_POST['data'])) {
            $data = $_POST['data'];
        }else{
            require 'controllers/error_.php';
            $error = new Error_();
            $error->index("Hubo un error en la transferencia de datos");
        }
        $datos = $this->model->agregarModificarProducto($data);
    }

    public function eliminarProducto() {
        if (isset($_POST['data'])) {
            $idProductos = $_POST['data'];
        }else{
            require 'controllers/error_.php';
            $error = new Error_();
            $error->index("Hubo un error en la transferencia de datos");
        }
        $datos = $this->model->eliminarProducto($idProductos);
    }

    function index() {

        $this->view->render('abmproductos/index');
    }

    public function __construct() {
        parent::__construct();
    }
}