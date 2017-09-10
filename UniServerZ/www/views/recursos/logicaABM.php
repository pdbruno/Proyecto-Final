<script>
var ElemForm = {
  checkboxes: document.getElementById("Formu").getElementsByClassName("checkbox"),
  intros: document.getElementById("Formu").getElementsByClassName("intro"),
  $BtnAceptar: $("#BtnAceptar"),
  $BtnAgregar: $("#BtnAgregar"),
  $BtnModificar: $("#BtnModificar"),
  $BtnEliminar: $("#BtnEliminar"),
  $Tabla: $('#Tabla'),
  json: [],
  Formu: document.getElementById("Formu"),
  alertdiv: "",
  modal: $("#ModalPropiedades")
};

$(document).on('show.bs.modal', '.modal', function (event) {
  var zIndex = 1040 + (10 * $('.modal:visible').length);
  $(this).css('z-index', zIndex);
  setTimeout(function() {
    $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
  }, 0);
});

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

function generarTablaCheta(columnas, respuesta, pers){
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
  listgroupitem.href = "#" + + respuesta[0].idClientes;
  listgroupitem.innerHTML = pers;
  listgroupitem.style.border = "none";
  listgroupitem.setAttribute("data-toggle", "collapse");
  listgroup.appendChild(listgroupitem);

  let collapse = document.createElement("div");
  collapse.className = "collapse";
  collapse.id = respuesta[0].idClientes;
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

function crearCampos(myObj){
  let l = myObj.length;
  for (var i = 0; i < l; i++) {
    let listgroupitem = document.createElement("li");
    listgroupitem.className = "list-group-item";
    let formgroup = document.createElement("div");
    formgroup.className = "form-group";
    formgroup.id = myObj[i].COLUMN_NAME + "Group";

    let controllabel = document.createElement("label");
    controllabel.className = "col-sm-2 control-label";
    controllabel.innerHTML = myObj[i].COLUMN_COMMENT;

    let col10 = document.createElement("div");
    col10.className = "col-sm-10";

    let formcontrolstatic = document.createElement("p");
    formcontrolstatic.id = myObj[i].COLUMN_NAME;
    if (myObj[i].DATA_TYPE=="tinyint") {
      formcontrolstatic.className = "intro hidden";
    }else{
      formcontrolstatic.className = "form-control-static";
    }
    let formcontrol = document.createElement("input");
    formcontrol.id = myObj[i].COLUMN_NAME + "Form";
    formcontrol.placeholder = myObj[i].COLUMN_COMMENT;
    let select;
    switch (myObj[i].DATA_TYPE) {
      case "tinyint":
      formcontrol.type = 'checkbox';
      formcontrol.className = "checkbox hidden";
      formcontrol.disabled = true;
      break;
      case "text":
      formcontrol.className = "form-control hidden";
      formcontrol.type = 'text';
      formcontrol.disabled = true;
      break;
      case "date":
      formcontrol.className = "form-control hidden";
      formcontrol.type = 'date';
      formcontrol.disabled = true;
      break;
      case "int":
      case "decimal":
      switch (myObj[i].COLUMN_KEY) {
        case "MUL":
        formcontrol.className = "form-control hidden";
        formcontrol.type = 'text';
        formcontrol.style.display = 'none';
        formcontrol.style.visibility = 'hidden';
        select = document.createElement("select");
        hacemeUnDropdown(myObj[i].COLUMN_NAME, select);
        select.className = "form-control hidden";
        select.id = myObj[i].COLUMN_NAME + "Select";
        break;
        case "PRI":
        formcontrol.className = "form-control hidden";
        formcontrol.type = 'text';
        listgroupitem.className = 'list-group-item hidden';
        break;
        default:
        formcontrol.className = "form-control hidden";
        formcontrol.type = 'number';
        formcontrol.disabled = true;
      }
    }

    if (myObj[i].COLUMN_KEY == 'MUL') {
      col10.appendChild(formcontrolstatic);
      col10.appendChild(select);
      col10.appendChild(formcontrol);
    }else {
      col10.appendChild(formcontrolstatic);
      col10.appendChild(formcontrol);
    }
    if (myObj[i].IS_NULLABLE === "NO"  && myObj[i].COLUMN_KEY != "PRI") {
      let errorlabel = document.createElement("label");
      errorlabel.id = myObj[i].COLUMN_NAME + "Error";
      errorlabel.className = "control-label hidden";
      errorlabel.innerHTML = "Este campo es obligatorio";
      col10.appendChild(errorlabel);
    }
    formgroup.appendChild(controllabel);
    formgroup.appendChild(col10);
    listgroupitem.appendChild(formgroup);
    ElemForm.Formu.appendChild(listgroupitem);
    setProp(myObj[i]);
  }
  let dates  = $("[type='date']");
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
  let request = $.ajax({
    url: "<?php echo URL; ?>help/Dropdown/" + nombre,
    type: "post"
  });
  request.done(function (respuesta){
    respuesta = JSON.parse(respuesta);
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
  });
}
function addOpt(nombre){
  let nuevaopcion = prompt("Ingrese la nueva opción");
  if (nuevaopcion != null) {
    var request = $.ajax({
      url: "<?php echo URL; ?>help/agregarModificarElemento/" + nombre.substr(2).toLowerCase(),
      type: "post",
      data: "data=" + JSON.stringify({Nombre : nuevaopcion}),
    });
    request.done(function (respuesta){
      hacemeUnDropdown(nombre, document.getElementById(nombre + "Select"));
    });
  }
}
function setProp(myObj){
  ElemForm.json.push(myObj);
  ElemForm[myObj.COLUMN_NAME + "Select"] = $("#" + myObj.COLUMN_NAME + "Select");
  ElemForm[myObj.COLUMN_NAME] = $("#" + myObj.COLUMN_NAME);
  ElemForm[myObj.COLUMN_NAME + "Form"] = $("#" + myObj.COLUMN_NAME + "Form");
  ElemForm[myObj.COLUMN_NAME + "Group"] = $("#" + myObj.COLUMN_NAME + "Group");
  ElemForm[myObj.COLUMN_NAME + "Error"] = $("#" + myObj.COLUMN_NAME+ "Error");
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
    ElemForm[x + "Group"].removeClass("has-error");
    ElemForm[x + "Error"].addClass("hidden");
    ElemForm[x + "Select"].addClass("hidden");
    ElemForm[x].removeClass("hidden").text(obj[x]);
    ElemForm[x + "Form"].addClass("hidden");
    if (ElemForm[x + "Form"].attr("type") == 'checkbox') {
      if (obj[x] == 1) {
        ElemForm[x + "Form"].attr("checked", true);
      } else {
        ElemForm[x + "Form"].attr("checked", false);
      }
    } else {
      ElemForm[x + "Form"].val(obj[x]);
    }
  }
  let l = ElemForm.intros.length;
  if (l>0) {
    for (let i = 0; i < l; i++) {
      $("#" + ElemForm.checkboxes[i].id).removeClass("hidden");
      ElemForm.checkboxes[i].disabled = true;
      if (ElemForm.intros[i].innerHTML == 1 || ElemForm.intros[i].innerHTML == "YES") {
        ElemForm.checkboxes[i].checked = true;
      } else {
        ElemForm.checkboxes[i].checked = false;
      }
      $("#" + ElemForm.intros[i].id).addClass("hidden");
    }
  }
  $('#ModalPropiedades').modal('show');
  ElemForm.$BtnAceptar.addClass("hidden");
  ElemForm.$BtnAgregar.removeClass("hidden");
  ElemForm.$BtnModificar.removeClass("hidden");
  ElemForm.$BtnEliminar.removeClass("hidden");
}
function afterEnviar(){
  let l = ElemForm.json.length;
  for (var i = 0; i < l; i++) {
    ElemForm[ElemForm.json[i].COLUMN_NAME + "Select"].addClass("hidden");
    ElemForm[ElemForm.json[i].COLUMN_NAME].removeClass("hidden").html("");
    ElemForm[ElemForm.json[i].COLUMN_NAME + "Form"].addClass("hidden");
  }
  l = ElemForm.checkboxes.length;
  if (l>0) {
    for (var i = 0; i < l; i++) {
      ElemForm.checkboxes[i].disabled = true;
    }
  }
  ElemForm.modal.modal('hide');
  ElemForm.$BtnAceptar.addClass("hidden");
  ElemForm.$BtnAgregar.removeClass("hidden");
  ElemForm.$BtnModificar.addClass("hidden");
  ElemForm.$BtnEliminar.addClass("hidden");
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
  l = ElemForm.json.length;
  for (var i = 0; i < l; i++) {
    ElemForm[ElemForm.json[i].COLUMN_NAME + "Group"].removeClass("has-error");
    ElemForm[ElemForm.json[i].COLUMN_NAME + "Error"].addClass("hidden");

    let sel = document.getElementById(ElemForm.json[i].COLUMN_NAME + "Select");
    if ( sel != null) {
      ElemForm[ElemForm.json[i].COLUMN_NAME + "Form"].val(sel.value);
    }
    if (ElemForm[ElemForm.json[i].COLUMN_NAME + "Form"].val() === "") {
      if (ElemForm.json[i].IS_NULLABLE === 'NO' && ElemForm.json[i].DATA_TYPE != "tinyint" && ElemForm.json[i].COLUMN_KEY != "PRI") {
        ElemForm[ElemForm.json[i].COLUMN_NAME + "Group"].addClass("has-error");
        ElemForm[ElemForm.json[i].COLUMN_NAME + "Error"].removeClass("hidden");
        mal = true;
      }else {
        ElemForm[ElemForm.json[i].COLUMN_NAME + "Form"].val(null);
      }
    }
    vec[ElemForm.json[i].COLUMN_NAME] = ElemForm[ElemForm.json[i].COLUMN_NAME + "Form"].val();
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
  ElemForm.$BtnAceptar.removeClass("hidden");
  ElemForm.$BtnModificar.addClass("hidden");
  ElemForm.$BtnEliminar.addClass("hidden");
  let l = ElemForm.json.length;
  for (var i = 0; i < l; i++) {
    ElemForm[ElemForm.json[i].COLUMN_NAME + "Group"].removeClass("has-error");
    ElemForm[ElemForm.json[i].COLUMN_NAME + "Error"].addClass("hidden");
    ElemForm[ElemForm.json[i].COLUMN_NAME + "Select"].removeClass("hidden");
    ElemForm[ElemForm.json[i].COLUMN_NAME].addClass("hidden");
    ElemForm[ElemForm.json[i].COLUMN_NAME + "Form"].removeClass("hidden").attr('disabled', false);
    if (modo == "Agregar") {
      ElemForm[ElemForm.json[i].COLUMN_NAME + "Form"].val(null);
    }else {
      let select = document.getElementById(ElemForm.json[i].COLUMN_NAME + "Select");
      if (select != null) {
        let opciones = select.options;
        let l = select.length;
        for (let j = 0; j < l; j++) {
          if (opciones[j].text == ElemForm[ElemForm.json[i].COLUMN_NAME + "Form"].val()) {
            select.selectedIndex = j;
            break;
          }
        }
      }
    }
  }
}
</script>
