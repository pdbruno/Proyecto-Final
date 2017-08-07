<script>
var Elementos = {
  $SeRepiteForm : $("#SeRepiteForm"),
  $RepeticionSelect : $("#RepeticionSelect"),
  $InicioForm :  $("#InicioForm"),
  $FinalizacionForm : $("#FinalizacionForm"),
  $FechaForm : $("#FechaForm"),
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
  NombreForm : document.getElementById("NombreForm"),
  idActividadesForm : document.getElementById("idActividadesForm"),
  Resumen : document.getElementById("resumen")
};
var rule;
Elementos.$InicioForm.timepicker({ 'timeFormat': 'H:i:s' });
Elementos.$FinalizacionForm.timepicker({ 'timeFormat': 'H:i:s' });
Elementos.$FechaForm.datepicker({
  language: "es",
  startDate: "today",
  autoclose: true,
  format: 'yyyy-mm-dd'
});

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
  let texto = {dtstart: new Date(Elementos.$FechaForm.val())};
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

function format(){
  let datos = {};
  let data = "";
  datos['idActividades'] = Elementos.idActividadesForm.value;
  datos['Inicio'] = Elementos.$FechaForm.val() +'T'+ Elementos.$InicioForm.val()+'-03:00';
  datos['Finalizacion'] = Elementos.$FechaForm.val() +'T'+ Elementos.$FinalizacionForm.val() +'-03:00';
  datos['Nombre'] = Elementos.NombreForm.value;
  if (datos['Nombre'] === "" || datos['Inicio'].length != 25 || datos['Inicio'].length != 25)
  {
    alert("Ingrese los campos correctamente");
  } else {
    if (Elementos.$SeRepiteForm.val() == "SI") {
      datos['Recurrencia'] = 'RRULE:' + rule.toString().substr(25);
    }else {
      datos['Recurrencia'] = 'no';
    }
    alert(datos['Recurrencia']);

    // datos['Recurrencia'] = (Elementos.$SeRepiteForm.val() == "SI") ? 'RRULE:' + rule.toString() : 'no';
    return data = "data1=" + JSON.stringify(datos);
  }
}
var NotFound = false;

document.getElementById("BtnAceptar").addEventListener("click", function() {
  let datos = format();
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
});

function armarFormulario(){
  rule = {};
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
    } else {
      NotFound = false;
      var obj = JSON.parse(respuesta);
      clickFila(obj);
      Elementos.$SeRepiteForm.removeClass('hidden').attr('disabled', true);
      if (obj["Recurrencia"] != null) {
        rule = rrulestr(obj["Recurrencia"][0]);
        let cucu = rule.toText();
        cucu = cucu.charAt(0).toUpperCase() + cucu.slice(1);
        Elementos.Resumen.innerHTML = cucu;
        Elementos.$SeRepiteForm.attr("checked", true);
      } else {
        Elementos.$SeRepiteForm.attr("checked", false);
        Elementos.Resumen.innerHTML = "";
      }
    }
    Elementos.NombreForm.value = $element.Nombre;
    $("#Nombre").text($element.Nombre);
    Elementos.idActividadesForm.value = $element.idActividades;
    $("#idActividades").text($element.idActividades);
  });
});
</script>
