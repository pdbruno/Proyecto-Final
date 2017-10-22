<script>
var ElemForm = {
  checkboxes: document.getElementById("Formu").getElementsByClassName("checkbox"),
  intros: document.getElementById("Formu").getElementsByClassName("intro"),
  BtnAceptar: document.getElementById("BtnAceptar"),
  BtnAgregar: document.getElementById("BtnAgregar"),
  BtnModificar: document.getElementById("BtnModificar"),
  BtnEliminar: document.getElementById("BtnEliminar"),
  $Tabla: $('#Tabla'),
  Columns: [],
  Formu: document.getElementById("Formu"),
  alertdiv: "",
  modal: $("#ModalPropiedades"),
  deshacerModal: document.getElementsByClassName("deshacerModal"),
  $ModalVer: $('#ModalVer'),
  CerrarVer: document.getElementsByClassName("CerrarVer")
};

$(document).on('show.bs.modal', '.modal', function (event) {
  var zIndex = 1040 + (10 * $('.modal:visible').length);
  $(this).css('z-index', zIndex);
  setTimeout(function() {
    $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
  }, 0);
});

for (var i = 0; i < 2; i++) {
  if (ElemForm.deshacerModal[i]) {
    ElemForm.deshacerModal[i].addEventListener("click", function() {
      deshacerModal();
    });
  }
  if (ElemForm.CerrarVer[i]) {
    ElemForm.CerrarVer[i].addEventListener("click", function() {
      ElemForm.$ModalVer.modal('hide');
    });
  }

}


function llenarDropdowns(youknow){
  let VecElementos = [];
  for (vector in youknow) {
    let txt = optionCrear(youknow[vector]);
    VecElementos.push(txt);
  }
  let selects = document.getElementById("Formu").getElementsByTagName("select");
  let l = selects.length;
  for (var i = 0; i < l; i++) {
    selects[i].innerHTML = VecElementos[i];
  }
}

function generarTablaCheta(columnas, respuesta, pers, id, url = ""){
  let trpricipal = document.createElement("tr");
  let tdpricipal = document.createElement("td");
  tdpricipal.style.padding = 0;
  trpricipal.appendChild(tdpricipal);

  let listgroup = document.createElement("div");
  listgroup.className = "list-group";
  listgroup.style.margin = 0;
  tdpricipal.appendChild(listgroup);

  let listgroupitem = document.createElement("a");
  listgroupitem.className = "list-group-item";
  listgroupitem.href = "#" + url + respuesta[0][id];
  listgroupitem.innerHTML = pers;
  listgroupitem.style.border = "none";
  listgroupitem.setAttribute("data-toggle", "collapse");
  listgroup.appendChild(listgroupitem);

  let collapse = document.createElement("div");
  collapse.className = "collapse";
  collapse.id = url + respuesta[0][id];
  tdpricipal.appendChild(collapse);

  let table = document.createElement("table");
  table.className = "table table-hover";
  collapse.appendChild(table);

  let thead = document.createElement("thead");
  table.appendChild(thead);

  let trsecundario = document.createElement("tr");
  thead.appendChild(trsecundario);

  for (x in columnas) {
    let th = document.createElement("th");
    th.innerHTML = columnas[x];
    trsecundario.appendChild(th);
  }
  let th = document.createElement("th");
  trsecundario.appendChild(th);

  let tbody = document.createElement("tbody");
  table.appendChild(tbody);
  let ll = respuesta.length;
  for (let i = 0; i < ll; i++) {
    tbody.appendChild(verDeudas(respuesta[i], columnas));
  }
  return trpricipal;
}

function verDeudas(Obj, columnas){
  let ll = Obj.length;
  let trsecundariobody = document.createElement("tr");
  for (x in columnas) {
    let td = document.createElement("td");
    td.innerHTML = Obj[x];
    trsecundariobody.appendChild(td);
  }

  return trsecundariobody;
}

function crearCampos(myObj, Formulario = ElemForm.Formu){
  let l = myObj.length;
  for (var i = 0; i < l; i++) {
    let listgroupitem = document.createElement("li");
    listgroupitem.className = "list-group-item";

    ElemForm[myObj[i].COLUMN_NAME + "Group"] = document.createElement("div");
    ElemForm[myObj[i].COLUMN_NAME + "Group"].className = "form-group";
    ElemForm[myObj[i].COLUMN_NAME + "Group"].id = myObj[i].COLUMN_NAME + "Group";

    let controllabel = document.createElement("label");
    controllabel.className = "col-sm-2 control-label";
    controllabel.innerHTML = myObj[i].COLUMN_COMMENT;

    let col10 = document.createElement("div");
    col10.className = "col-sm-10";

    ElemForm[myObj[i].COLUMN_NAME] = document.createElement("p");
    ElemForm[myObj[i].COLUMN_NAME].id = myObj[i].COLUMN_NAME;
    if (myObj[i].DATA_TYPE=="tinyint") {
      ElemForm[myObj[i].COLUMN_NAME].className = "intro hidden";
    }else{
      ElemForm[myObj[i].COLUMN_NAME].className = "form-control-static";
    }
    ElemForm[myObj[i].COLUMN_NAME + "Form"] = document.createElement("input");
    ElemForm[myObj[i].COLUMN_NAME + "Form"].id = myObj[i].COLUMN_NAME + "Form";
    ElemForm[myObj[i].COLUMN_NAME + "Form"].placeholder = myObj[i].COLUMN_COMMENT;
    switch (myObj[i].DATA_TYPE) {
      case "tinyint":
      ElemForm[myObj[i].COLUMN_NAME + "Form"].type = 'checkbox';
      ElemForm[myObj[i].COLUMN_NAME + "Form"].className = "checkbox hidden";
      ElemForm[myObj[i].COLUMN_NAME + "Form"].disabled = true;
      break;
      case "date":
      ElemForm[myObj[i].COLUMN_NAME + "Form"].className = "form-control date hidden";
      ElemForm[myObj[i].COLUMN_NAME + "Form"].type = 'text';
      ElemForm[myObj[i].COLUMN_NAME + "Form"].disabled = true;
      break;
      case "text":
      case "int":
      case "decimal":
      ElemForm[myObj[i].COLUMN_NAME + "Form"].disabled = true;
      ElemForm[myObj[i].COLUMN_NAME + "Form"].className = "form-control hidden";
      ElemForm[myObj[i].COLUMN_NAME + "Form"].type = 'text';
      switch (myObj[i].COLUMN_KEY) {
        case "MUL":
        ElemForm[myObj[i].COLUMN_NAME + "Form"].className = "form-control hidden";
        ElemForm[myObj[i].COLUMN_NAME + "Form"].type = 'text';
        ElemForm[myObj[i].COLUMN_NAME + "Form"].style.display = 'none';
        ElemForm[myObj[i].COLUMN_NAME + "Form"].style.visibility = 'hidden';
        ElemForm[myObj[i].COLUMN_NAME + "Select"] = document.createElement("select");
        hacemeUnDropdown(myObj[i].COLUMN_NAME, ElemForm[myObj[i].COLUMN_NAME + "Select"]);
        ElemForm[myObj[i].COLUMN_NAME + "Select"].className = "form-control hidden";
        ElemForm[myObj[i].COLUMN_NAME + "Select"].id = myObj[i].COLUMN_NAME + "Select";
        break;
        case "PRI":
        ElemForm[myObj[i].COLUMN_NAME + "Form"].className = "form-control hidden";
        ElemForm[myObj[i].COLUMN_NAME + "Form"].type = 'text';
        listgroupitem.className = 'list-group-item hidden';
      }
    }
    if (myObj[i].COLUMN_KEY == 'MUL') {
      col10.appendChild(ElemForm[myObj[i].COLUMN_NAME]);
      col10.appendChild(ElemForm[myObj[i].COLUMN_NAME + "Select"]);
      col10.appendChild(ElemForm[myObj[i].COLUMN_NAME + "Form"]);
    }else {
      col10.appendChild(ElemForm[myObj[i].COLUMN_NAME]);
      col10.appendChild(ElemForm[myObj[i].COLUMN_NAME + "Form"]);
    }
    if (myObj[i].IS_NULLABLE === "NO"  && myObj[i].COLUMN_KEY != "PRI") {
      ElemForm[myObj[i].COLUMN_NAME + "Error"] = document.createElement("label");
      ElemForm[myObj[i].COLUMN_NAME + "Error"].id = myObj[i].COLUMN_NAME + "Error";
      ElemForm[myObj[i].COLUMN_NAME + "Error"].className = "control-label hidden";
      ElemForm[myObj[i].COLUMN_NAME + "Error"].innerHTML = "Este campo es obligatorio";
      col10.appendChild(ElemForm[myObj[i].COLUMN_NAME + "Error"]);
    }
    ElemForm[myObj[i].COLUMN_NAME + "Group"].appendChild(controllabel);
    ElemForm[myObj[i].COLUMN_NAME + "Group"].appendChild(col10);
    listgroupitem.appendChild(ElemForm[myObj[i].COLUMN_NAME + "Group"]);
    Formulario.appendChild(listgroupitem);
    ElemForm.Columns.push(myObj[i]);
  }
  let dates  = $(".date");
  if (dates.length != 0) {
    dates.datepicker({
      format: "yyyy/mm/dd",
      endDate: "today",
      language: "es",
      autoclose: true,
    });
  }
}
function hacemeUnDropdown(nombre, select){
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "<?php echo URL; ?>help/Dropdown/" + nombre);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function() {
    if(xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
      let respuesta = JSON.parse(xhr.responseText);
      select.innerHTML = optionCrear(respuesta[0]);
      if (respuesta[1] == 2) {
        select.innerHTML += "<option onclick=\"addOpt('" + nombre + "')\">+Agregar</option>";
        let isChrome = !!window.chrome && !!window.chrome.webstore;
        if (isChrome) {
          select.addEventListener("change", function() {
            this.options[this.selectedIndex].onclick();
          });
        }
      }
    }
  };
  xhr.send();

}
function addOpt(nombre){
  let nuevaopcion = prompt("Ingrese la nueva opción");
  if (nuevaopcion != null) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "<?php echo URL; ?>help/agregarModificarElemento/" + nombre.substr(2).toLowerCase());
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
      if(xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
        hacemeUnDropdown(nombre, document.getElementById(nombre + "Select"));
      }
    };
    xhr.send("data=" + JSON.stringify({Nombre : nuevaopcion}));
  }
}

function optionCrear(vec) {
  let txt="<option disabled selected value>Seleccione una opción</option>";
  let l = vec.length;
  for (let i = 0; i < l; i++) {
    txt += "<option value='" + vec[i].id + "'>" + vec[i].Nombre + "</option>";
  }
  return txt;
}


function clickFila(obj){
  $("#noti").remove();
  for (x in obj) {
    ElemForm[x + "Group"].classList.remove("has-error");
    if (ElemForm[x + "Error"]) {
      ElemForm[x + "Error"].classList.add("hidden");
    }
    if (ElemForm[x + "Select"]) {
      ElemForm[x + "Select"].classList.add("hidden");
    }
    ElemForm[x].classList.remove("hidden");
    ElemForm[x].innerHTML = obj[x];
    ElemForm[x + "Form"].classList.add("hidden");
    if (ElemForm[x + "Form"].type == 'checkbox') {
      if (obj[x] == 1) {
        ElemForm[x + "Form"].checked = true;
      } else {
        ElemForm[x + "Form"].checked = false;
      }
    } else {
      ElemForm[x + "Form"].value = obj[x];
    }
  }
  let l = ElemForm.intros.length;
  if (l>0) {
    for (let i = 0; i < l; i++) {
      ElemForm.checkboxes[i].classList.remove("hidden");
      ElemForm.checkboxes[i].disabled = true;
      if (ElemForm.intros[i].innerHTML == 1 || ElemForm.intros[i].innerHTML == "YES") {
        ElemForm.checkboxes[i].checked = true;
      } else {
        ElemForm.checkboxes[i].checked = false;
      }
      ElemForm.intros[i].classList.add("hidden");
    }
  }
  $('#ModalPropiedades').modal('show');
  ElemForm.BtnAceptar.classList.add("hidden");
  ElemForm.BtnAgregar.classList.remove("hidden");
  ElemForm.BtnModificar.classList.remove("hidden");
  if (ElemForm.BtnEliminar) {
    ElemForm.BtnEliminar.classList.remove("hidden");
  }
}
function afterEnviar(){
  let l = ElemForm.Columns.length;
  for (var i = 0; i < l; i++) {
    if (ElemForm[ElemForm.Columns[i].COLUMN_NAME + "Select"]) {
      ElemForm[ElemForm.Columns[i].COLUMN_NAME + "Select"].classList.add("hidden");
    }
    ElemForm[ElemForm.Columns[i].COLUMN_NAME].classList.remove("hidden");
    ElemForm[ElemForm.Columns[i].COLUMN_NAME].innerHTML="";
    ElemForm[ElemForm.Columns[i].COLUMN_NAME + "Form"].classList.add("hidden");
  }
  l = ElemForm.checkboxes.length;
  if (l>0) {
    for (var i = 0; i < l; i++) {
      ElemForm.checkboxes[i].disabled = true;
    }
  }
  ElemForm.modal.modal('hide');

  ElemForm.BtnAceptar.classList.add("hidden");
  ElemForm.BtnAgregar.classList.remove("hidden");
  ElemForm.BtnModificar.classList.add("hidden");
  if (ElemForm.BtnEliminar) {
    ElemForm.BtnEliminar.classList.add("hidden");
  }

  ElemForm.$Tabla.bootstrapTable('refresh');
}
function beforeEnviar(){
  let mal = false;
  let vec = {};
  let l = ElemForm.checkboxes.length;
  if (l>0) {
    for (var i = 0; i < l; i++) {
      ElemForm.checkboxes[i].value = (ElemForm.checkboxes[i].checked) ? 1 : 0;
    }
  }
  l = ElemForm.Columns.length;
  for (var i = 0; i < l; i++) {
    ElemForm[ElemForm.Columns[i].COLUMN_NAME + "Group"].classList.remove("has-error");
    if (ElemForm[ElemForm.Columns[i].COLUMN_NAME + "Error"]) {
      ElemForm[ElemForm.Columns[i].COLUMN_NAME + "Error"].classList.add("hidden");
    }

    if ( ElemForm[ElemForm.Columns[i].COLUMN_NAME + "Select"]) {
      ElemForm[ElemForm.Columns[i].COLUMN_NAME + "Form"].value = ElemForm[ElemForm.Columns[i].COLUMN_NAME + "Select"].value;
    }
    if (ElemForm[ElemForm.Columns[i].COLUMN_NAME + "Form"].value === "") {
      if (ElemForm.Columns[i].IS_NULLABLE === 'NO' && ElemForm.Columns[i].DATA_TYPE != "tinyint" && ElemForm.Columns[i].COLUMN_KEY != "PRI") {
        ElemForm[ElemForm.Columns[i].COLUMN_NAME + "Group"].classList.add("has-error");
        ElemForm[ElemForm.Columns[i].COLUMN_NAME + "Error"].classList.remove("hidden");
        mal = true;
      }else {
        ElemForm[ElemForm.Columns[i].COLUMN_NAME + "Form"].value = null;
      }
    }
    vec[ElemForm.Columns[i].COLUMN_NAME] = ElemForm[ElemForm.Columns[i].COLUMN_NAME + "Form"].value;
  }
  if (mal) {
    if(document.getElementById("noti") == null){
      ElemForm.modal.append('<div id="noti" class="alert col-lg-6 col-lg-offset-3 col alert-danger alert-dismissible fade in" role="alert">\
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>\
    <strong>Alto ahi vaquero/a!</strong> Hay campos obligatorios sin llenar.\
  </div>');
    }
    return 'no';

  }else {
    return vec;
  }
}

function eliminarError(respuesta){
  afterEnviar();
  if (respuesta != "") {
    alert("Como existen registros que hacen referencia a este elemento, éste no se puede eliminar.\n\ Calma: esto no es un error ni una falla.");
  }
}

function modoFormulario(modo){
  if (modo == "Agregar") {
    $('#ModalPropiedades').modal('show');
  }
  if (ElemForm.BtnAceptar) {
    ElemForm.BtnAceptar.classList.remove("hidden");
  }
  if (ElemForm.BtnModificar) {
    ElemForm.BtnModificar.classList.add("hidden");
  }
  if (ElemForm.BtnEliminar) {
    ElemForm.BtnEliminar.classList.add("hidden");
  }
  let l = ElemForm.Columns.length;
  for (var i = 0; i < l; i++) {
    ElemForm[ElemForm.Columns[i].COLUMN_NAME + "Group"].classList.remove("has-error");
    if (ElemForm[ElemForm.Columns[i].COLUMN_NAME + "Error"]) {
      ElemForm[ElemForm.Columns[i].COLUMN_NAME + "Error"].classList.add("hidden");
    }
    if (ElemForm[ElemForm.Columns[i].COLUMN_NAME + "Select"]) {
      ElemForm[ElemForm.Columns[i].COLUMN_NAME + "Select"].classList.remove("hidden");
      ElemForm[ElemForm.Columns[i].COLUMN_NAME + "Select"].selectedIndex = 0;
    }
    ElemForm[ElemForm.Columns[i].COLUMN_NAME].classList.add("hidden");
    ElemForm[ElemForm.Columns[i].COLUMN_NAME + "Form"].classList.remove("hidden");
    ElemForm[ElemForm.Columns[i].COLUMN_NAME + "Form"].disabled = false;
    if (modo == "Agregar") {
      ElemForm[ElemForm.Columns[i].COLUMN_NAME + "Form"].value = null;
    }else {
      if (ElemForm[ElemForm.Columns[i].COLUMN_NAME + "Select"]) {
        let opciones = ElemForm[ElemForm.Columns[i].COLUMN_NAME + "Select"].options;
        let l = ElemForm[ElemForm.Columns[i].COLUMN_NAME + "Select"].length;
        for (let j = 0; j < l; j++) {
          if (opciones[j].innerHTML == ElemForm[ElemForm.Columns[i].COLUMN_NAME + "Form"].value) {
            ElemForm[ElemForm.Columns[i].COLUMN_NAME + "Select"].selectedIndex = j;
            break;
          }
        }
      }
    }
  }
}
</script>
