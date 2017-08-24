<script>
var select;
var request = $.ajax({
  url: "<?php echo URL; ?>actividad/tabla/egresos",
  type: "post",
});
request.done(function (respuesta){
  let myObj = JSON.parse(respuesta);
  crearCampos(myObj);
  select = document.getElementById("idFuentesDeEgresosSelect");
  select.innerHTML += "<option onclick='addOpt()'>+Agregar</option>";
  modoFormulario("Agregar");
});
function addOpt(){
  let nuevaopcion = prompt("Ingrese la nueva opción");
  if (nuevaopcion != null) {
    var request = $.ajax({
      url: "<?php echo URL; ?>help/agregarModificarElemento/FuentesDeEgresos",
      type: "post",
      data: "data=" + JSON.stringify({Nombre : nuevaopcion}),
    });
    request.done(function (respuesta){
      select.innerHTML = "";
      hacemeUnDropdown("idFuentesDeEgresos", select);
      select.innerHTML += "<option onclick='addOpt()'>+Agregar</option>";
    });
  }
}
document.getElementById("BtnAgregar").addEventListener("click", function() {
  let vec = beforeEnviar();
  if (vec != 'no') {
    let request = $.ajax({
      url: "<?php echo URL; ?>help/agregarModificarElemento/Egresos",
      type: "post",
      data: "data=" + JSON.stringify(vec),
    });
    request.done(function (respuesta){
      modoFormulario("Agregar");
    });
  }
});

</script>
<script src="<?php echo URL; ?>views/recursos/stock.js"></script>
