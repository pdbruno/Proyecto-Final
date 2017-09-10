<?php

//namespace Controllers;
//
//use Models\Cliente as Cliente;

class cliente extends Controller {

  public function actCliente() {
    $idClientes = $_POST['data'];
    echo json_encode($this->model->actCliente($idClientes));
  }
  public function agregarModificarCliente() {
    $cliente = json_decode($_POST['data1'], TRUE);
    $actividades = json_decode($_POST['data2'], TRUE);
    $this->model->agregarModificar('Clientes', $cliente);
    $this->model->asignarActividades($actividades);
  }
  function index() {
      $this->view->lista = URL . "cliente/listarElementos/Clientes";
      $this->view->titmodal ="Cliente";
      $this->view->th = "<th data-field='Nombres' data-sortable='true'>Nombres</th><th data-field='Apellidos' data-sortable='true'>Apellidos</th>";
      $this->view->modal2 = '<button type="button" id="IdActividadesVer" class="btn btn-link hidden" data-toggle="modal" data-target="#ModalVer">Ver actividad/es</button>
      <div class="modal fade" tabindex="-1" role="dialog" id="ModalVer">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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
                <button type="button" class="btn btn-default" id="CerrarVer" >Cerrar</button>
              </div>
            </div><!-- /.modal-content-->
          </div> <!--/.modal-dialog -->
        </div> <!--/.modal -->
      </div>

      <button type="button" id="IdActividadesSelect" class="btn btn-link hidden" data-toggle="modal" data-target="#ModalSel">Seleccionar actividad/es</button>

      <div class="modal fade" tabindex="-1" role="dialog" id="ModalSel">
        <div class="modal-dialog" role="document" >
          <div class="modal-content" >
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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
              <button type="button" class="btn btn-default" id="deshacerModal" data-dismiss="modal">Cancelar</button>
              <button type="button" class="btn btn-primary" id="aceptarModal"> Aceptar</button>
            </div>
          </div>
        </div><!-- /.modal-content-->
      </div> <!--/.modal-dialog -->';
      $this->view->render2modales('abmclientes');
  }
  public function __construct() {
    parent::__construct();
  }

}
