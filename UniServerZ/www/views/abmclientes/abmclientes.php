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
function deshacerModal(){
  let row = document.createElement("div");
  row.className = "row";
  row.style.margin = "50 0 0 0";
  let col7 = document.createElement("div");
  col7.className = "col-lg-7";
  let tit1 = document.createElement("h5");
  tit1.innerHTML = "Actividad";
  let select1 = document.createElement("select");
  select1.className = "form-control activ";
  select1.id = 'idActividadesSelect1';
  let col5 = document.createElement("div");
  col5.className = "col-lg-5";
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
  row.appendChild(col7);
  row.appendChild(col5);
  row.appendChild(button);
  col7.appendChild(tit1);
  col7.appendChild(select1);
  col5.appendChild(tit2);
  col5.appendChild(select2);
  Elementos.Selec.innerHTML = "";
  Elementos.Selec.appendChild(row);
  Elementos.idActividadesSelect1 = select1;
  Elementos.idModalidadesSelect1 = select2;
  select1.innerHTML += VecActividades;
  select2.innerHTML += VecModalidades;
}

function AddAct(bot) {
  let i = bot.id.replace("AddAct", "");
  if (Elementos["idActividadesSelect" + i].selectedIndex == "0" || Elementos["idModalidadesSelect" + i].selectedIndex == "0") {
    alert("Seleccione una actividad y una modalidad");
  } else {
    let j = Number(i) + 1;
    let row = document.createElement("div");
    row.className = "row";
    row.style = "margin-top : 50px";
    let col7 = document.createElement("div");
    col7.className = "col-lg-7";
    let select1 = document.createElement("select");
    select1.className = "form-control activ";
    select1.id = 'idActividadesSelect' + j ;
    let col5 = document.createElement("div");
    col5.className = "col-lg-5";
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
    row.appendChild(col7);
    row.appendChild(col5);
    row.appendChild(button);
    col7.appendChild(select1);
    col5.appendChild(select2);
    Elementos.Selec.appendChild(row);
    Elementos["idActividadesSelect" + j] = select1;
    Elementos["idModalidadesSelect" + j] = select2;
    select1.innerHTML += Elementos["idActividadesSelect" + i].innerHTML;
    select1.remove(Elementos["idActividadesSelect" + i].selectedIndex);
    $("#AddAct" + i).addClass('hidden')
    Elementos["idActividadesSelect" + i].disabled = true;
    select2.innerHTML += VecModalidades;
  }

}
$('#FechaNacimientoForm').datepicker({
  format: "yyyy/mm/dd",
  endDate: "today",
  language: "es",
  autoclose: true,
});
var VecActividades = "";
var VecModalidades = "";
var bien = false;
var final = [];
document.getElementById("aceptarModal").addEventListener("click", function() {
  final = [];
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
    url: "<?php echo URL; ?>help/Dropdown/idModalidades",
    type: "post"
  });
  request.done(function (respuesta){
    VecModalidades = optionCrear(JSON.parse(respuesta));
  });
  request = $.ajax({
    url: "<?php echo URL; ?>help/Dropdown/idActividades",
    type: "post"
  });
  request.done(function (respuesta){
    VecActividades = optionCrear(JSON.parse(respuesta));
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
  document.getElementById("IdActividadesSelect").innerHTML = 'Seleccionar actividad/es';
  if (bien == false){
    document.getElementById("IdActividadesSelect").innerHTML+= '<span class="label label-danger">!</span>';
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
    var actividades = JSON.parse(respuesta)[1][0];
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
      bien = true;
    }
    $("#TablaActividades").html(texto);
    $("#IdActividadesSelect").addClass("hidden");
    $("#IdActividadesVer").removeClass("hidden");
  });
});
</script>
