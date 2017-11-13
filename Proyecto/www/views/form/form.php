<script>
var xhr = new XMLHttpRequest();
xhr.open("POST", "<?php echo URL; ?>actividad/tabla/<?php echo $this->Tabla; ?>");
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.onreadystatechange = function () {
  if(xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
    let myObj = JSON.parse(xhr.responseText);
    crearCampos(myObj);
    modoFormulario("Agregar");
  }
};
xhr.send();
ElemForm.BtnAgregar.addEventListener("click", function() {
  let vec = beforeEnviar();
  if (vec != 'no') {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "<?php echo URL; echo $this->Alta; ?>");
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
