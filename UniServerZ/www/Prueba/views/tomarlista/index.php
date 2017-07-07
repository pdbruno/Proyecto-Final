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
              <th class='hidden'>idEvento</th>
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
var VecAsistio = [];
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
  alert(JSON.stringify(VecAsistio))
}
function ingresoFecha(){
  var dia={};
  dia["timeMax"] = document.getElementById("FechaForm").value +'T23:59:59-03:00';
  dia["timeMin"] = document.getElementById("FechaForm").value +'T00:00:00-03:00';
  $.ajax({
    type: "POST",
    url: "<?php echo URL; ?>actividad/traerEventos",
    data: "data=" + JSON.stringify(dia),
    success: function (respuesta)
    {
      if (respuesta == 'No hay eventos para ese día') {
        alert(respuesta)
      }else {
        var eventos = JSON.parse(respuesta);
        var i = 0;
        var texto = "";
        for (act in eventos) {
          texto += "<tr onclick='traerEvento($(this))' id='" + i + "'>";
          texto += "<td class='hidden'>" + eventos[act].idEvento + " </td>";
          texto += "<td>" + eventos[act].Nombre + " </td>";
          texto += "</tr>";
          i++;
        }
        texto += "</tr>"
        $("#ListaEventos").removeClass('hidden');
        $("#TablaActividades").html(texto);
      }
    }
  });
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
  filas = document.getElementById("TablaActividades").rows;
  for (row in filas) {
    if (filas[row].id == boton.attr('id')) {
      $("#" + filas[row].id).addClass("success");
    } else {
      $("#" + filas[row].id).removeClass("success");
    }
  }
  var x = document.getElementById(boton.attr('id')).cells;
  var ActNombre = x[1].innerHTML;
  var posEsp = ActNombre.indexOf(" ");
  var VecNombre = [];
  VecNombre.push(ActNombre.substr(0,posEsp).trim());
  VecNombre.push(ActNombre.substr(posEsp).trim());
  $.ajax({
    type: "POST",
    url: "<?php echo URL; ?>actividad/traerAnotados",
    data: "data=" + JSON.stringify(VecNombre),
    success: function (respuesta)
    {
      $("#Asistencia").removeClass("hidden")
      respuesta = JSON.parse(respuesta);
      var texto = "";
      for (usuario in respuesta) {
        texto+= "<button type='button' class='list-group-item' onclick='elegir($(this),"+respuesta[usuario].idClientes+")' >" + respuesta[usuario].name + "</button>"
      }
      $("#ListaClientes").html(texto);
      $('#NombreForm').typeahead('destroy')
      $("#NombreForm").typeahead({
      showHintOnFocus: "all",
      source: respuesta
    });
    }
  });
}
</script>
