<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-default">
      <div class="panel-heading">Listado de Aranceles
      </div>
      <div class="table-responsive col-sm-12">
        <table class="table table-hover" >
          <thead>
            <tr>
              <th class="hidden">idActividadesAranceles</th>
              <th>Actividad</th>
              <th>Modalidad</th>
              <th>Precio por Clase</th>
              <th>Precio por Mes</th>
              <th></th>
            </tr>
          </thead>
          <tbody id="Tabla">
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>
<script src="<?php echo URL; ?>views/recursos/logicaABM.js"></script>
<script>
var MyObj;
var request = $.ajax({
  url: "<?php echo URL; ?>cobro/listadoAranceles",
  type: "post",
});
request.done(function (respuesta){
  MyObj = JSON.parse(respuesta);
  var texto = "";
  for (var i = 0; i < MyObj.length; i++) {
    texto += "<tr>";
    texto += "<td class='hidden'>" + MyObj[i].idActividadesAranceles + " </td>";
    texto += "<td>" + MyObj[i].actNombre + " </td>";
    texto += "<td>" + MyObj[i].modNombre + " </td>";
    if (MyObj[i].PrecioXClase == null) {
      texto += "<td> <input type='text' id='Clase" + i + "'></td>";
    }else {
      texto += "<td> <input type='text' id='Clase" + i + "' value='" + MyObj[i].PrecioXClase + "'></td>";
    }
    if (MyObj[i].PrecioXMes == null) {
      texto += "<td> <input type='text' id='Mes" + i + "'></td>";
    }else {
      texto += "<td> <input type='text' id='Mes" + i + "'value='" + MyObj[i].PrecioXMes + "'></td>";
    }
    texto += "<td><button class='btn btn-default' onclick='Enviar(" + i + ")' type='button'>Aceptar</button></td>";
    texto += "</tr>";
  }
  $("#Tabla").html(texto);
});
function Enviar(i)
{
  var request = $.ajax({
    url: "<?php echo URL; ?>cobro/modArancel",
    type: "post",
    data: "data=" + JSON.stringify({PrecioXClase: $("#Clase" + i).val(), PrecioXMes: $("#Mes" + i).val(), idActividadesAranceles: MyObj[i].idActividadesAranceles})
  });

}
</script>
