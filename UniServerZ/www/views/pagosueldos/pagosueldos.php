<script>

var Instructores = [];
var Sueldos = {};

var request = $.ajax({
  url: "<?php echo URL; ?>actividad/tabla/pagodesueldos",
  type: "post",
});
request.done(function (respuesta){
  let myObj = JSON.parse(respuesta);
  crearCampos(myObj);
  ElemForm.idMesesSelect[0].remove(13);
  ElemForm.idClientesSelect[0].addEventListener("input", traerSueldo);
  ElemForm.idMesesSelect[0].addEventListener("input", traerSueldo);
  modoFormulario("Agregar");

  var request = $.ajax({
    url: "<?php echo URL; ?>cliente/listadoInstructores",
    type: "post",
  });
  request.done(function (respuesta){
    Instructores = JSON.parse(respuesta);
    ElemForm.idClientesSelect[0].innerHTML = optionCrear(Instructores);
  });
});

request = $.ajax({
  url: "<?php echo URL; ?>cobro/traerSueldos",
  type: "post"
});
request.done(function (respuesta){
  Sueldos = JSON.parse(respuesta);
});



function traerSueldo(){
  if (ElemForm.idClientesSelect[0].value && ElemForm.idMesesSelect[0].value) {
    let request = $.ajax({
      url: "<?php echo URL; ?>cliente/cantidadBloques",
      type: "post",
      data: "data1=" + ElemForm.idClientesSelect[0].value + "&data2=" + ElemForm.idMesesSelect[0].value,
    });
    request.done(function (respuesta){
      ElemForm.MontoForm[0].value = respuesta * Sueldos[Instructores[ElemForm.idClientesSelect[0].selectedIndex - 1].idCategorias].MontoXBloque;
    });
  }
}




document.getElementById("BtnAgregar").addEventListener("click", function() {
  let vec = beforeEnviar();
  if (vec != 'no') {
    let request = $.ajax({
      url: "<?php echo URL; ?>help/agregarModificarElemento/PagoDeSueldos",
      type: "post",
      data: "data=" + JSON.stringify(vec),
    });
    request.done(function (respuesta){
      alert("Gracias por colaborar con el gremio de Instructores BBG, se ha pagado el sueldo exitosamente");
      modoFormulario("Agregar");
    });
  }
});
</script>
