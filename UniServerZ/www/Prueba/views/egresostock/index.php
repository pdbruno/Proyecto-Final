<script src="<?php echo URL; ?>views/recursos/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo URL; ?>views/recursos/bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js" charset="UTF-8"></script>
<link href="<?php echo URL; ?>views/recursos/bootstrap-datepicker/css/bootstrap-datepicker3.standalone.min.css" rel="stylesheet">
<div class="col-lg-10 col-lg-offset-1" style="padding-top: 200px">
  <div class="row">
    <form class="form-inline" id="Formu">
      <div class="form-group">
        <label class="sr-only" for="FechaForm">Fecha de la venta</label>
        <input type="text" class="form-control" id="FechaForm" name="FechaForm" placeholder="Fecha de la venta">
      </div>
      <div class="form-group">
        <label class="sr-only" for="IdProductosForm">Producto</label>
        <select id="IdProductosForm" name="IdProductosForm" class="form-control">
          <option disabled hidden selected value> -- Seleccione un producto -- </option>
        </select>
      </div>
      <label class="sr-only" for="MontoForm">Monto total</label>
      <div class="input-group">
        <div class="input-group-addon">$</div>
        <input type="number" min="0" class="form-control" id="MontoForm" name="MontoForm" placeholder="Monto total" data-toggle="tooltip" title="Se puede modificar">
      </div>
      <div class="form-group">
        <label class="sr-only" for="CantidadForm">Cantidad</label>
        <input type="number" min="1" value="1" class="form-control" id="CantidadForm"name="CantidadForm" placeholder="Cantidad">
      </div>
      <button type="button" id="BtnAgregar" class="btn btn-default">Registrar Venta</button>
    </form>
  </div>
</div>

<?php require 'egresostock.php' ?>
