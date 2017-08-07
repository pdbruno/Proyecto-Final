<script src="<?php echo URL; ?>views/recursos/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo URL; ?>views/recursos/bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js" charset="UTF-8"></script>
<link href="<?php echo URL; ?>views/recursos/bootstrap-datepicker/css/bootstrap-datepicker3.standalone.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo URL; ?>views/recursos/bootstrap-table/bootstrap-table.min.css">
<script src="<?php echo URL; ?>views/recursos/bootstrap-table/bootstrap-table.min.js"></script>
<script src="<?php echo URL; ?>views/recursos/bootstrap-table/bootstrap-table-es-AR.min.js"></script>
<div class="row" style="height:100%;">
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
                <p id="idLocalidades" class="form-control-static"></p>
                <select id="idLocalidadesSelect" class="form-control hidden">

                </select>
                <input type="text" style="display: none; visibility: hidden;" class="form-control" id="idLocalidadesForm">

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
                <p id="idGrupoFactorSanguineo" class="form-control-static"></p>
                <select id="idGrupoFactorSanguineoSelect" class="form-control hidden">
                </select>
                <input type="text" style="display: none; visibility: hidden;" class="form-control" id="idGrupoFactorSanguineoForm">


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
                <p id="idCategorias" class="form-control-static"></p>
                <select id="idCategoriasSelect" class="form-control hidden">

                </select>
                <input type="text" style="display: none; visibility: hidden;" class="form-control" id="idCategoriasForm">
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
                    <p id="idSedes" class="form-control-static"></p>
                    <select id="idSedesSelect" class="form-control hidden">

                    </select>
                    <input type="text" style="display: none; visibility: hidden;" class="form-control" id="idSedesForm">
                  </div>
                </div>
              </li>

            </form>
          </ul>
        </div>
        <button type="button" id="BtnAgregar"  class="btn btn-default">Agregar</button>
        <button type="button" id="BtnModificar" class="btn btn-primary hidden">Modificar</button>
        <button type="button" id="BtnAceptar" class="btn btn-success hidden">Aceptar</button>
        <button type="button" id="BtnEliminar" class="btn btn-danger hidden">Eliminar</button>
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
          <button type="button" class="btn btn-default" id="deshacerModal" data-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary" id="aceptarModal"> Aceptar</button>
        </div>
      </div>
    </div><!-- /.modal-content-->
  </div> <!--/.modal-dialog -->

</div>


<script src="<?php echo URL; ?>views/recursos/logicaABM.js"></script>
<?php require 'abmclientes.php' ?>
