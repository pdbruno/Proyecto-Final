<script>
var MyObj;


function req(){
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "<?php echo URL; ?>cliente/listadoPlanillitaEsteban");
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
    if(xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
      document.getElementById('Tabla').innerHTML = "";
      MyObj = JSON.parse(xhr.responseText);
      let texto = "";
      for (var i = 0; i < MyObj.length; i++) {
        texto += "<tr>";
        texto += "<td>" + MyObj[i].Nombre + " </td>";
        texto += "<td>" + MyObj[i].UltimoExamen + " </td>";
        texto += "<td>" + MyObj[i].ProximoExamen + " </td>";
        texto += "<td><button class='btn btn-default' onclick='Enviar(" + i + ")' type='button'>Posponer 6 meses</button></td>";
        texto += "</tr>";
      }
      document.getElementById('Tabla').innerHTML = texto;
    }
  };
  xhr.send();
}
req();

function Enviar(i)
{
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "<?php echo URL; ?>cliente/posponerExamen");
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function() {
    if(xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
      req();
    }
  };
  xhr.send("data=" + MyObj[i].idClientes);
}
</script>
