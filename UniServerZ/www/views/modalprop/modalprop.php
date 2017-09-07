<script>

var request = $.ajax({
  url: "<?php echo $this->tabla; ?>",
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
    request = $.ajax({
      url: "<?php echo $this->agregarModificar; ?>",
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
    request = $.ajax({
      url: "<?php echo $this->eliminar; ?>",
      type: "post",
      data: "data=" + document.getElementById("id<?php echo $this->titmodal; ?>s").innerHTML,
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
    url: "<?php echo $this->traer; ?>",
    type: "post",
    data: "data=" + $element.id<?php echo $this->titmodal; ?>s,
  });
  request.done(function (respuesta){
    clickFila(JSON.parse(respuesta)[0]);
  });
});

</script>
