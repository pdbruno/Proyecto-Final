<link rel="stylesheet" href="<?php echo URL; ?>views/recursos/bootstrap-table/bootstrap-table.min.css">
<div class="row">
  <div class="col-lg-4 col-lg-offset-3">
    <select class="form-control" id="SelectTabla">
      <option disabled selected value>Elija una tabla</option>
    </select>
  </div>
  <div class="col-lg-10 col-lg-offset-1 hidden" id="TodoLoDemas">
    <div class="table-responsive col-lg-12">
      <table  id="Tabla" class="table table-hover" cellspacing="0" width="100%"  >
        <thead>
          <tr>
            <th data-field="COLUMN_NAME" data-sortable='true'>Nombre del campo</th>
            <th data-field="COLUMN_COMMENT" data-sortable='true'>Nombre posssta</th>
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
        <div class="modal-body" >
          <div class="panel panel-default" style="height: 50vh; overflow-y: scroll;">
            <ul class="list-group">
              <form class="form-horizontal" id="Formu">
              </form>
            </ul>
          </div>
          <button type="button" id="BtnModificar" class="btn btn-primary hidden">Modificar</button>
          <button type="button" id="BtnAceptar" class="btn btn-success hidden">Aceptar</button>
        </div>
      </div>
    </div><!-- /.modal-content-->
  </div> <!--/.modal-dialog -->
</div>
<script src="<?php echo URL; ?>views/recursos/bootstrap-table/bootstrap-table.min.js"></script>
<script src="<?php echo URL; ?>views/recursos/bootstrap-table/bootstrap-table-es-AR.min.js"></script>
