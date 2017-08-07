<script type="text/javascript">
var Elementos = {
  $Asistencia : $("#Asistencia"),
  $FechaForm : $('#FechaForm'),
  $ListaEventos : $('#ListaEventos'),
  TablaActividades : document.getElementById("TablaActividades"),
  ListaClientes: document.getElementById("ListaClientes"),
  $NombreForm: $("#NombreForm")
};
var VecAsistio = [];
var idEvento = "";
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
    data: "data=" + JSON.stringify(VecAsistio) + "&data2="+idEvento,
  });
  request.done(function (respuesta){
    alert('Se ha asignado la asistencia al evento');
    VecAsistio=[];
    Elementos.$Asistencia.addClass("hidden");
  });
});
document.getElementById("BTNfecha").addEventListener("click", function() {
  if (Elementos.$FechaForm.val() == "") {
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
        alert('No hay eventos para ese día')
      }else {
        let eventos = JSON.parse(respuesta);
        let texto = "";
        for (act in eventos) {
          texto += "<tr onclick='traerEvento(this)' id='" + eventos[act].idEvento + "'>";
          texto += "<td>" + eventos[act].Nombre + " </td>";
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

function traerEvento(boton){
  VecAsistio = [];
  filas = Elementos.TablaActividades.rows;
  for (row in filas) {
    if (filas[row].id == boton.id) {
      $("#" + filas[row].id).addClass("success");
      idEvento = filas[row].cells[0].innerHTML;
    } else {
      $("#" + filas[row].id).removeClass("success");
    }
  }
  let request = $.ajax({
    url: "<?php echo URL; ?>actividad/traerAnotados",
    type: "post",
    data: "data=" + boton.id,
  });
  request.done(function (respuesta){
    Elementos.$Asistencia.removeClass("hidden")
    respuesta = JSON.parse(respuesta);
    let texto = "";
    for (usuario in respuesta) {
      texto+= "<button type='button' class='list-group-item' onclick='elegir($(this),"+respuesta[usuario].idClientes+")' >" + respuesta[usuario].name + "</button>"
    }
    Elementos.ListaClientes.innerHTML = texto;
    Elementos.$NombreForm.typeahead('destroy')
    Elementos.$NombreForm.typeahead({
      source: respuesta,
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
  });
}
</script>
