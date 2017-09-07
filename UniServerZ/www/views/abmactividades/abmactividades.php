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
  var request = $.ajax({
    url: "<?php echo URL; ?>help/Dropdown/idModalidades",
    type: "post"
  });
  request.done(function (respuesta){
    VecModalidades = JSON.parse(respuesta);
  });
});
function deshacerModal(){
  let row = document.createElement("div");
  row.className = "row";
  row.style.margin = "50 0 0 0";

  let col5 = document.createElement("div");
  col5.className = "col-lg-12";

  let tit2 = document.createElement("h5");
  tit2.innerHTML = "Modalidad";

  let select2 = document.createElement("select");
  select2.className = "form-control mod";
  select2.id = 'idModalidadesSelect1';

  let button = document.createElement("button");
  button.type = "button"
  button.id = 'AddAct1';
  button.className = "btn btn-link";
  button.innerHTML = "+AgregarActividad";
  button.addEventListener("click", function() {
    AddAct(this);
  });
  row.appendChild(col5);
  row.appendChild(button);
  col5.appendChild(tit2);
  col5.appendChild(select2);
  Elementos.Selec.innerHTML = "";
  Elementos.Selec.appendChild(row);

  Elementos.idModalidadesSelect1 = select2;
  select2.innerHTML += optionCrear(VecModalidades[0]);
}

function AddAct(bot) {
  let i = bot.id.replace("AddAct", "");
  if (Elementos["idModalidadesSelect" + i].selectedIndex == "0") {
    alert("Seleccione una modalidad");
  } else {
    let j = Number(i) + 1;

    let row = document.createElement("div");
    row.className = "row";
    row.style = "margin-top : 50px";

    let col5 = document.createElement("div");
    col5.className = "col-lg-12";

    let select2 = document.createElement("select");
    select2.className = "form-control mod";
    select2.id = 'idModalidadesSelect' + j ;

    let button = document.createElement("button");
    button.type = "button"
    button.id = 'AddAct' + j ;
    button.className = "btn btn-link";
    button.innerHTML = "+AgregarActividad";
    button.addEventListener("click", function() {
      AddAct(this);
    });

    row.appendChild(col5);
    row.appendChild(button);
    col5.appendChild(select2);
    Elementos.Selec.appendChild(row);

    Elementos["idModalidadesSelect" + j] = select2;
    select2.innerHTML += Elementos["idModalidadesSelect" + i].innerHTML;
    select2.remove(Elementos["idModalidadesSelect" + i].selectedIndex);
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

</script>
