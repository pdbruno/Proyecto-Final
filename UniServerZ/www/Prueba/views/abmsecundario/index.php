<div class="row">
    <div class="col-lg-6">				
        <div class="panel panel-default">
            <div class="panel-heading">Listado de <?php echo $this->sujeto; ?>
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
                                <p id="id" class="form-control-static"></p>
                                <input type="text" style="display: none;" class="form-control" id="idForm" placeholder="Se mira y no se toca" disabled>
                                <!--Si alguien ve esto ayudenme, me tienen captivo programando las 24hs OH NO AHI VIENE ASDSDADAASDAWRARBJK-->

                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="form-group">

                            <label class="col-sm-2 control-label">Nombre:</label>
                            <div class="col-sm-10">
                                <p id="Nombre" class="form-control-static"></p>
                                <input type="text" style="display: none;" class="form-control" id="NombreForm" placeholder="Nombre">
                            </div>

                        </div>
                    </li>


                </form>
            </ul>
        </div>
        <button type="button" id="BtnAgregar" onclick="Agregar()" class="btn btn-default">Agregar</button>
        <button type="button" id="BtnModificar"onclick="Modificar()" class="btn btn-primary">Modificar</button>
        <button type="button" id="BtnAceptar" onclick="Enviar()" class="btn btn-success">Aceptar</button>
        <button type="button" id="BtnEliminar"id="BtnAgregar"onclick="Eliminar()" class="btn btn-danger">Eliminar</button>
    </div>

</div>
<script>
    document.getElementById("BtnModificar").style.display = 'none';
    document.getElementById("BtnEliminar").style.display = 'none';
    document.getElementById("BtnAceptar").style.display = 'none';
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
                                "url": "<?php echo URL; ?>help/listado/<?php echo $this->sujeto; ?>",
                                                                "dataSrc": function (txt)
                                                                {
                                                                    VecFila = [];
                                                                    for (i in txt)
                                                                    {
                                                                        var Fila =
                                                                                {
                                                                                    id: txt[i].id,
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
                                                var id = VecFila[indexes].id;
                                                var url = "<?php echo URL; ?>help/traerFila/<?php echo $this->sujeto; ?>";
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
                                                                        var y = document.getElementsByClassName("checkbox");
                                                                        var z = document.getElementsByClassName("intro");
                                                                        for (i = 0; i < y.length; i++) {
                                                                            y[i].style.display = 'block';
                                                                            if (z[i].innerHTML == 1) {
                                                                                y[i].checked = true;
                                                                            } else {
                                                                                y[i].checked = false;
                                                                            }
                                                                            z[i].style.display = 'none';
                                                                        }
                                                                        document.getElementById("BtnModificar").style.display = 'inline-block';
                                                                        document.getElementById("BtnEliminar").style.display = 'inline-block';
                                                                        document.getElementById("BtnAceptar").style.display = 'none';
                                                                    }
                                                                });
                                                            }
                                                        });
                                                    }

                                                    function Agregar()
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
                                                    function Modificar()
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
                                                    function Enviar()
                                                    {
                                                        if (document.getElementById("NombreForm").value === "")
                                                        {
                                                            alert("No me dejes en blanco el �nico campo te lo pido por favor media pila");
                                                        } else {
                                                            vec = [];
                                                            var x = document.getElementById("Formu").getElementsByTagName("input");
                                                            for (var i = 0; i < x.length; i++) {
                                                                vec.push(x[i].value);
                                                            }
                                                            var url = "<?php echo URL; ?>help/agregarModificarFila/<?php echo $this->sujeto; ?>";
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
                                                                                $('#Tabla').DataTable().clear().draw().ajax.reload();
                                                                            }
                                                                        });
                                                                    }
                                                                }
                                                                function Eliminar() {
                                                                    var r = confirm("Est�s muy recontra segur�sima que quer�s borrar este elemento?");
                                                                    if (r == true) {
                                                                        $.ajax({
                                                                            type: "POST",
                                                                            url: "<?php echo URL; ?>help/eliminarFila/<?php echo $this->sujeto; ?>",
                                                                                            data: "data=" + document.getElementById("id").innerHTML,
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
                                                                                                $('#Tabla').DataTable().clear().draw().ajax.reload();
                                                                                            }
                                                                                        });
                                                                                    }
                                                                                }
</script>