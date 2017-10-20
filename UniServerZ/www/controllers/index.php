<?php
class Index extends Controller {
  function __construct() {
    parent::__construct();
  }

  public function descartarexceso()
  {
    $this->model->descartarexceso($_POST['data']);
  }

  function index() {
    $this->view->titpag = "Home Sistema BBG";
    $this->view->render('inicio');
  }

  function corteProd()
  {
    $sql = $this->model->between(json_decode($_POST['data'], TRUE));
    $this->model->productosVentas($sql);
    $this->model->productosGanancias($sql);
  }

  function graficoSexoActividad()
  {
    $id = $_POST['data'];
    $this->model->graficoSexoActividad($id);
  }

  function graficoEdadActividad()
  {
    $id = $_POST['data'];
    $this->model->graficoEdadActividad($id);
  }

  public function finanzasEgresosTotal($idFondos, $sql){
    $egtot = $this->model->finanzasEgresosTotal($idFondos, $sql);
    $egtot['Egreso Total']['Total'] = 0;
    foreach ($egtot as $entrada) {
      $egtot['Egreso Total']['Total'] += (int) $entrada['Total'];
    }
    return $egtot;
  }

  public function finanzasIngresosTotal($idFondos, $sql){
    $intot = $this->model->finanzasIngresosTotal($idFondos, $sql);
    $intot['Ingreso Total']['Total'] = 0;
    foreach ($intot as $entrada) {
      $intot['Ingreso Total']['Total'] += (int) $entrada['Total'];
    }
    return $intot;
  }
  public function mesesFondos(){
    try {
      $fondos = $this->model->traerFondos();
      $fechas = $this->fecha();
      $final = [];
        for ($j=0; $j < count($fechas); $j++) {
          $outp['Fecha'] = $fechas[$j]['Fecha2'];
          $sql = $this->model->between($fechas[$j]);
          for ($i=0; $i < count($fondos); $i++) {
            $egtot = $this->finanzasEgresosTotal($fondos[$i]['idFondos'], $sql);
            $intot = $this->finanzasIngresosTotal($fondos[$i]['idFondos'], $sql);
            $outp[$fondos[$i]['Nombre']] = $intot['Ingreso Total']['Total'] - $egtot['Egreso Total']['Total'];
        }
        $final[] = $outp;
      }
      echo json_encode([$final, array_column($fondos, 'Nombre')]);
    } catch (Exception $e) {
      var_dump($e);
    }


  }
  public function fecha(){
    $outp = [];
    $fecha1 = date_create(date("Y")."-01-01");
    $fecha1Formateada = date_format($fecha1,"Y-m-d");
    $UnMes = new DateInterval("P1M");
    $fecha2 = clone($fecha1);
    for ($j=0; $j < date("m"); $j++) {
      $date = [];
      date_add($fecha2 , $UnMes);
      $date['Fecha1'] = $fecha1Formateada;
      $date['Fecha2'] = date_format($fecha2,"Y-m-d");
      $outp[] = $date;
    }
    return $outp;
  }
  function finanzas()
  {
    $idFondos = $_POST['idFondos'];
    $sql = $this->model->between(json_decode($_POST['data'], TRUE));
    $eg = $this->model->finanzasEgresos($idFondos, $sql);
    $in = $this->model->finanzasIngresos($idFondos, $sql);
    $bal = $this->model->finanzasBalance($idFondos, $sql);
    $egtot = $this->finanzasEgresosTotal($idFondos, $sql);
    $intot = $this->finanzasIngresosTotal($idFondos, $sql);
    echo json_encode([$eg, $in, $bal, $egtot, $intot]);
  }
  function porcentajeAsistencias()
  {
    $mes = $_POST['data'];
    $this->model->porcentajeAsistencias($mes);
  }
  function morososMatricula()
  {
    $this->model->morososMatricula();
  }
  function productosVentas()
  {
    $this->model->productosVentas();
  }
  function productosGanancias()
  {
    $this->model->productosGanancias();
  }
  function morososExceso()
  {
    $mes = $_POST['data'];
    $this->model->morososExceso($mes);
  }
  function morososActividad()
  {
    $this->model->morososActividad();
  }
}
