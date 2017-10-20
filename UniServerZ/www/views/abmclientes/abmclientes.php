<script>
var Elementos = {
  Selec: document.getElementById("Selec"),
  idActividadesSelect: document.getElementById("idActividadesSelect"),
  idActividadesVer: document.getElementById("idActividadesVer"),
  TablaActividades: document.getElementById("TablaActividades"),
  $ModalSel: $('#ModalSel'),
};

function deshacerModal(){
  Elementos.$ModalSel.modal('hide');
  Elementos.idActividadesSelect0 = document.createElement("select");
  Elementos.idModosDePagoSelect0 = document.createElement("select");
  Elementos.idModalidadesSelect0 = document.createElement("select");
  Elementos.idModalidadesSelect0.innerHTML = VecModalidades;
  Elementos.idActividadesSelect0.innerHTML = VecActividades;
  Elementos.idModosDePagoSelect0.innerHTML = VecModosDePago;
  Elementos.idActividadesSelect0.selectedIndex = -1;
  Elementos.idModosDePagoSelect0.selectedIndex = -1;
  Elementos.idModalidadesSelect0.selectedIndex = -1;
  Elementos.Selec.innerHTML = "";
  AddAct(0);
}
var xhr = new XMLHttpRequest();
xhr.open("POST", "<?php echo URL; ?>cliente/tabla/clientes");
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.onreadystatechange = function () {
  if(xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
    let myObj = JSON.parse(xhr.responseText);
    crearCampos(myObj);
  }
};
xhr.send();

  var idModalidades = new Promise(function(resolve, reject) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "<?php echo URL; ?>help/Dropdown/idModalidades");
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
      if(xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
        resolve(xhr.responseText);
      }
    };
    xhr.send();
  });
  var idActividades = new Promise(function(resolve, reject) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "<?php echo URL; ?>help/Dropdown/idActividades");
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
      if(xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
        resolve(xhr.responseText);
      }
    };
    xhr.send();
  });
  var idModosDePago = new Promise(function(resolve, reject) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "<?php echo URL; ?>help/Dropdown/idModosDePago");
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
      if(xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
        resolve(xhr.responseText);
      }
    };
    xhr.send();
  });

  Promise.all([idModalidades, idActividades, idModosDePago]).then(values => {
    VecModalidades = optionCrear(JSON.parse(values[0])[0]);
    VecActividades = optionCrear(JSON.parse(values[1])[0]);
    VecModosDePago = optionCrear(JSON.parse(values[2])[0]);
    deshacerModal();
  });


function AddAct(i) {
  if ((Elementos["idActividadesSelect" + i].selectedIndex == "0" || Elementos["idModosDePagoSelect" + i].selectedIndex == "0") || (Elementos["idModosDePagoSelect" + i].selectedIndex == "2" && Elementos["idModalidadesSelect" + i].selectedIndex == "0")) {
    alert("Seleccione una actividad, un modo de pago y, si corresponde, una modalidad");
  } else {
    let j = Number(i) + 1;
    let row = document.createElement("div");
    row.className = "row";
    row.style = "margin-top : 50px";
    let col1 = document.createElement("div");
    col1.className = "col-lg-4";
    let select1 = document.createElement("select");
    select1.className = "form-control activ";
    select1.id = 'idActividadesSelect' + j ;
    let col2 = document.createElement("div");
    col2.className = "col-lg-4";
    let select2 = document.createElement("select");
    select2.className = "form-control pag";
    select2.id = 'idModosDePagoSelect' + j ;
    let col3 = document.createElement("div");
    col3.className = "col-lg-4 hidden";
    let select3 = document.createElement("select");
    select3.className = "form-control mod";
    select3.id = 'idModalidadesSelect' + j ;
    select2.addEventListener("change", function() {
      if (this.options[this.selectedIndex].value == 2) {
        col3.className = "col-lg-4";
      }else {
        col3.className = "col-lg-4 hidden";
        select3.selectedIndex = "0";
      }
    });
    let button = document.createElement("button");
    button.type = "button"
    button.id = 'AddAct' + j ;
    button.className = "btn btn-link";
    button.innerHTML = "+AgregarActividad";
    button.addEventListener("click", function() {
      AddAct(j);
    });
    row.appendChild(col1);
    row.appendChild(col2);
    row.appendChild(col3);
    row.appendChild(button);
    col1.appendChild(select1);
    col2.appendChild(select2);
    col3.appendChild(select3);
    Elementos.Selec.appendChild(row);
    Elementos["idActividadesSelect" + j] = select1;
    Elementos["idModosDePagoSelect" + j] = select2;
    Elementos["idModalidadesSelect" + j] = select3;
    select1.innerHTML = Elementos["idActividadesSelect" + i].innerHTML;
    select1.remove(Elementos["idActividadesSelect" + i].selectedIndex);
    $("#AddAct" + i).addClass('hidden')
    Elementos["idActividadesSelect" + i].disabled = true;
    select2.innerHTML = Elementos["idModosDePagoSelect" + i].innerHTML;
    select3.innerHTML = Elementos["idModalidadesSelect" + i].innerHTML;
  }
}
$(ElemForm["FechaNacimientoForm"]).datepicker({
  format: "yyyy/mm/dd",
  endDate: "today",
  language: "es",
  autoclose: true,
});

var VecActividades = "";
var VecModalidades = "";
var VecModosDePago = "";

var bien = false;
var final = [];
document.getElementById("aceptarModal").addEventListener("click", function() {
  final = [];
  bien = true;
  Elementos.$ModalSel.modal('hide');
  let l = document.getElementById("Selec").getElementsByClassName("activ").length;
  for (var i = 1; i <= l; i++) {
    if ((Elementos["idActividadesSelect" + i].selectedIndex == "0" || Elementos["idModosDePagoSelect" + i].selectedIndex == "0") || (Elementos["idModosDePagoSelect" + i].selectedIndex == "2" && Elementos["idModalidadesSelect" + i].selectedIndex == "0")) {
      bien = false;
    }else{
      final.push({idClientes: idClientes, idActividades : Elementos["idActividadesSelect" + i].value, idModosDePago : Elementos["idModosDePagoSelect" + i].value, idModalidades : Elementos["idModalidadesSelect" + i].value});
    }
  }
});

ElemForm['BtnAgregar'].addEventListener("click", function() {
  Elementos.idActividadesSelect.classList.remove("hidden");
  Elementos.idActividadesVer.classList.add("hidden");
  modoFormulario("Agregar");
  deshacerModal();
  ElemForm["ActivoForm"].checked = true;
});
ElemForm['BtnModificar'].addEventListener("click", function() {
  Elementos.idActividadesSelect.classList.remove("hidden");
  Elementos.idActividadesVer.classList.add("hidden");
  modoFormulario("Modificar");
  deshacerModal();
});
ElemForm['BtnAceptar'].addEventListener("click", function() {
  Elementos.idActividadesSelect.innerHTML = 'Seleccionar actividad/es';
  if (bien == false){
    Elementos.idActividadesSelect.innerHTML+= '<span class="label label-danger">!</span>';
  }else {
    let vec = beforeEnviar();
    if (vec != 'no')
    {
      let xhr = new XMLHttpRequest();
      xhr.open("POST", "<?php echo URL; ?>cliente/agregarModificarCliente");
      xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhr.onreadystatechange = function () {
        if(xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
          Elementos.idActividadesSelect.classList.add("hidden");
          afterEnviar();
        }
      };
      xhr.send("data1=" + JSON.stringify(vec) + "&data2=" + JSON.stringify(final));
    }
  }
});
document.getElementById("BtnEliminar").addEventListener("click", function() {
  var r = confirm("Estás muy recontra segurísima/o que querés borrar a este cliente?\n\
  Esta funcionalidad se ha creado solo para casos extremos.");
  if (r == true) {

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "<?php echo URL; ?>cliente/eliminarElemento/Clientes");
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
      if(xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
        eliminarError(xhr.responseText);
      }
    };
    xhr.send("data=" + ElemForm["idClientes"].innerHTML);
  }
});
var idClientes;
$('#Tabla').on('click-row.bs.table', function (row, $element, field) {
  $('.success').removeClass('success');
  $(field).addClass('success');

  let xhr = new XMLHttpRequest();
  xhr.open("POST", "<?php echo URL; ?>cliente/traerElemento/Clientes");
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
    if(xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
      clickFila(JSON.parse(xhr.responseText)[0][0]);
      var actividades = JSON.parse(xhr.responseText)[1][0];
      var texto = "";
      for (var i = 0; i < actividades.length; i++) {
        texto += "<tr>";
        texto+="<td>" + actividades[i].NombreAct + "</td>";
        texto+="<td>" + actividades[i].NombrePag + "</td>";
        if (actividades[i].NombreMod == null) {
          texto+="<td>-</td>";
        }else {
          texto+="<td>" + actividades[i].NombreMod + "</td>";
        }
        texto+="</tr>";
        final.push({idClientes: idClientes, idActividades: actividades[i].idActividades, idModosDePago: actividades[i].idModosDePago, idModalidades: actividades[i].idModalidades});
        bien = true;
      }
      Elementos.TablaActividades.innerHTML = texto;
      Elementos.idActividadesSelect.classList.add("hidden");
      Elementos.idActividadesVer.classList.remove("hidden");
    }
  };
  xhr.send("data=" + $element.idClientes);
});
</script>
