<script>
var MyObj;
var request = $.ajax({
  url: "<?php echo URL; ?>cobro/listarSueldos",
  type: "post",
});
request.done(function (respuesta){
  MyObj = JSON.parse(respuesta);
  let texto = "";
  for (var i = 0; i < MyObj.length; i++) {
    texto += "<tr>";
    texto += "<td class='hidden'>" + MyObj[i].idCategoriasSueldos + " </td>";
    texto += "<td>" + MyObj[i].catNombre + " </td>";
    if (MyObj[i].MontoXBloque == null) {
      texto += "<td> <div class='input-group'>\
        <span class='input-group-addon'>$</span>\
        <input type='text' id='Monto" + i + "' class='form-control'>\
        <span class='input-group-addon'>.00</span>\
      </div> </td>";
    }else {
      texto += "<td> <div class='input-group'>\
        <span class='input-group-addon'>$</span>\
        <input type='text' value='" + MyObj[i].MontoXBloque + "' id='Monto" + i + "' class='form-control'>\
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
    url: "<?php echo URL; ?>cobro/modSueldo",
    type: "post",
    data: "data=" + JSON.stringify({MontoXBloque: $("#Monto" + i).val(), idCategoriasSueldos: MyObj[i].idCategoriasSueldos})
  });
}
</script>
