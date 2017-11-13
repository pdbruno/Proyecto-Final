<?php

class Cliente extends Controller {

  public function __construct() {
    parent::__construct();
  }

  function registroexamen() {
    $this->checkRol(2);
    $this->view->titpag = "Registrar Obtención de Categoría";
    $this->view->tit = "Registrar Obtención de Categoría";
    $this->view->lista = URL . "cliente/listarElementos/Clientes";
    $this->view->th = "<th data-field='Nombres' data-sortable='true'>Nombres</th><th data-field='Apellidos' data-sortable='true'>Apellidos</th>";
    $this->view->renderTabla('examen');
  }


  public function planillitaEsteban() {
    $this->checkRol(2);
    $this->view->titpag = "Exámenes de Cinturones Negros";
    $this->view->tit = "Exámenes de Cinturones Negros";
    $this->view->th = "
    <th>Nombre</th>
    <th>Último Examen</th>
    <th>Próximo Examen</th>";
    $this->view->renderTempSimple('planillitaEsteban', 'tablatonta');
  }

  public function listadoPlanillitaEsteban() {
    $this->model->listadoPlanillitaEsteban();
  }

  public function posponerExamen() {
    $idClientes = $_POST['data'];
    $this->model->posponerExamen($idClientes);
  }

  public function registrarExamen() {
    $this->checkRol(2);
    $data = json_decode($_POST['data'], TRUE);
    $this->model->agregarModificar('RegistroExamenes', $data);
    $this->model->updateCategoria($data);
  }

  public function actCliente() {
    $idClientes = $_POST['data'];
    echo json_encode($this->model->actCliente($idClientes));
  }
  public function listadoInstructores() {
    $this->model->listadoInstructores();
  }

  public function cantidadBloques() {
    $this->checkRol(2);
    $idClientes = $_POST['data1'];
    $mes = $_POST['data2'];
    $this->model->cantidadBloques($idClientes, $mes);
  }

  public function agregarModificarCliente() {
    $this->checkRol(2);
    $cliente = json_decode($_POST['data1'], TRUE);
    $actividades = json_decode($_POST['data2'], TRUE);
    $this->model->agregarModificar('Clientes', $cliente);
    $this->model->asignarActividades($actividades, $cliente['idClientes']);
  }
  function index() {
    $this->checkRol(2);
    $this->view->titpag = "Clientes";
    $this->view->lista = URL . "cliente/listarElementos/Clientes";
    $this->view->titmodal ="Cliente";
    $this->view->th = "<th data-field='Nombres' data-sortable='true'>Nombres</th><th data-field='Apellidos' data-sortable='true'>Apellidos</th>";
    $this->view->modal2 = '<button type="button" id="idActividadesVer" class="btn btn-link hidden" data-toggle="modal" data-target="#ModalVer">Ver actividad/es</button>
    <div class="modal fade" tabindex="-1" role="dialog" id="ModalVer" data-backdrop="false">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header">
    <button type="button" class="close CerrarVer" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">Actividades</h4>
    </div>
    <div class="modal-body">
    <table class="table table-hover" >
    <thead>
    <tr>
    <th>Actividad</th>
    <th>Modo de Pago</th>
    <th>Modalidad</th>
    </tr>
    </thead>
    <tbody id="TablaActividades">
    </tbody>
    </table>
    <div class="modal-footer">
    <button type="button" class="btn btn-default CerrarVer">Cerrar</button>
    </div>
    </div><!-- /.modal-content-->
    </div> <!--/.modal-dialog -->
    </div> <!--/.modal -->
    </div>

    <button type="button" id="idActividadesSelect" class="btn btn-link hidden" data-toggle="modal" data-target="#ModalSel">Seleccionar actividad/es</button>

    <div class="modal fade" tabindex="-1" role="dialog" id="ModalSel" data-backdrop="false">
    <div class="modal-dialog" role="document" >
    <div class="modal-content" >
    <div class="modal-header">
    <button type="button" class="close deshacerModal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">Seleccionar actividad/es</h4>
    </div>
    <div class="modal-body">
    <div class="col-lg-4">
    <h5>Actividad</h5>
    </div>
    <div class="col-lg-4">
    <h5>Modo de Pago</h5>
    </div>
    <div class="col-lg-4">
    <h5>Modalidad</h5>
    </div>
    <div id="Selec">
    </div>
    </div>
    <div class="modal-footer">
    <button type="button" class="btn btn-default deshacerModal" >Cancelar</button>
    <button type="button" class="btn btn-primary" id="aceptarModal"> Aceptar</button>
    </div>
    </div>
    </div><!-- /.modal-content-->
    </div> <!--/.modal-dialog -->';
    $this->view->render2modales('abmclientes');
  }

}
