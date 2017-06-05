<?php

class producto_Model extends Model {

    private $con;

    public function __construct() {
        require 'models/Conexion_Model.php';
        $this->con = new Conexion_Model();
    }

    public function listadoProductos() {

        $sql = "SELECT idProductos, Descripcion FROM productos";

        $outp = $this->con->consultaRetorno($sql);
        foreach ($outp as $indice => $elemento) {
            foreach ($elemento as $key => $value) {
                $output[$indice][$key] = preg_replace_callback("/(&#[0-9]+;)/", function($m) {
                    return mb_convert_encoding($m[1], "UTF-8", "HTML-ENTITIES");
                }, $value);
            }
        }

        echo json_encode($output);
    }

    public function listadodropdowns() {
        $sql = array();
        $sql = "SELECT idDistribuidores as id, Nombre FROM distribuidores;";
        $outp = $this->con->consultaRetorno($sql);
        foreach ($outp as $indice => $dropdown) {
            foreach ($dropdown as $key => $elemento) {
                $output[$indice][$key] = preg_replace_callback("/(&#[0-9]+;)/", function($m) {
                    return mb_convert_encoding($m[1], "UTF-8", "HTML-ENTITIES");
                }, $elemento);
            }
        }
        echo json_encode($output);
    }

    public function traerProducto($idProductos) {

        $sql = "SELECT productos.idProductos, productos.Descripcion, productos.Precio, distribuidores.Nombre as disNombre, productos.Stock,productos.Avisar
                FROM productos
                LEFT JOIN distribuidores ON productos.idDistribuidores = distribuidores.idDistribuidores
                WHERE idProductos=$idProductos";
        $outp = $this->con->consultaRetorno($sql);
        foreach ($outp as $indice => $elemento) {
            foreach ($elemento as $key => $value) {
                $output[$indice][$key] = preg_replace_callback("/(&#[0-9]+;)/", function($m) {
                    return mb_convert_encoding($m[1], "UTF-8", "HTML-ENTITIES");
                }, $value);
            }
        }

        echo json_encode($output);
    }

    public function eliminarProducto($idProductos) {
        $sql = "DELETE FROM productos WHERE idProductos = $idProductos";
        $this->con->consultaSimple($sql);
    }

    public function agregarCompra($info) {
        $caca = json_decode($info, TRUE);
        foreach ($caca as $indice => $elemento) {
            $data[$indice] = htmlentities($elemento, ENT_QUOTES);
//            if ($data[$indice] != "") {
//                if (gettype($data[$indice]) == 'string') {
//                    $data[$indice] = "'" . $data[$indice] . "'";
//                }
//            } else {
//                $data[$x] = 'null';
//            }
        }
        for ($x = 0; $x <= 4; $x++) {
            if ($data[$x] != "") {
                if (gettype($data[$x]) == 'string') {
                    $data[$x] = "'" . $data[$x] . "'";
                }
            } else {
                $data[$x] = 'null';
            }
        }
        array_shift($data);
        $sql = "INSERT INTO
                    registrocompras(
                    Fecha,
                    idProductos,
                    MontoInd,
                    Cantidad,)
                    VALUES($data[0],
                    $data[1],
                    $data[2],
                    $data[3],
                    $data[4])";
        $this->con->consultaSimple($sql);
        //HAY QUE TRAER EL CAMPO STOCK DE PRODUCTO,OPERAR Y UPDATE
    }

    public function agregarModificarProducto($info) {
        $caca = json_decode($info, TRUE);
        foreach ($caca as $indice => $elemento) {
            $data[$indice] = htmlentities($elemento, ENT_QUOTES);
//            if ($data[$indice] != "") {
//                if (gettype($data[$indice]) == 'string') {
//                    $data[$indice] = "'" . $data[$indice] . "'";
//                }
//            } else {
//                $data[$x] = 'null';
//            }
        }
        for ($x = 0; $x <= 5; $x++) {
            if ($data[$x] != "") {
                if (gettype($data[$x]) == 'string') {
                    $data[$x] = "'" . $data[$x] . "'";
                }
            } else {
                $data[$x] = 'null';
            }
        }

        if ($data[0] == 'null') {
            array_shift($data);
            $sql = "INSERT INTO
                    productos(
                    Descripcion,
                    idDistribuidores,
                    Precio,
                    Stock,
                    Avisar)
                    VALUES($data[0],
                    $data[1],
                    $data[2],
                    $data[3],
                    $data[4])";
        } else {
            $sql = "UPDATE
                    productos
                    SET
                    Descripcion = $data[1],
                    idDistribuidores = $data[2],
                    Precio = $data[3],
                    Stock = $data[4],
                    Avisar = $data[5],
                    WHERE idProductos=$data[0]";
        }
        $this->con->consultaSimple($sql);
    }

}
