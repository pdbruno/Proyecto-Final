<script src="<?php echo URL; ?>views/recursos/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo URL; ?>views/recursos/bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js" charset="UTF-8"></script>
<link href="<?php echo URL; ?>views/recursos/bootstrap-datepicker/css/bootstrap-datepicker3.standalone.min.css" rel="stylesheet">
<div class="col-lg-6">
  <div class="panel panel-default">
    <div class="panel-heading">Listado de Clientes
    </div>
    <div class="table-responsive col-lg-12">
      <table  id="Tabla" class="table table-hover" cellspacing="0" width="100%"  >
        <thead>
          <tr>
            <th>Nombres</th>
            <th>Apellidos</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
</div>
<div class="col-lg-6">
  <div class="row hidden escondible" id="PanelActividades">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading">Actividades que realiza el cliente
        </div>
        <div class="list-group" id="ListaActividades">
        </div>
      </div>
    </div>
  </div>
  <div class="row" id="Tiempo">
    <div class="col-lg-12">
      <div class="btn-group btn-group-lg btn-group-justified" data-toggle="buttons">
        <label class="btn btn-primary hidden escondible" id="Mes" onclick="elegirMes()">
          <input type="radio" name="options" autocomplete="off"> Mes
        </label>
        <label class="btn btn-primary hidden escondible" id="Clase" onclick="elegirFecha()">
          <input type="radio" name="options" autocomplete="off"> Clase
        </label>
        <label class="btn btn-primary hidden escondible" id="Semestre" onclick="elegirSemestre()">
          <input type="radio" name="options" autocomplete="off"> Semestre
        </label>
        <label class="btn btn-primary hidden escondible" id="Matricula" onclick="Matricula()">
          <input type="radio" name="options" autocomplete="off"> Matrícula
        </label>
      </div>
    </div>
  </div>
  <br>
  <div class="row hidden escondible escondible2" id="IngresoFecha">
    <div class="col-lg-12">
      <div class="input-group">
        <input type="text" class="form-control" id="FechaForm" name="FechaForm" placeholder="Fecha de la clase">
        <span class="input-group-btn">
          <button class="btn btn-default" onclick="ingresoFecha()" type="button">Aceptar</button>
        </span>
      </div>
    </div>
  </div>
  <div class="row hidden escondible escondible2" id="IngresoMes">
    <div class="col-lg-12">
      <div class="input-group">
        <input type="text" class="form-control" id="MesForm" name="MesForm" placeholder="Mes a pagar">
        <span class="input-group-btn">
          <button class="btn btn-default" onclick="ingresoMes()" type="button">Aceptar</button>
        </span>
      </div>
    </div>
  </div>
  <div class="row hidden escondible escondible2" id="ListaEventos">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading">Listado de Eventos Recientes
        </div>
        <div class="table-responsive col-sm-12">
          <table class="table table-hover" >
            <thead>
              <tr>
                <th class='hidden'>idEvento</th>
                <th>Actividad</th>
              </tr>
            </thead>
            <tbody id="TablaActividades">
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="row hidden escondible escondible2" id="SemestrePicker">
    <div class="col-lg-12">
      <div class="btn-group center-block" data-toggle="buttons">
        <label class="btn btn-default">
          <input type="radio" name="1erSemestre" autocomplete="off"> 1er semestre
        </label>
        <label class="btn btn-default">
          <input type="radio" name="2doSemestre" autocomplete="off"> 2do Semestre
        </label>
      </div>
    </div>
  </div>
  <div class="row hidden escondible escondible2" id="MontoRow">
    <div class="col-lg-6">
      <label for="Monto">A cobrar</label>
      <div class="input-group">
        <span class="input-group-addon">$</span>
        <input type="text" id="Monto" class="form-control">
        <span class="input-group-addon">.00</span>
      </div>
    </div>
  </div>
</div>
<script>
function Matricula(){
  Globales.Semestre = false;
  $(".escondible2").addClass("hidden");
  $("#MontoRow").removeClass("hidden");
  //traerPrecio(8)
  alert("precio matricula")
}
function Modalidad(caca){

    if (calcAge(Globales.FechaNacimiento)>=13) {
      if (caca == "Pase Libre") {
        traerPrecio(3);
      }else if (caca == "1 a 2 veces por semana") {
        traerPrecio(4);
      }
    }else {
      if (caca == "Pase Libre") {
        traerPrecio(1);
      }else if (caca == "1 a 2 veces por semana") {
        traerPrecio(2);
      }
    }
}
var Globales = {actividadElegida:"", ListaActividades:[], FechaNacimiento:"", Semestre:false};
function ingresoFecha(){
  if ($("#FechaForm").val()=="") {
    alert("Ingrese una fecha")
  }else {
    var dia={};
    dia["timeMax"] = document.getElementById("FechaForm").value +'T23:59:59-03:00';
    dia["timeMin"] = document.getElementById("FechaForm").value +'T00:00:00-03:00';

    var request = $.ajax({
      url: "<?php echo URL; ?>actividad/traerEventos",
      type: "post",
      data: "data=" + JSON.stringify(dia),
    });
    request.done(function (respuesta){
      if (respuesta == '"no papu"') {
        alert('No hay eventos para ese día')
      }else {
        var eventos = JSON.parse(respuesta);
        var i = 0;
        var texto = "";
        for (act in eventos) {
          if (eventos[act].Nombre.substr(0,eventos[act].Nombre.indexOf(" ")).trim() == Globales.actividadElegida) {
            texto += "<tr onclick='traerEvento($(this))' id='" + i + "'>";
            texto += "<td class='hidden'>" + eventos[act].idEvento + " </td>";
            texto += "<td>" + eventos[act].Nombre + " </td>";
            texto += "</tr>";
            i++;
          }
        }
        texto += "</tr>"
        $("#ListaEventos").removeClass('hidden');
        $("#TablaActividades").html(texto);
      }
    });

  }
}
function traerEvento(boton){
  VecAsistio = [];
  filas = document.getElementById("TablaActividades").rows;
  for (row in filas) {
    if (filas[row].id == boton.attr('id')) {
      $("#" + filas[row].id).addClass("success");
      idEvento = filas[row].cells[0].innerHTML;
    } else {
      $("#" + filas[row].id).removeClass("success");
    }
  }
  var x = document.getElementById(boton.attr('id')).cells;
  var ActNombre = x[1].innerHTML;
  alert(ActNombre);
  // var posEsp = ActNombre.indexOf(" ");
  // var VecNombre = [];
  // VecNombre.push(ActNombre.substr(0,posEsp).trim());
  // VecNombre.push(ActNombre.substr(posEsp).trim());

}
function traerPrecio(id){
  request = $.ajax({
    url: "<?php echo URL; ?>cobro/traerArancel",
    type: "post",
    data: "data=" + id,
  });
  request.done(function (respuesta)
  {
    $('#MontoRow').removeClass('hidden');
    $('#Monto').val(JSON.parse(respuesta)[0].Precio);
    if (Globales.Semestre) {
      $('#Monto').val(JSON.parse(respuesta)[0].Precio * 5);
    }
  });
}
function elegirSemestre(){
  $("#IngresoFecha").addClass("hidden");
  $("#IngresoMes").addClass("hidden");
  $("#ListaEventos").addClass("hidden");
  $("#SemestrePicker").removeClass("hidden");
  $("#MontoRow").addClass("hidden");
  Globales.Semestre = true;
  if (Globales.actividadElegida == "Funcional") {
    $("#ModalidadPicker").add("hidden");
    if (Globales.ListaActividades.length == 2) {
      traerPrecio(7);
    }else {
      traerPrecio(6);
    }
  }else {
    $("#ModalidadPicker").removeClass("hidden");
  }
}
var VecClientes = [];
$(document).ready(function () {
  listadoclientes();
});
var listadoclientes = function ()
{
  var table = $("#Tabla").DataTable(
    {
      "ajax":
      {
        "method": "POST",
        "url": "<?php echo URL; ?>cliente/listadoClientes",
        "dataSrc": function (txt)
        {
          VecClientes = [];
          for (i in txt)
          {
            var Cliente =
            {
              idClientes: txt[i].idClientes,
              Nombres: txt[i].Nombres,
              Apellidos: txt[i].Apellidos,
            };
            VecClientes.push(Cliente);
          }
          return VecClientes;
        }
      },
      "columns": [
        {data: "Nombres"},
        {data: "Apellidos"}
      ],
      select: {
        style: 'single'
      }
      //                        "language": {
      //                        "url": "dataTables.spanish.lang"
      //                          Hacer algo con el idioma de la tabla y de la extension select
    });
    table.on('select', function (e, dt, type, indexes) {
      if (type === 'row') {
        request = $.ajax({
          url: "<?php echo URL; ?>cliente/traerCliente",
          type: "post",
          data: "data=" + VecClientes[indexes].idClientes,
        });
        // Callback handler that will be called on success
        request.done(function (respuesta)
        {
          Globales.ListaActividades = [];
          Globales.FechaNacimiento = JSON.parse(respuesta)[0][0].FechaNacimiento
          var actividades = JSON.parse(respuesta)[1];
          var texto = "";
          var i = 0;
          for (actividad in actividades) {
            Globales.ListaActividades.push(actividades[actividad]);
            var nombre = actividades[actividad].Nombre;
            if (actividades[actividad].PaseLibre == 1) {
              nombre += " Pase Libre";
            }else {
              nombre += " 1 a 2 veces por semana";
            }
            texto+= "<button type='button' class='list-group-item btn btn-default' id='" + i + "' onclick='elegirActividad(this)'>" + nombre + "</button>";
            i++;
          }
          $("#ListaActividades").html(texto);
          $(".escondible").addClass("hidden");
          $("#PanelActividades").removeClass("hidden");
        });

      }
    });
  }
  function elegirFecha(){
    Globales.Semestre = false;
    $("#IngresoFecha").removeClass("hidden");
    $("#IngresoMes").addClass("hidden");
    $("#ListaEventos").addClass("hidden");
    $("#SemestrePicker").addClass("hidden");
    $("#ModalidadPicker").addClass("hidden");
    $("#MontoRow").addClass("hidden");


    $('#FechaForm').datepicker('destroy');
    $('#FechaForm').datepicker({
      format: "yyyy-mm-dd",
      startDate: "01/01/2017",
      endDate: "today",
      maxViewMode: 0,
      todayBtn: "linked",
      language: "es",
      autoclose: true,
      todayHighlight: true
    });
    if (Globales.actividadElegida=="Funcional") {
      traerPrecio(5);
    }
  }
  function elegirMes(){
    $(".escondible2").addClass("hidden");
    $("#IngresoMes").removeClass("hidden");
    $("#MontoRow").removeClass("hidden");

    $('#MesForm').datepicker({
      format: "yyyy-mm-dd",
      startDate: "01/01/2017",
      endDate: "today",
      maxViewMode: 1,
      minViewMode: 1,
      todayBtn: "linked",
      language: "es",
      autoclose: true,
      todayHighlight: true
    });
    var Act
    if (Globales.actividadElegida=="Funcional") {
      if (Globales.ListaActividades.length == 2) {
        traerPrecio(7);
      }else {
        traerPrecio(6);
      }
    }
  }
  function calcAge(dateString) {
    var birthday = +new Date(dateString);
    return ~~((Date.now() - birthday) / (31557600000));
  }
  function elegirActividad(boton){
    Globales.actividadElegida = Globales.ListaActividades[boton.id];
    filas = document.getElementById("ListaActividades").getElementsByTagName("button");
    for (var i = 0; i < filas.length; i++) {
      if (filas[i].id == boton.id) {
        $("#" + filas[i].id).addClass("list-group-item-info");
      } else {
        $("#" + filas[i].id).removeClass("list-group-item-info");
      }
    }

    $(".escondible").addClass("hidden");
    $("#PanelActividades").removeClass("hidden");

    if (Globales.ListaActividades[boton.id].XClase == 1) {
      $("#Clase").removeClass("hidden");
    }
    if (Globales.ListaActividades[boton.id].XMes == 1) {
      $("#Mes").removeClass("hidden");
    }
    if (Globales.ListaActividades[boton.id].XSemestre == 1) {
      $("#Semestre").removeClass("hidden");
    }
    if (Globales.ListaActividades[boton.id].Nombre.substr(0, Globales.ListaActividades[boton.id].Nombre.indexOf(' ')) == "Taekwon-Do") {
      $("#Matricula").removeClass("hidden");
    }
  }
  </script>
