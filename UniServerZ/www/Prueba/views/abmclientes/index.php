<script src="<?php echo URL; ?>views/recursos/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo URL; ?>views/recursos/bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js" charset="UTF-8"></script>
<link href="<?php echo URL; ?>views/recursos/bootstrap-datepicker/css/bootstrap-datepicker3.standalone.min.css" rel="stylesheet">
<div class="row" style="height:100%;">
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
  <div id="Formu" class="col-lg-6" style="height: 100%">
    <div class="panel panel-default" style="height: 90%; overflow-y: scroll;">
      <ul class="list-group">
        <form class="form-horizontal">
          <li class="list-group-item">
            <div class="form-group">
              <label class="col-sm-2 control-label">Id:</label>
              <div class="col-sm-10">
                <p id="idClientes" class="form-control-static"></p>
                <input type="text" class="form-control hidden" id="idClientesForm" placeholder="Se mira y no se toca" disabled>

              </div>
            </div>
          </li>
          <li class="list-group-item">
            <div class="form-group">

              <label class="col-sm-2 control-label">Nombres:</label>
              <div class="col-sm-10">
                <p id="Nombres" class="form-control-static"></p>
                <input type="text" class="form-control hidden" id="NombresForm" placeholder="Nombres">
              </div>

            </div>
          </li>
          <li class="list-group-item">
            <div class="form-group">
              <label class="col-sm-2 control-label">Apellidos:</label>
              <div class="col-sm-10">
                <p id="Apellidos" class="form-control-static"></p>
                <input type="text" class="form-control hidden" id="ApellidosForm" placeholder="Apellidos">

              </div>
            </div>
          </li>
          <li class="list-group-item">
            <div class="form-group">
              <label class="col-sm-2 control-label">Fecha de Nacimiento:</label>
              <div class="col-sm-10">
                <p id="FechaNacimiento" class="form-control-static"></p>
                <input type="text" class="form-control hidden" id="FechaNacimientoForm" placeholder="Fecha de Nacimiento">
              </div>
            </div>
          </li>
          <li class="list-group-item">
            <div class="form-group">
              <label class="col-sm-2 control-label">DNI:</label>
              <div class="col-sm-10">
                <p id="DNI" class="form-control-static"></p>
                <input type="number" min="0" class="form-control hidden" id="DNIForm" placeholder="DNI">

              </div>
            </div>
          </li>

          <li class="list-group-item">
            <div class="form-group">
              <label class="col-sm-2 control-label">Domicilio:</label>
              <div class="col-sm-10">
                <p id="Domicilio" class="form-control-static"></p>
                <input type="text" class="form-control hidden" id="DomicilioForm" placeholder="Domicilio">

              </div>
            </div>
          </li>
          <li class="list-group-item">
            <div class="form-group">

              <label class="col-sm-2 control-label">Localidad:</label>
              <div class="col-sm-10">
                <p id="locNombre" class="form-control-static"></p>
                <select id="IdLocalidadesSelect" class="form-control hidden">

                </select>
                <input type="text" style="display: none; visibility: hidden;" class="form-control" id="locNombreForm">

              </div>
            </div>
          </li>
          <li class="list-group-item">

            <div class="form-group">
              <label class="col-sm-2 control-label">Código Postal:</label>
              <div class="col-sm-10">
                <p id="CPostal" class="form-control-static"></p>
                <input type="text" class="form-control hidden" id="CPostalForm" placeholder="Código Postal">
              </div>
            </div>
          </li>
          <li class="list-group-item">

            <div class="form-group">
              <label class="col-sm-2 control-label">Teléfono/</br>Celular:</label>
              <div class="col-sm-10">
                <p id="TelCel" class="form-control-static"></p>
                <input type="tel" min="0" class="form-control hidden" id="TelCelForm" placeholder="Teléfono/Celular">

              </div>
            </div>
          </li>
          <li class="list-group-item">

            <div class="form-group">
              <label class="col-sm-2 control-label">Ocupación:</label>
              <div class="col-sm-10">
                <p id="Ocupacion" class="form-control-static"></p>
                <input type="text" class="form-control hidden" id="OcupacionForm" placeholder="Ocupación">

              </div>
            </div>
          </li>
          <li class="list-group-item">

            <div class="form-group">
              <label class="col-sm-2 control-label">E-mail:</label>
              <div class="col-sm-10">
                <p id="Email" class="form-control-static"></p>
                <input type="email" class="form-control hidden" id="EmailForm" placeholder="E-mail">

              </div>
            </div>
          </li>
          <li class="list-group-item">

            <div class="form-group">
              <label class="col-sm-2 control-label">Facebook:</label>
              <div class="col-sm-10">
                <p id="Facebook" class="form-control-static"></p>
                <input type="text" class="form-control hidden" id="FacebookForm" placeholder="Facebook">
              </div>
            </div>
          </li>
          <li class="list-group-item">

            <div class="form-group">
              <label class="col-sm-2 control-label">Autoriza su imagen en la web:</label>
              <div class="col-sm-10">
                <p class="intro hidden" id="AutorizaWeb"></p>
                <input type="checkbox"class="checkbox hidden" id="AutorizaWebForm" disabled>
              </div>
            </div>
          </li>
          <li class="list-group-item">

            <div class="form-group">
              <label class="col-sm-2 control-label">Apto médico:</label>
              <div class="col-sm-10">
                <p class="intro hidden" id="AptoMedico"></p>
                <input type="checkbox" class="checkbox hidden"id="AptoMedicoForm" disabled>


              </div>
            </div>
          </li>
          <li class="list-group-item">

            <div class="form-group">
              <label class="col-sm-2 control-label">Cobertura médica:</label>
              <div class="col-sm-10">
                <p id="CoberturaMedica" class="form-control-static"></p>
                <input type="text" class="form-control hidden" id="CoberturaMedicaForm" placeholder="Cobertura médica">
              </div>
            </div>
          </li>
          <li class="list-group-item">

            <div class="form-group">
              <label class="col-sm-2 control-label">Número de socio (Cobertura Médica):</label>
              <div class="col-sm-10">
                <p id="NumSocioMed" class="form-control-static"></p>
                <input type="text" class="form-control hidden" id="NumSocioMedForm" placeholder="Número de socio (Cobertura Médica)">
              </div>
            </div>
          </li>
          <li class="list-group-item">

            <div class="form-group">
              <label class="col-sm-2 control-label">Teléfono de emergencias:</label>
              <div class="col-sm-10">
                <p id="TelEmergencias" class="form-control-static"></p>
                <input type="tel" min="0" class="form-control hidden" id="TelEmergenciasForm" placeholder="Teléfono de emergencias">
              </div>
            </div>
          </li>
          <li class="list-group-item">

            <div class="form-group">
              <label class="col-sm-2 control-label">Grupo y factor sanguíneo:</label>
              <div class="col-sm-10">
                <p id="sangNombre" class="form-control-static"></p>
                <p id="IdGrupoFactorSanguineo" style="display: none; visibility: hidden;"></p>
                <select id="IdGrupoFactorSanguineoSelect" class="form-control hidden">

                </select>
                <input type="text" style="display: none; visibility: hidden;" class="form-control" id="sangNombreForm">


              </div>
            </div>
          </li>
          <li class="list-group-item">

            <div class="form-group">
              <label class="col-sm-2 control-label">Alergias:</label>
              <div class="col-sm-10">
                <p id="Alergia" class="form-control-static"></p>
                <input type="text" class="form-control hidden" id="AlergiaForm" placeholder="Alergias">
              </div>
            </div>
          </li>
          <li class="list-group-item">

            <div class="form-group">

              <label class="col-sm-2 control-label">Patologías:</label>
              <div class="col-sm-10">
                <p id="Patologia" class="form-control-static"></p>
                <input type="text" class="form-control hidden" id="PatologiaForm" placeholder="Patologías">
              </div>
            </div>
          </li>
          <li class="list-group-item">

            <div class="form-group">
              <label class="col-sm-2 control-label">Intervenciones quirúrgicas:</label>
              <div class="col-sm-10">
                <p id="IntQuirurgica" class="form-control-static"></p>
                <input type="text" class="form-control hidden" id="IntQuirurgicaForm" placeholder="Intervenciones quirúrgicas">

              </div>
            </div>
          </li>
          <li class="list-group-item">

            <div class="form-group">
              <label class="col-sm-2 control-label">Lesiones:</label>
              <div class="col-sm-10">
                <p id="Lesion" class="form-control-static"></p>
                <input type="text" class="form-control hidden" id="LesionForm" placeholder="Lesiones">
              </div>
            </div>
          </li>
          <li class="list-group-item">

            <div class="form-group">
              <label class="col-sm-2 control-label">Medicación:</label>
              <div class="col-sm-10">
                <p id="Medicacion" class="form-control-static"></p>
                <input type="text" class="form-control hidden" id="MedicacionForm" placeholder="Medicación">
              </div>
            </div>
          </li>
          <li class="list-group-item">

            <div class="form-group">
              <label class="col-sm-2 control-label">Observaciones:</label>
              <div class="col-sm-10">
                <p id="Observaciones" class="form-control-static"></p>
                <input type="text" class="form-control hidden" id="ObservacionesForm" placeholder="Observaciones">
              </div>
            </div>
          </li>
          <li class="list-group-item">

            <div class="form-group">
              <label class="col-sm-2 control-label">Padre/Madre/Tutor:</label>
              <div class="col-sm-10">
                <p id="PadMadTut" class="form-control-static"></p>
                <input type="text" class="form-control hidden" id="PadMadTutForm" placeholder="Padre/Madre/Tutor">
              </div>
            </div>
          </li>
          <li class="list-group-item">

            <div class="form-group">
              <label class="col-sm-2 control-label">Teléfono Padre/Madre/Tutor:</label>
              <div class="col-sm-10">
                <p id="TelPadMadTut" class="form-control-static"></p>
                <input type="tel" min="0" class="form-control hidden" id="TelPadMadTutForm" placeholder="Teléfono Padre/Madre/Tutor">
              </div>
            </div>
          </li>
          <li class="list-group-item">

            <div class="form-group">
              <label class="col-sm-2 control-label">Celular Padre/Madre/Tutor:</label>
              <div class="col-sm-10">
                <p id="CelPadMadTut" class="form-control-static"></p>
                <input type="tel" min="0" class="form-control hidden" id="CelPadMadTutForm" placeholder="Celular Padre/Madre/Tutor">
              </div>
            </div>
          </li>
          <li class="list-group-item">

            <div class="form-group">
              <label class="col-sm-2 control-label">E-mail Padre/Madre/Tutor:</label>
              <div class="col-sm-10">
                <p id="EmailPadMadTut" class="form-control-static"></p>
                <input type="email" class="form-control hidden" id="EmailPadMadTutForm" placeholder="Celular Padre/Madre/Tutor">
              </div>
            </div>
          </li>
          <li class="list-group-item">

            <div class="form-group">
              <label class="col-sm-2 control-label">Se va solo:</label>
              <div class="col-sm-10">

                <p class="intro hidden" id="SeVaSolo"></p>
                <input type="checkbox" class="checkbox hidden" id="SeVaSoloForm" disabled>
              </div>
            </div>
          </li>
          <li class="list-group-item">

            <div class="form-group">
              <label class="col-sm-2 control-label">Autorizado a retirar 1:</label>
              <div class="col-sm-10">
                <p id="Retirar1NomAp" class="form-control-static"></p>
                <input type="text" class="form-control hidden" id="Retirar1NomApForm" placeholder="Autorizado a retirar 1">
              </div>
            </div>
          </li>
          <li class="list-group-item">

            <div class="form-group">
              <label class="col-sm-2 control-label">Autorizado a retirar 1 DNI:</label>
              <div class="col-sm-10">
                <p id="Retirar1DNI" class="form-control-static"></p>
                <input type="number" min="0" class="form-control hidden" id="Retirar1DNIForm" placeholder="Autorizado a retirar 1 DNI">
              </div>
            </div>
          </li>

          <li class="list-group-item">
            <div class="form-group">
              <label class="col-sm-2 control-label">Autorizado a retirar 2:</label>
              <div class="col-sm-10">
                <p id="Retirar2NomAp" class="form-control-static"></p>
                <input type="text" class="form-control hidden" id="Retirar2NomApForm" placeholder="Autorizado a retirar 2">
              </div>
            </div>
          </li>
          <li class="list-group-item">

            <div class="form-group">
              <label class="col-sm-2 control-label">Autorizado a retirar 2 DNI:</label>
              <div class="col-sm-10">
                <p id="Retirar2DNI" class="form-control-static"></p>
                <input type="number" min="0" class="form-control hidden" id="Retirar2DNIForm" placeholder="Autorizado a retirar 2 DNI">
              </div>
            </div>
          </li>
          <li class="list-group-item">

            <div class="form-group">
              <label class="col-sm-2 control-label">Autorizado a retirar 3:</label>
              <div class="col-sm-10">
                <p id="Retirar3NomAp" class="form-control-static"></p>
                <input type="text" class="form-control hidden" id="Retirar3NomApForm" placeholder="Autorizado a retirar 3">
              </div>
            </div>
          </li>
          <li class="list-group-item">

            <div class="form-group">
              <label class="col-sm-2 control-label">Autorizado a retirar 3 DNI:</label>
              <div class="col-sm-10">
                <p id="Retirar3DNI" class="form-control-static"></p>
                <input type="number" min="0" class="form-control hidden" id="Retirar3DNIForm" placeholder="Autorizado a retirar 3 DNI">
              </div>
            </div>
          </li>
          <li class="list-group-item">

            <div class="form-group">
              <label class="col-sm-2 control-label">Está activo:</label>
              <div class="col-sm-10">
                <p class="intro hidden" id="Activo"></p>

                <input type="checkbox"class="checkbox hidden" id="ActivoForm" disabled>

              </div>
            </div>
          </li>
          <li class="list-group-item">

            <div class="form-group">
              <label class="col-sm-2 control-label">Es instructor:</label>
              <div class="col-sm-10">
                <p class="intro hidden" id="EsInstructor"></p>
                <input type="checkbox"class="checkbox hidden" id="EsInstructorForm" disabled>
              </div>
            </div>
          </li>
          <li class="list-group-item">

            <div class="form-group">
              <label class="col-sm-2 control-label">Categoría:</label>
              <div class="col-sm-10">
                <p id="catNombre" class="form-control-static"></p>
                <select id="IdCategoriasSelect" class="form-control hidden">

                </select>
                <input type="text" style="display: none; visibility: hidden;" class="form-control" id="catNombreForm">
              </div>
            </div>
          </li>
          <li class="list-group-item">

            <div class="form-group">
              <label class="col-sm-2 control-label">Actividades:</label>
              <div class="col-sm-10">
                <button type="button" id="IdActividadesVer" class="btn btn-link hidden" data-toggle="modal" data-target="#ModalVer">Ver actividad/es</button>

                <div class="modal fade" tabindex="-1" role="dialog" id="ModalVer">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Actividades</h4>
                      </div>
                      <div class="modal-body">
                        <table class="table table-hover" >
                          <thead>
                            <tr>
                              <th>Actividad</th>
                              <th>Pase Libre</th>
                            </tr>
                          </thead>
                          <tbody id="TablaActividades">
                          </tbody>
                        </table>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                      </div><!-- /.modal-content-->
                    </div> <!--/.modal-dialog -->
                  </div> <!--/.modal -->
                </div>
                <button type="button" id="IdActividadesSelect" class="btn btn-link hidden" data-toggle="modal" data-target="#ModalSel">Seleccionar actividad/es</button>

              </li>
              <li class="list-group-item">

                <div class="form-group">
                  <label class="col-sm-2 control-label">Sede:</label>
                  <div class="col-sm-10">
                    <p id="sedNombre" class="form-control-static"></p>
                    <select id="IdSedesSelect" class="form-control hidden">

                    </select>
                    <input type="text" style="display: none; visibility: hidden;" class="form-control" id="sedNombreForm">
                  </div>
                </div>
              </li>

            </form>
          </ul>
        </div>
        <button type="button" id="BtnAgregar" onclick="AgregarUsuario()" class="btn btn-default">Agregar Usuario</button>
        <button type="button" id="BtnModificar"onclick="ModificarUsuario()" class="btn btn-primary hidden">Modificar Usuario</button>
        <button type="button" id="BtnAceptar" onclick="EnviarUsuario()" class="btn btn-success hidden">Aceptar</button>
        <button type="button" id="BtnEliminar" onclick="EliminarUsuario()" class="btn btn-danger hidden">Eliminar Usuario</button>
      </div>
    </div>
  </div>

  <div class="modal fade" tabindex="-1" role="dialog" id="ModalSel">
    <div class="modal-dialog" role="document" >
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Seleccionar actividad/es</h4>
        </div>
        <div class="modal-body" id="Selec">

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default"onclick="deshacerModal()" data-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary" onclick="aceptarModal()"> Aceptar</button>
        </div>
      </div>
    </div><!-- /.modal-content-->
  </div> <!--/.modal-dialog -->

</div>


<script src="<?php echo URL; ?>views/recursos/logicaABM.js"></script>
<script>
function deshacerModal(){
  $("#Selec").html("<div class='col-lg-7'>\
  <h5>Actividad</h5>\
  </div>\
  <div class='col-lg-5'>\
  <h5>PaseLibre</h5>\
  </div><div class='row'>\
  <div class='col-lg-7'>\
  <select id='IdActividadesSelect1' class='form-control'>\
  <option disabled selected value>Elija una actividad</option>\
  </select>\
  </div>\
  <div class='col-lg-5'>\
  <input type='checkbox' class='checkbox' id='PaseLibre1' checked>\
  </div>\
  </div>\
  <button type='button' id='AddAct1' class='btn btn-link' onclick='AddAct(this)' >+AgregarActividad</button>");
  document.getElementById("IdActividadesSelect1").innerHTML += optionCrear(VecActividades)
}

function AddAct(bot) {
  i = bot.id.replace("AddAct", "");
  var anterior = document.getElementById("IdActividadesSelect" + i);
  if (anterior.selectedIndex == "0") {
    alert("Seleccione una actividad");
  } else {
    j = Number(i) + 1;
    $("#Selec").append("<div class='row' style='margin-top: 50px;'>\
    <div class='col-lg-7'>\
    <select id='IdActividadesSelect" + j + "' class='form-control'>\
    </select>\
    </div>\
    <div class='col-lg-5'>\
    <input type='checkbox' class='checkbox' id='PaseLibre" + j + "' checked>\
    </div>\
    </div>\
    <button type='button' id='AddAct" + j + "' class='btn btn-link' onclick='AddAct(this)' >+AgregarActividad</button>");
    var actual = document.getElementById("IdActividadesSelect" + j);
    actual.innerHTML += anterior.innerHTML;
    actual.remove(anterior.selectedIndex);
    $("#AddAct" + i).addClass('hidden')
    anterior.disabled = true;
  }

}

$('#FechaNacimientoForm').datepicker({
  format: "yyyy/mm/dd",
  endDate: "today",
  language: "es",
  autoclose: true,
});

var Cosavacia = {id: 0, Nombre: ""};
var VecActividades= [];
var bien = true;
var final = [];
function aceptarModal() {
  $('#ModalSel').modal('hide');
  final = [];
  var selects = document.getElementById("Selec").getElementsByTagName("select");
  var checks = document.getElementById("Selec").getElementsByTagName("input");
  for (var i = 0; i < selects.length; i++) {
    final[i] = {idActividades : selects[i].value};
    if (checks[i].checked) {
      final[i].PaseLibre = 1;
    }else {
      final[i].PaseLibre = 0;
    }
    if (selects[i] == "") {
      bien = false;
    }
  }
}
function optionCrear(vec) {
  var txt="";
  for (var i = 0; i < vec.length; i++) {
    if (vec[i].Nombre.length > 1) {
      txt += "<option value='" + vec[i].id + "'>" + vec[i].Nombre + "</option>";
    }
  }
  return txt;
}

var VecElementos = [];
var request = $.ajax({
  url: "<?php echo URL; ?>cliente/listadoDropdowns",
  type: "post",
});
request.done(function (respuesta){
  var myObj = JSON.parse(respuesta);
  VecActividades = myObj[1];
  VecActividadesTemp = myObj[1];
  for (vector in myObj[0]) {
    var txt = optionCrear(myObj[0][vector]);
    VecElementos.push(txt);
  }
  var i = 0;
  var selects = document.getElementById("Formu").getElementsByTagName("select");

  for (var i = 0; i < selects.length; i++) {
    selects[i].innerHTML = VecElementos[i];
  }
});


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
          clickFila(JSON.parse(respuesta)[0][0]);
          var actividades = JSON.parse(respuesta)[1];
          var texto = "";
          for (var i = 0; i < actividades.length; i++) {
            texto += "<tr>";
            texto+="<td>" + actividades[i].Nombre + "</td>";
            texto+="<td>" + actividades[i].PaseLibre + "</td>";
            texto+="</tr>";
            final.push(actividades[i].id);
          }
          $("#TablaActividades").html(texto);
          $("#IdLocalidadesSelect").addClass("hidden");
          $("#IdGrupoFactorSanguineoSelect").addClass("hidden");
          $("#IdCategoriasSelect").addClass("hidden");
          $("#IdSedesSelect").addClass("hidden");

          $("#IdActividadesSelect").addClass("hidden");
          $("#IdActividadesVer").removeClass("hidden");
        });

      }
    });
  }
  function AgregarUsuario()
  {
    $("#IdActividadesSelect").removeClass("hidden");
    $("#IdActividadesVer").addClass("hidden");
    modoFormulario("Agregar");
    deshacerModal();
    document.getElementById("ActivoForm").checked = true;
  }

  function ModificarUsuario()
  {
    $("#IdActividadesSelect").removeClass("hidden");
    $("#IdActividadesVer").addClass("hidden");
    modoFormulario("Modificar");
    deshacerModal();
    var selects = document.getElementById("Formu").getElementsByTagName("select");
    for (var i = 0; i < selects.length; i++) {
      var opciones = selects[i].options;
      for (var j = 0; j < selects[i].length; j++) {
        if (opciones[j].text == document.getElementById("locNombreForm").value || opciones[j].text == document.getElementById("sangNombreForm").value || opciones[j].text == document.getElementById("catNombreForm").value || opciones[j].text == document.getElementById("sedNombreForm").value ) {
          selects[i].selectedIndex = j;
        }
      }
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
      alert("Los siguientes campos son absolutamente obligatorios: Nombre, Apelliido, Sede, Actividades (llenar correctamente en case de no haberlo) y Categoría\n\
      (Se recomienda llenar todos)");
    } else {
      document.getElementById("locNombreForm").value = document.getElementById("IdLocalidadesSelect").value;
      document.getElementById("sangNombreForm").value = document.getElementById("IdGrupoFactorSanguineoSelect").value;
      document.getElementById("catNombreForm").value = document.getElementById("IdCategoriasSelect").value;
      document.getElementById("sedNombreForm").value = document.getElementById("IdSedesSelect").value;
      vec = beforeEnviar();
      request = $.ajax({
        url: "<?php echo URL; ?>cliente/agregarModificarCliente",
        type: "post",
        data:  "data1=" + JSON.stringify(vec) + "&data2=" + JSON.stringify(final)
      });
      request.done(function (respuesta){
        $("#IdActividadesSelect").addClass("hidden");
        afterEnviar();
      });

    }
  }

  function EliminarUsuario() {
    var r = confirm("Estás muy recontra segurísima/o que querés borrar a este cliente?\n\
    Esta funcionalidad se ha creado solo para casos extremos.");
    if (r == true) {
      request = $.ajax({
        url: "<?php echo URL; ?>cliente/eliminarCliente",
        type: "post",
        data: "data=" + document.getElementById("idClientes").innerHTML,
      });
      request.done(function (respuesta){
        eliminarError(respuesta);
      });

    }
  }
  </script>
