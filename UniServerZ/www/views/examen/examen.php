<script type="text/javascript">

document.getElementById("BtnAgregar").remove();
var idClientes = "";

var xhr = new XMLHttpRequest();
xhr.open("POST", "<?php echo URL; ?>cliente/tabla/registroexamenes");
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.onreadystatechange = function () {
  if(xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
    let myObj = JSON.parse(xhr.responseText);
    myObj.splice(1, 1);
    crearCampos(myObj);
    modoFormulario("Agregar");
  }
};
xhr.send();


document.getElementById("BtnAgregar").addEventListener("click", function() {
  let vec = beforeEnviar();
  if (idClientes == "") {
    alert("Seleccione un cliente");
  }
  if (vec != 'no' && idClientes != "") {
    vec.idClientes = idClientes;
    console.log(vec);
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "<?php echo URL; ?>cliente/registrarExamen");
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
      if(xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
        modoFormulario("Agregar");
      }
    };
    xhr.send("data=" + JSON.stringify(vec));
  }
});


$('#Tabla').on('click-row.bs.table', function (row, element, field) {
  $('.success').removeClass('success');
  $(field).addClass('success');
  idClientes = element.idClientes;
});



</script>
