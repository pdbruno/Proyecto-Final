<script>
var MyObj;
var request = $.ajax({
  url: "<?php echo URL; ?>cobro/listarElementos/Aranceles",
  type: "post",
});
request.done(function (respuesta){
  MyObj = JSON.parse(respuesta);
  let texto = "";
  MyObj.sort(function(a, b){return a.idActividades - b.idActividades}); 
  for (var i = 0; i < MyObj.length; i++) {
    texto += "<tr>";
    texto += "<td class='hidden'>" + MyObj[i].idActividadesAranceles + " </td>";
    texto += "<td>" + MyObj[i].actNombre + " </td>";
    texto += "<td>" + MyObj[i].pagNombre + " </td>";
    if (MyObj[i].modNombre == null) {
      texto += "<td>-</td>";
    }else {
      texto += "<td>" + MyObj[i].modNombre + " </td>";
    }
    if (MyObj[i].Precio == null) {
      texto += "<td> <div class='input-group'>\
      <span class='input-group-addon'>$</span>\
      <input type='text' id='Clase" + i + "' class='form-control'>\
      <span class='input-group-addon'>.00</span>\
      </div> </td>";
    }else {
      texto += "<td> <div class='input-group'>\
      <span class='input-group-addon'>$</span>\
      <input type='text' value='" + MyObj[i].Precio + "' id='Clase" + i + "' class='form-control'>\
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
    data: "data=" + JSON.stringify({Precio: $("#Clase" + i).val(), idModosDePago: MyObj[i].idModosDePago, idActividades: MyObj[i].idActividades, idModalidades: MyObj[i].idModalidades})
  });
}
</script>
