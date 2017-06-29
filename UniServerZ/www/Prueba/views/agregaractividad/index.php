<script src="<?php echo URL; ?>views/recursos/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo URL; ?>views/recursos/bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js" charset="UTF-8"></script>
<link href="<?php echo URL; ?>views/recursos/bootstrap-datepicker/css/bootstrap-datepicker3.standalone.min.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo URL; ?>views/recursos/jquery.timepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo URL; ?>views/recursos/jquery.timepicker.css" />
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
                <p id="Inicio" class="form-control-static"></p>
                <input type="text" style="display: none;" class="form-control" id="InicioForm" placeholder="Horario de inicio">

              </div>
            </div>
          </li>

          <li class="list-group-item">
            <div class="form-group">
              <label class="col-sm-2 control-label">Horario de finalización:</label>
              <div class="col-sm-10">
                <p id="Finalizacion" class="form-control-static"></p>
                <input type="text" style="display: none;" class="form-control" id="FinalizacionForm" placeholder="Horario de finalización">

              </div>
            </div>
          </li>

          <li class="list-group-item">
            <div class="form-group">
              <label class="col-sm-2 control-label">Se repite:</label>
              <div class="col-sm-10">
                <input type="checkbox" onclick='check()' class="checkbox hidden disabled" id="SeRepiteForm">
                <button type="button" id="RepeticionSelect" onclick="$('#DiaFin').datepicker({language: 'es',startDate: $('#FechaForm').val() + '+1d',autoclose: true})" class="btn btn-link hidden" data-toggle="modal" data-target="#RepEdit">Elegir repetición</button>
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
        <h4 class="modal-title">Repetición</h4>
      </div>
      <div class="modal-body" id="Selec">
        <form class="form-horizontal">
          <div class="form-group">
            <label class="col-sm-2 control-label">Se repite:</label>
            <div class="col-sm-4">
              <select id="RepSelect" class="form-control" onchange="byebye()">
                <option  value="0" title="Todos los días">Todos los días</option>
                <option value="1" title="Todos los días hábiles (de lunes a viernes)">Todos los días hábiles (de lunes a viernes)</option>
                <option value="2" title="Todos los lunes, miércoles y viernes">Todos los lunes, miércoles y viernes</option>
                <option value="3" title="Todos los martes y jueves">Todos los martes y jueves</option>
                <option value="4" title="Todas las semanas">Todas las semanas</option>
                <option value="5" title="Todos los meses">Todos los meses</option>
                <option value="6" title="Todos los años">Todos los años</option>
              </select>
            </div>
          </div>
          <div class="form-group" id="intervalo">
            <label class="col-sm-2 control-label">Repetir cada:</label>
            <div class="col-sm-4">
              <span>
                <select  class="form-control" id="RepCada">
                  <option value="1" selected="selected">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6">6</option>
                  <option value="7">7</option>
                  <option value="8">8</option>
                  <option value="9">9</option>
                  <option value="10">10</option>
                  <option value="11">11</option>
                  <option value="12">12</option>
                  <option value="13">13</option>
                  <option value="14">14</option>
                  <option value="15">15</option>
                  <option value="16">16</option>
                  <option value="17">17</option>
                  <option value="18">18</option>
                  <option value="19">19</option>
                  <option value="20">20</option>
                  <option value="21">21</option>
                  <option value="22">22</option>
                  <option value="23">23</option>
                  <option value="24">24</option>
                  <option value="25">25</option>
                  <option value="26">26</option>
                  <option value="27">27</option>
                  <option value="28">28</option>
                  <option value="29">29</option>
                  <option value="30">30</option>
                </select>
                <p id="unidad"> días</p>
              </span>
            </div>
          </div>
          <div class="form-group hidden" id="diasmes">
            <label class="col-sm-2 control-label">Repetir el:</label>
            <label class="radio-inline">
              <input type="radio" name="diadelmes" id="diadelmes" onclick="fdiadelmes()" value="diames"> día del mes (Ej.: "el cuarto miércoles del mes")
            </label>
            <label class="radio-inline">
              <input type="radio" name="diadelasemana" id="diadelasemana" onclick="fdiadelasemana()" value="diasemana" checked> día de la semana (Ej.: "el 28 de cada mes")
            </label>
          </div>
          <div class="form-group hidden" id="diassemana">
            <label class="col-sm-2 control-label">Repetir el:</label>
            <label class="checkbox-inline">
              <input type="checkbox" id="lunes" value="lunes"> L
            </label>
            <label class="checkbox-inline">
              <input type="checkbox" id="martes" value="martes"> M
            </label>
            <label class="checkbox-inline">
              <input type="checkbox" id="miercoles" value="miercoles"> X
            </label>
            <label class="checkbox-inline">
              <input type="checkbox" id="jueves" value="jueves"> J
            </label>
            <label class="checkbox-inline">
              <input type="checkbox" id="viernes" value="viernes"> V
            </label>
            <label class="checkbox-inline">
              <input type="checkbox" id="sabado" value="sabado"> S
            </label>
            <label class="checkbox-inline">
              <input type="checkbox" id="domingo" value="domingo"> D
            </label>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">Termina:</label>
            <div class="col-sm-10">
              <div class="radio">
                <label>
                  <input type="radio" onclick="radio1()" id="optionsRadios1" checked value="option1">
                  Nunca
                </label>
              </div>
            </br>
            <div class="radio form-inline">
              <label>
                <input type="radio" onclick="radio2()" id="optionsRadios2" value="option2">
                Después de
                <input type="number" id="NumVeces" class="form-control" disabled>
                veces
              </label>
            </div>
          </br>
          <div class="radio form-inline">
            <label>
              <input type="radio" onclick="radio3()" id="optionsRadios3" value="option3">
              El
              <input type="date" id="DiaFin" class="form-control" disabled>
            </label>
          </div>
        </div>
      </div>
    </form>

  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-default"onclick="document.getElementById('SeRepiteForm').checked=false" data-dismiss="modal">Cancelar</button>
    <button type="button" class="btn btn-primary" onclick="aceptarModal()"> Aceptar</button>
  </div>
</div>
</div><!-- /.modal-content-->
</div> <!--/.modal-dialog -->
</div> <!--/.modal -->
<script>
$('#InicioForm').timepicker({ 'timeFormat': 'H:i:s' });
$('#FinalizacionForm').timepicker({ 'timeFormat': 'H:i:s' });
var RepFinal = {};
function aceptarModal(){
  RepFinal['TipoRepeticion'] = document.getElementById("RepSelect").value;
  switch (document.getElementById("RepSelect").value) {
    case "0":
    RepFinal['RepCadaXDias'] = document.getElementById("RepCada").value;
    break;
    case "4":
    RepFinal['RepCadaXSemanas'] = document.getElementById("RepCada").value;
    var dias = document.getElementById("diassemana").document.getElementByTag("input");
    var diasvec = [];
    for (day in dias) {
      if (dias[day].checked==true) {
        diasvec.push(dias[day].value);
      }
    }
    if (diasvec.toString()=='') {
      var diaEvento = new Date($('#FechaForm').val());
      var days = ["domingo","lunes","martes","miercoles","jueves","viernes","sabado"];
      diaEvento = diaEvento.getDay();
      diasvec.push(days[diaEvento].value);
    }
    RepFinal['DiasARepXSemana'] = diasvec;
    break;
    case "5":
    RepFinal['RepCadaXMeses'] = document.getElementById("RepCada").value;
    var modo = document.getElementById("diasmes").document.getElementByTag("input");
    for (caca in modo) {
      if (modo[caca].checked==true) {
        RepFinal['ModoRepMes'] = modo[caca].value;
      }
    }
    break;
    case "6":
    RepFinal['RepCadaXAno'] = document.getElementById("RepCada").value;
    break;
  }
}
RepFinal = JSON.stringify(RepFinal);
$('#FechaForm').datepicker({
  language: "es",
  startDate: "today",
  autoclose: true,
  format: "yyyy-mm-dd"
});
function byebye(){
  switch (document.getElementById("RepSelect").value) {
    case "0":
    $("#unidad").text(' días');
    $("#intervalo").removeClass('hidden');
    $("#diassemana").addClass('hidden');
    $("#diasmes").addClass('hidden');

    break;
    case "4":
    $("#intervalo").removeClass('hidden');
    $("#unidad").text(' semanas');
    $("#diassemana").removeClass('hidden');
    $("#diasmes").addClass('hidden');

    break;
    case "5":
    $("#intervalo").removeClass('hidden');
    $("#unidad").text(' meses');
    $("#diassemana").addClass('hidden');
    $("#diasmes").removeClass('hidden');
    break;
    case "6":
    $("#intervalo").removeClass('hidden');
    $("#unidad").text(' años');
    $("#diassemana").addClass('hidden');
    $("#diasmes").addClass('hidden');
    break;
    default:
    $("#intervalo").addClass('hidden');
    $("#unidad").addClass('hidden');
    $("#diassemana").addClass('hidden');
    $("#diasmes").addClass('hidden');
  }
}
function fdiadelmes(){
  document.getElementById("diadelasemana").checked = false;
}
function fdiadelasemana(){
  document.getElementById("diadelmes").checked = false;
}
function radio1(){
  document.getElementById("optionsRadios2").checked = false;
  document.getElementById("optionsRadios3").checked = false;
  document.getElementById("NumVeces").disabled = true;
  document.getElementById("DiaFin").disabled = true;
}
function radio2(){
  document.getElementById("optionsRadios1").checked = false;
  document.getElementById("optionsRadios3").checked = false;
  document.getElementById("NumVeces").disabled = false;
  document.getElementById("DiaFin").disabled = true;
}
function radio3(){
  document.getElementById("optionsRadios2").checked = false;
  document.getElementById("optionsRadios1").checked = false;
  document.getElementById("NumVeces").disabled = true;
  document.getElementById("DiaFin").disabled = false;
}
document.getElementById("SeRepiteForm").disabled = true;
function check (){
  var check = document.getElementById("SeRepiteForm");
  if (check.checked == true) {
    $("#RepeticionSelect").removeClass("hidden");
  }else {
    $("#RepeticionSelect").addClass("hidden");
  }
}
document.getElementById("BtnModificar").style.display = 'none';
document.getElementById("BtnAceptar").style.display = 'none';
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
  var data = "";
  var datos = {};
  datos['Inicio'] = document.getElementById("FechaForm").value +'T'+document.getElementById("InicioForm").value+'−03:00';
  datos['Finalizacion'] = document.getElementById("FechaForm").value +'T'+document.getElementById("FinalizacionForm").value+'−03:00';
  datos['Nombre'] = document.getElementById("NombresForm").value;
  if (datos['Nombre'] === "" || datos['Inicio'].length != 22 || datos['Inicio'].length != 22)
  {
    alert("Ingrese los campos correctamente");
  } else {
    if (RepFinal.length != 2) {
      data = "data1=" + JSON.stringify(datos)+ "&data2=" + RepFinal;
    }else {
      data = "data1=" + JSON.stringify(datos)+ "&data2='no'";
    }
    var url = "<?php echo URL; ?>actividad/editarActividad";
    $.ajax({
      type: "POST",
      url: url,
      data: data,
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
