<script>
var caca = [];
var Elementos = {
  Producto : document.getElementById("IdProductosForm"),
  Monto : document.getElementById("MontoForm"),
  Cantidad : document.getElementById("CantidadForm"),
  $Formu: $("#Formu"),
  inputs: document.getElementById("Formu").getElementsByClassName("form-control"),
  $tooltips: $('[data-toggle="tooltip"]'),
  $FechaForm: $('#FechaForm')
};
document.getElementById("BtnAgregar").addEventListener("click", function() {
  if (Elementos.$FechaForm.val() === "" || Elementos.Producto.value == "" || Elementos.Monto.value == "" || Elementos.Cantidad.value == "" || Elementos.Monto.value < 1 || Elementos.Cantidad.value < 1)
  {
    alert("Por favor llene correctamente todos los campos");
  } else {
    var request = $.ajax({
      url: "<?php echo URL; ?>producto/registrarCompra",
      type: "post",
      data: "data=" + JSON.stringify(Elementos.$Formu.serializeArray()),

    });
    request.done(function (respuesta){
      let l = Elementos.inputs.length;
      for (var i = 0; i < l; i++) {
        Elementos.inputs[i].value = '';
      }
    });
  }
});
Elementos.Cantidad.addEventListener("input", function() {
  Elementos.Monto.value = caca[Elementos.Producto.selectedIndex-1] * Elementos.Cantidad.value;
});
Elementos.Producto.addEventListener("input", function() {
  Elementos.Monto.value = caca[Elementos.Producto.selectedIndex-1];
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
    caca.push(myObj[element].Precio);
    txt += "<option value='" + myObj[element].idProductos + "'>" + myObj[element].Descripcion + "</option>";
  }
  Elementos.Producto.innerHTML += txt;
});
</script>
