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
  Elementos.idActividadesSelect0 = document.createElement("select");
  Elementos.idModosDePagoSelect0 = document.createElement("select");
  Elementos.idModalidadesSelect0 = document.createElement("select");
  Elementos.idActividadesSelect0.innerHTML = VecModalidades;
  Elementos.idActividadesSelect0.innerHTML = VecActividades;
  Elementos.idModosDePagoSelect0.innerHTML = VecModosDePago;
  Elementos.idActividadesSelect0.selectedIndex = -1;
  Elementos.idModosDePagoSelect0.selectedIndex = -1;
  Elementos.idModalidadesSelect0.selectedIndex = -1;
  Elementos.Selec.innerHTML = "";
  AddAct(0);
}
var request = $.ajax({
  url: "<?php echo URL; ?>cliente/tabla/clientes",
  type: "post"
});
request.done(function (respuesta){
  let myObj = JSON.parse(respuesta);
  crearCampos(myObj);
});
var idModalidades = $.ajax({
  url: "<?php echo URL; ?>help/Dropdown/idModalidades",
  type: "post"
});
var idActividades = $.ajax({
  url: "<?php echo URL; ?>help/Dropdown/idActividades",
  type: "post"
});
var idModosDePago = $.ajax({
  url: "<?php echo URL; ?>help/Dropdown/idModosDePago",
  type: "post"
});
$.when(idModalidades, idActividades, idModosDePago).done(function(a1, a2, a3){
  VecModalidades = optionCrear(JSON.parse(a1[0])[0]);
  VecActividades = optionCrear(JSON.parse(a2[0])[0]);
  VecModosDePago = optionCrear(JSON.parse(a3[0])[0]);
  deshacerModal();
});

function AddAct(i) {
  if ((Elementos["idActividadesSelect" + i].selectedIndex == "0" || Elementos["idModosDePagoSelect" + i].selectedIndex == "0") || (Elementos["idModosDePagoSelect" + i].selectedIndex == "2" && Elementos["idModalidadesSelect" + i].selectedIndex == "0")) {
    alert("Seleccione una actividad, un modo de pago y, si corresponde, una modalidad");
  } else {
    let j = Number(i) + 1;
    let row = document.createElement("div");
    row.className = "row";
    row.style = "margin-top : 50px";
    let col1 = document.createElement("div");
    col1.className = "col-lg-4";
    let select1 = document.createElement("select");
    select1.className = "form-control activ";
    select1.id = 'idActividadesSelect' + j ;
    let col2 = document.createElement("div");
    col2.className = "col-lg-4";
    let select2 = document.createElement("select");
    select2.className = "form-control pag";
    select2.id = 'idModosDePagoSelect' + j ;
    let col3 = document.createElement("div");
    col3.className = "col-lg-4 hidden";
    let select3 = document.createElement("select");
    select3.className = "form-control mod";
    select3.id = 'idModalidadesSelect' + j ;
    select2.addEventListener("change", function() {
      if (this.options[this.selectedIndex].value == 2) {
        col3.className = "col-lg-4";
      }else {
        col3.className = "col-lg-4 hidden";
        select3.selectedIndex = "0";
      }
    });
    let button = document.createElement("button");
    button.type = "button"
    button.id = 'AddAct' + j ;
    button.className = "btn btn-link";
    button.innerHTML = "+AgregarActividad";
    button.addEventListener("click", function() {
      AddAct(j);
    });
    row.appendChild(col1);
    row.appendChild(col2);
    row.appendChild(col3);
    row.appendChild(button);
    col1.appendChild(select1);
    col2.appendChild(select2);
    col3.appendChild(select3);
    Elementos.Selec.appendChild(row);
    Elementos["idActividadesSelect" + j] = select1;
    Elementos["idModosDePagoSelect" + j] = select2;
    Elementos["idModalidadesSelect" + j] = select3;
    select1.innerHTML = Elementos["idActividadesSelect" + i].innerHTML;
    select1.remove(Elementos["idActividadesSelect" + i].selectedIndex);
    $("#AddAct" + i).addClass('hidden')
    Elementos["idActividadesSelect" + i].disabled = true;
    select2.innerHTML = Elementos["idModosDePagoSelect" + i].innerHTML;
    select3.innerHTML = Elementos["idModalidadesSelect" + i].innerHTML;
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
var VecModosDePago = "";

var bien = false;
var final = [];
document.getElementById("aceptarModal").addEventListener("click", function() {
  final = [];
  bien = true;
  $('#ModalSel').modal('hide');
  let l = document.getElementById("Selec").getElementsByClassName("mod").length;
  for (var i = 1; i <= l; i++) {
    if ((Elementos["idActividadesSelect" + i].selectedIndex == "0" || Elementos["idModosDePagoSelect" + i].selectedIndex == "0") || (Elementos["idModosDePagoSelect" + i].selectedIndex == "2" && Elementos["idModalidadesSelect" + i].selectedIndex == "0")) {
      bien = false;
    }else{
      final[i-1] = {idClientes: idClientes, idActividades : Elementos["idActividadesSelect" + i].value, idModosDePago : Elementos["idModosDePagoSelect" + i].value, idModalidades : Elementos["idModalidadesSelect" + i].value};
    }
  }
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
var idClientes;
$('#Tabla').on('click-row.bs.table', function (row, $element, field) {
  idClientes = $element.idClientes;
  $('.success').removeClass('success');
  $(field).addClass('success');
  request = $.ajax({
    url: "<?php echo URL; ?>cliente/traerElemento/Clientes",
    type: "post",
    data: "data=" + idClientes,
  });
  request.done(function (respuesta)
  {
    clickFila(JSON.parse(respuesta)[0][0]);
    var actividades = JSON.parse(respuesta)[1][0];
    var texto = "";
    for (var i = 0; i < actividades.length; i++) {
      texto += "<tr>";
      texto+="<td>" + actividades[i].NombreAct + "</td>";
      texto+="<td>" + actividades[i].NombrePag + "</td>";
      if (actividades[i].NombreMod == null) {
        texto+="<td>-</td>";
      }else {
        texto+="<td>" + actividades[i].NombreMod + "</td>";
      }
      texto+="</tr>";
      final.push({idClientes: idClientes, idActividades: actividades[i].idActividades, idModosDePago: actividades[i].idModosDePago, idModalidades: actividades[i].idModalidades});
      bien = true;
    }
    $("#TablaActividades").html(texto);
    $("#IdActividadesSelect").addClass("hidden");
    $("#IdActividadesVer").removeClass("hidden");
  });
});
</script>
