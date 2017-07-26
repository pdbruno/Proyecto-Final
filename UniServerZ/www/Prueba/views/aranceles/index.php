<div class="row">
  <div class="col-lg-6">
    <div class="panel panel-default">
      <div class="panel-heading">Listado de Aranceles
      </div>
      <div class="table-responsive col-sm-12">
        <table  id="Tabla" class="table table-hover" cellspacing="0" width="100%"  >
          <thead>
            <tr>
              <th>Nombre</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>
  <div id="Formu" class="col-lg-6" style="height: 100%;">
    <div class="panel panel-default">
      <ul class="list-group">
        <form class="form-horizontal">
          <li class="list-group-item">
            <div class="form-group">
              <label class="col-sm-2 control-label">Id:</label>
              <div class="col-sm-10">
                <p id="idAranceles" class="form-control-static"></p>
                <input type="text" class="form-control hidden" id="idArancelesForm" placeholder="Se mira y no se toca" disabled>
              </div>
            </div>
          </li>
          <li class="list-group-item">
            <div class="form-group">
              <label class="col-sm-2 control-label">Nombre:</label>
              <div class="col-sm-10">
                <p id="Nombre" class="form-control-static"></p>
                <input type="text" class="form-control hidden" id="NombreForm" placeholder="Nombre">
              </div>

            </div>
          </li>
          <li class="list-group-item">
            <div class="form-group">
              <label class="col-sm-2 control-label">Precio:</label>
              <div class="col-sm-10">
                <p id="Precio" class="form-control-static"></p>
                <input type="text" class="form-control hidden" id="PrecioForm" placeholder="Precio">
              </div>

            </div>
          </li>

        </form>
      </ul>
    </div>
    <button type="button" id="BtnModificar"onclick="modoFormulario('Modificar')" class="btn btn-primary hidden">Modificar Arancel</button>
    <button type="button" id="BtnAceptar" onclick="Enviar()" class="btn btn-success hidden">Aceptar</button>
    <button type="button" id="BtnAgregar" onclick="modoFormulario('Agregar')" class="btn btn-default">Agregar Arancel</button>
    <button type="button" id="BtnEliminar" onclick="Eliminar()" class="btn btn-danger hidden">Eliminar Arancel</button>
  </div>

</div>
<script src="<?php echo URL; ?>views/recursos/logicaABM.js"></script>
<script>
var VecFila = [];
$(document).ready(function () {
  listado();
});
var listado = function ()
{
  var table = $("#Tabla").DataTable(
    {
      "ajax":
      {
        "method": "POST",
        "url": "<?php echo URL; ?>cobro/listadoAranceles",
        "dataSrc": function (txt)
        {
          VecFila = [];
          for (i in txt)
          {
            var Fila =
            {
              id: txt[i].idAranceles,
              Nombre: txt[i].Nombre,
            };
            VecFila.push(Fila);
          }
          return VecFila;
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
          url: "<?php echo URL; ?>cobro/traerArancel",
          type: "post",
          data: "data=" + VecFila[indexes].id,
        });
        request.done(function (respuesta){
          clickFila(JSON.parse(respuesta)[0]);
        });

      }
    });
  }

  var vec = [];
  function Enviar()
  {
    if (document.getElementById("NombreForm").value === "")
    {
      alert("No me dejes en blanco el único campo te lo pido por favor media pila");
    } else {
      vec = beforeEnviar();
      var request = $.ajax({
        url: "<?php echo URL; ?>cobro/agregarModificarArancel",
        type: "post",
        data: "data=" + JSON.stringify(vec),
      });
      request.done(function (respuesta){
        afterEnviar();
      });

    }
  }
  function Eliminar() {
    var r = confirm("Estás muy recontra segurísima/o que querés borrar este arancel?");
    if (r == true) {
      request = $.ajax({
        url: "<?php echo URL; ?>cobro/eliminarArancel",
        type: "post",
        data: "data=" + document.getElementById("idAranceles").innerHTML,
      });
      request.done(function (respuesta){
        eliminarError(respuesta);
      });

    }
  }
  </script>
