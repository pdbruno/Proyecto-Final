<script>
var Elementos = {};
document.getElementById("CerrarVer").addEventListener("click", function() {
  $('#ModalVer').modal('hide');
});
document.getElementById("deshacerModal").addEventListener("click", function() {
  $('#ModalSel').modal('hide');
  deshacerModal();
});
var request = $.ajax({
  url: "<?php echo URL; ?>actividad/tabla/actividades",
  type: "post",
});
request.done(function (respuesta){
  let myObj = JSON.parse(respuesta);
  crearCampos(myObj);
});
function deshacerModal(){
  $("#Selec").html("<div class='col-lg-7'>\
  <h5>Modalidad</h5>\
  </div>\
  <div class='row'>\
  <div class='col-lg-7'>\
  <select id='idModalidadesSelect1' class='form-control mod'>\
  <option disabled selected value>Elija una modalidad</option>\
  </select>\
  <button type='button' id='AddAct1' class='btn btn-link' onclick='AddAct(this)' >+AgregarModalidad</button>\
  </div>");

  Elementos.idModalidadesSelect1 = document.getElementById("idModalidadesSelect1");
  Elementos.idModalidadesSelect1.innerHTML += optionCrear(VecModalidades);
}

function AddAct(bot) {
  let i = bot.id.replace("AddAct", "");
  if (Elementos["idModalidadesSelect" + i].selectedIndex == "0") {
    alert("Seleccione una actividad y una modalidad");
  } else {
    let j = Number(i) + 1;
    $("#Selec").append("<div class='row' style='margin-top: 50px;'>\
    <div class='col-lg-7'>\
    <select id='idModalidadesSelect" + j + "' class='form-control mod'>\
    </select>\
    </div>\
    </div>\
    <button type='button' id='AddAct" + j + "' class='btn btn-link' onclick='AddAct(this)' >+AgregarModalidad</button>");
    Elementos["idModalidadesSelect" + j] = document.getElementById("idModalidadesSelect" + j);
    Elementos["idModalidadesSelect" + j].innerHTML += Elementos["idModalidadesSelect" + i].innerHTML;
    Elementos["idModalidadesSelect" + j].remove(Elementos["idModalidadesSelect" + i].selectedIndex);
    $("#AddAct" + i).addClass('hidden')
    Elementos["idModalidadesSelect" + i].disabled = true;
  }
}
var VecModalidades= [];
var bien = false;
var final = [];
document.getElementById("aceptarModal").addEventListener("click", function() {
  bien = true;
  $('#ModalSel').modal('hide');
  final = [];
  var l = document.getElementById("Selec").getElementsByClassName("mod").length;
  for (let i = 1; i <= l; i++) {
    final.push(Elementos["idModalidadesSelect" + i].value);
    if (Elementos["idModalidadesSelect" + i].value == "") {
      bien = false;
    }
  }
});

document.getElementById("BtnAgregar").addEventListener("click", function() {
  $('#ModalPropiedades').modal('show');
  modoFormulario("Agregar");
  $("#idModalidadesSelect").removeClass("hidden");
  $("#idModalidadesVer").addClass("hidden");
  deshacerModal();
});
document.getElementById("BtnModificar").addEventListener("click", function() {
  modoFormulario("Modificar");
  $("#idModalidadesSelect").removeClass("hidden");
  $("#idModalidadesVer").addClass("hidden");
  deshacerModal();
});
document.getElementById("BtnAceptar").addEventListener("click", function() {
  document.getElementById("idModalidadesSelect").innerHTML = 'Seleccionar modalidad/es';
  if (bien == false){
    document.getElementById("idModalidadesSelect").innerHTML+= '<span class="label label-danger">!</span>';
  }else {
    let vec = beforeEnviar();
    if (vec != 'no')
    {
      request = $.ajax({
        url: "<?php echo URL; ?>actividad/agregarModificarActividad",
        type: "post",
        data:  "data1=" + JSON.stringify(vec) + "&data2=" + JSON.stringify(final)
      });
      request.done(function (respuesta){
        afterEnviar();
      });
    }
  }
});
document.getElementById("BtnEliminar").addEventListener("click", function() {
  var r = confirm("Estás muy recontra segurísima/o que querés borrar esta actividad?");
  if (r == true) {

    request = $.ajax({
      url: "<?php echo URL; ?>actividad/eliminarElemento/Actividades",
      type: "post",
      data: "data=" + document.getElementById("idActividades").innerHTML,
    });
    request.done(function (respuesta){
      eliminarError(respuesta);
    });
  }
});
$('#Tabla').on('click-row.bs.table', function (row, $element, field) {
  $('.success').removeClass('success');
  $(field).addClass('success');
  request = $.ajax({
    url: "<?php echo URL; ?>actividad/traerElemento/Actividades",
    type: "post",
    data: "data=" + $element.idActividades,
  });
  request.done(function (respuesta)
  {
    clickFila(JSON.parse(respuesta)[0][0]);
    let modalidades = JSON.parse(respuesta)[1];
    let texto = "";
    let l = modalidades.length;
    for (var i = 0; i < l; i++) {
      texto += "<tr>";
      texto+="<td>" + modalidades[i].NombreMod + "</td>";
      texto+="</tr>";
      final.push(modalidades[i].idModalidades);
      bien = true;
    }
    $("#TablaModalidades").html(texto);
    $("#idModalidadesSelect").addClass("hidden");
    $("#idModalidadesVer").removeClass("hidden");
  });
});
var request = $.ajax({
  url: "<?php echo URL; ?>cliente/listadoDropdowns",
  type: "post"
});
request.done(function (respuesta){
  VecModalidades = JSON.parse(respuesta)[1][1];
});
function optionCrear(vec) {
  var txt="";
  let l = vec.length;
  for (let i = 0; i < l; i++) {
    txt += "<option value='" + vec[i].id + "'>" + vec[i].Nombre + "</option>";
  }
  return txt;
}
</script>
