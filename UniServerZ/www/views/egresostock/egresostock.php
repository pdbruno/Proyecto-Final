<script>
var caca = [];
var Elementos = {};
var request = $.ajax({
  url: "<?php echo URL; ?>producto/listadoPrecio/",
  type: "post",
});
request.done(function (respuesta){
  var myObj = JSON.parse(respuesta);
  for (element in myObj) {
    caca.push(myObj[element].Precio);
  }
});
var request = $.ajax({
  url: "<?php echo URL; ?>producto/tabla/registroventas",
  type: "post",
});
request.done(function (respuesta){
  let myObj = JSON.parse(respuesta);
  crearCampos(myObj);
  Elementos.Producto = document.getElementById("idProductosSelect");
  Elementos.Monto = document.getElementById("MontoForm");
  Elementos.Cantidad = document.getElementById("CantidadForm");
  Elementos.Cantidad.addEventListener("input", function() {
    if (Elementos.Cantidad.value == 0) {
      Elementos.Monto.value = caca[Elementos.Producto.selectedIndex-1]
    }else {
      Elementos.Monto.value = caca[Elementos.Producto.selectedIndex-1] * Elementos.Cantidad.value;
    }
  });
  Elementos.Producto.addEventListener("input", function() {
    Elementos.Monto.value = caca[Elementos.Producto.selectedIndex-1];
  });
  modoFormulario("Agregar");
});
document.getElementById("BtnAgregar").addEventListener("click", function() {
  let vec = beforeEnviar();
  vec['Cantidad'] -= 2 * vec['Cantidad'];
  if (vec != 'no') {
    let request = $.ajax({
      url: "<?php echo URL; ?>producto/agregarRegistro/RegistroVentas",
      type: "post",
      data: "data=" + JSON.stringify(vec),
    });
    request.done(function (respuesta){
      if (respuesta != "") {
        alert(respuesta);
      }
      modoFormulario("Agregar");
    });
  }
});

</script>
<script src="<?php echo URL; ?>views/recursos/stock.js"></script>
