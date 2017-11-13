<script>
var Elementos = {
  Selec: document.getElementById("Selec"),
  idSubactividadesSelect: document.getElementById("idSubactividadesSelect"),
  idSubactividadesVer: document.getElementById("idSubactividadesVer"),
  TablaSubactividades: document.getElementById("TablaSubactividades"),
  $ModalSel: $('#ModalSel'),
};

var xhr = new XMLHttpRequest();
xhr.open("POST", "<?php echo URL; ?>actividad/tabla/actividades");
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.onreadystatechange = function () {
  if(xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
    let myObj = JSON.parse(xhr.responseText);
    crearCampos(myObj);
    ElemForm['idCalendarioGroup'].classList.add('hidden');
  }
};
xhr.send();
function deshacerModal(){
  Elementos.$ModalSel.modal('hide');
  Elementos["idSubactividadesForm0"] = document.createElement("input");
  Elementos.Selec.innerHTML = "";
  AddAct(0);
}

function AddAct(i) {
  if (Elementos["idSubactividadesForm" + i].value == "" && i != 0) {
    alert("Ingrese una subactividad");
  } else {
    let j = Number(i) + 1;
    let row = document.createElement("div");
    row.className = "row";
    row.style = "margin-top : 50px";
    let col5 = document.createElement("div");
    col5.className = "col-lg-5";
    let input = document.createElement("input");
    input.className = "form-control sub";
    input.id = 'idSubactividadesForm' + j ;
    let button = document.createElement("button");
    button.type = "button"
    button.id = 'AddAct' + j ;
    button.className = "btn btn-link";
    button.innerHTML = "+AgregarSubactividad";
    button.addEventListener("click", function() {
      AddAct(j);
    });
    row.appendChild(col5);
    row.appendChild(button);
    col5.appendChild(input);
    Elementos.Selec.appendChild(row);
    Elementos["idSubactividadesForm" + j] = input;
    Elementos["idSubactividadesForm" + i].disabled = true;
    $("#AddAct" + i).addClass('hidden')
  }
}

var final = [];
document.getElementById("aceptarModal").addEventListener("click", function() {
  Elementos.$ModalSel.modal('hide');
  final = [];
  var l = document.getElementById("Selec").getElementsByClassName("sub").length;
  for (let i = 1; i <= l; i++) {
    if (Elementos["idSubactividadesForm" + i].value != "") {
      final.push(Elementos["idSubactividadesForm" + i].value);
    }
  }
});

ElemForm['BtnAgregar'].addEventListener("click", function() {
  $('#ModalPropiedades').modal('show');
  modoFormulario("Agregar");
  Elementos.idSubactividadesSelect.classList.remove("hidden");
  Elementos.idSubactividadesVer.classList.add("hidden");
  deshacerModal();
});
ElemForm['BtnModificar'].addEventListener("click", function() {
  modoFormulario("Modificar");
  Elementos.idSubactividadesSelect.classList.remove("hidden");
  Elementos.idSubactividadesVer.classList.add("hidden");
  deshacerModal();
});
ElemForm['BtnAceptar'].addEventListener("click", function() {
  let vec = beforeEnviar();
  if (vec != 'no')
  {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "<?php echo URL; ?>actividad/agregarModificarActividad");
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
      if(xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
        afterEnviar();
      }
    };
    xhr.send("data1=" + JSON.stringify(vec) + "&data2=" + JSON.stringify(final));
  }
});
ElemForm['BtnEliminar'].addEventListener("click", function() {
  var r = confirm("Estás muy recontra segurísima/o que querés borrar esta actividad?");
  if (r == true) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "<?php echo URL; ?>actividad/eliminarElemento/Actividades");
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
      if(xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
        eliminarError(xhr.responseText);
      }
    };
    xhr.send("data=" + ElemForm["idActividades"].innerHTML);
  }
});
$('#Tabla').on('click-row.bs.table', function (row, $element, field) {
  $('.success').removeClass('success');
  $(field).addClass('success');

  let xhr = new XMLHttpRequest();
  xhr.open("POST", "<?php echo URL; ?>actividad/traerElemento/Actividades");
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
    if(xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
      clickFila(JSON.parse(xhr.responseText)[0][0]);
      let subactividades = JSON.parse(xhr.responseText)[1];
      let texto = "";
      let l = subactividades.length;
      for (var i = 0; i < l; i++) {
        texto += "<tr>";
        texto+="<td>" + subactividades[i].Nombre + "</td>";
        texto+="</tr>";
        final.push(subactividades[i].Nombre);
        bien = true;
      }
      Elementos.TablaSubactividades.innerHTML = texto;
      Elementos.idSubactividadesSelect.classList.add("hidden");
      Elementos.idSubactividadesVer.classList.remove("hidden");
    }
  };
  xhr.send("data=" + $element.idActividades);
});

</script>
