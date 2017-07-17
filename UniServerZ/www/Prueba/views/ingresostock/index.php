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
      <button type="button" id="BtnAgregar" onclick="Agregar()" class="btn btn-default">Registrar Ingreso de Stock</button>
    </form>
  </div>
</div>
<script>
$( document ).ajaxError(function(e, xhr, opt){
  alert("Error requesting " + opt.url + ": " + xhr.status + " " + xhr.statusText);
});
$('[data-toggle="tooltip"]').tooltip();
$('#FechaForm').datepicker({
  format: "yyyy/mm/dd",
  startDate: "01/01/2017",
  endDate: "today",
  maxViewMode: 0,
  todayBtn: "linked",
  language: "es",
  autoclose: true,
  todayHighlight: true,
  forceParse: false
});
var request = $.ajax({
  url: "<?php echo URL; ?>producto/listadoProductos",
  type: "post",
});
request.done(function (respuesta){
  var myObj = JSON.parse(respuesta);
  var txt = "";
  for (element in myObj) {
    txt += "<option value='" + myObj[element].idProductos + "'>" + myObj[element].Descripcion + "</option>";
  }
  document.getElementById("IdProductosForm").innerHTML += txt;
}

function Agregar() {
  var Fecha = document.getElementById("FechaForm").value;
  var Producto = document.getElementById("IdProductosForm").value;
  var MontoInd = document.getElementById("MontoIndForm").value;
  var Cantidad = document.getElementById("CantidadForm").value;
  if (Fecha === "" || Producto == "" || MontoInd == "" || Cantidad == "" || MontoInd < 1 || Cantidad < 1)
  {
    alert("Llenar todos los campos correctamente");
  } else {
    var request = $.ajax({
      url: "<?php echo URL; ?>producto/registrarCompra",
      type: "post",
      data: "data=" + JSON.stringify($("#Formu").serializeArray()),

    });
    request.done(function (respuesta){
      var x = document.getElementById("Formu").getElementsByClassName("form-control");
      for (var i = 0; i < x.length; i++) {
        x[i].value = '';
      }
    }
    var url = "<?php echo URL; ?>producto/registrarCompra";

  }
}

</script>
