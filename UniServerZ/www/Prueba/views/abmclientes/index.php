<script src="<?php echo URL; ?>views/recursos/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo URL; ?>views/recursos/bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js" charset="UTF-8"></script>
<link href="<?php echo URL; ?>views/recursos/bootstrap-datepicker/css/bootstrap-datepicker3.standalone.min.css" rel="stylesheet">
<div class="row" style="height:100%;">
  <div class="col-lg-6">
    <div class="panel panel-default">
      <div class="panel-heading">Listado de Clientes
      </div>
      <div class="table-responsive col-sm-12">
        <table  id="TablaClientes" class="table table-hover" cellspacing="0" width="100%"  >
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
                <input type="text" style="display: none;" class="form-control" id="idClientesForm" placeholder="Se mira y no se toca" disabled>

              </div>
            </div>
          </li>
          <li class="list-group-item">
            <div class="form-group">

              <label class="col-sm-2 control-label">Nombres:</label>
              <div class="col-sm-10">
                <p id="Nombres" class="form-control-static"></p>
                <input type="text" style="display: none;" class="form-control" id="NombresForm" placeholder="Nombres">
              </div>

            </div>
          </li>
          <li class="list-group-item">
            <div class="form-group">
              <label class="col-sm-2 control-label">Apellidos:</label>
              <div class="col-sm-10">
                <p id="Apellidos" class="form-control-static"></p>
                <input type="text" style="display: none;" class="form-control" id="ApellidosForm" placeholder="Apellidos">

              </div>
            </div>
          </li>
          <li class="list-group-item">
            <div class="form-group">
              <label class="col-sm-2 control-label">Fecha de Nacimiento:</label>
              <div class="col-sm-10">
                <p id="FechaNacimiento" class="form-control-static"></p>
                <input type="text" style="display: none;" class="form-control" id="FechaNacimientoForm" placeholder="Fecha de Nacimiento">
              </div>
            </div>
          </li>
          <li class="list-group-item">
            <div class="form-group">
              <label class="col-sm-2 control-label">DNI:</label>
              <div class="col-sm-10">
                <p id="DNI" class="form-control-static"></p>
                <input type="number" min="0" style="display: none;" class="form-control" id="DNIForm" placeholder="DNI">

              </div>
            </div>
          </li>

          <li class="list-group-item">
            <div class="form-group">
              <label class="col-sm-2 control-label">Domicilio:</label>
              <div class="col-sm-10">
                <p id="Domicilio" class="form-control-static"></p>
                <input type="text" style="display: none;" class="form-control" id="DomicilioForm" placeholder="Domicilio">

              </div>
            </div>
          </li>
          <li class="list-group-item">
            <div class="form-group">

              <label class="col-sm-2 control-label">Localidad:</label>
              <div class="col-sm-10">
                <p id="locNombre" class="form-control-static"></p>
                <select id="IdLocalidadesSelect" class="form-control"style="display: none;">

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
                <input type="text" style="display: none;" class="form-control" id="CPostalForm" placeholder="Código Postal">
              </div>
            </div>
          </li>
          <li class="list-group-item">

            <div class="form-group">
              <label class="col-sm-2 control-label">Teléfono/</br>Celular:</label>
              <div class="col-sm-10">
                <p id="TelCel" class="form-control-static"></p>
                <input type="tel" min="0" style="display: none;" class="form-control" id="TelCelForm" placeholder="Teléfono/Celular">

              </div>
            </div>
          </li>
          <li class="list-group-item">

            <div class="form-group">
              <label class="col-sm-2 control-label">Ocupación:</label>
              <div class="col-sm-10">
                <p id="Ocupacion" class="form-control-static"></p>
                <input type="text" style="display: none;" class="form-control" id="OcupacionForm" placeholder="Ocupación">

              </div>
            </div>
          </li>
          <li class="list-group-item">

            <div class="form-group">
              <label class="col-sm-2 control-label">E-mail:</label>
              <div class="col-sm-10">
                <p id="Email" class="form-control-static"></p>
                <input type="email" style="display: none;" class="form-control" id="EmailForm" placeholder="E-mail">

              </div>
            </div>
          </li>
          <li class="list-group-item">

            <div class="form-group">
              <label class="col-sm-2 control-label">Facebook:</label>
              <div class="col-sm-10">
                <p id="Facebook" class="form-control-static"></p>
                <input type="text" style="display: none;" class="form-control" id="FacebookForm" placeholder="Facebook">
              </div>
            </div>
          </li>
          <li class="list-group-item">

            <div class="form-group">
              <label class="col-sm-2 control-label">Autoriza su imagen en la web:</label>
              <div class="col-sm-10">
                <p class="intro" id="AutorizaWeb" hidden></p>
                <input type="checkbox"class="checkbox disabled"style="display: none;" id="AutorizaWebForm" disabled>
              </div>
            </div>
          </li>
          <li class="list-group-item">

            <div class="form-group">
              <label class="col-sm-2 control-label">Apto médico:</label>
              <div class="col-sm-10">
                <p class="intro" id="AptoMedico" hidden></p>
                <input type="checkbox" class="checkbox"style="display: none;"id="AptoMedicoForm" disabled>


              </div>
            </div>
          </li>
          <li class="list-group-item">

            <div class="form-group">
              <label class="col-sm-2 control-label">Cobertura médica:</label>
              <div class="col-sm-10">
                <p id="CoberturaMedica" class="form-control-static"></p>
                <input type="text" style="display: none;" class="form-control" id="CoberturaMedicaForm" placeholder="Cobertura médica">
              </div>
            </div>
          </li>
          <li class="list-group-item">

            <div class="form-group">
              <label class="col-sm-2 control-label">Número de socio (Cobertura Médica):</label>
              <div class="col-sm-10">
                <p id="NumSocioMed" class="form-control-static"></p>
                <input type="text" style="display: none;" class="form-control" id="NumSocioMedForm" placeholder="Número de socio (Cobertura Médica)">
              </div>
            </div>
          </li>
          <li class="list-group-item">

            <div class="form-group">
              <label class="col-sm-2 control-label">Teléfono de emergencias:</label>
              <div class="col-sm-10">
                <p id="TelEmergencias" class="form-control-static"></p>
                <input type="tel" min="0" style="display: none;" class="form-control" id="TelEmergenciasForm" placeholder="Teléfono de emergencias">
              </div>
            </div>
          </li>
          <li class="list-group-item">

            <div class="form-group">
              <label class="col-sm-2 control-label">Grupo y factor sanguíneo:</label>
              <div class="col-sm-10">
                <p id="sangNombre" class="form-control-static"></p>
                <p id="IdGrupoFactorSanguineo" style="display: none; visibility: hidden;"></p>
                <select id="IdGrupoFactorSanguineoSelect" class="form-control"style="display: none;">

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
                <input type="text" style="display: none;" class="form-control" id="AlergiaForm" placeholder="Alergias">
              </div>
            </div>
          </li>
          <li class="list-group-item">

            <div class="form-group">

              <label class="col-sm-2 control-label">Patologías:</label>
              <div class="col-sm-10">
                <p id="Patologia" class="form-control-static"></p>
                <input type="text" style="display: none;" class="form-control" id="PatologiaForm" placeholder="Patologías">
              </div>
            </div>
          </li>
          <li class="list-group-item">

            <div class="form-group">
              <label class="col-sm-2 control-label">Intervenciones quirúrgicas:</label>
              <div class="col-sm-10">
                <p id="IntQuirurgica" class="form-control-static"></p>
                <input type="text" style="display: none;" class="form-control" id="IntQuirurgicaForm" placeholder="Intervenciones quirúrgicas">

              </div>
            </div>
          </li>
          <li class="list-group-item">

            <div class="form-group">
              <label class="col-sm-2 control-label">Lesiones:</label>
              <div class="col-sm-10">
                <p id="Lesion" class="form-control-static"></p>
                <input type="text" style="display: none;" class="form-control" id="LesionForm" placeholder="Lesiones">
              </div>
            </div>
          </li>
          <li class="list-group-item">

            <div class="form-group">
              <label class="col-sm-2 control-label">Medicación:</label>
              <div class="col-sm-10">
                <p id="Medicacion" class="form-control-static"></p>
                <input type="text" style="display: none;" class="form-control" id="MedicacionForm" placeholder="Medicación">
              </div>
            </div>
          </li>
          <li class="list-group-item">

            <div class="form-group">
              <label class="col-sm-2 control-label">Observaciones:</label>
              <div class="col-sm-10">
                <p id="Observaciones" class="form-control-static"></p>
                <input type="text" style="display: none;" class="form-control" id="ObservacionesForm" placeholder="Observaciones">
              </div>
            </div>
          </li>
          <li class="list-group-item">

            <div class="form-group">
              <label class="col-sm-2 control-label">Padre/Madre/Tutor:</label>
              <div class="col-sm-10">
                <p id="PadMadTut" class="form-control-static"></p>
                <input type="text" style="display: none;" class="form-control" id="PadMadTutForm" placeholder="Padre/Madre/Tutor">
              </div>
            </div>
          </li>
          <li class="list-group-item">

            <div class="form-group">
              <label class="col-sm-2 control-label">Teléfono Padre/Madre/Tutor:</label>
              <div class="col-sm-10">
                <p id="TelPadMadTut" class="form-control-static"></p>
                <input type="tel" min="0" style="display: none;" class="form-control" id="TelPadMadTutForm" placeholder="Teléfono Padre/Madre/Tutor">
              </div>
            </div>
          </li>
          <li class="list-group-item">

            <div class="form-group">
              <label class="col-sm-2 control-label">Celular Padre/Madre/Tutor:</label>
              <div class="col-sm-10">
                <p id="CelPadMadTut" class="form-control-static"></p>
                <input type="tel" min="0" style="display: none;" class="form-control" id="CelPadMadTutForm" placeholder="Celular Padre/Madre/Tutor">
              </div>
            </div>
          </li>
          <li class="list-group-item">

            <div class="form-group">
              <label class="col-sm-2 control-label">E-mail Padre/Madre/Tutor:</label>
              <div class="col-sm-10">
                <p id="EmailPadMadTut" class="form-control-static"></p>
                <input type="email" style="display: none;" class="form-control" id="EmailPadMadTutForm" placeholder="Celular Padre/Madre/Tutor">
              </div>
            </div>
          </li>
          <li class="list-group-item">

            <div class="form-group">
              <label class="col-sm-2 control-label">Se va solo:</label>
              <div class="col-sm-10">

                <p class="intro" id="SeVaSolo" hidden></p>
                <input type="checkbox" class="checkbox" style="display: none;" id="SeVaSoloForm" disabled>
              </div>
            </div>
          </li>
          <li class="list-group-item">

            <div class="form-group">
              <label class="col-sm-2 control-label">Autorizado a retirar 1:</label>
              <div class="col-sm-10">
                <p id="Retirar1NomAp" class="form-control-static"></p>
                <input type="text" style="display: none;" class="form-control" id="Retirar1NomApForm" placeholder="Autorizado a retirar 1">
              </div>
            </div>
          </li>
          <li class="list-group-item">

            <div class="form-group">
              <label class="col-sm-2 control-label">Autorizado a retirar 1 DNI:</label>
              <div class="col-sm-10">
                <p id="Retirar1DNI" class="form-control-static"></p>
                <input type="number" min="0" style="display: none;" class="form-control" id="Retirar1DNIForm" placeholder="Autorizado a retirar 1 DNI">
              </div>
            </div>
          </li>

          <li class="list-group-item">
            <div class="form-group">
              <label class="col-sm-2 control-label">Autorizado a retirar 2:</label>
              <div class="col-sm-10">
                <p id="Retirar2NomAp" class="form-control-static"></p>
                <input type="text" style="display: none;" class="form-control" id="Retirar2NomApForm" placeholder="Autorizado a retirar 2">
              </div>
            </div>
          </li>
          <li class="list-group-item">

            <div class="form-group">
              <label class="col-sm-2 control-label">Autorizado a retirar 2 DNI:</label>
              <div class="col-sm-10">
                <p id="Retirar2DNI" class="form-control-static"></p>
                <input type="number" min="0" style="display: none;" class="form-control" id="Retirar2DNIForm" placeholder="Autorizado a retirar 2 DNI">
              </div>
            </div>
          </li>
          <li class="list-group-item">

            <div class="form-group">
              <label class="col-sm-2 control-label">Autorizado a retirar 3:</label>
              <div class="col-sm-10">
                <p id="Retirar3NomAp" class="form-control-static"></p>
                <input type="text" style="display: none;" class="form-control" id="Retirar3NomApForm" placeholder="Autorizado a retirar 3">
              </div>
            </div>
          </li>
          <li class="list-group-item">

            <div class="form-group">
              <label class="col-sm-2 control-label">Autorizado a retirar 3 DNI:</label>
              <div class="col-sm-10">
                <p id="Retirar3DNI" class="form-control-static"></p>
                <input type="number" min="0" style="display: none;" class="form-control" id="Retirar3DNIForm" placeholder="Autorizado a retirar 3 DNI">
              </div>
            </div>
          </li>
          <li class="list-group-item">

            <div class="form-group">
              <label class="col-sm-2 control-label">Está activo:</label>
              <div class="col-sm-10">
                <p class="intro" id="Activo" hidden></p>

                <input type="checkbox"class="checkbox" style="display: none;"id="ActivoForm" disabled>

              </div>
            </div>
          </li>
          <li class="list-group-item">

            <div class="form-group">
              <label class="col-sm-2 control-label">Es instructor:</label>
              <div class="col-sm-10">
                <p class="intro" id="EsInstructor" hidden></p>
                <input type="checkbox"class="checkbox"style="display: none;" id="EsInstructorForm" disabled>
              </div>
            </div>
          </li>
          <li class="list-group-item">

            <div class="form-group">
              <label class="col-sm-2 control-label">Categoría:</label>
              <div class="col-sm-10">
                <p id="catNombre" class="form-control-static"></p>
                <select id="IdCategoriasSelect" class="form-control"style="display: none;">

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
                              <th>Modalidad</th>
                              <th>Nivel</th>
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
                    <select id="IdSedesSelect" class="form-control" style="display: none;">

                    </select>
                    <input type="text" style="display: none; visibility: hidden;" class="form-control" id="sedNombreForm">
                  </div>
                </div>
              </li>

            </form>
          </ul>
        </div>
        <button type="button" id="BtnAgregar" onclick="AgregarUsuario()" class="btn btn-default">Agregar Usuario</button>
        <button type="button" id="BtnModificar"onclick="ModificarUsuario()" class="btn btn-primary">Modificar Usuario</button>
        <button type="button" id="BtnAceptar" onclick="EnviarUsuario()" class="btn btn-success">Aceptar</button>
        <button type="button" id="BtnEliminar"id="BtnAgregar"onclick="EliminarUsuario()" class="btn btn-danger">Eliminar Usuario</button>
      </div>
      <div class="modal fade" tabindex="-1" role="dialog" id="ModalSel">
        <div class="modal-dialog" role="document" >
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Seleccionar actividad/es</h4>
            </div>
            <div class="modal-body" id="Selec">

              <div class="row" id="Act1">
                <div class="col-md-4">
                  <select id="IdActividadesSelect1" class="form-control" onchange="ActividadesSelect1()">
                  </select>
                </div>
                <div class="col-md-4">
                  <select id="IdModalidadesSelect1" class="form-control hidden">
                    <option disabled selected value>Modalidad</option>
                    <option value='1'>1 a 2 veces por semana</option>
                    <option value='2'>Pase Libre</option>
                  </select>
                </div>
                <div class="col-md-4">
                  <select id="IdNivelesSelect1" class="form-control hidden">
                    <option disabled selected value>Nivel</option>
                    <option value='1'>Inicial</option>
                    <option value='2'>Infantiles A</option>
                    <option value='3'>Infantiles B</option>
                    <option value='4'>Juveniles y Adultos</option>
                    <option value='5'>Mañana</option>
                    <option value='6'>Tarde</option>
                    <option value='7'>Noche</option>

                  </select>
                </div>
              </div>
              <button type="button" id="AddAct1" class="btn btn-link" onclick="AddAct1()" >+AgregarActividad</button>
              <div class="collapse" id="Act2">
                <div class="row" style="margin-top: 50px;">
                  <div class="col-md-4">
                    <select id="IdActividadesSelect2" class="form-control" onchange="ActividadesSelect2()">
                    </select>
                  </div>
                  <div class="col-md-4">
                    <select id="IdModalidadesSelect2" class="form-control hidden">
                      <option disabled selected value>Modalidad</option>
                      <option value='1'>1 a 2 veces por semana</option>
                      <option value='2'>Pase Libre</option>
                    </select>
                  </div>
                  <div class="col-md-4">
                    <select id="IdNivelesSelect2" class="form-control hidden">
                      <option disabled selected value>Nivel</option>
                      <option value='1'>Inicial</option>
                      <option value='2'>Infantiles A</option>
                      <option value='3'>Infantiles B</option>
                      <option value='4'>Juveniles y Adultos</option>
                      <option value='5'>Mañana</option>
                      <option value='6'>Tarde</option>
                      <option value='7'>Noche</option>
                    </select>
                  </div>
                </div>
                <button type="button" id="AddAct2" class="btn btn-link" onclick="AddAct2();">+AgregarActividad</button>
                <div class="collapse" id="Act3">
                  <div class="row" style="margin-top: 50px;">
                    <div class="col-md-4">
                      <select id="IdActividadesSelect3" class="form-control" onchange="ActividadesSelect3()">
                      </select>
                    </div>
                    <div class="col-md-4">
                      <select id="IdModalidadesSelect3" class="form-control hidden">
                        <option disabled selected value>Modalidad</option>
                        <option value='1'>1 a 2 veces por semana</option>
                        <option value='2'>Pase Libre</option>
                      </select>
                    </div>
                    <div class="col-md-4">
                      <select id="IdNivelesSelect3" class="form-control hidden">
                        <option disabled selected value>Nivel</option>
                        <option value='1'>Inicial</option>
                        <option value='2'>Infantiles A</option>
                        <option value='3'>Infantiles B</option>
                        <option value='4'>Juveniles y Adultos</option>
                        <option value='5'>Mañana</option>
                        <option value='6'>Tarde</option>
                        <option value='7'>Noche</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default"onclick="deshacerModal()" data-dismiss="modal">Cancelar</button>
              <button type="button" class="btn btn-primary" onclick="aceptarModal()"> Aceptar</button>
            </div>
          </div>
        </div><!-- /.modal-content-->
      </div> <!--/.modal-dialog -->
    </div> <!--/.modal -->
  </div>
  <script>
  $( document ).ajaxError(function(e, xhr, opt){
    alert("Error requesting " + opt.url + ": " + xhr.status + " " + xhr.statusText);
  });
  function deshacerModal(){
    for (var i = 1; i < 4; i++) {
      $("#IdModalidadesSelect" + i).addClass("hidden");
      $("#IdNivelesSelect" + i).addClass("hidden");
      $("#IdActividadesSelect" + i).removeAttr( "disabled" );
      $("#IdActividadesSelect" + i).html("<option disabled selected value>Actividad:</option>" +  optionCrear(repetitivaCrear(Ids, Nombres)));
      document.getElementById("IdActividadesSelect" + i).selectedIndex ="0";
      document.getElementById("IdNivelesSelect" + i).selectedIndex ="0";
      document.getElementById("IdModalidadesSelect" + i).selectedIndex ="0";
    }
    $("#AddAct1").removeClass('hidden');
    $("#AddAct2").removeClass('hidden');
    $("#Act3").collapse('hide');
    $("#Act2").collapse('hide');
  }

  $('#FechaNacimientoForm').datepicker({
    format: "yyyy/mm/dd",
    endDate: "today",
    language: "es",
    autoclose: true,
  });
  document.getElementById("BtnModificar").style.display = 'none';
  document.getElementById("BtnEliminar").style.display = 'none';
  document.getElementById("BtnAceptar").style.display = 'none';
  var Cosavacia = {id: 0, Nombre: ""};
  var Ids = [1, 2, 3];
  var Nombres = ["Taekwon-Do", "Funcional", "Personalizado"];
  var VecActividades = repetitivaCrear(Ids, Nombres);
  var IdsNiv = [1, 2, 3, 4];
  var NombresNiv = ["Inicial", "Infantiles A", "Infantiles B", "Juveniles y Adultos"];
  var VecNiveles1 = repetitivaCrear(IdsNiv, NombresNiv);
  IdsNiv = [5, 6, 7];
  NombresNiv = ["Mañana", "Tarde", "Noche"];
  var VecNiveles2 = repetitivaCrear(IdsNiv, NombresNiv);
  var bien = true;
  var final = [];
  function aceptarModal() {
    final = [];
    $('#ModalSel').modal('hide');
    var todo = [];
    todo.push(document.getElementById("Act1").getElementsByTagName("select"));
    todo.push(document.getElementById("Act2").getElementsByTagName("select"));
    todo.push(document.getElementById("Act3").getElementsByTagName("select"));
    for (var i = 0; i < 3; i++) {
      switch (todo[i][0].value) {
        case "1":
        if (todo[i][1].value == "" || todo[i][2].value == "") {
          alert("Llena todo forro");
          bien = false;
        }
        break;
        case "2":
        if (todo[i][2].value == "") {
          alert("Llena todo forro");
          bien = false;
        }
      }
    }
    if (todo[0][0].value=="") {
      bien = false;
    }
    for (var i = 0; i < 3; i++) {
      var resul = [];
      for (var j = 0; j < 3; j++) {
        if (todo[i][j].value != "") {
          resul.push(todo[i][j].value);
        }
      }
      final.push(resul);
    }
    final = JSON.stringify(final);
  }
  function ActividadesSelect1() {
    $("#AddAct1").removeClass('hidden');
    switch ($('#IdActividadesSelect1').val()) {
      case "1":
      $('#IdModalidadesSelect1').removeClass('hidden');
      $('#IdNivelesSelect1').removeClass('hidden');
      document.getElementById("IdNivelesSelect1").innerHTML= optionCrear(VecNiveles1);
      break;
      case "2":
      $('#IdModalidadesSelect1').addClass('hidden');
      $('#IdNivelesSelect1').removeClass('hidden');
      $('#IdModalidadesSelect1').val('');
      document.getElementById("IdNivelesSelect1").innerHTML= optionCrear(VecNiveles2);

      break;
      case "3":
      $('#IdModalidadesSelect1').addClass('hidden');
      $('#IdNivelesSelect1').addClass('hidden');
      $('#IdModalidadesSelect1').val('');
      $('#IdNivelesSelect1').val('');
    }
  }
  function ActividadesSelect2() {
    $("#AddAct2").removeClass('hidden');
    switch ($('#IdActividadesSelect2').val()) {
      case "1":
      $('#IdModalidadesSelect2').removeClass('hidden');
      $('#IdNivelesSelect2').removeClass('hidden');
      document.getElementById("IdNivelesSelect2").innerHTML= optionCrear(VecNiveles1);
      break;
      case "2":
      $('#IdModalidadesSelect2').addClass('hidden');
      $('#IdNivelesSelect2').removeClass('hidden');
      $('#IdModalidadesSelect2').val('');
      document.getElementById("IdNivelesSelect2").innerHTML= optionCrear(VecNiveles2);
      break;
      case "3":
      $('#IdModalidadesSelect2').addClass('hidden');
      $('#IdNivelesSelect2').addClass('hidden');
      $('#IdModalidadesSelect2').val('');
      $('#IdNivelesSelect2').val('');
    }
  }
  function ActividadesSelect3() {
    switch ($('#IdActividadesSelect3').val()) {
      case "1":
      $('#IdModalidadesSelect3').removeClass('hidden');
      $('#IdNivelesSelect3').removeClass('hidden');
      document.getElementById("IdNivelesSelect3").innerHTML= optionCrear(VecNiveles1);
      break;
      case "2":
      $('#IdModalidadesSelect3').addClass('hidden');
      $('#IdNivelesSelect3').removeClass('hidden');
      $('#IdModalidadesSelect3').val('');
      document.getElementById("IdNivelesSelect3").innerHTML= optionCrear(VecNiveles2);
      break;
      case "3":
      $('#IdModalidadesSelect3').addClass('hidden');
      $('#IdNivelesSelect3').addClass('hidden');
      $('#IdModalidadesSelect3').val('');
      $('#IdNivelesSelect3').val('');
    }
  }
  function AddAct1() {
    if (document.getElementById("IdActividadesSelect1").selectedIndex =="0") {
      alert("Seleccione una actividad");
    } else {
      document.getElementById("IdActividadesSelect2").remove(document.getElementById("IdActividadesSelect1").value);
      document.getElementById("IdActividadesSelect3").remove(document.getElementById("IdActividadesSelect1").value);
      $("#Act2").collapse('show');
      $('#IdActividadesSelect1').prop("disabled", true);
      $("#AddAct1").addClass('hidden');
      $("#AddAct2").removeClass('hidden');
      $("#IdActividadesSelect2").removeClass('hidden');
    }

  }
  function AddAct2() {
    if (document.getElementById("IdActividadesSelect2").selectedIndex =="0") {
      alert("Seleccione una actividad");
    } else {
      document.getElementById("IdActividadesSelect3").remove(document.getElementById("IdActividadesSelect2").selectedIndex);
      $("#Act3").collapse('show');
      $('#IdActividadesSelect2').prop("disabled", true);
      $("#AddAct2").addClass('hidden');
      $("#AddAct3").removeClass('hidden');
      $("#IdActividadesSelect3").removeClass('hidden');
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
  function repetitivaCrear(Ids, Nombres) {
    var Cosa = [];
    var Vec = [];
    for (var i = 0; i < Ids.length; i++) {
      Cosa = {id: Ids[i], Nombre: Nombres[i]};
      Vec.push(Cosa);
    }
    return Vec;
  }
  var VecElementos = [];
  var request = $.ajax({
    url: "<?php echo URL; ?>cliente/listadoDropdowns",
    type: "post",
  });
  request.done(function (respuesta){
    var myObj = JSON.parse(respuesta);
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
    var table = $("#TablaClientes").DataTable(
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
            var casifinal = [];
            var sub=[];
            for (act in actividades) {
              texto += "<tr>"
              for (prop in actividades[act]) {
                switch (actividades[act][prop]) {
                  case "Taekwon-Do":
                  case "1 a 2 veces por semana":
                  case "Inicial":
                  sub.push("1");
                  break;
                  case "Funcional":
                  case "Pase libre":
                  case "Infantiles A":
                  sub.push("2");
                  break;
                  case "Personalizado":
                  case "Infantiles B":
                  sub.push("3");
                  break;
                  case "Juveniles y Adultos":
                  sub.push("4");
                  break;
                  case "Mañana":
                  sub.push("5");
                  break;
                  case "Tarde":
                  sub.push("6");
                  break;
                  case "Noche":
                  sub.push("7");
                  break;
                }
                if (actividades[act][prop] != null) {
                  texto+="<td>" + actividades[act][prop] + "</td>"
                } else {
                  texto+="<td>-</td>"
                }
              }
              texto+="</tr>"
              casifinal.push(sub);
              sub=[];
            }
            if (casifinal.length<3) {
              for (var i = 0; i < 3-casifinal.length; i++) {
                casifinal.push(sub);
              }
            }
            final =JSON.stringify(casifinal);
            $("#TablaActividades").html(texto);
            document.getElementById("IdLocalidadesSelect").style.display = 'none';
            document.getElementById("IdGrupoFactorSanguineoSelect").style.display = 'none';
            document.getElementById("IdCategoriasSelect").style.display = 'none';
            $("#IdActividadesVer").removeClass("hidden");
            $("#IdActividadesSelect").addClass("hidden");
            document.getElementById("IdSedesSelect").style.display = 'none';
            document.getElementById("BtnModificar").style.display = 'inline-block';
            document.getElementById("BtnEliminar").style.display = 'inline-block';
            document.getElementById("BtnAceptar").style.display = 'none';
          });

        }
      });
    }
    function AgregarUsuario()
    {
      document.getElementById("IdLocalidadesSelect").style.display = 'none';
      document.getElementById("IdGrupoFactorSanguineoSelect").style.display = 'none';
      document.getElementById("IdCategoriasSelect").style.display = 'none';
      document.getElementById("IdSedesSelect").style.display = 'none';
      $("#IdActividadesSelect").removeClass("hidden");
      $("#IdActividadesVer").addClass("hidden");
      mostrarOcultar();
      var x = document.getElementById("Formu").getElementsByClassName("form-control-static");
      var y = document.getElementById("Formu").getElementsByClassName("form-control");
      for (var i = 0; i < x.length; i++) {
        x[i].style.display = 'none';
      }
      for (var i = 0; i < y.length; i++) {
        y[i].style.display = 'block';
        y[i].value = null;
      }
      var z = document.getElementsByClassName("checkbox");
      for (var i = 0; i < z.length; i++) {
        z[i].disabled = false;
        z[i].style.display = 'block';
      }
      document.getElementById("ActivoForm").checked = true;
    }
    function mostrarOcultar(){
      deshacerModal();
      document.getElementById("BtnAceptar").style.display = 'inline-block';
      document.getElementById("BtnAgregar").style.display = 'none';
      document.getElementById("BtnModificar").style.display = 'none';
      document.getElementById("BtnEliminar").style.display = 'none';
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

        request = $.ajax({
          url: "<?php echo URL; ?>cliente/agregarModificarCliente",
          type: "post",
          data:  "data1=" + JSON.stringify(vec) + "&data2=" + final,
        });
        // Callback handler that will be called on success
        request.done(function (respuesta){
          // Log a message to the console
          mostrarOcultar3();
        });

      }
    }
    function mostrarOcultar3(){
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
      document.getElementById("BtnAgregar").style.display = 'inline-block';
      document.getElementById("BtnModificar").style.display = 'none';
      document.getElementById("BtnEliminar").style.display = 'none';
      document.getElementById("BtnAceptar").style.display = 'none';
      $('#TablaClientes').DataTable().clear().draw().ajax.reload();
    }

    function EliminarUsuario() {
      var r = confirm("Estás muy recontra segurísima que querés borrar a este cliente?\n\
      Esta funcionalidad se ha creado solo para casos extremos.");
      if (r == true) {
        request = $.ajax({
          url: "<?php echo URL; ?>cliente/eliminarCliente",
          type: "post",
          data: "data=" + document.getElementById("idClientes").innerHTML,
        });
        // Callback handler that will be called on success
        request.done(function (respuesta){
          // Log a message to the console
          mostrarOcultar3();
        });

      }
    }
    </script>
