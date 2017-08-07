<script>
var Elementos = {
  Producto : document.getElementById("IdProductosForm"),
  MontoInd : document.getElementById("MontoIndForm"),
  Cantidad : document.getElementById("CantidadForm"),
  $Formu: $("#Formu"),
  inputs: document.getElementById("Formu").getElementsByClassName("form-control"),
  $tooltips: $('[data-toggle="tooltip"]'),
  $FechaForm: $('#FechaForm')
};
document.getElementById("BtnAgregar").addEventListener("click", function() {
  if (Elementos.$FechaForm.val() === "" || Elementos.Producto.value == "" || Elementos.MontoInd.value == "" || Elementos.Cantidad.value == "" || Elementos.MontoInd.value < 1 || Elementos.Cantidad.value < 1)
  {
    alert("Por favor llene correctamente todos los campos");
  } else {
    var request = $.ajax({
      url: "<?php echo URL; ?>producto/registrarCompra",
      type: "post",
      data: "data=" + JSON.stringify(Elementos.$Formu.serializeArray()),

    });
    request.done(function (respuesta){
      for (var i = 0; i < Elementos.inputs.length; i++) {
        Elementos.inputs[i].value = '';
      }
    });
  }
});
Elementos.$tooltips.tooltip();
Elementos.$FechaForm.datepicker({
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
  url: "<?php echo URL; ?>producto/listarElementos/Productos",
  type: "post",
});
request.done(function (respuesta){
  var myObj = JSON.parse(respuesta);
  var txt = "";
  for (element in myObj) {
    txt += "<option value='" + myObj[element].idProductos + "'>" + myObj[element].Descripcion + "</option>";
  }
  Elementos.Producto.innerHTML += txt;
});
</script>
