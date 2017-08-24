<script type="text/javascript">
var request = $.ajax({
  url: "<?php echo URL; ?>producto/tabla/registrocompras",
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
      url: "<?php echo URL; ?>producto/agregarRegistro/RegistroCompras",
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
