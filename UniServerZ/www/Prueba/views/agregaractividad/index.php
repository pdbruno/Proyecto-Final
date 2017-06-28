<script src="<?php echo URL; ?>views/recursos/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo URL; ?>views/recursos/bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js" charset="UTF-8"></script>
<link href="<?php echo URL; ?>views/recursos/bootstrap-datepicker/css/bootstrap-datepicker3.standalone.min.css" rel="stylesheet">
<div class="row" style="height:100%;">
  <div class="col-lg-6">
    <div class="panel panel-default">
      <div class="panel-heading">Listado de Activiadades
      </div>
      <div class="table-responsive col-sm-12">
        <table class="table table-hover" >
          <thead>
            <tr>
              <th style="display:none;">idActividades</th>
              <th>Actividad</th>
              <th>Nivel</th>
            </tr>
          </thead>
          <tbody id="TablaActividades">
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div id="Formu" class="col-lg-6" style="height: 100%">
    <div class="panel panel-default">
      <ul class="list-group">
        <form class="form-horizontal">
          <li class="list-group-item">
            <div class="form-group">
              <label class="col-sm-2 control-label">Id:</label>
              <div class="col-sm-10">
                <p id="idClientes" class="form-control-static"></p>
                <input type="text" style="display: none;" class="form-control" id="idClientesForm" placeholder="Se mira y no se toca" disabled>

              </div>
            </div>
          </li>
          <li class="list-group-item">
            <div class="form-group">

              <label class="col-sm-2 control-label">Nombre del evento:</label>
              <div class="col-sm-10">
                <p id="Nombres" class="form-control-static"></p>
                <input type="text" style="display: none;" class="form-control" id="NombresForm" placeholder="Nombres">
              </div>

            </div>
          </li>
          <li class="list-group-item">
            <div class="form-group">
              <label class="col-sm-2 control-label">Fecha:</label>
              <div class="col-sm-10">
                <p id="Fecha" class="form-control-static"></p>
                <input type="text" style="display: none;" class="form-control" id="FechaForm" placeholder="Fecha">
              </div>
            </div>
          </li>
          <li class="list-group-item">
            <div class="form-group">
              <label class="col-sm-2 control-label">Horario de inicio:</label>
              <div class="col-sm-10">
                <p id="DNI" class="form-control-static"></p>
                <input type="number" min="0" style="display: none;" class="form-control" id="InicioForm" placeholder="Horario de inicio">

              </div>
            </div>
          </li>

          <li class="list-group-item">
            <div class="form-group">
              <label class="col-sm-2 control-label">Horario de finalización:</label>
              <div class="col-sm-10">
                <p id="Domicilio" class="form-control-static"></p>
                <input type="text" style="display: none;" class="form-control" id="FinalizacionForm" placeholder="Horario de finalización">

              </div>
            </div>
          </li>

          <li class="list-group-item">
            <div class="form-group">
              <label class="col-sm-2 control-label">Se repite:</label>
              <div class="col-sm-10">
                <input type="checkbox" onclick='check()' class="checkbox hidden disabled" id="SeRepiteForm">
                <button type="button" id="RepeticionSelect"  class="btn btn-link hidden" data-toggle="modal" data-target="#RepEdit">Elegir repetición</button>
              </div>
            </div>
          </li>
        </form>
      </ul>
    </div>
    <button type="button" id="BtnModificar"onclick="ModificarActividad()" class="btn btn-primary">Editar Actividad</button>
    <button type="button" id="BtnAceptar" onclick="EnviarActividad()" class="btn btn-success">Aceptar</button>
  </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="RepEdit">
  <div class="modal-dialog" role="document" >
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Seleccionar actividad/es</h4>
      </div>
      <div class="modal-body" id="Selec">

        <div class="row" id="Act1">
          <div class="col-md-4">
            <select id="IdActividadesSelect1" class="form-control" onchange="ActividadesSelect1()">
            </select>
          </div>
          <div class="col-md-4">
            <select id="IdModalidadesSelect1" class="form-control hidden">
              <option disabled selected value>Modalidad</option>
              <option value='1'>1 a 2 veces por semana</option>
              <option value='2'>Pase Libre</option>
            </select>
          </div>
          <div class="col-md-4">
            <select id="IdNivelesSelect1" class="form-control hidden">
              <option disabled selected value>Nivel</option>
              <option value='1'>Inicial</option>
              <option value='2'>Infantiles A</option>
              <option value='3'>Infantiles B</option>
              <option value='4'>Juveniles y Adultos</option>
              <option value='5'>Mañana</option>
              <option value='6'>Tarde</option>
              <option value='7'>Noche</option>

            </select>
          </div>
        </div>
        <button type="button" id="AddAct1" class="btn btn-link" onclick="AddAct1()" >+AgregarActividad</button>
        <div class="collapse" id="Act2">
          <div class="row" style="margin-top: 50px;">
            <div class="col-md-4">
              <select id="IdActividadesSelect2" class="form-control" onchange="ActividadesSelect2()">
              </select>
            </div>
            <div class="col-md-4">
              <select id="IdModalidadesSelect2" class="form-control hidden">
                <option disabled selected value>Modalidad</option>
                <option value='1'>1 a 2 veces por semana</option>
                <option value='2'>Pase Libre</option>
              </select>
            </div>
            <div class="col-md-4">
              <select id="IdNivelesSelect2" class="form-control hidden">
                <option disabled selected value>Nivel</option>
                <option value='1'>Inicial</option>
                <option value='2'>Infantiles A</option>
                <option value='3'>Infantiles B</option>
                <option value='4'>Juveniles y Adultos</option>
                <option value='5'>Mañana</option>
                <option value='6'>Tarde</option>
                <option value='7'>Noche</option>
              </select>
            </div>
          </div>
          <button type="button" id="AddAct2" class="btn btn-link" onclick="AddAct2();">+AgregarActividad</button>
          <div class="collapse" id="Act3">
            <div class="row" style="margin-top: 50px;">
              <div class="col-md-4">
                <select id="IdActividadesSelect3" class="form-control" onchange="ActividadesSelect3()">
                </select>
              </div>
              <div class="col-md-4">
                <select id="IdModalidadesSelect3" class="form-control hidden">
                  <option disabled selected value>Modalidad</option>
                  <option value='1'>1 a 2 veces por semana</option>
                  <option value='2'>Pase Libre</option>
                </select>
              </div>
              <div class="col-md-4">
                <select id="IdNivelesSelect3" class="form-control hidden">
                  <option disabled selected value>Nivel</option>
                  <option value='1'>Inicial</option>
                  <option value='2'>Infantiles A</option>
                  <option value='3'>Infantiles B</option>
                  <option value='4'>Juveniles y Adultos</option>
                  <option value='5'>Mañana</option>
                  <option value='6'>Tarde</option>
                  <option value='7'>Noche</option>
                </select>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default"onclick="deshacerModal()" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" onclick="aceptarModal()"> Aceptar</button>
      </div>
    </div>
  </div><!-- /.modal-content-->
</div> <!--/.modal-dialog -->
</div> <!--/.modal -->
<script>
document.getElementById("SeRepiteForm").disabled = true;
function check (checkbox){
  var check = document.getElementById("SeRepiteForm");
  if (check.checked == true) {
    $("#RepeticionSelect").removeClass("hidden");
  }
}
$('#Fecha').datepicker({
  format: "yyyy/mm/dd",
  endDate: "today",
  language: "es",
  autoclose: true,
});
document.getElementById("BtnModificar").style.display = 'none';
document.getElementById("BtnAceptar").style.display = 'none';

function optionCrear(vec) {
  var txt = "";
  for (var i = 0; i < vec.length; i++) {
    if (vec[i].Nombre.length > 1) {
      txt += "<option value='" + vec[i].id + "'>" + vec[i].Nombre + "</option>";
    }
  }
  return txt;
}
function repetitivaCrear(Ids, Nombres) {
  var Cosa = [];
  var Vec = [];
  for (var i = 0; i < Ids.length; i++) {
    Cosa = {id: Ids[i], Nombre: Nombres[i]};
    Vec.push(Cosa);
  }
  return Vec;
}
var VecClientes = [];

function mostrarOcultar() {
  document.getElementById("BtnAceptar").style.display = 'inline-block';
  document.getElementById("BtnModificar").style.display = 'none';
}
function ModificarActividad()
{
  $("#SeRepiteForm").removeAttr("disabled");
  $("#SeRepiteForm").removeClass("disabled");
  mostrarOcultar();
  var x = document.getElementsByClassName("form-control-static");
  var y = document.getElementsByClassName("form-control");
  for (var i = 0; i < x.length; i++) {
    x[i].style.display = 'none';
  }
  for (var i = 0; i < y.length; i++) {
    y[i].style.display = 'block';
  }
  var z = document.getElementsByClassName("checkbox");
  for (var i = 0; i < z.length; i++) {
    z[i].disabled = false;
    z[i].style.display = 'block';
  }

}
var vec = [];
function EnviarActividad()
{
  var nombre = document.getElementById("NombresForm").value;
  var fecha = document.getElementById("FechaForm").value;
  var inicio = document.getElementById("InicioForm").value;
  var finalizacion = document.getElementById("FinalizacionForm").value;
  if (nombre === "" || fecha == "" || inicio == "" || finalizacion == "")
  {
    alert("Los siguientes campos son absolutamente obligatorios: Nombre, fecha, inicio, finalizacion");
  } else {
    vec = [];
    var x = document.getElementById("Formu").getElementsByTagName("input");
    var z = document.getElementsByClassName("checkbox");
    for (var i = 0; i < z.length; i++) {
      if (z[i].checked == true) {
        z[i].value = 1;
      } else {
        z[i].value = 0;
      }
    }
    for (var i = 0; i < x.length; i++) {
      if (x[i].value === "") {
        x[i].value = null;
      }
      vec.push(x[i].value);
    }
    var url = "<?php echo URL; ?>actividad/editarActividad";
    $.ajax({
      type: "POST",
      url: url,
      data: "data1=" + JSON.stringify(vec) + "&data2=" + final,
      success: function (respuesta)
      {
        var x = document.getElementById("Formu").getElementsByClassName("form-control-static");
        var y = document.getElementById("Formu").getElementsByClassName("form-control");
        for (var i = 0; i < x.length; i++) {
          x[i].style.display = 'block';
          x[i].innerHTML = "";
        }
        for (var i = 0; i < y.length; i++) {
          y[i].style.display = 'none';
        }
        var z = document.getElementById("Formu").getElementsByClassName("checkbox");
        for (var i = 0; i < z.length; i++) {
          z[i].disabled = true;
          z[i].style.display = 'none';
        }
        $("#IdActividadesSelect").addClass("hidden");
        mostrarOcultar2();
      }
    });
  }
}
function mostrarOcultar2() {
  document.getElementById("BtnModificar").style.display = 'none';
  document.getElementById("BtnAceptar").style.display = 'none';
}
function traerActividad(valor) {
  document.getElementById("BtnModificar").style.display = 'block';
  var id = valor.substr(0, 1);
  var Nombre = valor.substr(2).trim();
  alert("Id: " + id);
  alert("Nombre: " + Nombre);
  $.ajax({
    type: "POST",
    data: "data=" + id,
    url: "<?php echo URL; ?>actividad/mostrar",
    success: function (respuesta)
    {
      // var obj = JSON.parse(respuesta)[0][0];
      // var actividades = JSON.parse(respuesta)[1];
      // var texto = "";
      // for (x in obj) {
      //   document.getElementById(x).innerHTML = obj[x];
      //   document.getElementById(x).style.display = 'block';
      //   var input = document.getElementById(x + "Form");
      //   input.style.display = 'none';
      //   if (input.type == 'checkbox') {
      //     if (obj[x] == 1) {
      //       input.checked = true;
      //     } else {
      //       input.checked = false;
      //     }
      //   } else {
      //     input.value = obj[x];
      //   }
      // }
      var y = document.getElementsByClassName("checkbox");
      for (i = 0; i < y.length; i++) {
        $("#" + y[i].id).removeClass("hidden");
      }
      document.getElementById("BtnModificar").style.display = 'inline-block';
      document.getElementById("BtnAceptar").style.display = 'none';
    }
  });
}
var texto = "";
$.ajax({
  type: "POST",
  url: "<?php echo URL; ?>actividad/traerActividades",
  success: function (respuesta)
  {
    var actividades = JSON.parse(respuesta);
    var i = 0;
    for (act in actividades) {
      texto += "<tr onclick='traerActividad($(this).text())'>";
      texto += "<td style='display:none;'>" + i + " </td>";
      for (prop in actividades[act]) {
        if (actividades[act][prop] != null) {
          texto += "<td>" + actividades[act][prop] + " </td>";

        } else {
          texto += "<td>-</td>";
        }
      }
      i++;
      texto += "</tr>";
      sub = [];
    }
    texto += "</tr>"
    $("#TablaActividades").html(texto);
  }
});
</script>
