<script>
var xhr = new XMLHttpRequest();
xhr.open("POST", "<?php echo URL; ?>actividad/tabla/cobrosescuelas");
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.onreadystatechange = function () {
  if(xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
    let myObj = JSON.parse(xhr.responseText);
    crearCampos(myObj);
    modoFormulario("Agregar");
    let traerEscuelas = new XMLHttpRequest();
    traerEscuelas.open("POST", "<?php echo URL; ?>cobro/traerEscuelas");
    traerEscuelas.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    traerEscuelas.onreadystatechange = function() {
      if(traerEscuelas.readyState === XMLHttpRequest.DONE && traerEscuelas.status === 200) {
        ElemForm.idSedesSelect.innerHTML = optionCrear(JSON.parse(traerEscuelas.responseText));
      }
    };
    traerEscuelas.send();
  }
};
xhr.send();
ElemForm.BtnAgregar.addEventListener("click", function() {
  let vec = beforeEnviar();
  if (vec != 'no') {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "<?php echo URL; ?>help/agregarModificarElemento/CobrosEscuelas");
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
      if(xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
        modoFormulario("Agregar");
      }
    };
    xhr.send("data=" + JSON.stringify(vec));
  }
});
</script>
