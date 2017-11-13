<script>

var xhr = new XMLHttpRequest();
xhr.open("POST", "<?php echo $this->tabla; ?>");
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.onreadystatechange = function() {
  if(xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
    let myObj = JSON.parse(xhr.responseText);
    crearCampos(myObj);
  }
};
xhr.send();

ElemForm.BtnAgregar.addEventListener("click", function() {
  modoFormulario('Agregar');
});
ElemForm.BtnModificar.addEventListener("click", function() {
  modoFormulario('Modificar');
});
ElemForm.BtnAceptar.addEventListener("click", function() {
  let vec = beforeEnviar();
  if (vec != 'no') {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "<?php echo $this->agregarModificar; ?>");
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
      if(xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
        afterEnviar();
      }
    };
    xhr.send("data=" + JSON.stringify(vec));
  }
});
ElemForm.BtnEliminar.addEventListener("click", function() {
  var r = confirm("Estás muy recontra segurísima/o que querés borrar este elemento?");
  if (r == true) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "<?php echo $this->eliminar; ?>");
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
      if(xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
        eliminarError(xhr.responseText);
      }
    };
    xhr.send("data=" + ElemForm["id<?php echo $this->titmodal; ?>s"].innerHTML);
  }
});
$('#Tabla').on('click-row.bs.table', function (row, $element, field) {
  $('.success').removeClass('success');
  $(field).addClass('success');
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "<?php echo $this->traer; ?>");
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function() {
    if(xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
      clickFila(JSON.parse(xhr.responseText)[0]);
    }
  };
  xhr.send("data=" + $element.id<?php echo $this->titmodal; ?>);
});
</script>
