<script src="<?php echo URL; ?>views/recursos/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo URL; ?>views/recursos/bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js" charset="UTF-8"></script>
<link href="<?php echo URL; ?>views/recursos/bootstrap-datepicker/css/bootstrap-datepicker3.standalone.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo URL; ?>views/recursos/bootstrap-table/bootstrap-table.min.css">
<script src="<?php echo URL; ?>views/recursos/bootstrap-table/bootstrap-table.min.js"></script>
<script src="<?php echo URL; ?>views/recursos/bootstrap-table/bootstrap-table-es-AR.min.js"></script>
<div class="row" style="height:100%;">
  
  <div class="col-lg-12">
    <div class="col-lg-10 col-lg-offset-1">
      <table  id="Tabla" class="table table-hover" data-toggle="table" data-url="<?php echo URL; ?>cliente/listarElementos/Clientes" data-search='true' cellspacing="0" width="100%"  >
        <thead>
          <tr>
            <th data-field="Nombres" data-sortable='true'>Nombres</th>
            <th data-field="Apellidos" data-sortable='true'>Apellidos</th>
          </tr>
        </thead>
      </table>
      <button type="button" id="BtnAgregar"  class="btn btn-default">Agregar</button>
    </div>
  </div>
</div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="ModalPropiedades">
  <div class="modal-dialog modal-lg" role="document" >
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Cliente</h4>
        <button type="button" id="IdActividadesVer" class="btn btn-link hidden" data-toggle="modal" data-target="#ModalVer">Ver actividad/es</button>

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
                      <th>Modalidad</th>
                    </tr>
                  </thead>
                  <tbody id="TablaActividades">
                  </tbody>
                </table>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" id="CerrarVer" >Close</button>
                </div>
              </div><!-- /.modal-content-->
            </div> <!--/.modal-dialog -->
          </div> <!--/.modal -->
        </div>

        <button type="button" id="IdActividadesSelect" class="btn btn-link hidden" data-toggle="modal" data-target="#ModalSel">Seleccionar actividad/es</button>

        <div class="modal fade" tabindex="-1" role="dialog" id="ModalSel">
          <div class="modal-dialog" role="document" >
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Seleccionar actividad/es</h4>
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

        <div class="modal-body" >
          <div class="panel panel-default" style="height: 50vh; overflow-y: scroll;">
            <ul class="list-group">
              <form class="form-horizontal" id="Formu">

              </form>
            </ul>
          </div>
          <button type="button" id="BtnModificar" class="btn btn-primary hidden">Modificar</button>
          <button type="button" id="BtnAceptar" class="btn btn-success hidden">Aceptar</button>
          <button type="button" id="BtnEliminar" data-dismiss="modal" class="btn btn-danger hidden">Eliminar</button>
        </div>
      </div>
    </div><!-- /.modal-content-->
  </div> <!--/.modal-dialog -->
  <script src="<?php echo URL; ?>views/recursos/logicaABM.js"></script>
  <?php require 'abmclientes.php' ?>
