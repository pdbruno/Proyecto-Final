<script>
var Elementos = {};
$(document).on('show.bs.modal', '.modal', function (event) {
  var zIndex = 1040 + (10 * $('.modal:visible').length);
  $(this).css('z-index', zIndex);
  setTimeout(function() {
    $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
  }, 0);
});
document.getElementById("CerrarVer").addEventListener("click", function() {
  $('#ModalVer').modal('hide');
});
document.getElementById("CerrarSelect").addEventListener("click", function() {
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
  let Formu = document.getElementById("Formu");
  let myObj = JSON.parse(respuesta);
  l = myObj.length;
  for (var i = 0; i < l; i++) {
    let listgroupitem = document.createElement("li");
    listgroupitem.className = "list-group-item";
    let formgroup = document.createElement("div");
    formgroup.className = "form-group";

    let controllabel = document.createElement("label");
    controllabel.className = "col-sm-2 control-label";
    controllabel.innerHTML = myObj[i].COLUMN_NAME;

    let col10 = document.createElement("div");
    col10.className = "col-sm-10";

    let formcontrolstatic = document.createElement("p");
    formcontrolstatic.id = myObj[i].COLUMN_NAME;

    if (myObj[i].DATA_TYPE=="tinyint") {
      formcontrolstatic.className = "intro hidden";
    }else{
      formcontrolstatic.className = "form-control-static";
    }
    let formcontrol = document.createElement("input");
    formcontrol.id = myObj[i].COLUMN_NAME + "Form";
    formcontrol.placeholder = myObj[i].COLUMN_NAME;
    let select;
    switch (myObj[i].DATA_TYPE) {
      case "tinyint":
      formcontrol.type = 'checkbox';
      formcontrol.className = "checkbox hidden";
      formcontrol.disabled = true;
      break;
      case "text":
      formcontrol.className = "form-control hidden";
      formcontrol.type = 'text';
      formcontrol.disabled = true;
      case "date":
      formcontrol.className = "form-control hidden";
      formcontrol.type = 'date';
      formcontrol.disabled = true;
      break;
      case "int":
      if (myObj[i].COLUMN_KEY == 'MUL') {
        formcontrol.className = "form-control hidden";
        formcontrol.type = 'text';
        formcontrol.style.display = 'none';
        formcontrol.style.visibility = 'hidden';

        select = document.createElement("select");
        select.className = "form-control hidden";
        select.id = myObj[i].COLUMN_NAME + "Select";

      }else {
        formcontrol.className = "form-control hidden";
        formcontrol.type = 'number';
        formcontrol.disabled = true;
      }
    }

    if (myObj[i].COLUMN_KEY == 'MUL') {
      col10.appendChild(formcontrolstatic);
      col10.appendChild(select);
      col10.appendChild(formcontrol);
    }else {
      col10.appendChild(formcontrolstatic);
      col10.appendChild(formcontrol);
    }
    formgroup.appendChild(controllabel);
    formgroup.appendChild(col10);
    listgroupitem.appendChild(formgroup);
    Formu.appendChild(listgroupitem);
    setCampos(myObj);
  }
  let request = $.ajax({
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
  $('#ModalPropiedades').modal('show');
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
  var nombre = document.getElementById("NombresForm").value;
  var apellido = document.getElementById("ApellidosForm").value;
  var sede = document.getElementById("idSedesSelect").value;
  var categoria = document.getElementById("idCategoriasSelect").value;

  if (nombre === "" || apellido == "" || sede == "" || categoria == "" || bien == false)
  {
    alert("Los siguientes campos son absolutamente obligatorios: Nombre, Apelliido, Sede, Actividades (llenar correctamente en case de no haberlo) y Categoría\n\
    (Se recomienda llenar todos)");
  } else {
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
    $('#ModalPropiedades').modal('show')
    $("#TablaActividades").html(texto);
    $("#IdActividadesSelect").addClass("hidden");
    $("#IdActividadesVer").removeClass("hidden");
  });
});
</script>
