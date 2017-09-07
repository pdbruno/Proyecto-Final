<?php
require_once 'controllers/calendar.php';
class actividad extends calendar {

  function __construct() {
    parent::__construct();
  }

  public function calendario() {
    $this->manejar("actividad","calendario");
    $this->view->render('calendario');
  }

  public function index() {
    $this->view->lista = URL . "actividad/listarElementos/Actividades";
    $this->view->titmodal ="Actividad";
    $this->view->th = "<th data-field='Nombre' data-sortable='true'>Nombre</th>";
    $this->view->modal2 = '<button type="button" id="idModalidadesVer" class="btn btn-link hidden" data-toggle="modal" data-target="#ModalVer">Ver modalidad/es</button>
    <div class="modal fade" tabindex="-1" role="dialog" id="ModalVer">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Modalidades</h4>
          </div>
          <div class="modal-body">
            <table class="table table-hover" >
              <thead>
                <tr>
                  <th>Modalidad</th>
                </tr>
              </thead>
              <tbody id="TablaModalidades">
              </tbody>
            </table>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" id="CerrarVer" >Close</button>
            </div>
          </div><!-- /.modal-content-->
        </div> <!--/.modal-dialog -->
      </div> <!--/.modal -->
    </div>
    <button type="button" id="idModalidadesSelect" class="btn btn-link hidden" data-toggle="modal" data-target="#ModalSel">Seleccionar modalidad/es</button>
    <div class="modal fade" tabindex="-1" role="dialog" id="ModalSel">
      <div class="modal-dialog" role="document" >
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Seleccionar modalidad/es</h4>
          </div>
          <div class="modal-body" id="Selec">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" id="deshacerModal" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-primary" id="aceptarModal">Aceptar</button>
          </div>
        </div>
      </div><!-- /.modal-content-->
    </div> <!--/.modal-dialog -->';
    $this->view->render2modales('abmactividades');
  }

  public function tomarlista() {
    $this->manejar("actividad","tomarlista");
    $this->view->render('tomarlista');
  }

  public function traerEventos() {
    $data = $_POST['data'];
    $data = json_decode($data, TRUE);
    $service = $this->getService();
    try {
      echo $this->model->traerEventos($data, $service);
    } catch (Exception $e) {
      $this->miCatch($e);
    }
  }

  public function asignarAsistencia()
  {
    $alumnos = json_decode($_POST['data'], TRUE);
    $id = trim($_POST['data2']);
    $fecha = trim($_POST['data4']);
    $profes = json_decode($_POST['data3'], TRUE);
    echo $this->model->asignarAsistencia($alumnos, $id, $fecha);
    echo $this->model->asignarProfes($profes, $id, $fecha);
  }
  public function traerAnotados() {
    $data = $_POST['data'];
    echo $this->model->traerAnotados($data);
  }

  public function agregarModificarActividad() {
    $caca = json_decode($_POST['data1'], TRUE);
    $modalidades = json_decode($_POST['data2'], TRUE);
    $this->model->agregarModificar('Actividades',$caca);
    $this->model->asignarModalidades($modalidades, $caca['idActividades']);
  }

  public function mostrar()
  {
    $service = $this->getService();
    $idActividades = $_POST['data'];
    try {
      echo $this->model->mostrar($idActividades, $service);
    } catch (Exception $e) {
      $this->miCatch($e);
    }
  }

  public function editarActividad() {
    $actividad = json_decode($_POST['data1'], TRUE);
    $evento = $this->model->format($actividad);
    $service = $this->getService();
    try {
      echo $this->model->editarEvento($evento, $actividad["idActividades"], $service);
    } catch (Exception $e) {
      $this->miCatch($e);
    }
  }
  public function addActividad() {
    $actividad = json_decode($_POST['data1'], TRUE);
    $evento = $this->model->format($actividad);
    $service = $this->getService();
    try {
      $this->model->agregarEvento($evento, $service);
    } catch (Exception $e) {
      $this->miCatch($e);
    }
  }

}
