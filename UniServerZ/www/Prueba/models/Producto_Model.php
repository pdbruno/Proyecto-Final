<?php

class producto_Model extends Model {

    private $con;

    public function __construct() {
        require 'models/Conexion_Model.php';
        $this->con = new Conexion_Model();
    }

    public function listadoProductos() {

        $sql = "SELECT idProductos, Descripcion, Precio FROM productos";

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

    public function registrarCompra($info) {
        $caca = json_decode($info, TRUE);
        $i = 0;
        foreach ($caca as $indice) {
            $data[$i] = htmlentities($indice["value"], ENT_QUOTES);
            if ($data[$i] != "") {
                if (gettype($data[$i]) == 'string') {
                    $data[$i] = "'" . $data[$i] . "'";
                }
            } else {
                $data[$i] = 'null';
            }
            $i++;
        }
        $sql = "INSERT INTO
                    registrocompras(
                    Fecha,
                    idProductos,
                    MontoInd,
                    Cantidad)
                    VALUES($data[0],
                    $data[1],
                    $data[2],
                    $data[3])";
        $this->con->consultaSimple($sql);
        $stock = $this->traerStock($data[1]);
        $stock = $stock[0]["Stock"];
        $stock = $stock + $caca[3]["value"];
        $this->actualizarStock($stock, $data[1]);
    }

    public function cerrarConexion() {
        $this->con->cerrarConexion();
    }

    private function actualizarStock($stock, $id) {
        $sql = "UPDATE
                    productos
                    SET
                    Stock = $stock
                    WHERE idProductos = $id";
        $this->con->consultaSimple($sql);
    }

    private function traerStock($id) {
        $sql = "SELECT Stock, Avisar FROM productos WHERE idProductos = $id";
        $outp = $this->con->consultaRetorno($sql);
        foreach ($outp as $indice => $elemento) {
            foreach ($elemento as $key => $value) {
                $output[$indice][$key] = preg_replace_callback("/(&#[0-9]+;)/", function($m) {
                    return mb_convert_encoding($m[1], "UTF-8", "HTML-ENTITIES");
                }, $value);
            }
        }
        return $output;
    }

    public function registrarVenta($info) {
        $caca = json_decode($info, TRUE);
        $i = 0;
        foreach ($caca as $indice) {
            $data[$i] = htmlentities($indice["value"], ENT_QUOTES);
            if ($data[$i] != "") {
                if (gettype($data[$i]) == 'string') {
                    $data[$i] = "'" . $data[$i] . "'";
                }
            } else {
                $data[$i] = 'null';
            }
            $i++;
        }


        $sql = "INSERT INTO
                    registroventas(
                    Fecha,
                    idProductos,
                    Monto,
                    Cantidad)
                    VALUES($data[0],
                    $data[1],
                    $data[2],
                    $data[3])";
        $this->con->consultaSimple($sql);
        $papasfritas = $this->traerStock($data[1]);
        $stock = $papasfritas[0]["Stock"];
        $avisar = $papasfritas[0]["Avisar"];
        $stock = $stock - $caca[3]["value"];
        $this->actualizarStock($stock, $data[1]);
        if ($stock <= $avisar) {
            echo json_encode("El stock está por debajo de las $avisar unidades (más específicamente está en $stock unidades)");
        }
    }

    public function agregarModificarProducto($info) {
        $caca = json_decode($info, TRUE);
        foreach ($caca as $indice => $elemento) {
            $data[$indice] = htmlentities($elemento, ENT_QUOTES);
            if ($data[$indice] != "") {
                if (gettype($data[$indice]) == 'string') {
                    $data[$indice] = "'" . $data[$indice] . "'";
                }
            } else {
                $data[$indice] = 'null';
            }
        }
        echo 'la id es ' . $data[0];
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
                    Avisar = $data[5]
                    WHERE idProductos = $data[0]";
        }

        $this->con->consultaSimple($sql);
    }

}
