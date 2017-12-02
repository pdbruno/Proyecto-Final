<script type="text/javascript">
var Elementos = {
  Asistencia : document.getElementById("Asistencia"),
  Profesorado : document.getElementById("Profesorado"),
  FechaForm : document.getElementById("FechaForm"),
  ListaEventos : document.getElementById("ListaEventos"),
  TablaActividades : document.getElementById("TablaActividades"),
  ListaClientes: document.getElementById("ListaClientes"),
  ListaInstructores: document.getElementById("ListaInstructores"),
  BTNenviar: document.getElementById("BTNenviar"),
  $NombreForm: $("#NombreForm"),
  $ProfeForm: $("#ProfeForm")
};
var VecAsistio = [];
var VecProfes = [];
var idActividades = "";
var TextoInstructores = "";
var idEvento = "";
var Fecha = "";
var eventos = {};
var instructores = new XMLHttpRequest();
instructores.open("POST", "<?php echo URL; ?>actividad/traerInstructores");
instructores.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
instructores.onreadystatechange = function () {
  if(instructores.readyState === XMLHttpRequest.DONE && instructores.status === 200) {
    let profes = JSON.parse(instructores.responseText);
    instructores = "";
    let l = profes.length;
    for (var i = 0; i < l; i++) {
      instructores += "<button type='button' class='list-group-item' onclick='elegir2(this,"+profes[i].idClientes+")' >" + profes[i].name + "</button>"
    }
  }
};
instructores.send();

Elementos.FechaForm.value = new Date().toISOString().substr(0,10);
$(Elementos.FechaForm).datepicker({
  format: "yyyy-mm-dd",
  startDate: "01/01/2017",
  endDate: "today",
  maxViewMode: 0,
  todayBtn: "linked",
  language: "es",
  autoclose: true,
  todayHighlight: true
});
$( document ).ajaxError(function( event, jqxhr, settings, thrownError ) {
  location.reload(true);
});
Elementos.BTNenviar.addEventListener("click", function() {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "<?php echo URL; ?>actividad/asignarAsistencia");
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
    if(xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
      alert('Se ha asignado la asistencia al evento');
      VecAsistio=[];
      Elementos.Asistencia.classList.add("hidden");
      Elementos.Profesorado.classList.add("hidden");
    }
  };
  xhr.send("data=" + JSON.stringify(VecAsistio) + "&data2="+idActividades + "&data3="+JSON.stringify(VecProfes) + "&data4=" + Fecha + "&data5=" + idEvento);
});

document.getElementById("BTNfecha").addEventListener("click", function() {
  if (Elementos.FechaForm.value == "") {
    alert("Ingrese una fecha");
  }else {
    Elementos.Asistencia.classList.add("hidden");
    Elementos.Profesorado.classList.add("hidden");
    let dia={};
    Elementos.fecha = Elementos.FechaForm.value
    dia["timeMax"] = Elementos.FechaForm.value +'T23:59:59-03:00';
    dia["timeMin"] = Elementos.FechaForm.value +'T00:00:00-03:00';
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "<?php echo URL; ?>actividad/traerEventos");
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
      if(xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
        if (xhr.responseText == "null") {
          alert('No hay eventos para ese día')
        }else {
          eventos = JSON.parse(xhr.responseText);
          let texto = "";
          let l = eventos.length;
          for (var i = 0; i < l; i++) {
            texto += "<tr onclick='traerEvento(this)' id='" + i + "'>";
            texto += "<td>" + eventos[i].Nombre + " </td>";
            texto += "</tr>";
          }
          texto += "</tr>"
          Elementos.ListaEventos.classList.remove('hidden');
          Elementos.TablaActividades.innerHTML = texto;
        }
      }
    };
    xhr.send("data=" + JSON.stringify(dia));
  }
});

function elegir(boton, id){
  boton.classList.toggle("list-group-item-info");
  if (VecAsistio.indexOf(id) == -1) {
    VecAsistio.push(id);
  } else {
    VecAsistio.splice(VecAsistio.indexOf(id), 1);
  }
}
function elegir2(boton, id){
  boton.classList.toggle("list-group-item-info");
  if (VecProfes.indexOf(id) == -1) {
    VecProfes.push(id);
  } else {
    VecProfes.splice(VecProfes.indexOf(id), 1);
  }
}

function traerEvento(boton){
  Elementos.Asistencia.classList.add("hidden");
  Elementos.Profesorado.classList.add("hidden");
  VecAsistio = [];
  VecProfes = [];
  let filas = Elementos.TablaActividades.rows;
  let l = filas.length;
  for (var i = 0; i < l; i++) {
    if (filas[i].id == boton.id) {
      filas[i].classList.add("success");
      idActividades = eventos[boton.id].idActividades;
      if (eventos[boton.id].idActividades != eventos[boton.id].idEvento) {
        idEvento = eventos[boton.id].idEvento;
      }else {
        idEvento = "";
      }
      Fecha = eventos[boton.id].Fecha;
    } else {
      filas[i].classList.remove("success");
    }
  }
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "<?php echo URL; ?>actividad/traerAnotados");
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
    if(xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
      let respuesta = JSON.parse(xhr.responseText);
      let profesquedictaron = respuesta[1];
      let alumnos = respuesta[0];
      let l = alumnos.length;
      let texto = "";

      Elementos.$NombreForm.typeahead('destroy');
      Elementos.$ProfeForm.typeahead('destroy');
      Elementos.Asistencia.classList.remove("hidden");
      Elementos.Profesorado.classList.remove("hidden");

      if (profesquedictaron.length) {
        Elementos.BTNenviar.disabled = true;

        for (var i = 0; i < l; i++) {
          texto+= "<button type='button' class='list-group-item' disabled>" + alumnos[i].name + "</button>"
        }

        l = profesquedictaron.length;
        Elementos.ListaInstructores.innerHTML = "";
        for (var i = 0; i < l; i++) {
          Elementos.ListaInstructores.innerHTML += "<button type='button' class='list-group-item' disabled>" + profesquedictaron[i].name + "</button>"
        }

        Elementos.$NombreForm.typeahead({
          source: alumnos,
        });
        Elementos.$ProfeForm.typeahead({
          source: profesquedictaron,
        });

      } else {

        Elementos.BTNenviar.disabled = false;

        for (var i = 0; i < l; i++) {
          texto += "<button type='button' class='list-group-item' onclick='elegir(this,"+alumnos[i].idClientes+")' >" + alumnos[i].name + "</button>"
        }

        Elementos.ListaInstructores.innerHTML = instructores;

        Elementos.$NombreForm.typeahead({
          source: alumnos,
          afterSelect: function(item){
            let botones =  Elementos.ListaClientes.getElementsByTagName("button");
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
        Elementos.$ProfeForm.typeahead({
          source: instructores,
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
      }

      Elementos.ListaClientes.innerHTML = texto;
    }
  };
  xhr.send("data=" + idActividades + "&data2=" + Elementos.FechaForm.value);

}


</script>
