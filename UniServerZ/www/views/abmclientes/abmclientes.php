<script>
var Elementos = {};
document.getElementById("CerrarVer").addEventListener("click", function() {
  $('#ModalVer').modal('hide');
});
document.getElementById("deshacerModal").addEventListener("click", function() {
  $('#ModalSel').modal('hide');
  deshacerModal();
});
function deshacerModal(){
  $("#Selec").html("<div class='col-lg-7'>\
  <h5>Actividad</h5>\
  </div>\
  <div class='col-lg-5'>\
  <h5>Modalidad</h5>\
  </div><div class='row'>\
  <div class='col-lg-7'>\
  <select id='idActividadesSelect1' class='form-control activ'>\
  <option disabled selected value>Elija una actividad</option>\
  </select>\
  </div>\
  <div class='col-lg-5'>\
  <select id='idModalidadesSelect1' class='form-control mod'>\
  <option disabled selected value>Elija una modalidad</option>\
  </select>\
  </div>\
  </div>\
  <button type='button' id='AddAct1' class='btn btn-link' onclick='AddAct(this)' >+AgregarActividad</button>");

  Elementos.idActividadesSelect1= document.getElementById("idActividadesSelect1");
  Elementos.idModalidadesSelect1= document.getElementById("idModalidadesSelect1");
  Elementos.idActividadesSelect1.innerHTML += optionCrear(VecActividades);
  Elementos.idModalidadesSelect1.innerHTML += VecModalidades;
}

function AddAct(bot) {
  let i = bot.id.replace("AddAct", "");
  Elementos["idActividadesSelect" + i];
  Elementos["idModalidadesSelect" + i];
  if (Elementos["idActividadesSelect" + i].selectedIndex == "0" || Elementos["idModalidadesSelect" + i].selectedIndex == "0") {
    alert("Seleccione una actividad y una modalidad");
  } else {
    let j = Number(i) + 1;
    $("#Selec").append("<div class='row' style='margin-top: 50px;'>\
    <div class='col-lg-7'>\
    <select id='idActividadesSelect" + j + "' class='form-control activ'>\
    </select>\
    </div>\
    <div class='col-lg-5'>\
    <select id='idModalidadesSelect" + j + "' class='form-control mod'>\
    <option disabled selected value>Elija una modalidad</option>\
    </select>\
    </div>\
    </div>\
    <button type='button' id='AddAct" + j + "' class='btn btn-link' onclick='AddAct(this)' >+AgregarActividad</button>");
    Elementos["idActividadesSelect" + j] = document.getElementById("idActividadesSelect" + j);
    Elementos["idModalidadesSelect" + j] = document.getElementById("idModalidadesSelect" + j);
    Elementos["idActividadesSelect" + j].innerHTML += Elementos["idActividadesSelect" + i].innerHTML;
    Elementos["idActividadesSelect" + j].remove(Elementos["idActividadesSelect" + i].selectedIndex);
    $("#AddAct" + i).addClass('hidden')
    Elementos["idActividadesSelect" + i].disabled = true;
    Elementos["idModalidadesSelect" + j].innerHTML += VecModalidades;
  }

}
$('#FechaNacimientoForm').datepicker({
  format: "yyyy/mm/dd",
  endDate: "today",
  language: "es",
  autoclose: true,
});
var VecActividades= [];
var VecModalidades= [];
var bien = true;
var final = [];
document.getElementById("aceptarModal").addEventListener("click", function() {
  bien = true;
  $('#ModalSel').modal('hide');
  let l = document.getElementById("Selec").getElementsByClassName("mod").length;
  for (var i = 1; i <= l; i++) {
    if (Elementos["idActividadesSelect" + i].value == "" || Elementos["idModalidadesSelect" + i].value == "") {
      bien = false;
    }else{
      final[i-1] = {idActividades : Elementos["idActividadesSelect" + i].value, idModalidades : Elementos["idModalidadesSelect" + i].value};
    }
  }
});

var request = $.ajax({
  url: "<?php echo URL; ?>cliente/tabla/clientes",
  type: "post",
});
request.done(function (respuesta){
  let myObj = JSON.parse(respuesta);
  crearCampos(myObj);
  request = $.ajax({
    url: "<?php echo URL; ?>cliente/listadoDropdowns",
    type: "post",
  });
  request.done(function (respuesta){
    let myObj = JSON.parse(respuesta);
    VecActividades = myObj[1][0];
    VecModalidades = optionCrear(myObj[1][1]);
    VecActividadesTemp = myObj[1][0];
    llenarDropdowns(myObj[0]);
  });
});
document.getElementById("BtnAgregar").addEventListener("click", function() {
  $("#IdActividadesSelect").removeClass("hidden");
  $("#IdActividadesVer").addClass("hidden");
  modoFormulario("Agregar");
  deshacerModal();
  document.getElementById("ActivoForm").checked = true;
});
document.getElementById("BtnModificar").addEventListener("click", function() {
  $("#IdActividadesSelect").removeClass("hidden");
  $("#IdActividadesVer").addClass("hidden");
  modoFormulario("Modificar");
  deshacerModal();
});
document.getElementById("BtnAceptar").addEventListener("click", function() {
  if (bien == false){
    alert('Complete las actividades')
  }else {
    let vec = beforeEnviar();
    if (vec != 'no')
    {
      let vec = beforeEnviar();
      request = $.ajax({
        url: "<?php echo URL; ?>cliente/agregarModificarCliente",
        type: "post",
        data:  "data1=" + JSON.stringify(vec) + "&data2=" + JSON.stringify(final)
      });
      request.done(function (respuesta){
        $("#IdActividadesSelect").addClass("hidden");
        afterEnviar();
      });
    }
  }
});
document.getElementById("BtnEliminar").addEventListener("click", function() {
  var r = confirm("Estás muy recontra segurísima/o que querés borrar a este cliente?\n\
  Esta funcionalidad se ha creado solo para casos extremos.");
  if (r == true) {
    request = $.ajax({
      url: "<?php echo URL; ?>cliente/eliminarElemento/Clientes",
      type: "post",
      data: "data=" + document.getElementById("idClientes").innerHTML,
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
    url: "<?php echo URL; ?>cliente/traerElemento/Clientes",
    type: "post",
    data: "data=" + $element.idClientes,
  });
  request.done(function (respuesta)
  {
    clickFila(JSON.parse(respuesta)[0][0]);
    var actividades = JSON.parse(respuesta)[1];
    var texto = "";
    for (var i = 0; i < actividades.length; i++) {
      texto += "<tr>";
      texto+="<td>" + actividades[i].NombreAct + "</td>";
      if (actividades[i].NombreMod == null) {
        texto+="<td>Ninguna</td>";
      }else {
        texto+="<td>" + actividades[i].NombreMod + "</td>";
      }
      texto+="</tr>";
      final.push({idActividades: actividades[i].idActividades, idModalidades: actividades[i].idModalidades});
    }
    $("#TablaActividades").html(texto);
    $("#IdActividadesSelect").addClass("hidden");
    $("#IdActividadesVer").removeClass("hidden");
  });
});
</script>
