<script>
var MyObj;
var request = $.ajax({
  url: "<?php echo URL; ?>cobro/listarElementos/Aranceles",
  type: "post",
});
request.done(function (respuesta){
  MyObj = JSON.parse(respuesta);
  let texto = "";
  for (var i = 0; i < MyObj.length; i++) {
    texto += "<tr>";
    texto += "<td class='hidden'>" + MyObj[i].idActividadesAranceles + " </td>";
    texto += "<td>" + MyObj[i].actNombre + " </td>";
    texto += "<td>" + MyObj[i].modNombre + " </td>";
    if (MyObj[i].PrecioXClase == null) {
      texto += "<td> <div class='input-group'>\
        <span class='input-group-addon'>$</span>\
        <input type='text' id='Clase" + i + "' class='form-control'>\
        <span class='input-group-addon'>.00</span>\
      </div> </td>";
    }else {
      texto += "<td> <div class='input-group'>\
        <span class='input-group-addon'>$</span>\
        <input type='text' value='" + MyObj[i].PrecioXClase + "' id='Clase" + i + "' class='form-control'>\
        <span class='input-group-addon'>.00</span>\
      </div> </td>";
    }
    if (MyObj[i].PrecioXMes == null) {
      texto += "<td> <div class='input-group'>\
        <span class='input-group-addon'>$</span>\
        <input type='text' id='Mes" + i + "' class='form-control'>\
        <span class='input-group-addon'>.00</span>\
      </div> </td>";
    }else {
      texto += "<td> <div class='input-group'>\
        <span class='input-group-addon'>$</span>\
        <input type='text' value='" + MyObj[i].PrecioXMes + "' id='Mes" + i + "' class='form-control'>\
        <span class='input-group-addon'>.00</span>\
      </div> </td>";
    }
    texto += "<td><button class='btn btn-default' onclick='Enviar(" + i + ")' type='button'>Aceptar</button></td>";
    texto += "</tr>";
  }
  $("#Tabla").html(texto);
});
function Enviar(i)
{
  var request = $.ajax({
    url: "<?php echo URL; ?>cobro/addArancel",
    type: "post",
    data: "data=" + JSON.stringify({PrecioXClase: $("#Clase" + i).val(), PrecioXMes: $("#Mes" + i).val(), idActividades: MyObj[i].idActividades, idModalidades: MyObj[i].idModalidades, FechaInicio: new Date().toISOString().slice(0,10)})
  });

}
</script>
