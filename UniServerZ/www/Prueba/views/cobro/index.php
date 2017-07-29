<script src="<?php echo URL; ?>views/recursos/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo URL; ?>views/recursos/bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js" charset="UTF-8"></script>
<link href="<?php echo URL; ?>views/recursos/bootstrap-datepicker/css/bootstrap-datepicker3.standalone.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo URL; ?>views/recursos/bootstrap-table/bootstrap-table.min.css">
<script src="<?php echo URL; ?>views/recursos/bootstrap-table/bootstrap-table.min.js"></script>
<script src="<?php echo URL; ?>views/recursos/bootstrap-table/bootstrap-table-es-AR.min.js"></script>
<div class="col-lg-6">
  <div class="panel panel-default">
    <div class="panel-heading">Listado de Clientes
    </div>
    <div class="table-responsive col-lg-12">
      <table  id="Tabla" class="table table-hover" data-toggle="table" data-url="<?php echo URL; ?>cliente/listarElementos/Clientes" data-search='true' cellspacing="0" width="100%"  >
        <thead>
          <tr>
            <th data-field="Nombres" data-sortable='true'>Nombres</th>
            <th data-field="Apellidos" data-sortable='true'>Apellidos</th>
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
        <label class="btn btn-default active" id="semestre1">
          <input type="radio" name="1erSemestre" autocomplete="off"> 1er semestre
        </label>
        <label class="btn btn-default" id="semestre2">
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
      <button class="btn btn-default" onclick="enviar()" type="button">Aceptar</button>
    </div>
  </div>
</div>
<script>
function enviar(){
  if ($("#Mes").hasClass("active")){
    var mes = $("#MesForm").val()
    if (mes!="") {
      var vecmes = mes.split('-');
      vecmes[1] = Number(vecmes[1]) + 1;
      vecmes = vecmes.join('-')
      Enviar.Actividad = Globales.actividadElegida.idActividades + '/' + mes + '/' + vecmes;
    }
  }else if ($("#Semestre").hasClass("active")) {
    var d = new Date();
    var n = d.getFullYear();
    if ($("#semestre1").hasClass("active")) {
      Enviar.Actividad = Globales.actividadElegida.idActividades + '/' + n + '-01-01/' +  n + '-06-30';
    }else {
      Enviar.Actividad = Globales.actividadElegida.idActividades + '/' + n + '-07-01/' +  n + '-12-31';
    }
  }
  var bien = true;
  Enviar.Monto=$("#Monto").val();
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
    var request = $.ajax({
      url: "<?php echo URL; ?>cobro/agregarModificarElemento/Cobros",
      type: "post",
      data: "data=" + JSON.stringify(Enviar),
    });

    request.done(function (respuesta){
      $(".escondible").addClass("hidden");
      for (x in Enviar) {
        Enviar[x]="";
      }
    });
  }
}
function Matricula(){
  $(".escondible2").addClass("hidden");
  $("#MontoRow").removeClass("hidden");
  Enviar.Actividad = "Matricula";
  alert("precio matricula")
}
var Enviar ={Actividad:"", idClientes:"", Monto : ""};
var Globales = {actividadElegida:"", ListaActividades:[]};
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
          if (eventos[act].Nombre == Globales.actividadElegida.NombreAct) {
            texto += "<tr onclick='traerEvento(this)' id='" + eventos[act].idEvento + "'>";
            texto += "<td>" + eventos[act].Nombre + " </td>";
            texto += "</tr>";
            i++;
          }
        }
        if (texto == "") {
          alert("No hay ninguna actividad de " + Globales.actividadElegida.NombreAct.substr(0, Globales.actividadElegida.NombreAct.indexOf(' ')) + " para el día seleccionado")
        }else {
          $("#ListaEventos").removeClass('hidden');
        }
        $("#TablaActividades").html(texto);
      }
    });

  }
}
function traerEvento(boton){
  filas = document.getElementById("TablaActividades").rows;
  for (row in filas) {
    if (filas[row].id == boton.id) {
      $("#" + filas[row].id).addClass("success");
      idEvento = filas[row].cells[0].innerHTML;
    } else {
      $("#" + filas[row].id).removeClass("success");
    }
  }
  Enviar.Actividad = boton.id;

}
function traerPrecio(campo){
  request = $.ajax({
    url: "<?php echo URL; ?>cobro/traerElemento/Arancel",
    type: "post",
    data: "data=" + JSON.stringify({idActividades:Globales.actividadElegida.idActividades, idModalidades:Globales.actividadElegida.idModalidades, Campo: campo})
  });
  request.done(function (respuesta)
  {
    $('#MontoRow').removeClass('hidden');
    if ($("#Semestre").hasClass("active")) {
      $('#Monto').val(respuesta * 5);
    }else {
      $('#Monto').val(respuesta);
    }
  });
}
function elegirSemestre(){
  $(".escondible2").addClass("hidden");
  $("#MontoRow").removeClass("hidden");
  $("#SemestrePicker").removeClass("hidden");
  traerPrecio('PrecioXMes');
}
$('#Tabla').on('click-row.bs.table', function (row, $element, field) {
  $('.success').removeClass('success');
  $(field).addClass('success');
  var request = $.ajax({
    url: "<?php echo URL; ?>cliente/actCliente",
    type: "post",
    data: "data=" + $element.idClientes,
  });
  Enviar.idClientes = $element.idClientes;
  request.done(function (respuesta){
    Globales.ListaActividades = [];
    var actividades = JSON.parse(respuesta)[0];
    var texto = "";
    var i = 0;
    for (actividad in actividades) {
      Globales.ListaActividades.push(actividades[actividad]);
      var NombreAct = actividades[actividad].NombreAct;
      var NombreMod = actividades[actividad].NombreMod;
      if (NombreMod == null) {
        texto+= "<button type='button' class='list-group-item btn btn-default' id='" + i + "' onclick='elegirActividad(this)'>" + NombreAct + "</button>";
      }else {
        texto+= "<button type='button' class='list-group-item btn btn-default' id='" + i + "' onclick='elegirActividad(this)'>" + NombreAct + " " + NombreMod + "</button>";
      }
      i++;
    }
    $("#ListaActividades").html(texto);
    $(".escondible").addClass("hidden");
    $("#PanelActividades").removeClass("hidden");
  });
});
function elegirFecha(){
  $(".escondible2").addClass("hidden");
  $("#IngresoFecha").removeClass("hidden");

  $('#FechaForm').datepicker('destroy');
  $('#FechaForm').datepicker({
    format: "yyyy-mm-dd",
    startDate: "01/01/2017",
    maxViewMode: 0,
    todayBtn: "linked",
    language: "es",
    autoclose: true,
    todayHighlight: true
  });

  traerPrecio('PrecioXClase');
  $("#MontoRow").removeClass("hidden");

}

function elegirMes(){
  $(".escondible2").addClass("hidden");
  $("#IngresoMes").removeClass("hidden");
  $("#MontoRow").removeClass("hidden");

  $('#MesForm').datepicker({
    format: "yyyy-mm-dd",
    startDate: "01/01/2017",
    maxViewMode: 1,
    minViewMode: 1,
    todayBtn: "linked",
    language: "es",
    autoclose: true,
    todayHighlight: true
  });
  var Act
  traerPrecio('PrecioXMes');
  if (Globales.actividadElegida.NombreAct.substr(0, Globales.actividadElegida.NombreAct.indexOf(' ')) == "Funcional") {
    if (!$("#Matricula").hasClass("hidden")) {
      alert("Precio de funcional (TAMBIEN HACE TKD) Por Mes");
    }
  }
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
  if (Globales.ListaActividades[boton.id].NombreAct.substr(0, Globales.ListaActividades[boton.id].NombreAct.indexOf(' ')) == "Taekwon-Do") {
    $("#Matricula").removeClass("hidden");
  }
}
</script>
