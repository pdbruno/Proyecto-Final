<?php

class Cobro_Model extends Model {

  public function __construct() {
    parent::__construct();
  }

  public function updateFondo($data) {
    $recaud = $this->db->getOne("SELECT `Recaudacion` FROM `fondos` WHERE `idFondos` = (SELECT `idFondos` FROM `actividades` WHERE `idActividades` = ?i)", substr($data['idActividades'], 0, 11));
    if ($recaud != false) {
      $this->db->query("UPDATE fondos SET Recaudacion = ?i WHERE `idFondos` = (SELECT `idFondos` FROM `actividades` WHERE `idActividades` = ?i)", $recaud + $data['Monto'], substr($data['idActividades'], 0, 11));
    }
  }

  public function updateAsistencias($data) {
    $sql = "UPDATE `asistencias` SET `Abonado`= 1 WHERE `idClientes` = ?i AND `idActividades` = ?i AND (`Fecha` BETWEEN ?s AND ?s)";
     $this->db->query($sql, $data['idClientes'], $data['idActividades'], $data['Fecha1'], $data['Fecha2']);
  }

  public function listado($tipo) {
    $sql = "SELECT actividadesaranceles.*, actividades.Nombre as actNombre, modalidades.Nombre as modNombre, modosdepago.Nombre as pagNombre
    FROM actividadesaranceles 
    LEFT JOIN modosdepago ON modosdepago.idModosDePago = actividadesaranceles.idModosDePago
    LEFT JOIN actividades ON actividades.idActividades = actividadesaranceles.idActividades
    LEFT JOIN modalidades ON modalidades.idModalidades = actividadesaranceles.idModalidades
    GROUP BY idActividades, idModosDePago, idModalidades";
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
  public function addArancel($data) {
    $sql = "INSERT INTO `actividadesaranceles` SET ?u";
    $this->db->query($sql, $data);
  }
  public function modSueldo($data) {
    $sql = "UPDATE `categoriassueldos` SET `MontoXBloque`= ?s WHERE idCategoriasSueldos = ?i";
    $this->db->query($sql, $data['MontoXBloque'], $data['idCategoriasSueldos']);
  }

  public function traerElemento($tipo,$data) {
    $data = json_decode($data);
    $sql = "SELECT `Precio` FROM `actividadesaranceles` WHERE idActividades = ?i AND idModosDePago = ?i AND idModalidades = ?s ORDER BY FechaInicio DESC LIMIT 1";
    return $this->db->getOne($sql, $data->idActividades, $data->idModosDePago, $data->idModalidades);
  }
}
