<script>
var Elementos = {
  $Mes : $("#Mes"),
  $Clase : $("#Clase"),
  $MesForm :  $("#MesForm"),
  $Semestre : $("#Semestre"),
  $semestre1: $("#semestre1"),
  $Monto: $("#Monto"),
  $escondible: $(".escondible"),
  $escondible2: $(".escondible2"),
  $disab: $(".disab"),
  $FechaForm: $('#FechaForm'),
  $ListaEventos: $('#ListaEventos'),
  $PanelActividades: $('#PanelActividades'),
  $PanelDeudas: $('#PanelDeudas'),
  TablaActividades : document.getElementById("TablaActividades"),
  $MontoRow: $('#MontoRow'),
  Monto : document.getElementById("Monto"),
  $SemestrePicker: $("#SemestrePicker"),
  ListaActividades : document.getElementById("ListaActividades"),
  $Enviar: $('#Enviar'),
  TablaMor : document.getElementById("TablaMor")
};

var Enviar = {idActividades:"", idClientes:"", Monto : "", FechaCobro: "", Fecha1:"", Fecha2:""};
var Globales = {actividadElegida:"", ListaActividades:[]};

document.getElementById("Enviar").addEventListener("click", function() {
  if (Elementos.$Mes.hasClass("active")){
    let mes = Elementos.$MesForm.val();
    if (mes!="") {
      let messig = mes.split('-');
      messig[1] = Number(messig[1]) + 1;
      messig = messig.join('-');
      Enviar.Fecha1 = mes;
      Enviar.Fecha2 = messig;
    }
  }else if (Elementos.$Semestre.hasClass("active")) {
    let d = new Date().getFullYear();
    if (Elementos.$semestre1.hasClass("active")) {
      Enviar.Fecha1 = d + '-01-01';
      Enviar.Fecha2 = d + '-06-30';
    }else {
      Enviar.Fecha1 = d + '-07-01';
      Enviar.Fecha2 = d + '-12-31';
    }
  }
  let bien = true;
  Enviar.Monto=Elementos.$Monto.val();
  Enviar.idActividades = Globales.actividadElegida.idActividades;
  Enviar.FechaCobro = new Date().toISOString().slice(0,10);
  for (x in Enviar) {
    if (Enviar[x]==""||Enviar[x]==null) {
      bien = false;
      alert("Ingrese el " + x);
    }
  }
  if (bien) {
    let request = $.ajax({
      url: "<?php echo URL; ?>cobro/addCobro/",
      type: "post",
      data: "data=" + JSON.stringify(Enviar),
    });
    request.done(function (respuesta){
      Elementos.$escondible.addClass("hidden");
      for (x in Enviar) {
        Enviar[x]="";
      }
    });
  }
});
var eventos = {};
document.getElementById("FechaAceptar").addEventListener("click", function(){
  if (Elementos.$FechaForm.val()=="") {
    alert("Ingrese una fecha");
  }else {
    let dia={};
    dia["timeMax"] = Elementos.$FechaForm.val() +'T23:59:59-03:00';
    dia["timeMin"] = Elementos.$FechaForm.val() +'T00:00:00-03:00';
    let request = $.ajax({
      url: "<?php echo URL; ?>actividad/traerEventos",
      type: "post",
      data: "data=" + JSON.stringify(dia),
    });
    request.done(function (respuesta){
      if (respuesta == '"no papu"') {
        alert('No hay eventos en ese día');
      }else {
        eventos = JSON.parse(respuesta);
        let hay = false;
        let l = eventos.length;
        for (var i = 0; i < l; i++) {
          if (eventos[i].Nombre == Globales.actividadElegida.NombreAct) {
            hay = true;
            Enviar.Fecha1 = eventos[i].Fecha;
            Enviar.Fecha2 = eventos[i].Fecha;
            Elementos.$Enviar.removeClass('hidden');
          }
        }
        if (!hay) {
          alert("No hay " + Globales.actividadElegida.NombreAct + " en el día seleccionado")
        }else {
          Elementos.$ListaEventos.removeClass('hidden');
        }
        Elementos.TablaActividades.innerHTML = texto;
      }
    });

  }
});

function traerPrecio(campo){
  let request = $.ajax({
    url: "<?php echo URL; ?>cobro/traerElemento/Arancel",
    type: "post",
    data: "data=" + JSON.stringify({idActividades:Globales.actividadElegida.idActividades, idModalidades:Globales.actividadElegida.idModalidades, Campo: campo})
  });
  request.done(function (respuesta)
  {
    Elementos.$MontoRow.removeClass('hidden');
    if (Elementos.$Semestre.hasClass("active")) {
      Elementos.Monto.value = respuesta * 5;
    }else {
      Elementos.Monto.value = respuesta;
    }
  });
}

document.getElementById("Semestre").addEventListener("click", function() {
  DAFUNC3();
  Elementos.$SemestrePicker.removeClass("hidden");
  traerPrecio('PrecioXMes');
  Elementos.$Enviar.removeClass('hidden');
});

function DAFUNC3(){
  Elementos.$escondible2.addClass("hidden");
  Elementos.$disab.prop("disabled", false);
}

$('#Tabla').on('click-row.bs.table', function (row, $element, field) {
  $('.success').removeClass('success');
  $(field).addClass('success');
  let request = $.ajax({
    url: "<?php echo URL; ?>cliente/actCliente",
    type: "post",
    data: "data=" + $element.idClientes,
  });
  Enviar.idClientes = $element.idClientes;
  request.done(function (respuesta){
    respuesta = JSON.parse(respuesta);
    let actividades = respuesta[0];
    let deudas = respuesta[1];

    Globales.ListaActividades = actividades;
    let texto = "";
    let i = 0;
    for (actividad in actividades) {
      if (actividades[actividad].NombreMod == null) {
        texto+= "<button type='button' class='list-group-item btn btn-default' id='" + i + "Actividad' onclick='elegirActividad(" + i + ")'>" + actividades[actividad].NombreAct + "</button>";
      }else {
        texto+= "<button type='button' class='list-group-item btn btn-default' id='" + i + "Actividad' onclick='elegirActividad(" + i + ")'>" + actividades[actividad].NombreAct + " " + actividades[actividad].NombreMod + "</button>";
      }
      i++;
    }
    Elementos.ListaActividades.innerHTML = texto
    Elementos.$escondible.addClass("hidden");
    Elementos.$PanelActividades.removeClass("hidden");
    if (deudas.length != 0) {
      Elementos.TablaMor.innerHTML = "";
      for (x in deudas) {
        let ll = deudas[x].length;
        for (let i = 0; i < ll; i++) {
          let trsecundariobody = verDeudas(deudas[x][i]);
          Elementos.TablaMor.appendChild(trsecundariobody);
          trsecundariobody.addEventListener("click", function() {
            Elementos.$disab.prop("disabled", true);
            Elementos.$escondible2.addClass("hidden");
            Globales.actividadElegida = deudas[x][i];
            if (deudas[x][i].Fecha.length == 10) {
              Elementos.$FechaForm.val(deudas[x][i].Fecha);
              Enviar.Fecha1 = deudas[x][i].Fecha;
              Enviar.Fecha2 = deudas[x][i].Fecha;
              $("#IngresoFecha").removeClass("hidden");
              $("#IngresoMes").addClass("hidden");
            }else {
              let Meses = {
                Enero: 1,
                Febrero: 2,
                Marzo: 3,
                Abril: 4,
                Mayo: 5,
                Junio: 6,
                Julio: 7,
                Agosto: 8,
                Septiembre: 9,
                Octubre: 10,
                Noviembre: 11,
                Diciembre: 12
              };
              let d = new Date().getFullYear();
              d = d + "-" + Meses[deudas[x][i].Fecha] + "-01";
              Enviar.Fecha1 = d;
              Enviar.Fecha2 = d;
              Elementos.$MesForm.val(d);
              Elementos.$Mes.addClass("active")
              $("#IngresoMes").removeClass("hidden");
              $("#IngresoFecha").addClass("hidden");
            }
            Elementos.$Monto.val(deudas[x][i].Monto);
            Elementos.$MontoRow.removeClass("hidden");
            Elementos.$Enviar.removeClass("hidden");
          });
        }
      }
      Elementos.$PanelDeudas.removeClass("hidden");
    }
  });
});

document.getElementById("Clase").addEventListener("click", function() {
  DAFUNC3();
  $("#IngresoFecha").removeClass("hidden");
  Elementos.$FechaForm.datepicker('destroy');
  Elementos.$FechaForm.datepicker({
    format: "yyyy-mm-dd",
    startDate: "01/01/2017",
    maxViewMode: 0,
    todayBtn: "linked",
    language: "es",
    autoclose: true,
    todayHighlight: true
  });
  traerPrecio('PrecioXClase');
  Elementos.$MontoRow.addClass('hidden');
});

document.getElementById("Mes").addEventListener("click", function() {
  DAFUNC3();
  $("#IngresoMes").removeClass("hidden");
  Elementos.$MontoRow.removeClass('hidden');
  Elementos.$MesForm.datepicker({
    format: "yyyy-mm-dd",
    startDate: "01/01/2017",
    maxViewMode: 1,
    minViewMode: 1,
    todayBtn: "linked",
    language: "es",
    autoclose: true,
    todayHighlight: true
  });
  traerPrecio('PrecioXMes');
  Elementos.$Enviar.removeClass('hidden');
});


function elegirActividad(ii){
  Globales.actividadElegida = Globales.ListaActividades[ii];
  filas = Elementos.ListaActividades.getElementsByTagName("button");
  for (var i = 0; i < filas.length; i++) {
    if (filas[i].id == ii + "Actividad") {
      $("#" + filas[i].id).addClass("list-group-item-info");
    } else {
      $("#" + filas[i].id).removeClass("list-group-item-info");
    }
  }

  Elementos.$escondible.addClass("hidden");
  DAFUNC3();
  Elementos.$PanelActividades.removeClass("hidden");
  Elementos.$PanelDeudas.removeClass("hidden");

  if (Globales.ListaActividades[ii].XClase == 1) {
    Elementos.$Clase.removeClass("hidden");
  }
  if (Globales.ListaActividades[ii].XMes == 1) {
    Elementos.$Mes.removeClass("hidden");
  }
  if (Globales.ListaActividades[ii].XSemestre == 1) {
    Elementos.$Semestre.removeClass("hidden");
  }

}
</script>
