<?php

class producto_Model extends Model {

  public function __construct() {
    parent::__construct();
  }

  public function nuevoObjeto($data) {
    $obj['idProductos'] = $data[0];
    $obj['Descripcion'] = $data[1];
    $obj['idDistribuidores'] = $data[2];
    $obj['Precio'] = $data[3];
    $obj['Stock'] = $data[4];
    $obj['Avisar'] = $data[5];
    return $obj;
  }

  public function listado($tipo) {
    $sql = "SELECT idProductos, Descripcion FROM productos";
    $outp = $this->db->getAll($sql);
    echo json_encode($outp);
  }

  public function listadodropdowns() {
    $sql = "SELECT idDistribuidores as id, Nombre FROM distribuidores";
    $outp = $this->db->getAll($sql);
    echo json_encode($outp);
  }

  public function traerElemento($tipo,$idProductos) {
    $sql = "SELECT productos.idProductos, productos.Descripcion, productos.Precio, distribuidores.Nombre as disNombre, productos.Stock,productos.Avisar
    FROM productos
    LEFT JOIN distribuidores ON productos.idDistribuidores = distribuidores.idDistribuidores
    WHERE idProductos=?i";
    $outp = $this->db->getAll($sql, $idProductos);
    return json_encode($outp);
  }

  public function registrarCompra($data) {
    $sql = "INSERT INTO
    registrocompras(
    Fecha,
    idProductos,
    MontoInd,
    Cantidad)
    VALUES(?s,
    ?i,
    ?s,
    ?i)";
    $this->db->query($sql, $data[0]["value"],$data[1]["value"],$data[2]["value"],$data[3]["value"]);
    $stock = $this->traerStock($data[1]["value"]);
    $stock = $stock[0]["Stock"];
    $stock = $stock + $data[3]["value"];
    $this->actualizarStock($stock, $data[1]["value"]);
  }

  private function actualizarStock($stock, $id) {
    $sql = "UPDATE
    productos
    SET
    Stock = ?i
    WHERE idProductos = ?i";
    $this->db->query($sql, $stock, $id);
  }

  private function traerStock($id) {
    $sql = "SELECT Stock, Avisar FROM productos WHERE idProductos = ?i";
    $outp = $this->db->getAll($sql, $id);
    return $outp;
  }

  public function registrarVenta($data) {
    $sql = "INSERT INTO
    registroventas(
    Fecha,
    idProductos,
    Monto,
    Cantidad)
    VALUES(?s,
    ?i,
    ?s,
    ?i)";
    $this->db->query($sql, $data[0]["value"],$data[1]["value"],$data[2]["value"],$data[3]["value"]);
    $papasfritas = $this->traerStock($data[1]["value"]);
    $stock = $papasfritas[0]["Stock"];
    $avisar = $papasfritas[0]["Avisar"];
    $stock = $stock - $data[3]["value"];
    $this->actualizarStock($stock, $data[1]["value"]);
    if ($stock <= $avisar) {
      echo json_encode("El stock está por debajo de las $avisar unidades (más específicamente está en $stock unidades)");
    }
  }
}
