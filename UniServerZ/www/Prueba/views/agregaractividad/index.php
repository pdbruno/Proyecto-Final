<div class="row" style="height:100%;">
  <div class="col-md-6 col-md-offset-3">
    <table class="table table-hover" >
      <thead>
        <tr>
          <th>Actividad</th>
          <th>Nivel</th>
        </tr>
      </thead>
      <tbody id="TablaActividades">
      </tbody>
    </table>
  </div>
</div>
<script>
function caca (valor){
  $.ajax({
    type: "POST",
    url: "<?php echo URL; ?>actividad/mostrar",
    success: function (respuesta)
    {
      alert(respuesta);
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
    for (act in actividades) {
      texto += "<tr onclick='caca($(this).text())'>";
      for (prop in actividades[act]) {
        if (actividades[act][prop] != null) {
            texto+="<td>" + actividades[act][prop] + " </td>";

        }
        else {
          texto+="<td>-</td>";
        }
      }
      texto+="</tr>";
      sub=[];
    }
    texto+="</tr>"
    $("#TablaActividades").html(texto);
  }
});
$.ajax({
  type: "GET",
  url: "<?php echo URL; ?>actividad/manejar",
  success: function (respuesta)
  {
    alert(respuesta);
  }
});

</script>
