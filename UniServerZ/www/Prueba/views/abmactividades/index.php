<div class="row">
  <div class="col-lg-6">
    <div class="panel panel-default">
      <div class="panel-heading">Listado de Actividades
      </div>
      <div class="table-responsive col-sm-12">
        <table  id="Tabla" class="table table-hover" cellspacing="0" width="100%"  >
          <thead>
            <tr>
              <th>Descripción</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>
  <div id="Formu" class="col-lg-6" >
    <div class="panel panel-default">
      <ul class="list-group">
        <form class="form-horizontal">
          <li class="list-group-item">
            <div class="form-group">
              <label class="col-sm-2 control-label">Id:</label>
              <div class="col-sm-10">
                <p id="idActividades" class="form-control-static"></p>
                <input type="text" class="form-control hidden" id="idActividadesForm" placeholder="Se mira y no se toca" disabled>

              </div>
            </div>
          </li>
          <li class="list-group-item">
            <div class="form-group">

              <label class="col-sm-2 control-label">Nombre:</label>
              <div class="col-sm-10">
                <p id="Nombre" class="form-control-static"></p>
                <input type="text" class="form-control hidden" id="NombreForm" placeholder="Descripción">
              </div>

            </div>
          </li>
          <!-- <li class="list-group-item">
            <div class="form-group">

              <label class="col-sm-2 control-label">Distribuidor:</label>
              <div class="col-sm-10">
                <p id="disNombre" class="form-control-static"></p>
                <select id="idDistribuidoresSelect" class="form-control hidden">
                </select>
                <input type="text" style="display: none; visibility: hidden;" class="form-control" id="disNombreForm">

              </div>
            </div>
          </li> -->
          <li class="list-group-item">
            <div class="form-group">
              <label class="col-sm-2 control-label">Se paga por clase:</label>
              <div class="col-sm-10">
                <p class="intro hidden" id="XClase"></p>
                <input type="checkbox"class="checkbox hidden" id="XClaseForm" disabled>
              </div>
            </div>
          </li>
          <li class="list-group-item">
            <div class="form-group">
              <label class="col-sm-2 control-label">Se paga por mes:</label>
              <div class="col-sm-10">
                <p class="intro hidden" id="XMes"></p>
                <input type="checkbox"class="checkbox hidden" id="XMesForm" disabled>
              </div>
            </div>
          </li>
          <li class="list-group-item">
            <div class="form-group">
              <label class="col-sm-2 control-label">Se paga por semestre:</label>
              <div class="col-sm-10">
                <p class="intro hidden" id="XSemestre"></p>
                <input type="checkbox"class="checkbox hidden" id="XSemestreForm" disabled>
              </div>
            </div>
          </li>
        </form>
      </ul>
    </div>
    <button type="button" id="BtnAgregar" onclick="modoFormulario('Agregar')" class="btn btn-default">Agregar</button>
    <button type="button" id="BtnModificar"onclick="modoFormulario('Modificar')" class="btn btn-primary hidden">Modificar</button>
    <button type="button" id="BtnAceptar" onclick="EnviarActividad()" class="btn btn-success hidden">Aceptar</button>
    <button type="button" id="BtnEliminar" onclick="EliminarActividad()" class="btn btn-danger hidden">Eliminar</button>
  </div>
</div>
<script src="<?php echo URL; ?>views/recursos/logicaABM.js"></script>
<script>
var VecActividades = [];
// var request = $.ajax({
//   url: "<?php echo URL; ?>producto/listadoDropdowns",
//   type: "post"
// });
// request.done(function (respuesta){
//   var myObj = JSON.parse(respuesta);
//   var txt = "";
//   for (element in myObj) {
//     txt += "<option value='" + myObj[element].id + "'>" + myObj[element].Nombre + "</option>";
//   }
//   document.getElementById("idDistribuidoresSelect").innerHTML = txt;
// });
$(document).ready(function () {
  listadoActividades();
});
var listadoActividades = function ()
{
  var table = $("#Tabla").DataTable(
    {
      "ajax":
      {
        "method": "POST",
        "url": "<?php echo URL; ?>actividad/traerActividades",
        "dataSrc": function (txt)
        {
          VecActividades = [];
          for (i in txt)
          {
            var Actividad =
            {
              idActividades: txt[i].idActividades,
              Nombre: txt[i].Nombre
            };
            VecActividades.push(Actividad);
          }
          return VecActividades;
        }
      },
      "columns": [
        {data: "Nombre"}
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
        var request = $.ajax({
          url: "<?php echo URL; ?>actividad/traerActividad",
          type: "post",
          data: "data=" + VecActividades[indexes].idActividades,
        });
        request.done(function (respuesta){
          clickFila(JSON.parse(respuesta)[0]);
          // var select = document.getElementById("idDistribuidoresSelect");
          // $("#" + select.id).addClass("hidden");
          // var options = select.options;
          // for (var i = 0; i < select.length; i++) {
          //   if (options[i].text == document.getElementById("disNombreForm").value) {
          //     select.selectedIndex = i;
          //   }
          // }
        });

      }
    });
  }

  var vec = [];
  function EnviarActividad()
  {
    var nombre = document.getElementById("NombreForm").value;
    if (nombre === "")
    {
      alert("Por favor llene el nombre thank you very much");
    } else {
      vec = [];
      vec = beforeEnviar();
      request = $.ajax({
        url: "<?php echo URL; ?>actividad/agregarModificarActividad",
        type: "post",
        data: "data=" + JSON.stringify(vec),
      });
      request.done(function (respuesta){
        afterEnviar();
      });

    }

  }
  function EliminarActividad() {
    var r = confirm("Estás muy recontra segurísima/o que querés borrar esta actividad?");
    if (r == true) {

      request = $.ajax({
        url: "<?php echo URL; ?>actividad/eliminarActividad",
        type: "post",
        data: "data=" + document.getElementById("idActividades").innerHTML,
      });
      request.done(function (respuesta){
        eliminarError(respuesta);
      });

    }
  }

  </script>
