<link href="<?php echo URL; ?>views/recursos/bootstrap-datepicker/css/bootstrap-datepicker3.standalone.min.css" rel="stylesheet">
<div class="modal fade" tabindex="-1" role="dialog" id="ModalPropiedades">
  <div class="modal-dialog modal-lg" role="document" >
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><?php echo $this->titmodal;?></h4>
        <?php echo $this->modal2;?>
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
<script src="<?php echo URL; ?>views/recursos/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo URL; ?>views/recursos/bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js" charset="UTF-8"></script>
<script src="<?php echo URL; ?>views/recursos/bootstrap-table/bootstrap-table.min.js"></script>
<script src="<?php echo URL; ?>views/recursos/bootstrap-table/bootstrap-table-es-AR.min.js"></script>
