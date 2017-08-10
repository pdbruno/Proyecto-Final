<script>
var caca = [];
var Elementos = {
  Producto : document.getElementById("IdProductosForm"),
  Monto : document.getElementById("MontoForm"),
  Cantidad : document.getElementById("CantidadForm"),
  $Formu: $("#Formu"),
  inputs: ["IdProductos", "Cantidad", "Fecha", "Monto"],
  $tooltips: $('[data-toggle="tooltip"]'),
  $FechaForm: $('#FechaForm'),
};
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
document.getElementById("BtnAgregar").addEventListener("click", function() {
  lala();
  if (Elementos.Monto.value < 1 && Elementos.Monto.value.length != 0) {
    err("Monto");
  }
  if (Elementos.Cantidad.value < 1 && Elementos.Cantidad.value.length != 0) {
    err("Cantidad");
  }

  if (bien){
    let request = $.ajax({
      url: "<?php echo URL; ?>producto/registrarVenta",
      type: "post",
      data: "data=" + JSON.stringify(Elementos.$Formu.serializeArray()),
    });
    request.done(function (respuesta){
      let l = Elementos.inputs.length;
      for (var i = 0; i < l; i++) {
        Elementos[Elementos.inputs[i] + "Form"].value = '';
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

</script>
