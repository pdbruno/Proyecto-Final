<script src="<?php echo URL; ?>views/recursos/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo URL; ?>views/recursos/bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js" charset="UTF-8"></script>
<link href="<?php echo URL; ?>views/recursos/bootstrap-datepicker/css/bootstrap-datepicker3.standalone.min.css" rel="stylesheet">
<div class="row" style="height:100%;">
  <div class="col-lg-6">
    <div class="panel panel-default">
      <div class="panel-heading">Listado de Activiadades
      </div>
      <div class="table-responsive col-sm-12">
        <table class="table table-hover" >
      <thead>
        <tr>
          <th style="display:none;">idActividades</th>
          <th>Actividad</th>
          <th>Nivel</th>
        </tr>
      </thead>
      <tbody id="TablaActividades">
      </tbody>
    </table>
      </div>
    </div>
  </div>
  <div id="Formu" class="col-lg-6" style="height: 100%">
    <div class="panel panel-default" style="height: 90%; overflow-y: scroll;">
      <ul class="list-group">
        <form class="form-horizontal">
          <li class="list-group-item">
            <div class="form-group">
              <label class="col-sm-2 control-label">Id:</label>
              <div class="col-sm-10">
                <p id="idClientes" class="form-control-static"></p>
                <input type="text" style="display: none;" class="form-control" id="idClientesForm" placeholder="Se mira y no se toca" disabled>

              </div>
            </div>
          </li>
          <li class="list-group-item">
            <div class="form-group">

              <label class="col-sm-2 control-label">Nombre del evento:</label>
              <div class="col-sm-10">
                <p id="Nombres" class="form-control-static"></p>
                <input type="text" style="display: none;" class="form-control" id="NombresForm" placeholder="Nombres">
              </div>

            </div>
          </li>
          <li class="list-group-item">
            <div class="form-group">
              <label class="col-sm-2 control-label">Fecha:</label>
              <div class="col-sm-10">
                <p id="FechaNacimiento" class="form-control-static"></p>
                <input type="text" style="display: none;" class="form-control" id="FechaNacimientoForm" placeholder="Fecha de Nacimiento">
              </div>
            </div>
          </li>
          <li class="list-group-item">
            <div class="form-group">
              <label class="col-sm-2 control-label">Horario de inicio:</label>
              <div class="col-sm-10">
                <p id="DNI" class="form-control-static"></p>
                <input type="number" min="0" style="display: none;" class="form-control" id="DNIForm" placeholder="DNI">

              </div>
            </div>
          </li>

          <li class="list-group-item">
            <div class="form-group">
              <label class="col-sm-2 control-label">Horario de finalización:</label>
              <div class="col-sm-10">
                <p id="Domicilio" class="form-control-static"></p>
                <input type="text" style="display: none;" class="form-control" id="DomicilioForm" placeholder="Domicilio">

              </div>
            </div>
          </li>

          <li class="list-group-item">

            <div class="form-group">
              <label class="col-sm-2 control-label">Se repite:</label>
              <div class="col-sm-10">
                <p class="intro" id="AutorizaWeb" hidden></p>
                <input type="checkbox"class="checkbox"style="display: none;" id="AutorizaWebForm" disabled>
                <button type="button" id="RepeticionSelect" class="btn btn-link" data-toggle="modal" data-target="#ModalVer">Elegir repetición</button>
              </div>
            </div>
          </li>
            </form>
          </ul>
        </div>
        <button type="button" id="BtnModificar"onclick="ModificarUsuario()" class="btn btn-primary">Modificar Usuario</button>
        <button type="button" id="BtnAceptar" onclick="EnviarUsuario()" class="btn btn-success">Aceptar</button>
      </div>
  </div>
  <script>
  $('#FechaNacimientoForm').datepicker({
    format: "yyyy/mm/dd",
    endDate: "today",
    language: "es",
    autoclose: true,
  });
  document.getElementById("BtnModificar").style.display = 'none';
  document.getElementById("BtnAceptar").style.display = 'none';

  function optionCrear(vec) {
    var txt="";
    for (var i = 0; i < vec.length; i++) {
      if (vec[i].Nombre.length > 1) {
        txt += "<option value='" + vec[i].id + "'>" + vec[i].Nombre + "</option>";
      }
    }
    return txt;
  }
  function repetitivaCrear(Ids, Nombres) {
    var Cosa = [];
    var Vec = [];
    for (var i = 0; i < Ids.length; i++) {
      Cosa = {id: Ids[i], Nombre: Nombres[i]};
      Vec.push(Cosa);
    }
    return Vec;
  }
  var VecClientes = [];

    function mostrarOcultar(){
      deshacerModal();
      document.getElementById("BtnAceptar").style.display = 'inline-block';
      document.getElementById("BtnModificar").style.display = 'none';
    }
    function ModificarUsuario()
    {

      $("#IdActividadesSelect").removeClass("hidden");
      $("#IdActividadesVer").addClass("hidden");
      mostrarOcultar();
      var selects = document.getElementById("Formu").getElementsByTagName("select");
      for (select in selects) {
        var options = selects[select].options;
        for (option in options) {
          if (options[option].text == document.getElementById("locNombreForm").value) {
            selects[select].selectedIndex = options[option].value - 1;
          } else if (options[option].text == document.getElementById("sangNombreForm").value) {
            selects[select].selectedIndex = options[option].value - 1;
          } else if (options[option].text == document.getElementById("catNombreForm").value) {
            selects[select].selectedIndex = options[option].value - 1;
          } else if (options[option].text == document.getElementById("sedNombreForm").value) {
            selects[select].selectedIndex = options[option].value - 1;
          }
        }
      }
      var x = document.getElementsByClassName("form-control-static");
      var y = document.getElementsByClassName("form-control");
      for (var i = 0; i < x.length; i++) {
        x[i].style.display = 'none';
      }
      for (var i = 0; i < y.length; i++) {
        y[i].style.display = 'block';
      }
      var z = document.getElementsByClassName("checkbox");
      for (var i = 0; i < z.length; i++) {
        z[i].disabled = false;
        z[i].style.display = 'block';
      }



    }
    var vec = [];
    function EnviarUsuario()
    {
      var nombre = document.getElementById("NombresForm").value;
      var apellido = document.getElementById("ApellidosForm").value;
      var sede = document.getElementById("IdSedesSelect").value;
      var categoria = document.getElementById("IdCategoriasSelect").value;
      if (nombre === "" || apellido == "" || sede == "" || categoria == "" || bien == false)
      {
        alert("Los siguientes campos son absolutamente obligatorios: Nombre, Apelliido, Sede, Actividades (llenar correctamente en case de no haberlo) y Categor�a\n\
        (Se recomienda llenar todos)");
      } else {
        vec = [];
        var x = document.getElementById("Formu").getElementsByTagName("input");
        var z = document.getElementsByClassName("checkbox");
        document.getElementById("locNombreForm").value = document.getElementById("IdLocalidadesSelect").value;
        document.getElementById("sangNombreForm").value = document.getElementById("IdGrupoFactorSanguineoSelect").value;
        document.getElementById("catNombreForm").value = document.getElementById("IdCategoriasSelect").value;
        document.getElementById("sedNombreForm").value = document.getElementById("IdSedesSelect").value;
        for (var i = 0; i < z.length; i++) {
          if (z[i].checked == true) {
            z[i].value = 1;
          } else {
            z[i].value = 0;
          }
        }
        for (var i = 0; i < x.length; i++) {
          if (x[i].value === "") {
            x[i].value = null;
          }
          vec.push(x[i].value);
        }
        var url = "<?php echo URL; ?>cliente/agregarModificarCliente";
        $.ajax({
          type: "POST",
          url: url,
          data: "data1=" + JSON.stringify(vec) + "&data2=" + final,
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
            for (var i = 0; i < z.length; i++) {
              z[i].disabled = true;
              z[i].style.display = 'none';
            }
            $("#IdActividadesSelect").addClass("hidden");
            mostrarOcultar2();
          }
        });
      }
    }
    function mostrarOcultar2(){
      document.getElementById("BtnModificar").style.display = 'none';
      document.getElementById("BtnAceptar").style.display = 'none';
    }
    </script>
    <script>
function traerActividad(valor){
  var id = valor.substr(0, 1);
  var Nombre = valor.substr(2).trim();
  alert("Id: " + id);
  alert("Nombre: " + Nombre);
  $.ajax({
    type: "POST",
    data: "data=" + id,
    url: "<?php echo URL; ?>actividad/mostrar",
    success: function (respuesta)
    {
          var obj = JSON.parse(respuesta)[0][0];
          var actividades = JSON.parse(respuesta)[1];
          var texto = "";
          for (x in obj) {
            document.getElementById(x).innerHTML = obj[x];
            document.getElementById(x).style.display = 'block';
            var input = document.getElementById(x + "Form");
            input.style.display = 'none';
            if (input.type == 'checkbox') {
              if (obj[x] == 1) {
                input.checked = true;
              } else {
                input.checked = false;
              }
            } else {
              input.value = obj[x];
            }
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
          document.getElementById("BtnAceptar").style.display = 'none';
  }
});
}
var texto = "";
$.ajax({
  type: "POST",
  url: "<?php echo URL; ?>actividad/traerActividades",
  success: function (respuesta)
  {
    var actividades = JSON.parse(respuesta);
    var i = 0;
    for (act in actividades) {
      texto += "<tr onclick='traerActividad($(this).text())'>";
      texto+= "<td style='display:none;'>" + i + " </td>";
      for (prop in actividades[act]) {
        if (actividades[act][prop] != null) {
            texto+="<td>" + actividades[act][prop] + " </td>";

        }
        else {
          texto+="<td>-</td>";
        }
      }
      i++;
      texto+="</tr>";
      sub=[];
    }
    texto+="</tr>"
    $("#TablaActividades").html(texto);
  }
});
$.ajax({
  type: "GET",
  url: "<?php echo URL; ?>actividad/manejar",
  success: function (respuesta)
  {
    alert(respuesta);
  }
});

</script>
