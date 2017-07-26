<div class="row">
  <div class="col-lg-6">
    <div class="panel panel-default">
      <div class="panel-heading">Listado de Productos
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
                <p id="idProductos" class="form-control-static"></p>
                <input type="text" class="form-control hidden" id="idProductosForm" placeholder="Se mira y no se toca" disabled>

              </div>
            </div>
          </li>
          <li class="list-group-item">
            <div class="form-group">

              <label class="col-sm-2 control-label">Descripción:</label>
              <div class="col-sm-10">
                <p id="Descripcion" class="form-control-static"></p>
                <input type="text" class="form-control hidden" id="DescripcionForm" placeholder="Descripción">
              </div>

            </div>
          </li>
          <li class="list-group-item">
            <div class="form-group">

              <label class="col-sm-2 control-label">Distribuidor:</label>
              <div class="col-sm-10">
                <p id="disNombre" class="form-control-static"></p>
                <select id="idDistribuidoresSelect" class="form-control hidden">
                </select>
                <input type="text" style="display: none; visibility: hidden;" class="form-control" id="disNombreForm">

              </div>
            </div>
          </li>
          <li class="list-group-item">
            <div class="form-group">
              <label class="col-sm-2 control-label">Precio: $</label>
              <div class="col-sm-10">
                <p id="Precio" class="form-control-static"></p>
                <input type="number" min="0" class="form-control hidden" id="PrecioForm" placeholder="Precio">
              </div>
            </div>
          </li>
          <li class="list-group-item">
            <div class="form-group">

              <label class="col-sm-2 control-label">Stock:</label>
              <div class="col-sm-10">
                <p id="Stock" class="form-control-static"></p>
                <input type="number" min="0" class="form-control hidden" id="StockForm" placeholder="Stock">
              </div>

            </div>
          </li>
          <li class="list-group-item">
            <div class="form-group">

              <label class="col-sm-2 control-label">Avisar cuando el stock llegue a esta cantidad:</label>
              <div class="col-sm-10">
                <p id="Avisar" class="form-control-static"></p>
                <input type="number" min="0" class="form-control hidden" id="AvisarForm" placeholder="Avisar cuando el stock llegue a esta cantidad">
              </div>

            </div>
          </li>
        </form>
      </ul>
    </div>
    <button type="button" id="BtnAgregar" onclick="modoFormulario('Agregar')" class="btn btn-default">Agregar Producto</button>
    <button type="button" id="BtnModificar"onclick="modoFormulario('Modificar')" class="btn btn-primary hidden">Modificar Producto</button>
    <button type="button" id="BtnAceptar" onclick="EnviarProducto()" class="btn btn-success hidden">Aceptar</button>
    <button type="button" id="BtnEliminar" onclick="EliminarProducto()" class="btn btn-danger hidden">Eliminar Producto</button>
  </div>
</div>
<script src="<?php echo URL; ?>views/recursos/logicaABM.js"></script>
<script>
var VecProductos = [];
var VecElementos = [];
var request = $.ajax({
  url: "<?php echo URL; ?>producto/listadoDropdowns",
  type: "post"
});
request.done(function (respuesta){
  var myObj = JSON.parse(respuesta);
  var txt = "";
  for (element in myObj) {
    txt += "<option value='" + myObj[element].id + "'>" + myObj[element].Nombre + "</option>";
  }
  document.getElementById("idDistribuidoresSelect").innerHTML = txt;
});
$(document).ready(function () {
  listadoProductos();
});
var listadoProductos = function ()
{
  var table = $("#Tabla").DataTable(
    {
      "ajax":
      {
        "method": "POST",
        "url": "<?php echo URL; ?>producto/listadoProductos",
        "dataSrc": function (txt)
        {
          VecProductos = [];
          for (i in txt)
          {
            var Producto =
            {
              idProductos: txt[i].idProductos,
              Descripcion: txt[i].Descripcion
            };
            VecProductos.push(Producto);
          }
          return VecProductos;
        }
      },
      "columns": [
        {data: "Descripcion"}
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
          url: "<?php echo URL; ?>producto/traerProducto",
          type: "post",
          data: "data=" + VecProductos[indexes].idProductos,
        });
        request.done(function (respuesta){
          clickFila(JSON.parse(respuesta)[0]);
          var select = document.getElementById("idDistribuidoresSelect");
          $("#" + select.id).addClass("hidden");
          var options = select.options;
          for (var i = 0; i < select.length; i++) {
            if (options[i].text == document.getElementById("disNombreForm").value) {
              select.selectedIndex = i;
            }
          }
        });

      }
    });
  }

  var vec = [];
  function EnviarProducto()
  {
    var descripcion = document.getElementById("DescripcionForm").value;
    var stock = document.getElementById("StockForm").value;
    if (descripcion === "" || stock === "")
    {
      alert("Por favor llene la descripción de producto y el stock muchas gracias jeje");
    } else {
      vec = [];
      document.getElementById("disNombreForm").value = document.getElementById("idDistribuidoresSelect").value;
      vec = beforeEnviar();
      request = $.ajax({
        url: "<?php echo URL; ?>producto/agregarModificarProducto",
        type: "post",
        data: "data=" + JSON.stringify(vec),
      });
      request.done(function (respuesta){
        afterEnviar();
      });

    }

  }
  function EliminarProducto() {
    var r = confirm("Estás muy recontra segurísima/o que querés borrar este producto?");
    if (r == true) {

      request = $.ajax({
        url: "<?php echo URL; ?>producto/eliminarProducto",
        type: "post",
        data: "data=" + document.getElementById("idProductos").innerHTML,
      });
      request.done(function (respuesta){
        eliminarError(respuesta);
      });

    }
  }

  </script>
