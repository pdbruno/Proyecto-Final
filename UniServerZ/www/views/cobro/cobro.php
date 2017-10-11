<script>
var Elementos = {
  MesForm :  document.getElementById("MesForm"),
  Semestre : document.getElementById("Semestre"),
  semestre1: document.getElementById("semestre1"),
  Monto: document.getElementById("Monto"),
  escondible: document.querySelectorAll(".escondible"),
  escondible2: document.querySelectorAll(".escondible2"),
  disab: document.querySelectorAll(".disab"),
  FechaForm: document.getElementById('FechaForm'),
  PanelActividades: document.getElementById('PanelActividades'),
  PanelDeudas: document.getElementById('PanelDeudas'),
  MontoRow: document.getElementById('MontoRow'),
  Monto : document.getElementById("Monto"),
  SemestrePicker: document.getElementById("SemestrePicker"),
  ListaActividades : document.getElementById("ListaActividades"),
  Enviar: document.getElementById('Enviar'),
  TablaMor : document.getElementById("TablaMor"),
  IngresoMes: document.getElementById("IngresoMes"),
  IngresoFecha: document.getElementById("IngresoFecha")
};
$( document ).ajaxError(function( event, jqxhr, settings, thrownError ) {
  location.reload(true);
});
var YaMultiplicado = false;
$(Elementos.MesForm).datepicker({
  format: "yyyy-mm-dd",
  startDate: "01/01/2017",
  maxViewMode: 1,
  minViewMode: 1,
  todayBtn: "linked",
  language: "es",
  autoclose: true,
  todayHighlight: true
});
$(Elementos.FechaForm).datepicker({
  format: "yyyy-mm-dd",
  startDate: "01/01/2017",
  maxViewMode: 0,
  todayBtn: "linked",
  language: "es",
  autoclose: true,
  todayHighlight: true
});
var Enviar = {idActividades:"", idClientes:"", Monto : "", FechaCobro: "", Fecha1:"", Fecha2:""};
var Globales = {actividadElegida:"", ListaActividades:[]};
document.getElementById("BtnAgregar").remove();
document.getElementById("Enviar").addEventListener("click", function() {
  if (Globales.actividadElegida.idModosDePago == 2){
    let mes = Elementos.MesForm.value;
    if (mes!="") {
      let messig = mes.split('-');
      messig[1] = Number(messig[1]) + 1;
      messig = messig.join('-');
      Enviar.Fecha1 = mes;
      Enviar.Fecha2 = messig;
    }
  }
  if (Elementos.Semestre.classList.contains("active")) {
    let d = new Date().getFullYear();
    if (Elementos.semestre1.classList.contains("active")) {
      Enviar.Fecha1 = d + '-01-01';
      Enviar.Fecha2 = d + '-06-30';
    }else {
      Enviar.Fecha1 = d + '-07-01';
      Enviar.Fecha2 = d + '-12-31';
    }
  }
  let bien = true;
  Enviar.Monto = Elementos.Monto.value;
  Enviar.idActividades = Globales.actividadElegida.idActividades;
  Enviar.FechaCobro = new Date().toISOString().slice(0,10);
  for (x in Enviar) {
    if (Enviar[x]==""||Enviar[x]==null) {
      bien = false;
      alert("Ingrese el " + x);
    }
  }
  if (bien) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "<?php echo URL; ?>cobro/addCobro/");
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
      if(xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
        let l = Elementos.escondible.length;
        for (var i = 0; i < l; i++) {
          Elementos.escondible[i].classList.add("hidden");
        }
        for (x in Enviar) {
          Enviar[x]="";
        }
      }
    };
    xhr.send("data=" + JSON.stringify(Enviar));
  }
});
document.getElementById("FechaAceptar").addEventListener("click", function(){
  if (Elementos.FechaForm.value == "") {
    alert("Ingrese una fecha");
  }else {
    let dia={};
    dia["timeMax"] = Elementos.FechaForm.value +'T23:59:59-03:00';
    dia["timeMin"] = Elementos.FechaForm.value +'T00:00:00-03:00';
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "<?php echo URL; ?>actividad/traerEventos/");
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
      if(xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
        if (xhr.responseText == '"no papu"') {
          alert('No hay eventos en ese día');
        }else {
          let eventos = JSON.parse(xhr.responseText);
          let hay = false;
          let l = eventos.length;
          for (var i = 0; i < l; i++) {
            if (eventos[i].Nombre == Globales.actividadElegida.NombreAct) {
              hay = true;
              Enviar.Fecha1 = eventos[i].Fecha;
              Enviar.Fecha2 = eventos[i].Fecha;
            }
          }
          if (!hay) {
            alert("No hay " + Globales.actividadElegida.NombreAct + " en el día seleccionado")
          }else {
            traerPrecio();
            Elementos.Enviar.classList.remove('hidden');
          }
        }
      }
    };
    xhr.send("data=" + JSON.stringify(dia));

  }
});

function traerPrecio(){
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "<?php echo URL; ?>cobro/traerElemento/Arancel");
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
    if(xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
      Elementos.MontoRow.classList.remove('hidden');
      if (Elementos.Semestre.classList.contains("active")) {
        if (!YaMultiplicado) {
          Elementos.Monto.value = xhr.responseText * 5;
          YaMultiplicado = true;
        }
      }else {
        Elementos.Monto.value = xhr.responseText;
      }
    }
  };
  xhr.send("data=" + JSON.stringify({idActividades:Globales.actividadElegida.idActividades, idModalidades:Globales.actividadElegida.idModalidades, idModosDePago: Globales.actividadElegida.idModosDePago}));

}
document.getElementById("Semestre").addEventListener("click", function() {
  Elementos.SemestrePicker.classList.toggle("hidden");
  if (!YaMultiplicado) {
    Elementos.Monto.value = Elementos.Monto.value * 5;
    YaMultiplicado = true;
  }
});
function Reset(){
  let l = Elementos.escondible2.length;
  for (var i = 0; i < l; i++) {
    Elementos.escondible2[i].classList.add("hidden");
  }
  Elementos.Semestre.classList.remove("active");
  l = Elementos.disab.length;
  for (var i = 0; i < l; i++) {
    Elementos.disab[i].disabled = false;
  }
  YaMultiplicado = false;
}

$('#Tabla').on('click-row.bs.table', function (row, element, field) {
  document.getElementById("headingOne").innerHTML = "Deudas del cliente";
  $('.success').removeClass('success');
  $(field).addClass('success');
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "<?php echo URL; ?>cliente/actCliente");
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
    if(xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
      let respuesta = JSON.parse(xhr.responseText);
      let actividades = respuesta[0];
      let deudas = respuesta[1];
      Globales.ListaActividades = actividades;
      let texto = "";
      let l = actividades.length;
      for (var i = 0; i < l; i++) {
        if (actividades[i].NombreMod == null) {
          texto+= "<button type='button' class='list-group-item btn btn-default' id='" + i + "Actividad' onclick='elegirActividad(" + i + ")'>" + actividades[i].NombreAct + " " + actividades[i].NombrePag + "</button>";
        }else {
          texto+= "<button type='button' class='list-group-item btn btn-default' id='" + i + "Actividad' onclick='elegirActividad(" + i + ")'>" + actividades[i].NombreAct + " " + actividades[i].NombrePag + " " + actividades[i].NombreMod +"</button>";
        }
      }

      Elementos.ListaActividades.innerHTML = texto
      l = Elementos.escondible.length;
      for (var i = 0; i < l; i++) {
        Elementos.escondible[i].classList.add("hidden");
      }
      Elementos.PanelActividades.classList.remove("hidden");
      if (deudas.length != 0) {
        Elementos.TablaMor.innerHTML = "";
        for (let x in deudas) {
          let ll = deudas[x].length;
          document.getElementById("headingOne").innerHTML += " (" + ll + ")";
          let columnas = {Actividad: 'Actividad', Fecha: 'Fecha/Mes', Monto: 'Monto debido'};
          for (let i = 0; i < ll; i++) {
            let deuda = deudas[x][i];
            let trsecundariobody = verDeudas(deuda, columnas);
            Elementos.TablaMor.appendChild(trsecundariobody);


            trsecundariobody.addEventListener("click", function() {
              l = Elementos.disab.length;
              for (var i = 0; i < l; i++) {
                Elementos.disab[i].disabled = true;
              }
              l = Elementos.escondible2.length;
              for (let i = 0; i < l; i++) {
                Elementos.escondible2[i].classList.add("hidden");
              }
              Globales.actividadElegida = deuda;
              if (deuda.Fecha.indexOf("-") != -1) {
                Elementos.FechaForm.value = deuda.Fecha;
                Enviar.Fecha1 = deuda.Fecha;
                Enviar.Fecha2 = deuda.Fecha;
                Elementos.IngresoFecha.classList.remove("hidden");
                Elementos.IngresoMes.classList.add("hidden");
              }else {
                let Meses = {Enero: 1,Febrero: 2,Marzo: 3,Abril: 4,Mayo: 5,Junio: 6,Julio: 7,Agosto: 8,Septiembre: 9,Octubre: 10,Noviembre: 11,Diciembre: 12};
                let d = new Date().getFullYear();
                Enviar.Fecha1 = d + "-" + Meses[deuda.Fecha] + "-01";
                Enviar.Fecha2 = d + "-" + (Meses[deuda.Fecha] + 1) + "-01";
                Elementos.MesForm.value = d + "-" + Meses[deuda.Fecha] + "-01";
                Elementos.IngresoMes.classList.remove("hidden");
                Elementos.IngresoFecha.classList.add("hidden");
                Elementos.Semestre.classList.add("hidden");
              }
              Elementos.Monto.value = deuda.Monto;
              Elementos.MontoRow.classList.remove("hidden");
              Elementos.Enviar.classList.remove("hidden");
            });


          }
        }
        Elementos.PanelDeudas.classList.remove("hidden");
      }
    }
  };
  xhr.send("data=" + element.idClientes);

  Enviar.idClientes = element.idClientes;
});

function XClase(){
  Elementos.IngresoFecha.classList.remove("hidden");
}

function XMes(){
  Elementos.IngresoMes.classList.remove("hidden");
  traerPrecio();
}


function elegirActividad(ii){
  Globales.actividadElegida = Globales.ListaActividades[ii];
  filas = Elementos.ListaActividades.getElementsByTagName("button");
  for (var i = 0; i < filas.length; i++) {
    if (filas[i].id == ii + "Actividad") {
      filas[i].classList.add("list-group-item-info");
    } else {
      filas[i].classList.remove("list-group-item-info");
    }
  }

  Reset();

  if (Globales.ListaActividades[ii].idModosDePago == 1) {
    XClase();
  }
  if (Globales.ListaActividades[ii].idModosDePago == 2) {
    XMes();
  }
  if (Globales.ListaActividades[ii].XSemestre == 1) {
    Elementos.Semestre.classList.remove("hidden");
  }

}
</script>
