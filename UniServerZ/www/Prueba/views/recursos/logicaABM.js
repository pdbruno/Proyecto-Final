function clickFila(obj){
  var input;
  for (x in obj) {
    $("#" + x).removeClass("hidden").text(obj[x]);
    input = $("#" + x + "Form");
    if(input != null){
      input.addClass("hidden");
      if (input.attr("type") == 'checkbox') {
        if (obj[x] == 1) {
          input.attr("checked", true);
        } else {
          input.attr("checked", false);
        }
      } else {
        input.val(obj[x]);
      }
    }
  }
  var y = document.getElementById("Formu").getElementsByClassName("checkbox");
  var z = document.getElementById("Formu").getElementsByClassName("intro");
  if (z.length>0) {
    for (i = 0; i < y.length; i++) {
      $("#" + y[i].id).removeClass("hidden");
      y[i].disabled = true;
      if (z[i].innerHTML == 1) {
        y[i].checked = true;
      } else {
        y[i].checked = false;
      }
      $("#" + z[i].id).addClass("hidden");

    }
  }
  $("#BtnAceptar").addClass("hidden");
  $("#BtnAgregar").removeClass("hidden");
  $("#BtnModificar").removeClass("hidden");
  $("#BtnEliminar").removeClass("hidden");
}
function afterEnviar(){
  var x = document.getElementById("Formu").getElementsByClassName("form-control-static");
  var y = document.getElementById("Formu").getElementsByClassName("form-control");
  for (var i = 0; i < x.length; i++) {
    $("#" + x[i].id).removeClass("hidden");
    x[i].innerHTML = "";
  }
  for (var i = 0; i < y.length; i++) {
    $("#" + y[i].id).addClass("hidden");
  }
  var z = document.getElementById("Formu").getElementsByClassName("checkbox");
  if (z.length>0) {
    for (var i = 0; i < z.length; i++) {
      z[i].disabled = true;
      $("#" + z[i].id).addClass("hidden");
    }
  }
  $("#BtnAceptar").addClass("hidden");
  $("#BtnAgregar").removeClass("hidden");
  $("#BtnModificar").addClass("hidden");
  $("#BtnEliminar").addClass("hidden");
  $('#Tabla').bootstrapTable('refresh');
}
function beforeEnviar(){
  vec = [];
  var x = document.getElementById("Formu").getElementsByTagName("input");
  var z = document.getElementById("Formu").getElementsByClassName("checkbox");
  if (z.length>0) {
    for (var i = 0; i < z.length; i++) {
      if (z[i].checked == true) {
        z[i].value = 1;
      } else {
        z[i].value = 0;
      }
    }
  }
  for (var i = 0; i < x.length; i++) {
    if (x[i].value === "") {
      x[i].value = null;
    }
    vec.push(x[i].value);
  }
  return vec;
}
function eliminarError(respuesta){
  afterEnviar();
  if (respuesta != "") {
    alert("Como existen registros que hacen referencia a este elemento, éste no se puede eliminar.\n\ Calma: esto no es un error ni una falla.");
  }
}
function modoFormulario(modo){
  $("#BtnAceptar").removeClass("hidden");
  $("#BtnAgregar").addClass("hidden");
  $("#BtnModificar").addClass("hidden");
  $("#BtnEliminar").addClass("hidden");
  var x = document.getElementById("Formu").getElementsByClassName("form-control-static");
  var y = document.getElementById("Formu").getElementsByClassName("form-control");
  for (var i = 0; i < x.length; i++) {
    $("#" + x[i].id).addClass("hidden");
  }
  if (modo == "Modificar") {
    for (var i = 0; i < y.length; i++) {
      $("#" + y[i].id).removeClass("hidden");
    }
  }else{
    for (var i = 0; i < y.length; i++) {
      $("#" + y[i].id).removeClass("hidden");
      y[i].value = null;
    }
  }
  var z = document.getElementById("Formu").getElementsByClassName("checkbox");
  if (z.length>0) {
    for (var i = 0; i < z.length; i++) {
      z[i].disabled = false;
      $("#" + z[i].id).removeClass("hidden");
    }
  }
}
