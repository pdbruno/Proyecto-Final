<script src="<?php echo URL; ?>views/recursos/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo URL; ?>views/recursos/bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js" charset="UTF-8"></script>
<link href="<?php echo URL; ?>views/recursos/bootstrap-datepicker/css/bootstrap-datepicker3.standalone.min.css" rel="stylesheet">
<div class="col-lg-11 col-lg-offset-1" style="padding-top: 200px">
  <div class="row">
    <form class="form-inline" id="Formu">
      <div class="form-group">
        <label class="sr-only" for="FechaForm">Fecha de la compra</label>
        <input type="text" class="form-control" id="FechaForm" name="FechaForm" placeholder="Fecha de la compra">
      </div>
      <div class="form-group">
        <label class="sr-only" for="IdProductosForm">Producto</label>
        <select id="IdProductosForm" value ="" name="IdProductosForm" class="form-control">
          <option disabled hidden selected value> -- Seleccione un producto -- </option>
        </select>
      </div>
      <label class="sr-only" for="MontoIndForm">Valor individual</label>
      <div class="input-group">
        <span class="input-group-addon">$</span>
        <input type="number" min="0" class="form-control" id="MontoIndForm"name="MontoIndForm" placeholder="Monto individual" data-toggle="tooltip" title="Dividir el valor total de la compra por la cantidad de productos">
      </div>
      <div class="form-group">
        <label class="sr-only" for="CantidadForm">Cantidad</label>
        <input type="number" min="1" class="form-control" id="CantidadForm"name="CantidadForm" placeholder="Cantidad">
      </div>
      <button type="button" id="BtnAgregar"  class="btn btn-default">Registrar Ingreso de Stock</button>
    </form>
  </div>
</div>
<?php require 'ingresostock.php' ?>
