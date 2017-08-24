<script>

var Elementos = {
  $SeRepiteForm : $("#RecurrenciaForm"),
  $RepeticionSelect : $("#RepeticionSelect"),

  InicioForm :  document.getElementById("InicioForm"),
  FinalizacionForm : document.getElementById("FinalizacionForm"),
  FechaForm : document.getElementById("FechaForm"),
  NombreForm : document.getElementById("NombreForm"),

  $InicioGroup :  $("#InicioGroup"),
  $FinalizacionGroup : $("#FinalizacionGroup"),
  $FechaGroup : $("#FechaGroup"),
  $NombreGroup : $("#NombreGroup"),

  $InicioError :  $("#InicioError"),
  $FinalizacionError : $("#FinalizacionError"),
  $FechaError : $("#FechaError"),
  $NombreError : $("#NombreError"),

  RepSelect : document.getElementById("RepSelect"),
  $RepEdit : $('#RepEdit'),
  RepCada : document.getElementById("RepCada"),
  $intervalo : $("#intervalo"),
  $unidad : $("#unidad"),
  $diassemana : $("#diassemana"),
  $cosaloca : $("#cosaloca"),
  $diasmes : $("#diasmes"),
  diadelasemana : document.getElementById("diadelasemana"),
  DiaFin : document.getElementById("DiaFin"),
  NumVeces : document.getElementById("NumVeces"),
  idActividadesForm : document.getElementById("idActividadesForm"),
  Resumen : document.getElementById("resumen")
};
var rule;
$("#InicioForm").timepicker({ 'timeFormat': 'H:i:s' });
$("#FinalizacionForm").timepicker({ 'timeFormat': 'H:i:s' });
$("#FechaForm").datepicker({
  language: "es",
  startDate: "today",
  autoclose: true,
  format: 'yyyy-mm-dd'
});
var vecsito = [{COLUMN_NAME: "idActividades"},{COLUMN_NAME: "Nombre"},{COLUMN_NAME: "Fecha"},{COLUMN_NAME: "Inicio"},{COLUMN_NAME: "Finalizacion"},{COLUMN_NAME: "SeRepite"}];
for (var i = 0; i < vecsito.length; i++) {
  setProp(vecsito[i]);
}
document.getElementById("BtnAgregar").addEventListener("click", function() {
  armarFormulario();
});
document.getElementById("RepSelect").addEventListener("click", function() {
  byebye();
});

document.getElementById("CancelarModal").addEventListener("change", function() {
  Elementos.$SeRepiteForm.attr('checked', false);
});

document.getElementById("AceptarModal").addEventListener("click", function() {
  let texto = {dtstart: new Date(Elementos.FechaForm.value)};
  Elementos.$RepEdit.modal('hide');
  switch (Elementos.RepSelect.value) {
    case "0":
    texto.freq = 3;
    texto.interval = Elementos.RepCada.value;
    break;
    case "1":
    texto.freq = 3;
    texto.byweekday = [0, 1, 2, 3, 4];
    break;
    case "2":
    texto.freq = 3;
    texto.byweekday = [0, 2, 4];
    break;
    case "3":
    texto.freq = 3;
    texto.byweekday = [1, 3];
    break;
    case "4":
    texto.freq = 2;
    if (Elementos.RepCada.value!=1) {
      texto.interval = Elementos.RepCada.value;
    }
    let dias = document.getElementById("diassemana").getElementsByTagName("input");
    let diasvec = [];
    for (day in dias) {
      if (dias[day].checked==true) {
        diasvec.push(Number(dias[day].value))
      }
    }
    if (diasvec!=null) {
      texto.byweekday = diasvec;
    }
    break;
    case "5":
    texto.freq = 1;
    texto.interval = Elementos.RepCada.value;
    if (diadelasemana.checked == true) {
      let dia = document.getElementById("SemSelect").value;
      var ord = document.getElementById("OrdinalSelect").value;
      texto.byweekday= [dia.nth(ord)];
    }
    break;
    case "6":
    texto.freq = 0;
    break;
  }
  let radios = document.getElementsByClassName("radiomitre");
  for (radio in radios) {
    if (radios[radio].checked == true) {
      if (radios[radio].id == "optionsRadios2") {
        texto.count = Elementos.NumVeces.value;
      }else if (radios[radio].id == "optionsRadios3") {
        texto.until = new Date(Elementos.DiaFin.value);
      }
    }
  }
  rule  = new RRule(texto);
  if (rule.toText() == "RRule error: Unable to fully convert this rrule to text") {
    Elementos.Resumen.innerHTML = "";
    Elementos.$SeRepiteForm.attr("checked", false);
  }else{
    Elementos.Resumen.innerHTML = rule.toText();
    Elementos.$SeRepiteForm.attr("checked", true);
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

Elementos.$SeRepiteForm.click(function(){
  Elementos.$RepeticionSelect.toggleClass("hidden");
});

document.getElementById("BtnModificar").addEventListener("click", function() {
  Elementos.$SeRepiteForm.removeAttr("disabled");
  modoFormulario('Modificar');
  Elementos.NombreForm.disabled = true;
  if (Elementos.$SeRepiteForm.attr('checked')) {
    Elementos.$RepeticionSelect.removeClass('hidden');
  }else {
    Elementos.$RepeticionSelect.addClass('hidden');
  }
});

var bien = true;

function err(Nom){
  Elementos["$" + Nom + "Group"].addClass("has-error");
  Elementos["$" + Nom + "Error"].removeClass("hidden").text("Ingrese el campo correctamente");
  bien = false;
}

function format(){

  for (var i = 1; i < 5; i++) {
    bien = true;
    Elementos["$" + vecsito[i].COLUMN_NAME + "Group"].removeClass("has-error");
    Elementos["$" + vecsito[i].COLUMN_NAME + "Error"].addClass("hidden").text("Campo Obligatorio");
    if (Elementos[vecsito[i].COLUMN_NAME + "Form"].value == "") {
      Elementos["$" + vecsito[i].COLUMN_NAME + "Group"].addClass("has-error");
      Elementos["$" + vecsito[i].COLUMN_NAME + "Error"].removeClass("hidden");
      bien = false;
    }
  }

  if (Elementos.FinalizacionForm.value.length != 8 && Elementos.FinalizacionForm.value.length != 0) {
    err("Finalizacion");
  }
  if (Elementos.InicioForm.value.length != 8 && Elementos.InicioForm.value.length != 0) {
    err("Inicio");
  }
  if (Elementos.FechaForm.value.length != 10 && Elementos.FechaForm.value.length != 0) {
    err("Fecha");
  }
  if (bien) {
    let datos = {};
    datos['idActividades'] = Elementos.idActividadesForm.value;
    datos['Inicio'] = Elementos.FechaForm.value +'T'+ Elementos.InicioForm.value +'-03:00';
    datos['Finalizacion'] = Elementos.FechaForm.value +'T'+ Elementos.FinalizacionForm.value +'-03:00';
    datos['Nombre'] = Elementos.NombreForm.value;
    datos['Recurrencia'] = (Elementos.$SeRepiteForm.val() == "SI") ? 'RRULE:' + rule.toString().substr(25) : 'no';
    return "data1=" + JSON.stringify(datos);
  }else {
    return 'no'
  }

}
var NotFound = false;

document.getElementById("BtnAceptar").addEventListener("click", function() {
  let datos = format();
  if (datos != 'no') {
    let url;
    if (datos['idActividades']=="" || NotFound) {
      url = "addActividad";
    }else{
      url = "editarActividad";
    }
    var request = $.ajax({
      url: "<?php echo URL; ?>actividad/" + url,
      type: "post",
      data: datos,
    });
    request.done(function (respuesta){
      afterEnviar();
      Elementos.Resumen.innerHTML = "";
      Elementos.$SeRepiteForm.addClass("hidden");
      Elementos.$RepeticionSelect.addClass("hidden");
    });
  }
});

function armarFormulario(){
  rule = {};
  $('#ModalPropiedades').modal('show');
  $("form .form-control").removeClass('hidden').val("");
  $("form .form-control-static").addClass('hidden');
  ElemForm.$BtnAceptar.removeClass("hidden");
  ElemForm.$BtnAgregar.addClass("hidden");
  ElemForm.$BtnModificar.addClass("hidden");
  Elementos.idActividadesForm.disabled = true;
  Elementos.$SeRepiteForm.removeAttr("disabled").removeClass("hidden").prop('checked', false);
}

$('#Tabla').on('click-row.bs.table', function (row, $element, field) {
  $('.success').removeClass('success');
  $(field).addClass('success');
  request = $.ajax({
    url: "<?php echo URL; ?>actividad/mostrar",
    type: "post",
    data: "data=" + $element.idActividades,
  });
  request.done(function (respuesta)
  {
    if (respuesta == "Not Found") {
      alert('No hay un evento en Google Calendar asignado a esta actividad. Por favor llene los datos');
      NotFound = true;
      armarFormulario();
      Elementos.NombreForm.disabled = true;
    } else {
      NotFound = false;
      var obj = JSON.parse(respuesta);
      clickFilaa(obj);
      if (obj["Recurrencia"] != null) {
        rule = rrulestr(obj["Recurrencia"][0]);
        let cucu = rule.toText();
        cucu = cucu.charAt(0).toUpperCase() + cucu.slice(1);
        Elementos.Resumen.innerHTML = cucu;
        Elementos.$SeRepiteForm.prop("checked");
      } else {
        Elementos.$SeRepiteForm.prop("checked", false);
        Elementos.Resumen.innerHTML = "";
      }
    }
    Elementos.NombreForm.value = $element.Nombre;
    $("#Nombre").text($element.Nombre);
    Elementos.idActividadesForm.value = $element.idActividades;
    $("#idActividades").text($element.idActividades);
  });
});
function clickFilaa(obj){
  $('#ModalPropiedades').modal('show');
  for (x in obj) {
    if (x != "Recurrencia") {
      ElemForm[x].removeClass("hidden").text(obj[x]);
      ElemForm[x + "Form"].addClass("hidden");
      ElemForm[x + "Form"].val(obj[x]);
    }else{
      Elementos.$SeRepiteForm.removeClass('hidden').prop('disabled');
    }
  }
  ElemForm.$BtnAceptar.addClass("hidden");
  ElemForm.$BtnAgregar.removeClass("hidden");
  ElemForm.$BtnModificar.removeClass("hidden");
}
</script>
