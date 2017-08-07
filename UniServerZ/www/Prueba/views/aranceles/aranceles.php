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
