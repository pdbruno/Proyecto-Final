<script type="text/javascript">
var Elementos = {
  Producto : document.getElementById("IdProductosForm"),
  MontoInd : document.getElementById("MontoIndForm"),
  Cantidad : document.getElementById("CantidadForm"),
  $Formu: $("#Formu"),
  inputs: ["IdProductos", "Cantidad", "Fecha", "MontoInd"],
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
    txt += "<option value='" + myObj[element].idProductos + "'>" + myObj[element].Descripcion + "</option>";
  }
  Elementos.Producto.innerHTML += txt;
});
document.getElementById("BtnAgregar").addEventListener("click", function() {
  lala();
  if (Elementos.MontoInd.value < 1 && Elementos.MontoInd.value.length != 0) {
    err("Monto");
  }
  if (Elementos.Cantidad.value < 1 && Elementos.Cantidad.value.length != 0) {
    err("Cantidad");
  }

  if (bien){
    let request = $.ajax({
      url: "<?php echo URL; ?>producto/registraCompra",
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

</script>
