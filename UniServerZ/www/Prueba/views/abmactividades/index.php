<link rel="stylesheet" href="<?php echo URL; ?>views/recursos/bootstrap-table/bootstrap-table.min.css">
<script src="<?php echo URL; ?>views/recursos/bootstrap-table/bootstrap-table.min.js"></script>
<script src="<?php echo URL; ?>views/recursos/bootstrap-table/bootstrap-table-es-AR.min.js"></script>
<div class="row">
  <div class="col-lg-6">
    <div class="panel panel-default">
      <div class="panel-heading">Listado de Actividades
      </div>
      <div class="table-responsive col-lg-12">
        <table  id="Tabla" class="table table-hover" data-toggle="table" data-url="<?php echo URL; ?>actividad/listarElementos/Actividades" data-search='true' cellspacing="0" width="100%"  >
          <thead>
            <tr>
              <th data-field="Nombre" data-sortable='true'>Nombre</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>
  <div id="Formu" class="col-lg-6" >
    <div class="panel panel-default">
      <ul class="list-group">
        <form class="form-horizontal">
          <li class="list-group-item">
            <div class="form-group">
              <label class="col-sm-2 control-label">Id:</label>
              <div class="col-sm-10">
                <p id="idActividades" class="form-control-static"></p>
                <input type="text" class="form-control hidden" id="idActividadesForm" placeholder="Se mira y no se toca" disabled>
              </div>
            </div>
          </li>
          <li class="list-group-item">
            <div class="form-group">

              <label class="col-sm-2 control-label">Nombre:</label>
              <div class="col-sm-10">
                <p id="Nombre" class="form-control-static"></p>
                <input type="text" class="form-control hidden" id="NombreForm" placeholder="Descripción">
              </div>

            </div>
          </li>
          <li class="list-group-item">

            <div class="form-group">
              <label class="col-sm-2 control-label">Modalidades:</label>
              <div class="col-sm-10">
                <button type="button" id="idModalidadesVer" class="btn btn-link hidden" data-toggle="modal" data-target="#ModalVer">Ver modalidad/es</button>

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
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                      </div><!-- /.modal-content-->
                    </div> <!--/.modal-dialog -->
                  </div> <!--/.modal -->
                </div>
                <button type="button" id="idModalidadesSelect" class="btn btn-link hidden" data-toggle="modal" data-target="#ModalSel">Seleccionar modalidad/es</button>

              </li>
              <li class="list-group-item">
                <div class="form-group">
                  <label class="col-sm-2 control-label">Se paga por clase:</label>
                  <div class="col-sm-10">
                    <p class="intro hidden" id="XClase"></p>
                    <input type="checkbox"class="checkbox hidden" id="XClaseForm" disabled>
                  </div>
                </div>
              </li>
              <li class="list-group-item">
                <div class="form-group">
                  <label class="col-sm-2 control-label">Se paga por mes:</label>
                  <div class="col-sm-10">
                    <p class="intro hidden" id="XMes"></p>
                    <input type="checkbox"class="checkbox hidden" id="XMesForm" disabled>
                  </div>
                </div>
              </li>
              <li class="list-group-item">
                <div class="form-group">
                  <label class="col-sm-2 control-label">Se paga por semestre:</label>
                  <div class="col-sm-10">
                    <p class="intro hidden" id="XSemestre"></p>
                    <input type="checkbox"class="checkbox hidden" id="XSemestreForm" disabled>
                  </div>
                </div>
              </li>
            </form>
          </ul>
        </div>
        <button type="button" id="BtnAgregar"  class="btn btn-default">Agregar</button>
        <button type="button" id="BtnModificar" class="btn btn-primary hidden">Modificar</button>
        <button type="button" id="BtnAceptar" class="btn btn-success hidden">Aceptar</button>
        <button type="button" id="BtnEliminar" class="btn btn-danger hidden">Eliminar</button>
      </div>
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
              <button type="button" class="btn btn-primary" id="aceptarModal"> Aceptar</button>
            </div>
          </div>
        </div><!-- /.modal-content-->
      </div> <!--/.modal-dialog -->
    </div>
    <script src="<?php echo URL; ?>views/recursos/logicaABM.js"></script>
    <?php require 'abmactividades.php' ?>
