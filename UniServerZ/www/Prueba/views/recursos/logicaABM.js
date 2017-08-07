var ElemForm = {
  checkboxes: document.getElementById("Formu").getElementsByClassName("checkbox"),
  intros: document.getElementById("Formu").getElementsByClassName("intro"),
  $BtnAceptar: $("#BtnAceptar"),
  $BtnAgregar: $("#BtnAgregar"),
  $BtnModificar: $("#BtnModificar"),
  $BtnEliminar: $("#BtnEliminar"),
  $Tabla: $('#Tabla'),
  json: []
}

function optionCrear(vec) {
  let txt="";
  let l = vec.length;
  for (let i = 0; i < l; i++) {
    txt += "<option value='" + vec[i].id + "'>" + vec[i].Nombre + "</option>";
  }
  return txt;
}
function setCampos(obj){
  for (x in obj) {
    ElemForm.json.push(obj[x].COLUMN_NAME);
    ElemForm[obj[x].COLUMN_NAME + "Select"] = $("#" + obj[x].COLUMN_NAME + "Select");
    ElemForm[obj[x].COLUMN_NAME] = $("#" + obj[x].COLUMN_NAME);
    ElemForm[obj[x].COLUMN_NAME + "Form"] = $("#" + obj[x].COLUMN_NAME + "Form");
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

function clickFila(obj){
  for (x in obj) {
    ElemForm[x + "Select"].addClass("hidden");
    ElemForm[x].removeClass("hidden").text(obj[x]);
    if(ElemForm[x + "Form"] != null){
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
  }
  let l = ElemForm.intros.length;
  if (l>0) {
    for (let i = 0; i < l; i++) {
      $("#" + ElemForm.checkboxes[i].id).removeClass("hidden");
      ElemForm.checkboxes[i].disabled = true;
      if (ElemForm.intros[i].innerHTML == 1) {
        ElemForm.checkboxes[i].checked = true;
      } else {
        ElemForm.checkboxes[i].checked = false;
      }
      $("#" + ElemForm.intros[i].id).addClass("hidden");
    }
  }
  ElemForm.$BtnAceptar.addClass("hidden");
  ElemForm.$BtnAgregar.removeClass("hidden");
  ElemForm.$BtnModificar.removeClass("hidden");
  ElemForm.$BtnEliminar.removeClass("hidden");
}
function afterEnviar(){
  for (x in ElemForm.json) {
    ElemForm[ElemForm.json[x] + "Select"].addClass("hidden");
    ElemForm[ElemForm.json[x]].removeClass("hidden").html("");
    ElemForm[ElemForm.json[x] + "Form"].addClass("hidden");
  }
  let l = ElemForm.checkboxes.length;
  if (l>0) {
    for (var i = 0; i < l; i++) {
      ElemForm.checkboxes[i].disabled = true;
    }
  }
  ElemForm.$BtnAceptar.addClass("hidden");
  ElemForm.$BtnAgregar.removeClass("hidden");
  ElemForm.$BtnModificar.addClass("hidden");
  ElemForm.$BtnEliminar.addClass("hidden");
  ElemForm.$Tabla.bootstrapTable('refresh');
}
function beforeEnviar(){
  let vec = {};
  let l = ElemForm.checkboxes.length;
  if (l>0) {
    for (var i = 0; i < l; i++) {
      ElemForm.checkboxes[i].value = (ElemForm.checkboxes[i].checked) ? 1 : 0;
    }
  }
  for (x in ElemForm.json) {
    let sel = document.getElementById(x + "Select");
    if ( sel != null) {
      ElemForm[ElemForm.json[x] + "Form"].val(sel.value);
    }
    if (ElemForm[ElemForm.json[x] + "Form"].val() === "") {
      ElemForm[ElemForm.json[x] + "Form"].val(null);
    }
    vec[ElemForm.json[x]] = ElemForm[ElemForm.json[x] + "Form"].val();
  }
  return vec;
}

function eliminarError(respuesta){
  afterEnviar();
  if (respuesta != "") {
    alert("Como existen registros que hacen referencia a este elemento, éste no se puede eliminar.\n\ Calma: esto no es un error ni una falla.");
  }
}

function modoFormulario(modo){
  ElemForm.$BtnAceptar.removeClass("hidden");
  // ElemForm.$BtnAgregar.addClass("hidden");
  ElemForm.$BtnModificar.addClass("hidden");
  ElemForm.$BtnEliminar.addClass("hidden");
  for (x in ElemForm.json) {
    ElemForm[ElemForm.json[x] + "Select"].removeClass("hidden");
    ElemForm[ElemForm.json[x]].addClass("hidden");
    ElemForm[ElemForm.json[x] + "Form"].removeClass("hidden").attr('disabled', false);
    if (modo == "Agregar") {
      ElemForm[ElemForm.json[x] + "Form"].val(null);
    }else {
      let select = document.getElementById(ElemForm.json[x] + "Select");
      if (select != null) {
        let opciones = select.options;
        let l = select.length;
        for (let j = 0; j < l; j++) {
          if (opciones[j].text == ElemForm[ElemForm.json[x] + "Form"].val()) {
            select.selectedIndex = j;
            break;
          }
        }
      }
    }
  }
  $("form .form-control:first").attr('disabled', true);
}
