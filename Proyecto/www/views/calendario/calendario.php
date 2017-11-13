<script>

var Elementos = {
  tabs : document.getElementById("tabs"),
  $RepEdit : $('#RepEdit'),
  $ModalPropiedades: $('#ModalPropiedades'),
  RepSelect : document.getElementById("RepSelect"),
  RepCada : document.getElementById("RepCada"),
  intervalo : document.getElementById("intervalo"),
  unidad : document.getElementById("unidad"),
  diassemana : document.getElementById("diassemana"),
  cosaloca : document.getElementById("cosaloca"),
  diasmes : document.getElementById("diasmes"),
  diadelasemana : document.getElementById("diadelasemana"),
  DiaFin : document.getElementById("DiaFin"),
  NumVeces : document.getElementById("NumVeces"),
  Forms: document.querySelectorAll("form .form-control"),
  Statics: document.querySelectorAll("form .form-control-static"),
};
var rule = {};
var turno = "1";

$( document ).ajaxError(function( event, jqxhr, settings, thrownError ) {
  location.reload(true);
});

document.getElementById("BtnAgregar").addEventListener("click", function() {
  eventoUnico();
  crearFormulario();
  modoInput();
});
document.getElementById("RepSelect").addEventListener("click", function() {
  byebye();
});

document.getElementById("CancelarModal").addEventListener("change", function() {
  ElemForm["Recurrencia" + turno + "Form"].checked = false;
});

document.getElementById("AceptarModal").addEventListener("click", function() {
  let repeticion = {};
  Elementos.$RepEdit.modal('hide');
  switch (Elementos.RepSelect.value) {
    case "0":
    repeticion.freq = 3;
    repeticion.interval = Elementos.RepCada.value;
    break;
    case "1":
    repeticion.freq = 3;
    repeticion.byweekday = [0, 1, 2, 3, 4];
    break;
    case "2":
    repeticion.freq = 3;
    repeticion.byweekday = [0, 2, 4];
    break;
    case "3":
    repeticion.freq = 3;
    repeticion.byweekday = [1, 3];
    break;
    case "4":
    repeticion.freq = 2;
    if (Elementos.RepCada.value!=1) {
      repeticion.interval = Elementos.RepCada.value;
    }
    let dias = document.getElementById("diassemana").getElementsByTagName("input");
    let diasvec = [];
    for (day in dias) {
      if (dias[day].checked==true) {
        diasvec.push(Number(dias[day].value))
      }
    }
    if (diasvec!=null) {
      repeticion.byweekday = diasvec;
    }
    break;
    case "5":
    repeticion.freq = 1;
    repeticion.interval = Elementos.RepCada.value;
    if (diadelasemana.checked == true) {
      let dia = document.getElementById("SemSelect").value;
      var ord = document.getElementById("OrdinalSelect").value;
      repeticion.byweekday= [dia.nth(ord)];
    }
    break;
    case "6":
    repeticion.freq = 0;
    break;
  }
  let radios = document.getElementsByClassName("radiomitre");
  for (radio in radios) {
    if (radios[radio].checked == true) {
      if (radios[radio].id == "optionsRadios2") {
        repeticion.count = Elementos.NumVeces.value;
      }else if (radios[radio].id == "optionsRadios3") {
        repeticion.until = new Date(Elementos.DiaFin.value);
      }
    }
  }
  rule[turno] = new RRule(repeticion);
  if (rule[turno].toText() == "RRule error: Unable to fully convert this rrule to text") {
    ElemForm["Recurrencia" + turno + "Form"].checked = false;
  }else{
    ElemForm["Recurrencia" + turno + "Form"].checked = true;
  }

});

function byebye(){
  switch (Elementos.RepSelect.value) {
    case "0":
    Elementos.unidad.innerHTML = ' días';
    Elementos.intervalo.classList.remove("hidden");
    Elementos.diassemana.classList.add("hidden");
    Elementos.cosaloca.classList.add("hidden");
    Elementos.diasmes.classList.add("hidden");
    break;
    case "4":
    Elementos.intervalo.classList.remove("hidden");
    Elementos.unidad.innerHTML = ' semanas';
    Elementos.diassemana.classList.remove("hidden");
    Elementos.cosaloca.classList.add("hidden");
    Elementos.diasmes.classList.add("hidden");
    break;
    case "5":
    Elementos.intervalo.classList.remove("hidden");
    Elementos.unidad.innerHTML = ' meses';
    Elementos.diassemana.classList.add("hidden");
    Elementos.cosaloca.classList.remove("hidden");
    Elementos.diasmes.classList.remove("hidden");
    break;
    case "6":
    Elementos.intervalo.classList.remove("hidden");
    Elementos.unidad.innerHTML = ' años';
    Elementos.diassemana.classList.add("hidden");
    Elementos.diasmes.classList.add("hidden");
    Elementos.cosaloca.classList.add("hidden");
    break;
    default:
    Elementos.intervalo.classList.add("hidden");
    Elementos.unidad.classList.add("hidden");
    Elementos.diassemana.classList.add("hidden");
    Elementos.cosaloca.classList.add("hidden");
    Elementos.diasmes.classList.add("hidden");
  }
}

document.getElementById("diadelmes").addEventListener("click", function() {
  Elementos.cosaloca.classList.add("hidden");
});
document.getElementById("diadelasemana").addEventListener("click", function() {
  Elementos.cosaloca.classList.remove("hidden");
});
document.getElementById("OrdinalSelect").addEventListener("click", function() {
  byebye();
});
document.getElementById("SemSelect").addEventListener("click", function() {
  byebye();
});

document.getElementById("optionsRadios1").addEventListener("click", function() {
  Elementos.NumVeces.disabled = true;
  Elementos.DiaFin.disabled = true;
});

document.getElementById("optionsRadios2").addEventListener("click", function() {
  Elementos.NumVeces.disabled = false;
  Elementos.DiaFin.disabled = true;
});

document.getElementById("optionsRadios3").addEventListener("click", function() {
  Elementos.NumVeces.disabled = true;
  Elementos.DiaFin.disabled = false;
});

document.getElementById("BtnModificar").addEventListener("click", function() {
  modoFormulario('Modificar');
  for (var i = 1; i < largo + 1; i++) {
    ElemForm["Nombre" + i + "Form"].disabled = true;
    if (ElemForm["Recurrencia" + i + "Form"].checked) {
      ElemForm["Recurrencia" + i + "Select"].classList.remove("hidden");
    }else {
      ElemForm["Recurrencia" + i + "Select"].classList.add("hidden");
    }
  }
});

var bien = true;

function err(Nom){
  ElemForm[Nom + "Group"].classList.add("has-error");
  ElemForm[Nom + "Error"].classList.remove("hidden");
  ElemForm[Nom + "Error"].innerHTML = "Ingrese el campo correctamente";
  bien = false;
}

function format(){

  let l = ElemForm.Columns.length;

  for (let i = 1; i < l; i++) {
    bien = true;
    ElemForm[ElemForm.Columns[i].COLUMN_NAME + "Group"].classList.remove("has-error");
    if (ElemForm[ElemForm.Columns[i].COLUMN_NAME + "Error"]) {
      ElemForm[ElemForm.Columns[i].COLUMN_NAME + "Error"].classList.add("hidden");
      ElemForm[ElemForm.Columns[i].COLUMN_NAME + "Error"].innerHTML = "Campo Obligatorio";
    }
    if (ElemForm[ElemForm.Columns[i].COLUMN_NAME + "Form"].value == "") {
      ElemForm[ElemForm.Columns[i].COLUMN_NAME + "Group"].classList.add("has-error");
      ElemForm[ElemForm.Columns[i].COLUMN_NAME + "Error"].classList.remove("hidden");
      bien = false;
    }
  }
  for (var i = 1; i < largo + 1; i++) {
    if (ElemForm["Finalizacion" + i + "Form"].value.length != 8 && ElemForm["Finalizacion" + i + "Form"].value.length != 0) {
      err("Finalizacion");
    }
    if (ElemForm["Inicio" + i + "Form"].value.length != 8 && ElemForm["Inicio" + i + "Form"].value.length != 0) {
      err("Inicio");
    }
    if (ElemForm["Fecha" + i + "Form"].value.length != 10 && ElemForm["Fecha" + i + "Form"].value.length != 0) {
      err("Fecha");
    }
  }

  if (bien) {
    let final = [];
    for (var i = 1; i < largo + 1; i++) {
      let datos = {};
      datos['idActividades'] = ElemForm["idActividades" + i + "Form"].value;
      datos['idEvento'] = ElemForm["idEvento" + i + "Form"].value;
      datos['Inicio'] = ElemForm["Fecha" + i + "Form"].value +'T'+ ElemForm["Inicio" + i + "Form"].value +'-03:00';
      datos['Finalizacion'] = ElemForm["Fecha" + i + "Form"].value +'T'+ ElemForm["Finalizacion" + i + "Form"].value +'-03:00';
      datos['Nombre'] = ElemForm["Nombre" + i + "Form"].value;
      datos['Recurrencia'] = (ElemForm["Recurrencia" + i + "Form"].checked) ? 'RRULE:' + rule[i].toString() : 'no';
      final.push(datos);
    }
    return final;
  }else {
    return 'no'
  }

}
var NotFound = false;

document.getElementById("BtnAceptar").addEventListener("click", function() {
  let datos = format();
  if (datos != 'no') {
    let url;
    if (datos[0]['idEvento']=="" || NotFound) {
      url = "addEvento";
    }else{
      url = "editarEvento";
    }
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "<?php echo URL; ?>actividad/" + url);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
      if(xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
        afterEnviar();
        for (var i = 1; i < largo + 1; i++) {
          Elementos["Resumen" + i].innerHTML="";
          ElemForm["Recurrencia" + i + "Form"].classList.add("hidden");
          ElemForm["Recurrencia" + i + "Select"].classList.add("hidden");
        }
      }
    };
    xhr.send("data=" + JSON.stringify(datos) + "&data2=" + CalendarId);
  }
});

function modoInput($element = ""){
  Elementos.tabs.classList.add("hidden");
  rule = {};
  Elementos.$ModalPropiedades.modal('show');
  let l = Elements.Forms.length;
  for (var i = 0; i < l; i++) {
    Elements.Forms[i].classList.remove('hidden');
    Elements.Forms[i].value = "";
    Elements.Forms[i].disabled = false;
  }
  l = Elements.Statics.length;
  for (var i = 0; i < l; i++) {
    Elements.Statics[i].classList.add('hidden');
  }
  ElemForm.BtnAceptar.classList.remove("hidden");
  ElemForm.BtnModificar.classList.add("hidden");
  for (var i = 1; i < largo + 1; i++) {
    if ($element != "") {
      ElemForm["idActividades" + i + "Form"].value = $element.idActividades;
      ElemForm["Nombre" + i + "Form"].value = $element.Nombre;
      ElemForm["Nombre" + i + "Form"].disabled = true;
    }
    ElemForm["Recurrencia" + i + "Form"].disabled = false;
    ElemForm["Recurrencia" + i + "Form"].classList.remove("hidden");
  }
}
var largo = 0;
function eventoUnico(){
  largo = 1;
  let ul = document.createElement("ul");
  ul.style = "padding-left: 0px";
  let form = document.createElement("form");
  form.className = "form-horizontal";
  form.id = "Formu" + largo;
  ul.appendChild(form);
  ElemForm.Formu.innerHTML = "";
  ElemForm.Formu.appendChild(ul);
}
var CalendarId;
$('#Tabla').on('click-row.bs.table', function (row, $element, field) {
  $('.success').removeClass('success');
  $(field).addClass('success');
  $('#tabs a:first').tab('show');
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "<?php echo URL; ?>actividad/traerEvento");
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
    if(xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
      largo = 0;
      let asd = JSON.parse(xhr.responseText);
      respuestaParse = asd[0];
      CalendarId = asd[1];
      NotFound = false;
      turno = "1";
      ElemForm.Columns = [];
      ElemForm.Formu.innerHTML = "";
      if (respuestaParse === "Not Found") {
        //Si hay 1 solo evento no establecido
        alert('No hay un evento en Google Calendar asignado a esta actividad. Por favor llene los datos');
        NotFound = true;
        eventoUnico();
        crearFormulario();
        modoInput($element);
        ElemForm["idEvento1Form"].value = $element.idActividades;
      }else {
        largo = 0;
        if('Nombre' in respuestaParse && 'idEvento' in respuestaParse && 'idActividades' in respuestaParse && 'Finalizacion' in respuestaParse && 'Inicio' in respuestaParse && 'Fecha' in respuestaParse && 'Recurrencia' in respuestaParse){
          //Si hay 1 solo evento establecido
          eventoUnico();
        }else {
          //Si hay multiples eventos
          for (evento in respuestaParse) {
            if (respuestaParse[evento] == null) {
              NotFound = true;
            }
          }
          if (NotFound) {
            //Si alguno de ellos no esta establecido
            alert('No están asignadas correctamente todas las subactividades. Por favor llene los datos');
          }
          let texto = '<ul class="nav nav-tabs nav-justified" role="tablist" id="tabs">';
          let tabcontent = document.createElement("div");
          tabcontent.className = "tab-content";
          for (x in respuestaParse) {
            largo++;
            if (largo === 1) {
              texto += '<li role="presentation" class="active"><a href="#'+ x.replace(/ /g,"") +'" id="'+ largo +'" role="tab" onclick="turno = this.id" data-toggle="tab">'+ x +'</a></li>';
            }else {
              texto += '<li role="presentation"><a href="#'+ x.replace(/ /g,"") +'" id="'+ largo +'" role="tab" onclick="turno = this.id" data-toggle="tab">'+ x +'</a></li>';
            }
            let tabpane = document.createElement("div");
            tabpane.id = x.replace(/ /g,"");
            tabpane.role = "tabpanel";
            if (largo === 1) {
              tabpane.className = "tab-pane fade in active";
            }else {
              tabpane.className = "tab-pane fade";
            }
            let ul = document.createElement("ul");
            ul.style = "padding-left: 0px";
            let form = document.createElement("form");
            form.className = "form-horizontal";
            form.id = "Formu" + largo;
            ul.appendChild(form);
            tabpane.appendChild(ul);
            tabcontent.appendChild(tabpane);
          }
          texto += '</ul>';
          ElemForm.Formu.innerHTML = texto;
          ElemForm.Formu.appendChild(tabcontent);
        }
        crearFormulario();
        //Una vez creado el formulario, se llena con la info recibida
        if (!NotFound) {
          if(largo > 1){
            let i = 1;
            for (evento in respuestaParse) {
              clickFilaa(respuestaParse[evento], i);
              i++;
            }
          }else {
            clickFilaa(respuestaParse);
          }
        }else {
          modoInput($element);
          let i = 1;
          for (evento in respuestaParse) {
            ElemForm["Nombre" + i + "Form"].value = evento;
            ElemForm["Nombre" + i + "Form"].disabled = true;
            i++;
          }
        }
      }
    }
  };
  xhr.send("data=" + $element.idActividades + "&data2=" + $element.Nombre);

});

function crearFormulario(){
  for (let i = 1; i < largo + 1; i++) {
    let campos = [
      {
        IS_NULLABLE: "NO",
        COLUMN_NAME: "idActividades" + i,
        DATA_TYPE: "int",
        COLUMN_COMMENT: "idActividades",
        COLUMN_KEY: "PRI"
      },
      {
        IS_NULLABLE: "NO",
        COLUMN_NAME: "idEvento" + i,
        DATA_TYPE: "text",
        COLUMN_COMMENT: "idEvento",
        COLUMN_KEY: "PRI"
      },
      {
        IS_NULLABLE: "NO",
        COLUMN_NAME: "Nombre" + i,
        DATA_TYPE: "text",
        COLUMN_COMMENT: "Nombre",
        COLUMN_KEY: ""
      },
      {
        IS_NULLABLE: "NO",
        COLUMN_NAME: "Fecha" + i,
        DATA_TYPE: "date",
        COLUMN_COMMENT: "Fecha",
        COLUMN_KEY: ""
      },
      {
        IS_NULLABLE: "NO",
        COLUMN_NAME: "Inicio" + i,
        DATA_TYPE: "text",
        COLUMN_COMMENT: "Inicio",
        COLUMN_KEY: ""
      },
      {
        IS_NULLABLE: "NO",
        COLUMN_NAME: "Finalizacion" + i,
        DATA_TYPE: "text",
        COLUMN_COMMENT: "Finalizacion",
        COLUMN_KEY: ""
      },
      {
        IS_NULLABLE: "NO",
        COLUMN_NAME: "Recurrencia" + i,
        DATA_TYPE: "tinyint",
        COLUMN_COMMENT: "Se repite",
        COLUMN_KEY: ""
      }
    ];
    crearCampos(campos, document.getElementById("Formu" + i));
    $(ElemForm["Inicio" + i + "Form"]).timepicker({ 'timeFormat': 'H:i:s' });
    $(ElemForm["Finalizacion" + i + "Form"]).timepicker({ 'timeFormat': 'H:i:s' });
    $(ElemForm["Fecha" + i + "Form"]).datepicker('destroy').datepicker({
      language: "es",
      startDate: "today",
      autoclose: true,
      format: 'yyyy-mm-dd'
    });

    let label = document.createElement("label");
    label.className = "col-sm-2 control-label";
    label.innerHTML = "Se repite";

    let col1 = document.createElement("div");
    col1.className = "col-sm-1";
    ElemForm["Recurrencia" + i +"Form"] = document.createElement("input");
    ElemForm["Recurrencia" + i +"Form"].className = "checkbox hidden";
    ElemForm["Recurrencia" + i +"Form"].type = "checkbox";
    ElemForm["Recurrencia" + i +"Form"].value = "SI";
    ElemForm["Recurrencia" + i +"Form"].id = "Recurrencia" + i + "Form";
    ElemForm["Recurrencia" + i +"Form"].disabled = true;
    col1.appendChild(ElemForm["Recurrencia" + i +"Form"]);
    let col3 = document.createElement("div");
    col3.className = "col-sm-3";
    let button = '<button type="button" id="Recurrencia'+ i +'Select" class="btn btn-link hidden" data-toggle="modal" data-target="#RepEdit">Elegir repetición</button>';
    col3.innerHTML = button;
    ElemForm["Recurrencia" + i +"Select"] = col3.firstChild;
    ElemForm["Recurrencia" + i +"Form"].addEventListener('click',function(){
      ElemForm["Recurrencia" + i +"Select"].classList.toggle("hidden");
    });
    let col6 = document.createElement("div");
    col6.className = "col-sm-6";
    Elementos["Resumen" + i] = document.createElement("p");
    Elementos["Resumen" + i].id = "Resumen" + i;
    col6.appendChild(Elementos["Resumen" + i]);
    ElemForm["Recurrencia"+ i +"Group"].innerHTML = "";
    ElemForm["Recurrencia"+ i +"Group"].appendChild(label);
    ElemForm["Recurrencia"+ i +"Group"].appendChild(col1);
    ElemForm["Recurrencia"+ i +"Group"].appendChild(col3);
    ElemForm["Recurrencia"+ i +"Group"].appendChild(col6);
  }
}

function clickFilaa(obj, i = 1){
  Elementos.$ModalPropiedades.modal('show');
  for (x in obj) {
    if (x != "Recurrencia") {
      ElemForm[x + i].classList.remove("hidden");
      ElemForm[x + i].innerHTML = obj[x];
      ElemForm[x + i +"Form"].classList.add("hidden");
      ElemForm[x + i +"Form"].value = obj[x];
    }else {
      ElemForm[x + i +"Form"].classList.remove("hidden");
      ElemForm[x + i +"Form"].disabled = true;
    }
  }
  ElemForm["Nombre" + i +"Form"].disabled = true;
  ElemForm["Nombre" + i +"Form"].value = obj["Nombre"];


  if (obj["Recurrencia"] != null) {
    rule["" + i] = rrulestr(obj["Recurrencia"][0]);
    let cucu = rule["" + i].toText();
    cucu = cucu.charAt(0).toUpperCase() + cucu.slice(1);
    Elementos["Resumen" + i].innerHTML = cucu;

    ElemForm["Recurrencia" + i +"Form"].checked = true;
  } else {
    ElemForm["Recurrencia" + i +"Form"].checked = false;
    Elementos["Resumen" + i].innerHTML = "";

  }
  ElemForm.BtnAceptar.classList.add("hidden");
  ElemForm.BtnAgregar.classList.remove("hidden");
  ElemForm.BtnModificar.classList.remove("hidden");
}
</script>
