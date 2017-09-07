<link rel="stylesheet" href="<?php echo URL; ?>views/recursos/bootstrap-table/bootstrap-table.min.css">
<link href="<?php echo URL; ?>views/recursos/bootstrap-datepicker/css/bootstrap-datepicker3.standalone.min.css" rel="stylesheet">
<div class="row">
  <div class="col-lg-10 col-lg-offset-1">
    <div class="table-responsive col-lg-12">
      <table  id="Tabla" class="table table-hover" data-toggle="table" data-url="<?php echo $this->lista;?>" data-search='true' cellspacing="0" width="100%"  >
        <thead>
          <tr>
            <?php echo $this->th;?>
          </tr>
        </thead>
      </table>
      <button type="button" id="BtnAgregar"  class="btn btn-default">Agregar</button>
    </div>
  </div>
</div>

<script src="<?php echo URL; ?>views/recursos/bootstrap-table/bootstrap-table.min.js"></script>
<script src="<?php echo URL; ?>views/recursos/bootstrap-table/bootstrap-table-es-AR.min.js"></script>
