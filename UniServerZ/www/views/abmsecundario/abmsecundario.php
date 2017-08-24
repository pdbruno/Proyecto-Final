<script>
var request = $.ajax({
  url: "<?php echo URL; ?>help/tabla/<?php echo $this->sujeto; ?>",
  type: "post",
});
request.done(function (respuesta){
  let myObj = JSON.parse(respuesta);
  crearCampos(myObj);
});
document.getElementById("BtnAgregar").addEventListener("click", function() {
  modoFormulario('Agregar');
});
document.getElementById("BtnModificar").addEventListener("click", function() {
  modoFormulario('Modificar');
});
document.getElementById("BtnAceptar").addEventListener("click", function() {
  let vec = beforeEnviar();
  if (vec != 'no') {
    var request = $.ajax({
      url: "<?php echo URL; ?>help/agregarModificarElemento/<?php echo $this->sujeto; ?>",
      type: "post",
      data: "data=" + JSON.stringify(vec),
    });
    request.done(function (respuesta){
      afterEnviar();
    });

  }
});
document.getElementById("BtnEliminar").addEventListener("click", function() {
  var r = confirm("Estás muy recontra segurísima/o que querés borrar este elemento?");
  if (r == true) {
    var request = $.ajax({
      url: "<?php echo URL; ?>help/eliminarElemento/<?php echo $this->sujeto; ?>",
      type: "post",
      data: "data=" + document.getElementById("id<?php echo $this->sujeto; ?>").innerHTML,
    });
    request.done(function (respuesta){
      eliminarError(respuesta);
    });
  }
});
$('#Tabla').on('click-row.bs.table', function (row, $element, field) {
  $('.success').removeClass('success');
  $(field).addClass('success');
  var request = $.ajax({
    url: "<?php echo URL; ?>help/traerElemento/<?php echo $this->sujeto; ?>",
    type: "post",
    data: "data=" + $element.id<?php echo $this->sujeto; ?>,
  });
  request.done(function (respuesta){
    clickFila(JSON.parse(respuesta)[0]);
  });
});
</script>
