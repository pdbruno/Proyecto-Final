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
  Resumen1 : document.getElementById("resumen1"),
  Resumen2 : document.getElementById("resumen2"),
  Resumen3 : document.getElementById("resumen3")
};
var rule = {};
var turno = "1";
$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
  turno = "" + e.target.id;
})
var form1 = [{COLUMN_NAME: "idActividades1"},{COLUMN_NAME: "Nombre1"},{COLUMN_NAME: "Fecha1"},{COLUMN_NAME: "Inicio1"},{COLUMN_NAME: "Finalizacion1"},{COLUMN_NAME: "Recurrencia1"}];
var form2 = [{COLUMN_NAME: "idActividades2"},{COLUMN_NAME: "Nombre2"},{COLUMN_NAME: "Fecha2"},{COLUMN_NAME: "Inicio2"},{COLUMN_NAME: "Finalizacion2"},{COLUMN_NAME: "Recurrencia2"}];
var form3 = [{COLUMN_NAME: "idActividades3"},{COLUMN_NAME: "Nombre3"},{COLUMN_NAME: "Fecha3"},{COLUMN_NAME: "Inicio3"},{COLUMN_NAME: "Finalizacion3"},{COLUMN_NAME: "Recurrencia3"}];
for (var i = 0; i < form1.length; i++) {
  setProp(form1[i]);
  setProp(form2[i]);
  setProp(form3[i]);
}
for (var i = 1; i < 4; i++) {
  ElemForm["Inicio" + i + "Form"].timepicker({ 'timeFormat': 'H:i:s' });
  ElemForm["Finalizacion" + i + "Form"].timepicker({ 'timeFormat': 'H:i:s' });
  ElemForm["Fecha" + i + "Form"].datepicker({
    language: "es",
    startDate: "today",
    autoclose: true,
    format: 'yyyy-mm-dd'
  });
}

document.getElementById("BtnAgregar").addEventListener("click", function() {
  armarFormulario();
});
document.getElementById("RepSelect").addEventListener("click", function() {
  byebye();
});

document.getElementById("CancelarModal").addEventListener("change", function() {
  ElemForm["Recurrencia" + turno + "Form"].attr('checked', false);
});

document.getElementById("AceptarModal").addEventListener("click", function() {
  let repeticion = {dtstart: new Date(ElemForm["Fecha" + turno + "Form"].val())};
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

ElemForm["Recurrencia1Form"].click(function(){
  ElemForm["Recurrencia1Select"].toggleClass('hidden');
});
ElemForm["Recurrencia2Form"].click(function(){
  ElemForm["Recurrencia2Select"].toggleClass('hidden');
});
ElemForm["Recurrencia3Form"].click(function(){
  ElemForm["Recurrencia3Select"].toggleClass('hidden');
});

document.getElementById("BtnModificar").addEventListener("click", function() {
  modoFormulario('Modificar');
  for (var i = 1; i < 4; i++) {
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

function format(form, j){

  for (let i = 1; i < 5; i++) {
    bien = true;
    ElemForm[form[i].COLUMN_NAME + "Group"].removeClass("has-error");
    ElemForm[form[i].COLUMN_NAME + "Error"].addClass("hidden").text("Campo Obligatorio");
    if (ElemForm[form[i].COLUMN_NAME + "Form"].val() == "") {
      ElemForm[form[i].COLUMN_NAME + "Group"].addClass("has-error");
      ElemForm[form[i].COLUMN_NAME + "Error"].removeClass("hidden");
      bien = false;
    }
  }

  if (ElemForm[form[4].COLUMN_NAME + "Form"].val().length != 8 && ElemForm[form[4].COLUMN_NAME + "Form"].val().length != 0) {
    err("Finalizacion");
  }
  if (ElemForm[form[3].COLUMN_NAME + "Form"].val().length != 8 && ElemForm[form[3].COLUMN_NAME + "Form"].val().length != 0) {
    err("Inicio");
  }
  if (ElemForm[form[2].COLUMN_NAME + "Form"].val().length != 10 && ElemForm[form[2].COLUMN_NAME + "Form"].val().length != 0) {
    err("Fecha");
  }
  if (bien) {
    let datos = {};
    datos['idActividades'] = ElemForm[form[0].COLUMN_NAME + "Form"].val();
    datos['Inicio'] = ElemForm[form[2].COLUMN_NAME + "Form"].val() +'T'+ ElemForm[form[3].COLUMN_NAME + "Form"].val() +'-03:00';
    datos['Finalizacion'] = ElemForm[form[2].COLUMN_NAME + "Form"].val() +'T'+ ElemForm[form[4].COLUMN_NAME + "Form"].val() +'-03:00';
    datos['Nombre'] = ElemForm[form[1].COLUMN_NAME + "Form"].val();
    datos['Recurrencia'] = (ElemForm[form[5].COLUMN_NAME + "Form"].val() == "SI") ? 'RRULE:' + rule[j].toString().substr(25) : 'no';
    return "data" + j + "=" + JSON.stringify(datos);
  }else {
    return 'no'
  }

}
var NotFound = false;

document.getElementById("BtnAceptar").addEventListener("click", function() {
  let zafa = true;
  let datos = [];
  datos.push(format(form1, 1));
  if (!Elementos.$tabs.hasClass("hidden")) {
    datos.push(format(form2, 2));
    datos.push(format(form3, 3));
  }
  for (var i = 0; i < datos.length; i++) {
    if (datos[i] == 'no') {
      zafa = false;
    }
  }
  if (zafa) {
    let url;
    if (datos[0]['idActividades']=="" || NotFound) {
      url = "addActividad";
    }else{
      url = "editarActividad";
    }
    let textofinal = "";
    for (var i = 0; i < datos.length; i++) {
      textofinal += datos[i];
      textofinal += "&";
    }
    textofinal = textofinal.slice(0, textofinal.length-1);
    var request = $.ajax({
      url: "<?php echo URL; ?>actividad/" + url,
      type: "post",
      data: textofinal,
    });
    request.done(function (respuesta){
      afterEnviar();
      for (var i = 1; i < 4; i++) {
        Elementos["Resumen" + i].innerHTML="";
        ElemForm["Recurrencia" + i + "Form"].addClass("hidden");
        ElemForm["Recurrencia" + i + "Select"].addClass("hidden");
      }
    });
  }
});

function armarFormulario(){
  Elementos.$tabs.addClass("hidden");
  rule = {};
  $('#ModalPropiedades').modal('show');
  $("form .form-control").removeClass('hidden').val("");
  $("form .form-control-static").addClass('hidden');
  ElemForm.$BtnAceptar.removeClass("hidden");
  ElemForm.$BtnModificar.addClass("hidden");
  for (var i = 1; i < 4; i++) {
    ElemForm["Recurrencia" + i + "Form"].prop("disabled", false).removeClass("hidden");
  }
}

$('#Tabla').on('click-row.bs.table', function (row, $element, field) {
  $('.success').removeClass('success');
  $(field).addClass('success');
  $('#tabs a:first').tab('show');
  for (var i = 1; i < 4; i++) {
  }
  let request = $.ajax({
    url: "<?php echo URL; ?>actividad/mostrar",
    type: "post",
    data: "data=" + $element.idActividades + "&data2=" + $element.Nombre,
  });
  request.done(function (respuesta)
  {
    if($element.Nombre == "Funcional"){
      if (respuesta == "Not Found" || respuesta == '"no papu"') {
        alert('No hay un evento en Google Calendar asignado a esta actividad. Por favor llene los datos');
        NotFound = true;
        armarFormulario();
      }else {
        NotFound = false;
        var obj = JSON.parse(respuesta);
        for (var i = 0; i < obj.length; i++) {
          let j = i+1;
          clickFilaa(obj[i], i + 1);
          rule["" + j] = rrulestr(obj[i]["Recurrencia"][0]);
          let cucu = rule["" + j].toText();
          cucu = cucu.charAt(0).toUpperCase() + cucu.slice(1);
          Elementos["Resumen" + j].innerHTML = cucu;
          ElemForm["Recurrencia" + j + "Form"].prop("checked");
        }
      }
      ElemForm.Nombre1Form.prop('disabled', true).val("Funcional Mañana");
      ElemForm.Nombre2Form.prop('disabled', true).val("Funcional Tarde");
      ElemForm.Nombre3Form.prop('disabled', true).val("Funcional Noche");
      Elementos.$tabs.removeClass("hidden");
    }else {
      Elementos.$tabs.addClass("hidden");
      if (respuesta == "Not Found") {
        alert('No hay un evento en Google Calendar asignado a esta actividad. Por favor llene los datos');
        NotFound = true;
        armarFormulario();
      } else {
        NotFound = false;
        var obj = JSON.parse(respuesta);
        clickFilaa(obj);
      }
      ElemForm.Nombre1Form.val($element.Nombre);
      ElemForm.Nombre1.text($element.Nombre);
      ElemForm.idActividades1Form.val($element.idActividades);
      ElemForm.idActividades1.text($element.idActividades);
    }
  });
});
function clickFilaa(obj, i = 1){
  $('#ModalPropiedades').modal('show');
  for (x in obj) {
    if (x != "Recurrencia") {
      ElemForm[x + i].removeClass("hidden").text(obj[x]);
      ElemForm[x + i +"Form"].addClass("hidden").val(obj[x]);
    }
  }
  ElemForm["Nombre" + i +"Form"].prop('disabled', true);
  ElemForm["Recurrencia" + i +"Form"].removeClass('hidden').prop('disabled', true);
  if (obj["Recurrencia"] != null) {
    rule["" + 1] = rrulestr(obj["Recurrencia"][0]);
    let cucu = rule["" + 1].toText();
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
