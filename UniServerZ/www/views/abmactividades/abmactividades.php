<script>
var Elementos = {
  Selec: document.getElementById("Selec")
};
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
  Elementos["idSubactividadesForm0"] = document.createElement("input");
  Elementos.Selec.innerHTML = "";
  AddAct(0);
}

function AddAct(i) {
  if (Elementos["idSubactividadesForm" + i].value == "" && i != 0) {
    alert("Ingrese una subactividad");
  } else {
    let j = Number(i) + 1;
    let row = document.createElement("div");
    row.className = "row";
    row.style = "margin-top : 50px";
    let col5 = document.createElement("div");
    col5.className = "col-lg-5";
    let input = document.createElement("input");
    input.className = "form-control sub";
    input.id = 'idSubactividadesForm' + j ;
    let button = document.createElement("button");
    button.type = "button"
    button.id = 'AddAct' + j ;
    button.className = "btn btn-link";
    button.innerHTML = "+AgregarSubactividad";
    button.addEventListener("click", function() {
      AddAct(j);
    });
    row.appendChild(col5);
    row.appendChild(button);
    col5.appendChild(input);
    Elementos.Selec.appendChild(row);
    Elementos["idSubactividadesForm" + j] = input;
    Elementos["idSubactividadesForm" + i].disabled = true;
    $("#AddAct" + i).addClass('hidden')
  }
}

var final = [];
document.getElementById("aceptarModal").addEventListener("click", function() {
  $('#ModalSel').modal('hide');
  final = [];
  var l = document.getElementById("Selec").getElementsByClassName("sub").length;
  for (let i = 1; i <= l; i++) {
    if (Elementos["idSubactividadesForm" + i].value != "") {
      final.push(Elementos["idSubactividadesForm" + i].value);
    }
  }
});

document.getElementById("BtnAgregar").addEventListener("click", function() {
  $('#ModalPropiedades').modal('show');
  modoFormulario("Agregar");
  $("#idSubactividadesSelect").removeClass("hidden");
  $("#idSubactividadesVer").addClass("hidden");
  deshacerModal();
});
document.getElementById("BtnModificar").addEventListener("click", function() {
  modoFormulario("Modificar");
  $("#idSubactividadesSelect").removeClass("hidden");
  $("#idSubactividadesVer").addClass("hidden");
  deshacerModal();
});
document.getElementById("BtnAceptar").addEventListener("click", function() {
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
    let subactividades = JSON.parse(respuesta)[1];
    let texto = "";
    let l = subactividades.length;
    for (var i = 0; i < l; i++) {
      texto += "<tr>";
      texto+="<td>" + subactividades[i].Nombre + "</td>";
      texto+="</tr>";
      final.push(subactividades[i].Nombre);
      bien = true;
    }
    $("#TablaSubactividades").html(texto);
    $("#idSubactividadesSelect").addClass("hidden");
    $("#idSubactividadesVer").removeClass("hidden");
  });
});

</script>
