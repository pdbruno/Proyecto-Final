<script>
var caca = {};
var xhr = new XMLHttpRequest();
xhr.open("POST", "<?php echo URL; ?>producto/listadoPrecio");
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.onreadystatechange = function () {
  if(xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
    caca = JSON.parse(xhr.responseText);
  }
};
xhr.send();

var xhr2 = new XMLHttpRequest();
xhr2.open("POST", "<?php echo URL; ?>producto/tabla/registroventas");
xhr2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr2.onreadystatechange = function () {
  if(xhr2.readyState === XMLHttpRequest.DONE && xhr2.status === 200) {
    let myObj = JSON.parse(xhr2.responseText);
    crearCampos(myObj);
    ElemForm.CantidadForm.value = 1;
    ElemForm.MontoForm.value = 0;
    ElemForm.CantidadForm.addEventListener("input", function() {
      if (ElemForm.idProductosSelect.value != "") {
        if (ElemForm.CantidadForm.value == 0) {
          ElemForm.MontoForm.value = caca[ElemForm.idProductosSelect.value]
        }else {
          ElemForm.MontoForm.value = caca[ElemForm.idProductosSelect.value] * ElemForm.CantidadForm.value;
        }
      }
    });
    ElemForm.idProductosSelect.addEventListener("change", function() {
      ElemForm.MontoForm.value = caca[ElemForm.idProductosSelect.value] * ElemForm.CantidadForm.value;
    });
    modoFormulario("Agregar");
  }
};
xhr2.send();

ElemForm.BtnAgregar.addEventListener("click", function() {
  let vec = beforeEnviar();
  vec['Cantidad'] -= 2 * vec['Cantidad'];
  if (vec != 'no') {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "<?php echo URL; ?>producto/agregarRegistro/RegistroVentas");
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
      if(xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
        if (xhr.responseText != "") {
          alert(xhr.responseText);
        }
        modoFormulario("Agregar");
      }
    };
    xhr.send("data=" + JSON.stringify(vec));

  }
});

</script>
