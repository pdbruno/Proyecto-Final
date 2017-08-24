<?php

class Cobro_Model extends Model {

  public function __construct() {
    parent::__construct();
  }

  public function agregarModificar($tipo,$data) {
    $sql = "INSERT INTO ?n SET ?u";
    $this->db->query($sql, strtolower($tipo), $data);
    $recaud =  $this->db->getOne("SELECT `Recaudacion` FROM `fondos` WHERE `idFondos` = (SELECT `idFondos` FROM `actividades` WHERE `idActividades` = ?i)", substr($data['Actividad'], 0, 11));
    $this->db->query("UPDATE fondos SET Recaudacion = ?i WHERE `idFondos` = (SELECT `idFondos` FROM `actividades` WHERE `idActividades` = ?i)", $recaud + $data['Monto'], substr($data['Actividad'], 0, 11));
  }

  public function listado($tipo) {
    $sql = "SELECT actividadesaranceles.idActividadesAranceles, actividades.Nombre as actNombre, modalidades.Nombre as modNombre, actividadesaranceles.PrecioXClase , actividadesaranceles.PrecioXMes
            FROM actividadesaranceles
            LEFT JOIN actividades ON actividades.idActividades = actividadesaranceles.idActividades
            LEFT JOIN modalidades ON modalidades.idModalidades = actividadesaranceles.idModalidades";
    $outp = $this->db->getAll($sql);
    echo json_encode($outp);
  }

  public function listarSueldos(){
    $sql = "SELECT categoriassueldos.idCategoriasSueldos, categorias.Nombre as catNombre, categoriassueldos.MontoXBloque
            FROM categoriassueldos
            LEFT JOIN categorias ON categorias.idCategorias = categoriassueldos.idCategorias";
    $outp = $this->db->getAll($sql);
    return json_encode($outp);
  }
  public function modArancel($data) {
      $sql = "UPDATE `actividadesaranceles` SET `PrecioXClase`= ?s,`PrecioXMes`=?s WHERE idActividadesAranceles = ?i";
      $this->db->query($sql, $data['PrecioXClase'], $data['PrecioXMes'], $data['idActividadesAranceles']);
    }
  public function modSueldo($data) {
    $sql = "UPDATE `categoriassueldos` SET `MontoXBloque`= ?s WHERE idCategoriasSueldos = ?i";
    $this->db->query($sql, $data['MontoXBloque'], $data['idCategoriasSueldos']);
  }

  public function traerElemento($tipo,$data) {
    $data = json_decode($data);
    $sql = "SELECT ?n FROM `actividadesaranceles` WHERE idActividades = ?i AND idModalidades = ?s";
    return $this->db->getOne($sql, $data->Campo, $data->idActividades, $data->idModalidades);
  }
}
