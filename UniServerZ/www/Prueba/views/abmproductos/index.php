<div class="row">
    <div class="col-lg-6">				
        <div class="panel panel-default">
            <div class="panel-heading">Listado de Productos
            </div>
            <div class="table-responsive col-sm-12">
                <table  id="TablaProductos" class="table table-hover" cellspacing="0" width="100%"  >
                    <thead>
                        <tr>
                            <th>Descripci�n</th>
                        </tr> 
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <div id="Formu" class="col-lg-6" >
        <div class="panel panel-default" style="height: 80%; overflow-y: scroll;">
            <ul class="list-group">
                <form class="form-horizontal">
                    <li class="list-group-item">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Id:</label>
                            <div class="col-sm-10">
                                <p id="idProductos" class="form-control-static"></p>
                                <input type="text" style="display: none;" class="form-control" id="idProductosForm" placeholder="Se mira y no se toca" disabled>

                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="form-group">

                            <label class="col-sm-2 control-label">Descripci�n:</label>
                            <div class="col-sm-10">
                                <p id="Descripcion" class="form-control-static"></p>
                                <input type="text" style="display: none;" class="form-control" id="DescripcionForm" placeholder="Descripci�n">
                            </div>

                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="form-group">

                            <label class="col-sm-2 control-label">Distribuidor:</label>
                            <div class="col-sm-10">
                                <p id="disNombre" class="form-control-static"></p>
                                <select id="idDistribuidoresSelect" class="form-control"style="display: none;">
                                </select>
                                <input type="text" style="display: none; visibility: hidden;" class="form-control" id="disNombreForm">

                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Precio:</label>
                            <div class="col-sm-10">
                                <p id="Precio" class="form-control-static"></p>
                                <input type="text" style="display: none;" class="form-control" id="PrecioForm" placeholder="Precio">
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="form-group">

                            <label class="col-sm-2 control-label">Stock:</label>
                            <div class="col-sm-10">
                                <p id="Stock" class="form-control-static"></p>
                                <input type="text" style="display: none;" class="form-control" id="StockForm" placeholder="Stock">
                            </div>

                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="form-group">

                            <label class="col-sm-2 control-label">Avisar cuando el stock llegue a esta cantidad:</label>
                            <div class="col-sm-10">
                                <p id="Avisar" class="form-control-static"></p>
                                <input type="text" style="display: none;" class="form-control" id="AvisarForm" placeholder="Avisar cuando el stock llegue a esta cantidad">
                            </div>

                        </div>
                    </li>
                </form>
            </ul>
        </div>
        <button type="button" id="BtnAgregar" onclick="AgregarProducto()" class="btn btn-default">Agregar Producto</button>
        <button type="button" id="BtnModificar"onclick="ModificarProducto()" class="btn btn-primary">Modificar Producto</button>
        <button type="button" id="BtnAceptar" onclick="EnviarProducto()" class="btn btn-success">Aceptar</button>
        <button type="button" id="BtnEliminar"id="BtnAgregar"onclick="EliminarProducto()" class="btn btn-danger">Eliminar Producto</button>
    </div>
</div>
<script>
    document.getElementById("BtnModificar").style.display = 'none';
    document.getElementById("BtnEliminar").style.display = 'none';
    document.getElementById("BtnAceptar").style.display = 'none';
    var VecElementos = [];
    $.ajax({
        type: "POST",
        url: "<?php echo URL; ?>producto/listadoDropdowns",
        success: function (respuesta) {
            var myObj = JSON.parse(respuesta);
            var txt = "";
            for (element in myObj) {
                txt += "<option value='" + myObj[element].id + "'>" + myObj[element].Nombre + "</option>";
            }
            document.getElementById("idDistribuidoresSelect").innerHTML = txt
        }
    });
    var VecProductos = [];
    $(document).ready(function () {
        listadoProductos();
    });
    var listadoProductos = function ()
    {
        var table = $("#TablaProductos").DataTable(
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
                var id = VecProductos[indexes].idProductos;
                var url = "<?php echo URL; ?>producto/traerProducto";
                $.ajax({
                    type: "POST",
                    url: url,
                    data: "data=" + id,
                    success: function (respuesta)
                    {
                        var obj = JSON.parse(respuesta)[0];
                        for (x in obj) {
                            document.getElementById(x).innerHTML = obj[x];
                            document.getElementById(x).style.display = 'block';
                            var input = document.getElementById(x + "Form");
                            input.style.display = 'none';
                            input.value = obj[x];
                        }
                        document.getElementById("BtnModificar").style.display = 'inline-block';
                        document.getElementById("BtnEliminar").style.display = 'inline-block';
                        document.getElementById("BtnAceptar").style.display = 'none';
                    }
                });
            }
        });
    }


    function AgregarProducto()
    {
        var x = document.getElementById("Formu").getElementsByClassName("form-control-static");
        var y = document.getElementById("Formu").getElementsByClassName("form-control");
        for (var i = 0; i < x.length; i++) {
            x[i].style.display = 'none';
        }
        for (var i = 0; i < y.length; i++) {
            y[i].style.display = 'block';
            y[i].value = null;
        }
        document.getElementById("BtnAceptar").style.display = 'inline-block';
        document.getElementById("BtnAgregar").style.display = 'none';
        document.getElementById("BtnModificar").style.display = 'none';
        document.getElementById("BtnEliminar").style.display = 'none';
    }
    function ModificarProducto()
    {
        var x = document.getElementsByClassName("form-control-static");
        var y = document.getElementsByClassName("form-control");
        for (var i = 0; i < x.length; i++) {
            x[i].style.display = 'none';
        }
        for (var i = 0; i < y.length; i++) {
            y[i].style.display = 'block';
        }
        document.getElementById("BtnAceptar").style.display = 'inline-block';
        document.getElementById("BtnAgregar").style.display = 'none';
        document.getElementById("BtnModificar").style.display = 'none';
        document.getElementById("BtnEliminar").style.display = 'none';
    }
    var vec = [];
    function EnviarProducto()
    {
        var descripcion = document.getElementById("DescripcionForm").value;
        var stock = document.getElementById("StockForm").value;
        if (descripcion === "" || stock === "")
        {
            alert("Por favor llene la descripci�n de producto y el stock muchas gracias jeje");
        } else {
            vec = [];
            var x = document.getElementById("Formu").getElementsByTagName("input");
            document.getElementById("disNombreForm").value = document.getElementById("idDistribuidoresSelect").value;
            for (var i = 0; i < x.length; i++) {
                if (x[i].value === "") {
                    x[i].value = null;
                }
                vec.push(x[i].value);
            }
            var url = "<?php echo URL; ?>producto/agregarModificarProducto";
            $.ajax({
                type: "POST",
                url: url,
                data: "data=" + JSON.stringify(vec),
                success: function (respuesta)
                {
                    var x = document.getElementById("Formu").getElementsByClassName("form-control-static");
                    var y = document.getElementById("Formu").getElementsByClassName("form-control");
                    for (var i = 0; i < x.length; i++) {
                        x[i].style.display = 'block';
                        x[i].innerHTML = "";
                    }
                    for (var i = 0; i < y.length; i++) {
                        y[i].style.display = 'none';
                    }
                    document.getElementById("BtnAgregar").style.display = 'inline-block';
                    document.getElementById("BtnModificar").style.display = 'none';
                    document.getElementById("BtnEliminar").style.display = 'none';
                    document.getElementById("BtnAceptar").style.display = 'none';
                    $('#TablaProductos').DataTable().clear().draw().ajax.reload();
                }
            });
        }


    }
    function EliminarProducto() {
        var r = confirm("Est�s muy recontra segur�sima que quer�s borrar este producto?");
        if (r == true) {
            $.ajax({
                type: "POST",
                url: '<?php echo URL; ?>producto/eliminarProducto',
                data: "data=" + document.getElementById("idProductos").innerHTML,
                success: function (respuesta)
                {
                    var x = document.getElementById("Formu").getElementsByClassName("form-control-static");
                    var y = document.getElementById("Formu").getElementsByClassName("form-control");
                    for (var i = 0; i < x.length; i++) {
                        x[i].style.display = 'block';
                        x[i].innerHTML = "";
                    }
                    for (var i = 0; i < y.length; i++) {
                        y[i].style.display = 'none';
                    }
                    var z = document.getElementById("Formu").getElementsByClassName("checkbox");
                    document.getElementById("BtnAgregar").style.display = 'inline-block';
                    document.getElementById("BtnModificar").style.display = 'none';
                    document.getElementById("BtnEliminar").style.display = 'none';
                    document.getElementById("BtnAceptar").style.display = 'none';
                    $('#TablaProductos').DataTable().clear().draw().ajax.reload();
                }
            });
        }
    }

</script>