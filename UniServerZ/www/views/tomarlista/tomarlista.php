<script type="text/javascript">
var Elementos = {
  $Asistencia : $("#Asistencia"),
  $Profesorado : $("#Profesorado"),
  $FechaForm : $('#FechaForm'),
  $ListaEventos : $('#ListaEventos'),
  TablaActividades : document.getElementById("TablaActividades"),
  ListaClientes: document.getElementById("ListaClientes"),
  ListaInstructores: document.getElementById("ListaInstructores"),
  $NombreForm: $("#NombreForm"),
  $ProfeForm: $("#ProfeForm")
};
var VecAsistio = [];
var VecProfes = [];
var idActividades = "";
var Fecha = "";
var eventos = {};
var d = new Date().toISOString().substr(0,10);
Elementos.$FechaForm.val(d);
Elementos.$FechaForm.datepicker({
  format: "yyyy-mm-dd",
  startDate: "01/01/2017",
  endDate: "today",
  maxViewMode: 0,
  todayBtn: "linked",
  language: "es",
  autoclose: true,
  todayHighlight: true
});

document.getElementById("BTNenviar").addEventListener("click", function() {
  let request = $.ajax({
    url: "<?php echo URL; ?>actividad/asignarAsistencia",
    type: "post",
    data: "data=" + JSON.stringify(VecAsistio) + "&data2="+idActividades + "&data3="+JSON.stringify(VecProfes) + "&data4=" + Fecha,
  });
  request.done(function (respuesta){
    alert('Se ha asignado la asistencia al evento');
    VecAsistio=[];
    Elementos.$Asistencia.addClass("hidden");
    Elementos.$Profesorado.addClass("hidden");
  });
});
document.getElementById("BTNfecha").addEventListener("click", function() {
  if (Elementos.$FechaForm.val() == "") {
    alert("Ingrese una fecha");
  }else {
    Elementos.$Asistencia.addClass("hidden");
    Elementos.$Profesorado.addClass("hidden");
    let dia={};
    Elementos.fecha = Elementos.$FechaForm.val();
    dia["timeMax"] = Elementos.$FechaForm.val() +'T23:59:59-03:00';
    dia["timeMin"] = Elementos.$FechaForm.val() +'T00:00:00-03:00';
    let request = $.ajax({
      url: "<?php echo URL; ?>actividad/traerEventos",
      type: "post",
      data: "data=" + JSON.stringify(dia),
    });
    request.done(function (respuesta){
      if (respuesta == '"no papu"') {
        alert('No hay eventos para ese día')
      }else {
        eventos = JSON.parse(respuesta);
        let texto = "";
        let l = eventos.length;
        for (var i = 0; i < l; i++) {
          texto += "<tr onclick='traerEvento(this)' id='" + i + "'>";
          texto += "<td>" + eventos[i].Nombre + " </td>";
          texto += "</tr>";
        }
        texto += "</tr>"
        Elementos.$ListaEventos.removeClass('hidden');
        Elementos.TablaActividades.innerHTML = texto;
      }
    });
  }
});

function elegir($boton, id){
  $boton.toggleClass("list-group-item-info");
  if (VecAsistio.indexOf(id) == -1) {
    VecAsistio.push(id);
  } else {
    VecAsistio.splice(VecAsistio.indexOf(id), 1);
  }
}
function elegir2($boton, id){
  $boton.toggleClass("list-group-item-info");
  if (VecProfes.indexOf(id) == -1) {
    VecProfes.push(id);
  } else {
    VecProfes.splice(VecProfes.indexOf(id), 1);
  }
}
var alumnos = {};
var profes = {};
function traerEvento(boton){
  Elementos.$Asistencia.addClass("hidden");
  Elementos.$Profesorado.addClass("hidden");
  VecAsistio = [];
  VecProfes = [];
  let filas = Elementos.TablaActividades.rows;
  for (row in filas) {
    if (filas[row].id == boton.id) {
      $("#" + filas[row].id).addClass("success");
      idActividades = eventos[boton.id].idActividades;
      Fecha = eventos[boton.id].Fecha;
    } else {
      $("#" + filas[row].id).removeClass("success");
    }
  }
  let request = $.ajax({
    url: "<?php echo URL; ?>actividad/traerAnotados",
    type: "post",
    data: "data=" + idActividades,
  });
  request.done(function (respuesta){
    Elementos.$Asistencia.removeClass("hidden");
    Elementos.$Profesorado.removeClass("hidden");
    alumnos = JSON.parse(respuesta)[0];
    profes = JSON.parse(respuesta)[1];
    let texto = "";
    let texto2 = "";
    for (usuario in alumnos) {
      texto+= "<button type='button' class='list-group-item' onclick='elegir($(this),"+alumnos[usuario].idClientes+")' >" + alumnos[usuario].name + "</button>"
    }
    for (usuario in profes) {
      texto2+= "<button type='button' class='list-group-item' onclick='elegir2($(this),"+profes[usuario].idClientes+")' >" + profes[usuario].name + "</button>"
    }
    Elementos.ListaClientes.innerHTML = texto;
    Elementos.ListaInstructores.innerHTML = texto2;
  });
}

Elementos.$NombreForm.typeahead('destroy');
Elementos.$NombreForm.typeahead({
  source: alumnos,
  afterSelect: function(item){
    var botones =  Elementos.ListaClientes.getElementsByTagName("button");
    for (row in botones) {
      if (botones[row].innerHTML == item.name) {
        if (VecAsistio.indexOf(item.idClientes) == -1) {
          VecAsistio.push(item.idClientes);
          botones[row].className = "list-group-item list-group-item-info";
        } else {
          VecAsistio.splice(VecAsistio.indexOf(item.idClientes), 1);
          botones[row].className = "list-group-item";
        }
      }
    }
    Elementos.$NombreForm.val("");
  }
});

Elementos.$ProfeForm.typeahead('destroy');
Elementos.$ProfeForm.typeahead({
  source: profes,
  afterSelect: function(item){
    var botones =  Elementos.ListaInstructores.getElementsByTagName("button");
    for (row in botones) {
      if (botones[row].innerHTML == item.name) {
        if (VecProfes.indexOf(item.idClientes) == -1) {
          VecProfes.push(item.idClientes);
          botones[row].className = "list-group-item list-group-item-info";
        } else {
          VecProfes.splice(VecProfes.indexOf(item.idClientes), 1);
          botones[row].className = "list-group-item";
        }
      }
    }
    Elementos.$ProfeForm.val("");
  }
});
</script>
