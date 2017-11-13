<script>

var Instructores = [];
var Sueldos = {};

var tabla = new XMLHttpRequest();
tabla.open("POST", "<?php echo URL; ?>actividad/tabla/pagodesueldos");
tabla.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
tabla.onreadystatechange = function() {
  if(tabla.readyState === XMLHttpRequest.DONE && tabla.status === 200) {
    let myObj = JSON.parse(tabla.responseText);
    crearCampos(myObj);
    ElemForm.idMesesSelect.remove(13);
    ElemForm.idClientesSelect.addEventListener("input", traerSueldo);
    ElemForm.idMesesSelect.addEventListener("input", traerSueldo);
    modoFormulario("Agregar");
    let listadoInstructores = new XMLHttpRequest();
    listadoInstructores.open("POST", "<?php echo URL; ?>cliente/listadoInstructores");
    listadoInstructores.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    listadoInstructores.onreadystatechange = function() {
      if(listadoInstructores.readyState === XMLHttpRequest.DONE && listadoInstructores.status === 200) {
        Instructores = JSON.parse(listadoInstructores.responseText);
        ElemForm.idClientesSelect.innerHTML = optionCrear(Instructores);
      }
    };
    listadoInstructores.send();
  }
};
tabla.send();

let traerSueldos = new XMLHttpRequest();
traerSueldos.open("POST", "<?php echo URL; ?>cobro/traerSueldos");
traerSueldos.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
traerSueldos.onreadystatechange = function() {
  if(traerSueldos.readyState === XMLHttpRequest.DONE && traerSueldos.status === 200) {
    Sueldos = JSON.parse(traerSueldos.responseText);
  }
};
traerSueldos.send();


function traerSueldo(){
  if (ElemForm.idClientesSelect.value && ElemForm.idMesesSelect.value) {

    let cantidadBloques = new XMLHttpRequest();
    cantidadBloques.open("POST", "<?php echo URL; ?>cliente/cantidadBloques");
    cantidadBloques.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    cantidadBloques.onreadystatechange = function() {
      if(cantidadBloques.readyState === XMLHttpRequest.DONE && cantidadBloques.status === 200) {
        ElemForm.MontoForm.value = cantidadBloques.responseText * Sueldos[Instructores[ElemForm.idClientesSelect.selectedIndex - 1].idCategorias].MontoXBloque;
      }
    };
    cantidadBloques.send("data1=" + ElemForm.idClientesSelect.value + "&data2=" + ElemForm.idMesesSelect.value);

  }
}




document.getElementById("BtnAgregar").addEventListener("click", function() {
  let vec = beforeEnviar();
  if (vec != 'no') {

    let agregarModificarElemento = new XMLHttpRequest();
    agregarModificarElemento.open("POST", "<?php echo URL; ?>help/agregarModificarElemento/PagoDeSueldos");
    agregarModificarElemento.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    agregarModificarElemento.onreadystatechange = function() {
      if(agregarModificarElemento.readyState === XMLHttpRequest.DONE && agregarModificarElemento.status === 200) {
        alert("Gracias por colaborar con el gremio de Instructores BBG, se ha pagado el sueldo exitosamente");
        modoFormulario("Agregar");
      }
    };
    agregarModificarElemento.send("data=" + JSON.stringify(vec));

  }
});
</script>
