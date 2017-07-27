<?php

class Cobro_Model extends Model {

  public function __construct() {
    parent::__construct();
  }

  public function addCobro($cobro){
    $sql = "INSERT INTO cobros SET ?u";
    $this->db->query($sql, (array) $cobro);
  }
  public function listadoAranceles() {
    $sql = "SELECT actividadesaranceles.idActividadesAranceles, actividades.Nombre as actNombre, modalidades.Nombre as modNombre, actividadesaranceles.PrecioXClase , actividadesaranceles.PrecioXMes
            FROM actividadesaranceles
            LEFT JOIN actividades ON actividades.idActividades = actividadesaranceles.idActividades
            LEFT JOIN modalidades ON modalidades.idModalidades = actividadesaranceles.idModalidades";
    $outp = $this->db->getAll($sql);
    echo json_encode($outp);
  }

  public function modArancel($data) {
    $sql = "UPDATE `actividadesaranceles` SET `PrecioXClase`= ?s,`PrecioXMes`=?s WHERE idActividadesAranceles = ?i";
    $this->db->query($sql, $data['PrecioXClase'], $data['PrecioXMes'], $data['idActividadesAranceles']);
  }

  public function traerArancel($data) {
    $sql = "SELECT ?n FROM `actividadesaranceles` WHERE idActividades = ?i AND idModalidades = ?s";
    return $this->db->getOne($sql, $data['Campo'], $data['idActividades'], $data['idModalidades']);
  }
}
