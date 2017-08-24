<link href="<?php echo URL; ?>views/recursos/bootstrap-datepicker/css/bootstrap-datepicker3.standalone.min.css" rel="stylesheet">
<div class="row">
  <div class="col-lg-10 col-lg-offset-1">
    <form class="form-horizontal" id="Formu">
      <div class="form-group" id="FechaGroup">
        <label class="control-label hidden" id="FechaError">Campo obligatorio</label>
        <input type="text" class="form-control" id="FechaForm" name="FechaForm" placeholder="Fecha de la venta">
      </div>

      <div class="form-group" id="IdProductosGroup">
        <label class="control-label hidden" id="IdProductosError">Campo obligatorio</label>
        <select id="IdProductosForm" name="IdProductosForm" class="form-control">
          <option disabled hidden selected value> -- Seleccione un producto -- </option>
        </select>
      </div>

      <div class="form-group" id="MontoIndGroup">
        <label class="control-label hidden" id="MontoIndError">Campo obligatorio</label>
        <div class="input-group">
          <div class="input-group-addon">$</div>
          <input type="number" min="0" class="form-control" id="MontoIndForm" name="MontoForm" placeholder="Monto total" data-toggle="tooltip" title="Se puede modificar">
        </div>
      </div>

      <div class="form-group" id="CantidadGroup">
        <label class="control-label hidden" id="CantidadError">Campo obligatorio</label>
        <input type="number" min="1" value="1" class="form-control" id="CantidadForm"name="CantidadForm" placeholder="Cantidad">
      </div>
      <button type="button" id="BtnAgregar" class="btn btn-default">Registrar Venta</button>
    </form>
  </div>
</div>
<script src="<?php echo URL; ?>views/recursos/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo URL; ?>views/recursos/bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js" charset="UTF-8"></script>
