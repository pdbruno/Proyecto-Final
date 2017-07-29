<script src="<?php echo URL; ?>views/recursos/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo URL; ?>views/recursos/bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js" charset="UTF-8"></script>
<link href="<?php echo URL; ?>views/recursos/bootstrap-datepicker/css/bootstrap-datepicker3.standalone.min.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo URL; ?>views/recursos/jquery.timepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo URL; ?>views/recursos/jquery.timepicker.css" />
<script src="<?php echo URL; ?>views/recursos/rrule/rrule.js"></script>
<script src="<?php echo URL; ?>views/recursos/rrule/nlp.js"></script>
<link rel="stylesheet" href="<?php echo URL; ?>views/recursos/bootstrap-table/bootstrap-table.min.css">
<script src="<?php echo URL; ?>views/recursos/bootstrap-table/bootstrap-table.min.js"></script>
<script src="<?php echo URL; ?>views/recursos/bootstrap-table/bootstrap-table-es-AR.min.js"></script>
<div class="row" style="height:100%;">
  <div class="col-lg-6">
    <div class="panel panel-default">
      <div class="panel-heading">Listado de Activiadades
      </div>
      <div class="table-responsive col-sm-12">
        <table class="table table-hover" >
          <thead>
            <tr>
              <th class="hidden">idActividades</th>
              <th>Actividad</th>
            </tr>
          </thead>
          <tbody id="TablaActividades">
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div id="Formu" class="col-lg-6" style="height: 90%">
    <div class="panel panel-default">
      <ul class="list-group">
        <form class="form-horizontal">
          <li class="list-group-item">
            <div class="form-group">
              <label class="col-sm-2 control-label">Id:</label>
              <div class="col-sm-10">
                <p id="idActividades" class="form-control-static"></p>
                <input type="text" class="form-control hidden" id="idActividadesForm" placeholder="Se mira y no se toca" disabled>

              </div>
            </div>
          </li>
          <li class="list-group-item">
            <div class="form-group">

              <label class="col-sm-2 control-label">Nombre del evento:</label>
              <div class="col-sm-10">
                <p id="Nombre" class="form-control-static"></p>
                <input type="text"  class="form-control hidden" id="NombreForm" placeholder="Nombres">
              </div>

            </div>
          </li>
          <li class="list-group-item">
            <div class="form-group">
              <label class="col-sm-2 control-label">Fecha:</label>
              <div class="col-sm-10">
                <p id="Fecha" class="form-control-static"></p>
                <input type="text" class="form-control hidden" id="FechaForm" placeholder="Fecha">
              </div>
            </div>
          </li>
          <li class="list-group-item">
            <div class="form-group">
              <label class="col-sm-2 control-label">Horario de inicio:</label>
              <div class="col-sm-10">
                <p id="Inicio" class="form-control-static"></p>
                <input type="text" class="form-control hidden" id="InicioForm" placeholder="Horario de inicio">

              </div>
            </div>
          </li>

          <li class="list-group-item">
            <div class="form-group">
              <label class="col-sm-2 control-label">Horario de finalización:</label>
              <div class="col-sm-10">
                <p id="Finalizacion" class="form-control-static"></p>
                <input type="text" class="form-control hidden" id="FinalizacionForm" placeholder="Horario de finalización">

              </div>
            </div>
          </li>

          <li class="list-group-item">
            <div class="form-group">
              <label class="col-sm-2 control-label">Se repite:</label>
              <div class="col-sm-1">
                <input type="checkbox" onclick='check()' class="checkbox hidden" disabled id="SeRepiteForm">
              </div>
              <div class="col-sm-3">
                <button type="button" id="RepeticionSelect" onclick="$('#DiaFin').datepicker({language: 'es',startDate: $('#FechaForm').val() + '+1d',autoclose: true,format: 'yyyy-mm-dd'})" class="btn btn-link hidden" data-toggle="modal" data-target="#RepEdit">Elegir repetición</button>
              </div>
              <div class="col-sm-6">
                <p  id="resumen"></p>
              </div>
            </div>
          </li>
        </form>
      </ul>
    </div>
    <button type="button" id="BtnAceptar" onclick="Enviar()" class="btn btn-success hidden">Aceptar</button>
    <button type="button" id="BtnAgregar" onclick="AgregarActividad()" class="btn btn-default">Agregar</button>
    <button type="button" id="BtnModificar"onclick="ModificarActividad()" class="btn btn-primary hidden">Modificar</button>
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
              <input type="radio" name="diadelmes" id="diadelmes" onclick="fdiadelmes()" value="diames"> día del mes (Ej.: "el 28 de cada mes")
            </label>
            <label class="radio-inline">
              <input type="radio" name="diadelasemana" id="diadelasemana" onclick="fdiadelasemana()" value="diasemana" checked> día de la semana (Ej.: "el cuarto miércoles del mes")
            </label>
          </div>
          <div class="form-group hidden" id="cosaloca">
            <label class="col-sm-2 control-label">Repetir el:</label>
            <div class="col-sm-4">
              <select id="OrdinalSelect" class="form-control" onchange="byebye()">
                <option  value="1">Primer</option>
                <option value="2">Segundo</option>
                <option value="3">Tercer</option>
                <option value="4">Cuarto</option>
                <option value="-1">Último</option>
              </select>
            </div>
            <div class="col-sm-4">
              <select id="SemSelect" class="form-control" onchange="byebye()">
                <option  value="lunes">Lunes</option>
                <option value="martes">Martes</option>
                <option value="miercoles">Miércoles</option>
                <option value="jueves">Jueves</option>
                <option value="viernes">Viernes</option>
                <option value="sabadp">Sábado</option>
                <option value="domingo">Domingo</option>
              </select>
            </div>
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
            <div class="col-sm-10" id="radiostermina">
              <div class="radio">
                <label>
                  <input type="radio" class="radiomitre"onclick="radio1()" id="optionsRadios1" checked value="option1">
                  Nunca
                </label>
              </div>
            </br>
            <div class="radio form-inline">
              <label>
                <input type="radio" class="radiomitre" onclick="radio2()" id="optionsRadios2" value="option2">
                Después de
                <input type="number" id="NumVeces" class="form-control" disabled>
                veces
              </label>
            </div>
          </br>
          <div class="radio form-inline">
            <label>
              <input type="radio" class="radiomitre" onclick="radio3()" id="optionsRadios3" value="option3">
              El
              <input type="text" id="DiaFin" class="form-control" disabled>
            </label>
          </div>
        </div>
      </div>
    </form>

  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-primary" onclick="aceptarModal()" > Aceptar</button>
    <button type="button" class="btn btn-default"onclick="document.getElementById('SeRepiteForm').checked=false" data-dismiss="modal">Cancelar</button>
  </div>
</div>
</div><!-- /.modal-content-->
</div> <!--/.modal-dialog -->
</div> <!--/.modal -->
<script src="<?php echo URL; ?>views/recursos/logicaABM.js"></script>
<script>
function AgregarActividad()
{
  var rule;
  $("#SeRepiteForm").removeAttr("disabled");
  $("#SeRepiteForm").removeClass("disabled");
  $("#SeRepiteForm").prop('checked', false);
}
$('#InicioForm').timepicker({ 'timeFormat': 'H:i:s' });
$('#FinalizacionForm').timepicker({ 'timeFormat': 'H:i:s' });
var RepFinal = {};
function aceptarModal(){
  var texto = {dtstart: new Date($('#FechaForm').val())};
  RepFinal = {};
  $('#RepEdit').modal('hide');

  switch (document.getElementById("RepSelect").value) {
    case "0":
    texto.freq = RRule.DAILY;
    texto.interval = document.getElementById("RepCada").value;
    break;
    case "1":
    texto.freq = RRule.DAILY;
    texto.byweekday = [RRule.MO, RRule.TU, RRule.WE, RRule.TH, RRule.FR];
    break;
    case "2":
    texto.freq = RRule.DAILY;
    texto.byweekday = [RRule.MO, RRule.WE, RRule.FR];
    break;
    case "3":
    texto.freq = RRule.DAILY;
    texto.byweekday = [RRule.TU, RRule.TH];
    break;
    case "4":
    texto.freq = RRule.WEEKLY;
    if (document.getElementById("RepCada").value!=1) {
      texto.interval = document.getElementById("RepCada").value;
    }
    var dias = document.getElementById("diassemana").getElementsByTagName("input");
    var diasvec = [];
    for (day in dias) {
      if (dias[day].checked==true) {
        switch (dias[day].value) {
          case "lunes":
          diasvec.push(RRule.MO);
          break;
          case "martes":
          diasvec.push(RRule.TU);
          break;
          case "miercoles":
          diasvec.push(RRule.WE);
          break;
          case "jueves":
          diasvec.push(RRule.TH);
          break;
          case "viernes":
          diasvec.push(RRule.FR);
          break;
          case "sabado":
          diasvec.push(RRule.SA);
          break;
          case "domingo":
          diasvec.push(RRule.SU);
        }
      }
    }
    if (diasvec!=null) {
      texto.byweekday = diasvec;
    }
    break;
    case "5":
    texto.freq = RRule.MONTHLY;
    texto.interval = document.getElementById("RepCada").value;
    if (document.getElementById("diadelasemana").checked == true) {
      var dia;
      switch (document.getElementById("SemSelect").value) {
        case "lunes":
        dia = RRule.MO;
        break;
        case "martes":
        dia = RRule.TU;
        break;
        case "miercoles":
        dia = RRule.WE;
        break;
        case "jueves":
        dia = RRule.TH;
        break;
        case "viernes":
        dia = RRule.FR;
        break;
        case "sabado":
        dia = RRule.SA;
        break;
        case "domingo":
        dia = RRule.SU;
      }
      var ord = document.getElementById("OrdinalSelect").value;
      texto.byweekday= [dia.nth(ord)];
    }
    break;
    case "6":
    texto.freq = RRule.YEARLY;
    break;
  }
  var radios = document.getElementsByClassName("radiomitre");
  for (radio in radios) {
    if (radios[radio].checked==true) {
      switch (radios[radio].id) {
        case "optionsRadios2":
        texto.count = $("#NumVeces").val();
        break;
        case "optionsRadios3":
        texto.until = new Date($("#DiaFin").val());
      }
    }
  }
  rule  = new RRule(texto);
  $("#resumen").text(rule.toText());
}
$('#FechaForm').datepicker({
  language: "es",
  startDate: "today",
  autoclose: true,
  format: 'yyyy-mm-dd'
});
function byebye(){
  switch (document.getElementById("RepSelect").value) {
    case "0":
    $("#unidad").text(' días');
    $("#intervalo").removeClass('hidden');
    $("#diassemana").addClass('hidden');
    $("#cosaloca").addClass('hidden');
    $("#diasmes").addClass('hidden');

    break;
    case "4":
    $("#intervalo").removeClass('hidden');
    $("#unidad").text(' semanas');
    $("#diassemana").removeClass('hidden');
    $("#cosaloca").addClass('hidden');
    $("#diasmes").addClass('hidden');

    break;
    case "5":
    $("#intervalo").removeClass('hidden');
    $("#unidad").text(' meses');
    $("#diassemana").addClass('hidden');
    $("#cosaloca").removeClass('hidden');
    $("#diasmes").removeClass('hidden');
    break;
    case "6":
    $("#intervalo").removeClass('hidden');
    $("#unidad").text(' años');
    $("#diassemana").addClass('hidden');
    $("#diasmes").addClass('hidden');
    $("#cosaloca").addClass('hidden');
    break;
    default:
    $("#intervalo").addClass('hidden');
    $("#unidad").addClass('hidden');
    $("#diassemana").addClass('hidden');
    $("#cosaloca").addClass('hidden');
    $("#diasmes").addClass('hidden');
  }
}
function fdiadelmes(){
  document.getElementById("diadelasemana").checked = false;
  $("#cosaloca").addClass('hidden');
}
function fdiadelasemana(){
  $("#cosaloca").removeClass('hidden');
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

$("#BtnModificar").addClass("hidden");
$("#BtnAceptar").addClass("hidden");
$("#BtnAceptarAgr").addClass("hidden");

function ModificarActividad()
{
  $("#SeRepiteForm").removeAttr("disabled");
  modoFormulario('Modificar')
}
var vec = [];
var data = "";
var datos = {};
function format(){
  datos = {};
  data = "";
  datos['idActividades'] = document.getElementById("idActividadesForm").value;
  datos['Inicio'] = document.getElementById("FechaForm").value +'T'+document.getElementById("InicioForm").value+'-03:00';
  datos['Finalizacion'] = document.getElementById("FechaForm").value +'T'+document.getElementById("FinalizacionForm").value+'-03:00';
  datos['Nombre'] = document.getElementById("NombreForm").value;
  if (datos['Nombre'] === "" || datos['Inicio'].length != 25 || datos['Inicio'].length != 25)
  {
    alert("Ingrese los campos correctamente");
  } else {
    if (document.getElementById("SeRepiteForm").checked == true) {
      datos['Recurrencia'] = 'RRULE:' + rule.toString().substr(25);
    }else {
      datos['Recurrencia'] = 'no';
    }
    data = "data1=" + JSON.stringify(datos);
  }
}
var NotFound = false;
function Enviar()
{
  format();
  if (data != "") {
    var url;
    if (datos['idActividades']=="" || NotFound) {
      url = "addActividad";
    }else{
      url = "editarActividad";
    }
    var request = $.ajax({
      url: "<?php echo URL; ?>actividad/" + url,
      type: "post",
      data: data,
    });
    request.done(function (respuesta){
      afterEnviar();
      $("#resumen").text("");
      $("#SeRepiteForm").addClass("hidden");
      $("#RepeticionSelect").addClass("hidden")
    });
  }
}
function traerActividad(valor) {
  $("#SeRepiteForm").removeClass("hidden");
  document.getElementById("SeRepiteForm").setAttribute("disabled", true);
  var id = valor.substr(0, 11);
  var Nombre = valor.substr(11);

  var request = $.ajax({
    url: "<?php echo URL; ?>actividad/mostrar",
    type: "post",
    data: "data=" + id,
  });
  request.done(function (respuesta){
    if (respuesta == "Not Found") {
      alert('No hay un Evento en Google Calendar asignado a esta actividad. Por Favor llene los datos');
      NotFound = true;
      var rule;
      $("#SeRepiteForm").removeAttr("disabled");
      $("#SeRepiteForm").removeClass("disabled");
      $("#SeRepiteForm").prop('checked', false);
      modoFormulario('Agregar');
      $("#NombreForm").val(Nombre);
      $("#Nombre").text(Nombre);
      $("#idActividadesForm").val(id);
      $("#idActividades").text(id);
    } else {
      NotFound = false;
      var obj = JSON.parse(respuesta);
      clickFila(obj);
      if (obj["Recurrencia"] != null) {
        rule = rrulestr(obj["Recurrencia"][0]);
        var cucu = rule.toText();
        cucu = cucu.charAt(0).toUpperCase() + cucu.slice(1);
        $("#resumen").text(cucu);
        document.getElementById("SeRepiteForm").setAttribute("checked", true);
        $("#RepeticionSelect").removeClass("hidden");
      } else {
        document.getElementById("SeRepiteForm").setAttribute("checked", false);
        $("#RepeticionSelect").addClass("hidden");
        $("#resumen").text("");
      }
    }
  });

}
var texto = "";
var request = $.ajax({
  url: "<?php echo URL; ?>actividad/traerActividades",
  type: "post",
});
request.done(function (respuesta){
  var actividades = JSON.parse(respuesta);
  var i = 0;
  for (act in actividades) {
    texto += "<tr onclick='traerActividad($(this).text())'>";
    texto += "<td class='hidden'>" + actividades[act].idActividades + "</td>";
    texto += "<td>" + actividades[act].Nombre + "</td>";
    i++;
    texto += "</tr>";
    sub = [];
  }
  texto += "</tr>";
  $("#TablaActividades").html(texto);
});

</script>
