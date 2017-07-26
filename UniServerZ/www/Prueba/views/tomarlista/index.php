<script src="<?php echo URL; ?>views/recursos/bootstrap3-typeahead.min.js"></script>
<script src="<?php echo URL; ?>views/recursos/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo URL; ?>views/recursos/bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js" charset="UTF-8"></script>
<link href="<?php echo URL; ?>views/recursos/bootstrap-datepicker/css/bootstrap-datepicker3.standalone.min.css" rel="stylesheet">
<div class="col-lg-3">
  <div class="row">
    <div class="input-group">
      <input type="text" class="form-control" id="FechaForm" name="FechaForm" placeholder="Fecha de la venta">
      <span class="input-group-btn">
        <button class="btn btn-default" onclick="ingresoFecha()" type="button">Aceptar</button>
      </span>
    </div>
  </div>
  <div class="row hidden" id="ListaEventos">
    <div class="panel panel-default">
      <div class="panel-heading">Listado de Eventos Recientes
      </div>
      <div class="table-responsive col-sm-12">
        <table class="table table-hover" >
          <thead>
            <tr>
              <th>Actividad</th>
            </tr>
          </thead>
          <tbody id="TablaActividades">
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<div class="col-lg-9 hidden" id="Asistencia">
  <input type="text" class="form-control" id="NombreForm" name="NombreForm" data-provide="typeahead" placeholder="Nombe o Apellido del alumno">
  <div class="list-group" id="ListaClientes">
  </div>
  <button class="btn btn-default" onclick="enviar()" type="button">Enviar lista de asistencia</button>
</div>
<script>
$( document ).ajaxError(function(e, xhr, opt){
  alert("Error requesting " + opt.url + ": " + xhr.status + " " + xhr.statusText);
});
var VecAsistio = [];
var idEvento = "";
var d = new Date();
var n = d.toISOString();
n = n.substr(0,10);
$('#FechaForm').val(n);
$('#FechaForm').datepicker({
  format: "yyyy-mm-dd",
  startDate: "01/01/2017",
  endDate: "today",
  maxViewMode: 0,
  todayBtn: "linked",
  language: "es",
  autoclose: true,
  todayHighlight: true
});
function enviar(){
  var request = $.ajax({
    url: "<?php echo URL; ?>actividad/asignarAsistencia",
    type: "post",
    data: "data=" + JSON.stringify(VecAsistio) + "&data2="+idEvento,

  });
  request.done(function (respuesta){
    alert('Se ha asignado la asistencia al evento');
    VecAsistio=[];
    $("#Asistencia").addClass("hidden");
  });

}

function ingresoFecha(){

  if ($("#FechaForm").val()=="") {
    alert("Ingrese una fecha")
  }else {
    var dia={};
    dia["timeMax"] = document.getElementById("FechaForm").value +'T23:59:59-03:00';
    dia["timeMin"] = document.getElementById("FechaForm").value +'T00:00:00-03:00';

    var request = $.ajax({
      url: "<?php echo URL; ?>actividad/traerEventos",
      type: "post",
      data: "data=" + JSON.stringify(dia),
    });
    request.done(function (respuesta){
      if (respuesta == '"no papu"') {
        alert('No hay eventos para ese día')
      }else {
        var eventos = JSON.parse(respuesta);
        var i = 0;
        var texto = "";
        for (act in eventos) {
          texto += "<tr onclick='traerEvento(this)' id='" + eventos[act].idEvento + "'>";
          texto += "<td>" + eventos[act].Nombre + " </td>";
          texto += "</tr>";
          i++;
        }
        texto += "</tr>"
        $("#ListaEventos").removeClass('hidden');
        $("#TablaActividades").html(texto);
      }
    });

  }
}
function elegir(boton, id){
  boton.toggleClass("list-group-item-info");
  if (VecAsistio.indexOf(id) == -1) {
    VecAsistio.push(id);
  } else {
    VecAsistio.splice(VecAsistio.indexOf(id), 1);
  }
}
function traerEvento(boton){
  VecAsistio = [];
  filas = document.getElementById("TablaActividades").rows;
  for (row in filas) {
    if (filas[row].id == boton.id) {
      $("#" + filas[row].id).addClass("success");
      idEvento = filas[row].cells[0].innerHTML;
    } else {
      $("#" + filas[row].id).removeClass("success");
    }
  }

  var request = $.ajax({
    url: "<?php echo URL; ?>actividad/traerAnotados",
    type: "post",
    data: "data=" + boton.id,

  });
  request.done(function (respuesta){
    $("#Asistencia").removeClass("hidden")
    respuesta = JSON.parse(respuesta);
    var texto = "";
    for (usuario in respuesta) {
      texto+= "<button type='button' class='list-group-item' onclick='elegir($(this),"+respuesta[usuario].idClientes+")' >" + respuesta[usuario].name + "</button>"
    }
    $("#ListaClientes").html(texto);
    $('#NombreForm').typeahead('destroy')
    $("#NombreForm").typeahead({
      source: respuesta,
      afterSelect: function(item){
        var botones =  document.getElementById("ListaClientes").getElementsByTagName("button");
        for (row in botones) {
          if (botones[row].innerHTML == item.name) {
            if (VecAsistio.indexOf(item.idClientes) == -1) {
              VecAsistio.push(item.idClientes);
              botones[row].className = "list-group-item list-group-item-info";
            } else {
              VecAsistio.splice(VecAsistio.indexOf(item.idClientes), 1);
              botones[row].className = "list-group-item";
            }
          }
        }
        $("#NombreForm").val("");
      }
    });

  });
}
</script>
