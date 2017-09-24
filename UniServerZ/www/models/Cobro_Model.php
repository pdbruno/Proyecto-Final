<?php

class Cobro_Model extends Model {

  public function __construct() {
    parent::__construct();
  }

  public function traerSueldos() {
    echo json_encode($this->db->getInd('idCategorias', "SELECT idCategorias, MontoXBloque FROM `categoriassueldos`"));
  }


  public function updateAsistencias($data) {
    $sql = "UPDATE `asistencias` SET `Abonado`= 1 WHERE `idClientes` = ?i AND `idActividades` = ?i AND (`Fecha` BETWEEN ?s AND ?s)";
     $this->db->query($sql, $data['idClientes'], $data['idActividades'], $data['Fecha1'], $data['Fecha2']);
  }

  public function listado($tipo) {
    $sql = "SELECT actividadesaranceles.*, actividades.Nombre as actNombre, modalidades.Nombre as modNombre, modosdepago.Nombre as pagNombre
    FROM actividadesaranceles
    INNER JOIN modosdepago ON actividadesaranceles.idModosDePago = modosdepago.idModosDePago
    INNER JOIN actividades ON actividadesaranceles.idActividades = actividades.idActividades
    LEFT JOIN modalidades ON actividadesaranceles.idModalidades = modalidades.idModalidades
    GROUP BY idActividades, idModosDePago, idModalidades";
    $outp = $this->db->getAll($sql);
    echo json_encode($outp);
  }

  public function listarSueldos(){
    $sql = "SELECT categoriassueldos.idCategoriasSueldos, categorias.Nombre as catNombre, categoriassueldos.MontoXBloque
    FROM categoriassueldos
    LEFT JOIN categorias ON categoriassueldos.idCategorias = categorias.idCategorias";
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
