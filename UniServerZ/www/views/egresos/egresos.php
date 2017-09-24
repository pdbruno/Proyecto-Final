<script>
var request = $.ajax({
  url: "<?php echo URL; ?>actividad/tabla/egresos",
  type: "post",
});
request.done(function (respuesta){
  let myObj = JSON.parse(respuesta);
  crearCampos(myObj);
  modoFormulario("Agregar");
});

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
