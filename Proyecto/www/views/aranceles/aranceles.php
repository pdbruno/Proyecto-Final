<script>
var MyObj;

let xhr = new XMLHttpRequest();
xhr.open("POST", "<?php echo URL; ?>cobro/listarElementos/Aranceles");
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.onreadystatechange = function () {
  if(xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
    MyObj = JSON.parse(xhr.responseText);
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
    document.getElementById('Tabla').innerHTML = texto;
  }
};
xhr.send();

function Enviar(i)
{
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "<?php echo URL; ?>cobro/agregarModificarElemento/actividadesaranceles");
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.send("data=" + JSON.stringify({Precio: $("#Clase" + i).val(), idModosDePago: MyObj[i].idModosDePago, idActividades: MyObj[i].idActividades, idModalidades: MyObj[i].idModalidades}));
}
</script>
