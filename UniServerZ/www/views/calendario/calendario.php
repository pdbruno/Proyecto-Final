<script>

var Elementos = {
  $tabs : $("#tabs"),
  $RepEdit : $('#RepEdit'),

  RepSelect : document.getElementById("RepSelect"),
  RepCada : document.getElementById("RepCada"),
  $intervalo : $("#intervalo"),
  $unidad : $("#unidad"),
  $diassemana : $("#diassemana"),
  $cosaloca : $("#cosaloca"),
  $diasmes : $("#diasmes"),
  diadelasemana : document.getElementById("diadelasemana"),
  DiaFin : document.getElementById("DiaFin"),
  NumVeces : document.getElementById("NumVeces"),
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
  ElemForm["Recurrencia" + turno + "Form"].attr('checked', false);
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
    ElemForm["Recurrencia" + turno + "Form"].attr("checked", false);
  }else{
    ElemForm["Recurrencia" + turno + "Form"].attr("checked", true);
  }

});

function byebye(){
  switch (Elementos.RepSelect.value) {
    case "0":
    Elementos.$unidad.text(' días');
    Elementos.$intervalo.removeClass('hidden');
    Elementos.$diassemana.addClass('hidden');
    Elementos.$cosaloca.addClass('hidden');
    Elementos.$diasmes.addClass('hidden');
    break;
    case "4":
    Elementos.$intervalo.removeClass('hidden');
    Elementos.$unidad.text(' semanas');
    Elementos.$diassemana.removeClass('hidden');
    Elementos.$cosaloca.addClass('hidden');
    Elementos.$diasmes.addClass('hidden');
    break;
    case "5":
    Elementos.$intervalo.removeClass('hidden');
    Elementos.$unidad.text(' meses');
    Elementos.$diassemana.addClass('hidden');
    Elementos.$cosaloca.removeClass('hidden');
    Elementos.$diasmes.removeClass('hidden');
    break;
    case "6":
    Elementos.$intervalo.removeClass('hidden');
    Elementos.$unidad.text(' años');
    Elementos.$diassemana.addClass('hidden');
    Elementos.$diasmes.addClass('hidden');
    Elementos.$cosaloca.addClass('hidden');
    break;
    default:
    Elementos.$intervalo.addClass('hidden');
    Elementos.$unidad.addClass('hidden');
    Elementos.$diassemana.addClass('hidden');
    Elementos.$cosaloca.addClass('hidden');
    Elementos.$diasmes.addClass('hidden');
  }
}

document.getElementById("diadelmes").addEventListener("click", function() {
  Elementos.$cosaloca.addClass('hidden');
});
document.getElementById("diadelasemana").addEventListener("click", function() {
  Elementos.$cosaloca.removeClass('hidden');
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
    ElemForm["Nombre" + i + "Form"].prop("disabled", true);
    if (ElemForm["Recurrencia" + i + "Form"].prop('checked')) {
      ElemForm["Recurrencia" + i + "Select"].removeClass('hidden');
    }else {
      ElemForm["Recurrencia" + i + "Select"].addClass('hidden');
    }
  }
});

var bien = true;

function err(Nom){
  ElemForm[Nom + "Group"].addClass("has-error");
  ElemForm[Nom + "Error"].removeClass("hidden").text("Ingrese el campo correctamente");
  bien = false;
}

function format(){

  let l = ElemForm.Columns.length;

  for (let i = 1; i < l; i++) {
    bien = true;
    ElemForm[ElemForm.Columns[i].COLUMN_NAME + "Group"].removeClass("has-error");
    ElemForm[ElemForm.Columns[i].COLUMN_NAME + "Error"].addClass("hidden").text("Campo Obligatorio");
    if (ElemForm[ElemForm.Columns[i].COLUMN_NAME + "Form"].val() == "") {
      ElemForm[ElemForm.Columns[i].COLUMN_NAME + "Group"].addClass("has-error");
      ElemForm[ElemForm.Columns[i].COLUMN_NAME + "Error"].removeClass("hidden");
      bien = false;
    }
  }
  for (var i = 1; i < largo + 1; i++) {
    if (ElemForm["Finalizacion" + i + "Form"].val().length != 8 && ElemForm["Finalizacion" + i + "Form"].val().length != 0) {
      err("Finalizacion");
    }
    if (ElemForm["Inicio" + i + "Form"].val().length != 8 && ElemForm["Inicio" + i + "Form"].val().length != 0) {
      err("Inicio");
    }
    if (ElemForm["Fecha" + i + "Form"].val().length != 10 && ElemForm["Fecha" + i + "Form"].val().length != 0) {
      err("Fecha");
    }
  }

  if (bien) {
    let final = [];
    for (var i = 1; i < largo + 1; i++) {
      let datos = {};
      datos['idActividades'] = ElemForm["idActividades" + i + "Form"].val();
      datos['idEvento'] = ElemForm["idEvento" + i + "Form"].val();
      datos['Inicio'] = ElemForm["Fecha" + i + "Form"].val() +'T'+ ElemForm["Inicio" + i + "Form"].val() +'-03:00';
      datos['Finalizacion'] = ElemForm["Fecha" + i + "Form"].val() +'T'+ ElemForm["Finalizacion" + i + "Form"].val() +'-03:00';
      datos['Nombre'] = ElemForm["Nombre" + i + "Form"].val();
      datos['Recurrencia'] = (ElemForm["Recurrencia" + i + "Form"].prop('checked')) ? 'RRULE:' + rule[i].toString() : 'no';
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
    var request = $.ajax({
      url: "<?php echo URL; ?>actividad/" + url,
      type: "post",
      data: "data=" + JSON.stringify(datos) + "&data2=" + CalendarId,
    });
    request.done(function (respuesta){
      afterEnviar();
      for (var i = 1; i < largo + 1; i++) {
        Elementos["Resumen" + i].innerHTML="";
        ElemForm["Recurrencia" + i + "Form"].addClass("hidden");
        ElemForm["Recurrencia" + i + "Select"].addClass("hidden");
      }
    });
  }
});

function modoInput($element = ""){
  Elementos.$tabs.addClass("hidden");
  rule = {};
  $('#ModalPropiedades').modal('show');
  $("form .form-control").removeClass('hidden').val("").prop("disabled", false);
  $("form .form-control-static").addClass('hidden');
  ElemForm.$BtnAceptar.removeClass("hidden");
  ElemForm.$BtnModificar.addClass("hidden");
  for (var i = 1; i < largo + 1; i++) {
    if ($element != "") {
      ElemForm["idActividades" + i + "Form"].val($element.idActividades);
      ElemForm["Nombre" + i + "Form"].val($element.Nombre).prop("disabled", true);
    }
    ElemForm["Recurrencia" + i + "Form"].prop("disabled", false).removeClass("hidden");
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
  let request = $.ajax({
    url: "<?php echo URL; ?>actividad/traerEvento",
    type: "post",
    data: "data=" + $element.idActividades + "&data2=" + $element.Nombre,
  });
  request.done(function (respuesta)
  {
    largo = 0;
    let asd = JSON.parse(respuesta);
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
      ElemForm["idEvento1Form"].val($element.idActividades);
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
          ElemForm["Nombre" + i + "Form"].val(evento).prop("disabled", true);
          i++;
        }
      }
    }
  });
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
    ElemForm["Inicio" + i + "Form"].timepicker({ 'timeFormat': 'H:i:s' });
    ElemForm["Finalizacion" + i + "Form"].timepicker({ 'timeFormat': 'H:i:s' });
    ElemForm["Fecha" + i + "Form"].datepicker('destroy');
    ElemForm["Fecha" + i + "Form"].datepicker({
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
    let checkbox = document.createElement("input");
    checkbox.className = "checkbox hidden";
    checkbox.type = "checkbox";
    checkbox.value = "SI";
    checkbox.id = "Recurrencia" + i + "Form";
    checkbox.disabled = true;
    col1.appendChild(checkbox);
    ElemForm["Recurrencia" + i +"Form"] = $(checkbox);
    let col3 = document.createElement("div");
    col3.className = "col-sm-3";
    let button = '<button type="button" id="Recurrencia'+ i +'Select" class="btn btn-link hidden" data-toggle="modal" data-target="#RepEdit">Elegir repetición</button>';
    col3.innerHTML = button;
    ElemForm["Recurrencia" + i +"Select"] = $(col3.firstChild);
    checkbox.addEventListener('click',function(){
      $(ElemForm["Recurrencia" + i +"Select"]).toggleClass("hidden");
    });
    let col6 = document.createElement("div");
    col6.className = "col-sm-6";
    Elementos["Resumen" + i] = document.createElement("p");
    Elementos["Resumen" + i].id = "Resumen" + i;
    col6.appendChild(Elementos["Resumen" + i]);
    ElemForm["Recurrencia"+ i +"Group"].html("");
    ElemForm["Recurrencia"+ i +"Group"].append(label, col1, col3, col6);
  }
}

function clickFilaa(obj, i = 1){
  $('#ModalPropiedades').modal('show');

  for (x in obj) {
    if (x != "Recurrencia") {
      ElemForm[x + i].removeClass("hidden").text(obj[x]);
      ElemForm[x + i +"Form"].addClass("hidden").val(obj[x]);
    }else {
      ElemForm[x + i +"Form"].removeClass("hidden").prop('disabled', true);
    }
  }

  ElemForm["Nombre" + i +"Form"].prop('disabled', true).val(obj["Nombre"]);
  if (obj["Recurrencia"] != null) {
    rule["" + i] = rrulestr(obj["Recurrencia"][0]);
    let cucu = rule["" + i].toText();
    cucu = cucu.charAt(0).toUpperCase() + cucu.slice(1);
    Elementos["Resumen" + i].innerHTML = cucu;

    ElemForm["Recurrencia" + i +"Form"].prop("checked", true);
  } else {
    ElemForm["Recurrencia" + i +"Form"].prop("checked", false);
    Elementos["Resumen" + i].innerHTML = "";

  }
  ElemForm.$BtnAceptar.addClass("hidden");
  ElemForm.$BtnAgregar.removeClass("hidden");
  ElemForm.$BtnModificar.removeClass("hidden");
}
</script>
