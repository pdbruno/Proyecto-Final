<?php

class producto_Model extends Model {

  public function __construct() {
    parent::__construct();
  }

  public function listadoPrecio($tipo) {
    $sql = "SELECT idProductos, Precio FROM productos";
    $outp = $this->db->getAll($sql);
    echo json_encode($outp);
  }

  public function traerElemento($tipo,$idProductos) {
    $sql = "SELECT productos.*, distribuidores.Nombre as idDistribuidores
    FROM productos
    LEFT JOIN distribuidores ON productos.idDistribuidores = distribuidores.idDistribuidores
    WHERE idProductos=?i";
    $outp = $this->db->getAll($sql, $idProductos);
    return json_encode($outp);
  }


  public function actualizarStock($caca) {
    $stock = $this->traerStock($caca["idProductos"]);
    $stock[0]["Stock"] += $caca["Cantidad"];
    $sql = "UPDATE
    productos
    SET
    Stock = ?i
    WHERE idProductos = ?i";
    $this->db->query($sql, $stock[0]["Stock"], $caca["idProductos"]);
    if ($stock[0]["Stock"] <= $stock[0]["Avisar"]) {
      echo "El stock está por debajo de las " . $stock[0]["Avisar"] . " unidades (más específicamente está en " . $stock[0]["Stock"] . " unidades)";
    }
  }

  private function traerStock($id) {
    $sql = "SELECT Stock, Avisar FROM productos WHERE idProductos = ?i";
    $outp = $this->db->getAll($sql, $id);
    return $outp;
  }

}
