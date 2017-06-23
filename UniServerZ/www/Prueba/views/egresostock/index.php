<script src="<?php echo URL; ?>views/recursos/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo URL; ?>views/recursos/bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js" charset="UTF-8"></script>
<link href="<?php echo URL; ?>views/recursos/bootstrap-datepicker/css/bootstrap-datepicker3.standalone.min.css" rel="stylesheet">
<div class="col-lg-10 col-lg-offset-1" style="padding-top: 200px">
    <div class="row">
        <form class="form-inline" id="Formu">
            <div class="form-group">
                <label class="sr-only" for="FechaForm">Fecha de la venta</label>
                <input type="text" class="form-control" id="FechaForm" name="FechaForm" placeholder="Fecha de la venta">
            </div>
            <div class="form-group">
                <label class="sr-only" for="IdProductosForm">Producto</label>
                <select id="IdProductosForm" name="IdProductosForm" oninput="Precio()" class="form-control">
                    <option disabled hidden selected value> -- Seleccione un producto -- </option>
                </select>
            </div>
            <label class="sr-only" for="MontoForm">Monto total</label>
            <div class="input-group">
                <div class="input-group-addon">$</div>
                <input type="number" min="0" class="form-control" id="MontoForm" name="MontoForm" placeholder="Monto total" data-toggle="tooltip" title="Se puede modificar">
            </div>
            <div class="form-group">
                <label class="sr-only" for="CantidadForm">Cantidad</label>
                <input type="number" min="1" value="1" class="form-control" oninput="Multiplicar()" id="CantidadForm"name="CantidadForm" placeholder="Cantidad">
            </div>
            <button type="button" id="BtnAgregar" onclick="Agregar()" class="btn btn-default">Registrar Venta</button>
        </form>
    </div>
</div>
<script>
    var caca;
    $('[data-toggle="tooltip"]').tooltip();
    $('#FechaForm').datepicker({
        format: "yyyy/mm/dd",
        startDate: "01/01/2017",
        endDate: "today",
        maxViewMode: 0,
        todayBtn: "linked",
        language: "es",
        autoclose: true,
        todayHighlight: true,
        forceParse: false
    });
    $.ajax({
        type: "POST",
        url: "<?php echo URL; ?>producto/listadoProductos",
        success: function (respuesta) {
            var myObj = JSON.parse(respuesta);
            caca = myObj;
            var txt = "";
            for (element in myObj) {
                txt += "<option value='" + myObj[element].idProductos + "'>" + myObj[element].Descripcion + "</option>";
            }
            document.getElementById("IdProductosForm").innerHTML += txt;
        }
    });
    function Precio()
    {
        document.getElementById("MontoForm").value = caca[document.getElementById("IdProductosForm").selectedIndex].Precio;
    }
    function Multiplicar()
    {
        document.getElementById("MontoForm").value = caca[document.getElementById("IdProductosForm").selectedIndex].Precio * document.getElementById("CantidadForm").value;
    }
    function Agregar()
    {
        var Fecha = document.getElementById("FechaForm").value;
        var Producto = document.getElementById("IdProductosForm").value;
        var Monto = document.getElementById("MontoForm").value;
        var Cantidad = document.getElementById("CantidadForm").value;
        if (Fecha === "" || Producto === "" || Monto === "" || Cantidad === "" || Monto < 1 || Cantidad < 1)
        {
            alert("Llenar todos los campos correctamente");
        } else {
            var url = "<?php echo URL; ?>producto/registrarVenta";
            $.ajax({
                type: "POST",
                url: url,
                data: "data=" + JSON.stringify($("#Formu").serializeArray()),
                success: function (respuesta)
                {
                    alert(JSON.parse(respuesta));
                    var x = document.getElementById("Formu").getElementsByClassName("form-control");
                    for (var i = 0; i < x.length; i++) {
                        x[i].value = '';
                    }
                }
            });
        }
    }

</script>