<script>
var Elementos = {
  $Mes : $("#Mes"),
  $MesForm :  $("#MesForm"),
  $Semestre : $("#Semestre"),
  $semestre1: $("#semestre1"),
  $Monto: $("#Monto"),
  $escondible: $(".escondible"),
  $escondible2: $(".escondible2"),
  $FechaForm: $('#FechaForm'),
  $ListaEventos: $('#ListaEventos'),
  TablaActividades : document.getElementById("TablaActividades"),
  $MontoRow: $('#MontoRow'),
  Monto : document.getElementById("Monto"),
  $SemestrePicker: $("#SemestrePicker"),
  ListaActividades : document.getElementById("ListaActividades"),
  $Enviar: $('#Enviar')
};

var Enviar = {Actividad:"", idClientes:"", Monto : ""};
var Globales = {actividadElegida:"", ListaActividades:[]};

document.getElementById("Enviar").addEventListener("click", function() {
  if (Elementos.$Mes.hasClass("active")){
    let mes = Elementos.$MesForm.val();
    if (mes!="") {
      let vecmes = mes.split('-');
      vecmes[1] = Number(vecmes[1]) + 1;
      vecmes = vecmes.join('-');
      Enviar.Actividad = Globales.actividadElegida.idActividades + '/' + mes + '/' + vecmes;
    }
  }else if (Elementos.$Semestre.hasClass("active")) {
    let d = new Date().getFullYear();
    if (Elementos.$semestre1.hasClass("active")) {
      Enviar.Actividad = Globales.actividadElegida.idActividades + '/' + d + '-01-01/' +  d + '-06-30';
    }else {
      Enviar.Actividad = Globales.actividadElegida.idActividades + '/' + d + '-07-01/' +  d + '-12-31';
    }
  }
  let bien = true;
  Enviar.Monto=Elementos.$Monto.val();
  for (x in Enviar) {
    if (Enviar[x]==""||Enviar[x]==null) {
      bien = false;
      switch (x) {
        case "Actividad":
        alert("Ingrese qué está pagando");
        break;
        case "idClientes":
        alert("Si ves este mensaje soy un pelotudo");
        break;
        case "Monto":
        alert("Ingrese el monto");
        break;
      }
    }
  }
  if (bien) {
    Enviar.Fecha = new Date().toISOString().slice(0,10);
    let request = $.ajax({
      url: "<?php echo URL; ?>cobro/agregarModificarElemento/Cobros",
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
        alert('No hay eventos para ese día');
      }else {
        let eventos = JSON.parse(respuesta);
        let texto = "";
        for (act in eventos) {
          if (eventos[act].Nombre == Globales.actividadElegida.NombreAct) {
            texto += "<tr onclick='traerEvento(this)' id='" + eventos[act].idEvento + "'>";
            texto += "<td>" + eventos[act].Nombre + " </td>";
            texto += "</tr>";
          }
        }
        if (texto == "") {
          alert("No hay ninguna actividad de " + Globales.actividadElegida.NombreAct.substr(0, Globales.actividadElegida.NombreAct.indexOf(' ')) + " para el día seleccionado")
        }else {
          Elementos.$ListaEventos.removeClass('hidden');
        }
        Elementos.TablaActividades.innerHTML = texto;
      }
    });

  }
});

function traerEvento(boton){
  let filas = Elementos.TablaActividades.rows;
  for (row in filas) {
    if (filas[row].id == boton.id) {
      $("#" + filas[row].id).addClass("success");
      idEvento = filas[row].cells[0].innerHTML;
    } else {
      $("#" + filas[row].id).removeClass("success");
    }
  }
  Enviar.Actividad = boton.id;
  Elementos.$Enviar.removeClass('hidden');
}

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
  Elementos.$escondible2.addClass("hidden");
  Elementos.$SemestrePicker.removeClass("hidden");
  traerPrecio('PrecioXMes');
  Elementos.$Enviar.removeClass('hidden');
});

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
    Globales.ListaActividades = [];
    let actividades = JSON.parse(respuesta);
    let texto = "";
    let i = 0;
    for (actividad in actividades) {
      Globales.ListaActividades.push(actividades[actividad]);
      if (actividades[actividad].NombreMod == null) {
        texto+= "<button type='button' class='list-group-item btn btn-default' id='" + i + "' onclick='elegirActividad(this)'>" + actividades[actividad].NombreAct + "</button>";
      }else {
        texto+= "<button type='button' class='list-group-item btn btn-default' id='" + i + "' onclick='elegirActividad(this)'>" + actividades[actividad].NombreAct + " " + actividades[actividad].NombreMod + "</button>";
      }
      i++;
    }
    Elementos.ListaActividades.innerHTML = texto
    Elementos.$escondible.addClass("hidden");
    $("#PanelActividades").removeClass("hidden");
  });
});

document.getElementById("Clase").addEventListener("click", function() {
  Elementos.$escondible2.addClass("hidden");
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
  Elementos.$MontoRow.removeClass('hidden');
});

document.getElementById("Mes").addEventListener("click", function() {
  Elementos.$escondible2.addClass("hidden");
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


function elegirActividad(boton){
  Globales.actividadElegida = Globales.ListaActividades[boton.id];
  filas = Elementos.ListaActividades.getElementsByTagName("button");
  for (var i = 0; i < filas.length; i++) {
    if (filas[i].id == boton.id) {
      $("#" + filas[i].id).addClass("list-group-item-info");
    } else {
      $("#" + filas[i].id).removeClass("list-group-item-info");
    }
  }

  Elementos.$escondible.addClass("hidden");
  $("#PanelActividades").removeClass("hidden");

  if (Globales.ListaActividades[boton.id].XClase == 1) {
    $("#Clase").removeClass("hidden");
  }
  if (Globales.ListaActividades[boton.id].XMes == 1) {
    Elementos.$Mes.removeClass("hidden");
  }
  if (Globales.ListaActividades[boton.id].XSemestre == 1) {
    Elementos.$Semestre.removeClass("hidden");
  }

}
</script>
