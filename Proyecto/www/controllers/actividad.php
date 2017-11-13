<?php
require_once 'controllers/calendar.php';
class Actividad extends Calendar {

  function __construct() {
    parent::__construct();
  }

  public function calendario() {
    $this->checkRol(2);
    $this->manejar("actividad","calendario");
    $this->view->titpag = "Calendario";
    $this->view->lista = URL . "actividad/listarElementos/Actividades";
    $this->view->th = "<th data-field='Nombre' data-sortable='true'>Nombre</th>";
    $this->view->renderTabla('calendario');
  }

  public function index() {
    $this->checkRol(2);
    $this->view->titpag = "Actividades";
    $this->view->lista = URL . "actividad/listarElementos/Actividades";
    $this->view->titmodal ="Actividad";
    $this->view->th = "<th data-field='Nombre' data-sortable='true'>Nombre</th>";
    $this->view->modal2 = '<button type="button" id="idSubactividadesVer" class="btn btn-link hidden" data-toggle="modal" data-target="#ModalVer">Ver subactividades</button>
    <div class="modal fade" tabindex="-1" role="dialog" id="ModalVer" data-backdrop="false">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header">
    <button type="button" class="close CerrarVer" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">Subactividades</h4>
    </div>
    <div class="modal-body">
    <table class="table table-hover" >
    <thead>
    <tr>
    <th>Subactividad</th>
    </tr>
    </thead>
    <tbody id="TablaSubactividades">
    </tbody>
    </table>
    <div class="modal-footer">
    <button type="button" class="btn btn-default CerrarVer">Cerrar</button>
    </div>
    </div><!-- /.modal-content-->
    </div> <!--/.modal-dialog -->
    </div> <!--/.modal -->
    </div>
    <button type="button" id="idSubactividadesSelect" class="btn btn-link hidden" data-toggle="modal" data-target="#ModalSel">Seleccionar subactividades</button>
    <div class="modal fade" tabindex="-1" role="dialog" id="ModalSel" data-backdrop="false">
    <div class="modal-dialog" role="document" >
    <div class="modal-content">
    <div class="modal-header">
    <button type="button" class="close deshacerModal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">Seleccionar subactividades</h4>
    </div>
    <div class="modal-body">
    <div class="col-lg-12">
    <h5>Subactividad</h5>
    </div>
    <div id="Selec">
    </div>
    </div>
    <div class="modal-footer">
    <button type="button" class="btn btn-default deshacerModal" >Cancelar</button>
    <button type="button" class="btn btn-primary" id="aceptarModal">Aceptar</button>
    </div>
    </div>
    </div><!-- /.modal-content-->
    </div> <!--/.modal-dialog -->';
    $this->view->render2modales('abmactividades');
  }

  public function tomarlista() {
    
    $this->manejar("actividad","tomarlista");
    $this->view->titpag = "Tomar Lista";
    $this->view->render('tomarlista');
  }

  public function traerEventos() {

    $data = json_decode($_POST['data'], TRUE);
    try {
      $cals = $this->model->listCals($this->getService());
      $outp = [];
      for ($i=0; $i < count($cals); $i++) {
        $ev = $this->model->traerEventos($data, $this->getService(), $cals[$i]);
        for ($j=0; $j < count($ev); $j++) {
          $outp[] = $ev[$j];
        }
      }
      echo json_encode($outp);
    } catch (Exception $e) {
      $this->miCatch($e);
    }
  }

  public function asignarAsistencia()
  {

    $alumnos = json_decode($_POST['data'], TRUE);
    $id = trim($_POST['data2']);
    $fecha = trim($_POST['data4']);
    $idEvento = trim($_POST['data5']);
    $profes = json_decode($_POST['data3'], TRUE);
    echo $this->model->asignarAsistencia($alumnos, $id, $fecha, $idEvento);
    echo $this->model->asignarProfes($profes, $id, $fecha);
  }
  public function traerAnotados() {

    $idActividades = $_POST['data'];
    $Fecha = $_POST['data2'];
    $this->model->traerAnotados($idActividades, $Fecha);
  }

  public function traerInstructores() {

    $this->model->traerInstructores();
  }

  public function agregarModificarActividad() {
    $this->checkRol(2);
    $caca = json_decode($_POST['data1'], TRUE);
    $subactividades = json_decode($_POST['data2'], TRUE);
    $this->model->agregarModificar('Actividades',$caca);
    if (count($subactividades) > 0) {
      $this->model->asignarSubactividades($subactividades, $caca['idActividades']);
    }
  }

  public function traerEvento()
  {
    $this->checkRol(2);
    $idActividades = $_POST['data'];
    $Nombre = $_POST['data2'];
    $sub = $this->model->traerSubactividades($idActividades);
    $idCalendario = $this->model->traeridCalendario($idActividades);

    try {

      if (count($sub)>0 && $idCalendario == 'primary') {
        $idCalendario = $this->model->crearCalendario($Nombre, $this->getService());
        $this->model->asignarCalendario($idActividades, $idCalendario);
      }

      if (count($sub) == 0) {
        echo json_encode([$this->model->traerEvento($idActividades, $this->getService()), $idCalendario]);
      } else {
        $eventos = $this->model->traerCalendario($idCalendario, $this->getService());
        $sub = array_fill_keys($sub, null);
        if ($eventos != 'no papu') {
          $outp = [];
          foreach ($sub as $key => $value) {
            for ($j=0; $j < count($eventos); $j++) {
              if ($key == $eventos[$j]['Nombre']) {
                $sub[$key] = $eventos[$j];
              }
            }
          }
        }
        echo json_encode([$sub, $idCalendario]);
      }
    } catch (Exception $e) {
      $this->miCatch($e);
    }
  }

  public function editarEvento() {
    $this->checkRol(2);
    $actividades = json_decode($_POST['data'], TRUE);
    $idCalendario = $_POST['data2'];
    try {
      for ($i=0; $i < count($actividades); $i++) {
        $this->model->setidEvento($actividades[$i]);
        $evento = $this->model->setFormat($actividades[$i]);
        $this->model->editarEvento($evento, $this->getService(), $idCalendario);
      }
    } catch (Exception $e) {
      $this->miCatch($e);
    }
  }
  public function addEvento() {
    $this->checkRol(2);
    $idCalendario = $_POST['data2'];
    $actividades = json_decode($_POST['data'], TRUE);
    try {
      for ($i=0; $i < count($actividades); $i++) {
        $evento = $this->model->setFormat($actividades[$i]);
        $this->model->agregarEvento($evento, $this->getService(), $idCalendario);
      }
    } catch (Exception $e) {
      $this->miCatch($e);
    }
  }

}
