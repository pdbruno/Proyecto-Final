<link rel="stylesheet" href="<?php echo URL; ?>views/recursos/bootstrap-table/bootstrap-table.min.css">
<div class="row">
  <div class="col-lg-10 col-lg-offset-1">
    <div class="table-responsive col-lg-12">
      <table  id="Tabla" class="table table-hover" data-toggle="table" data-url="<?php echo URL; ?>actividad/listarElementos/Actividades" data-search='true' cellspacing="0" width="100%"  >
        <thead>
          <tr>
            <th data-field="Nombre" data-sortable='true'>Nombre</th>
          </tr>
        </thead>
      </table>
      <button type="button" id="BtnAgregar"  class="btn btn-default">Agregar</button>
    </div>
  </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="ModalPropiedades">
  <div class="modal-dialog modal-lg" role="document" >
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Actividad</h4>
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
</div>
<script src="<?php echo URL; ?>views/recursos/bootstrap-table/bootstrap-table.min.js"></script>
<script src="<?php echo URL; ?>views/recursos/bootstrap-table/bootstrap-table-es-AR.min.js"></script>
