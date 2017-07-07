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
<script>
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

function ingresoFecha(){
  var dia={};
  dia["timeMax"] = document.getElementById("FechaForm").value +'T23:59:59−03:00';
  dia["timeMin"] = document.getElementById("FechaForm").value +'T00:00:00−03:00';
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
        for (act in eventos) {
          texto += "<tr onclick='traerEvento(" + i + ")'>";
          texto += "<td class='hidden'>" + eventos[act].idEvento + " </td>";
          texto += "<td>" + eventos[act].Nombre + " </td>";
          texto += "</tr>";
        }
        texto += "</tr>"
        $("#ListaEventos").removeClass('hidden');
        $("#TablaActividades").html(texto);
      }
    }
  });
}
function traerEvento(fila){
  var x = document.getElementById('TablaActividades').rows[fila].cells;
  var ActNombre = x[1].innerHTML;
  var VecNombre = ActNombre.split(" ");
  alert(cosa);
  $.ajax({
    type: "POST",
    url: "<?php echo URL; ?>actividad/traerAnotados",
    data: "data=" + JSON.stringify(VecNombre),
    success: function (respuesta)
    {

    }
  });
}
</script>
