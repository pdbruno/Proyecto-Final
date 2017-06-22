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
                                <input type="date" style="display: none;" class="form-control" id="FechaNacimientoForm" placeholder="Fecha de Nacimiento">
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
                                <input type="checkbox"class="checkbox"style="display: none;" id="AutorizaWebForm" disabled>
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
                                <button type="button" id="actNombre" class="btn btn-link" data-toggle="modal" data-target="#ModalVer">Ver actividad/es</button>






                                <div class="modal fade" tabindex="-1" role="dialog" id="ModalVer">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title">Modal title</h4>
                                            </div>
                                            <div class="modal-body">
                                                <p>One fine body&hellip;</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </div><!-- /.modal-content--> 
                                    </div> <!--/.modal-dialog --> 
                                </div> <!--/.modal -->  
                                <button type="button" id="IdActividadesSelect" class="btn btn-link" data-toggle="modal" data-target="#ModalSel">Seleccionar actividad/es</button>









                                <div class="modal fade" tabindex="-1" role="dialog" id="ModalSel">
                                    <div class="modal-dialog" role="document" >
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title">Seleccionar actividad/es</h4>
                                            </div>
                                            <div class="modal-body">

                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <select id="IdActividadesSelect1" class="form-control" oninput="$('#IdModalidadesSelect1').removeClass('hidden');">
                                                            <option value="volvo">Volvo</option>
                                                            <option value="saab">Saab</option>
                                                            <option value="mercedes">Mercedes</option>
                                                            <option value="audi">Audi</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <select id="IdModalidadesSelect1" class="form-control hidden" oninput="$('#IdNivelesSelect1').removeClass('hidden');">
                                                            <option value="volvo">Volvo</option>
                                                            <option value="saab">Saab</option>
                                                            <option value="mercedes">Mercedes</option>
                                                            <option value="audi">Audi</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <select id="IdNivelesSelect1" class="form-control hidden">
                                                            <option value="volvo">Volvo</option>
                                                            <option value="saab">Saab</option>
                                                            <option value="mercedes">Mercedes</option>
                                                            <option value="audi">Audi</option>
                                                        </select>
                                                    </div>

                                                </div>


                                                <button type="button" id="AddAct1" class="btn btn-link" onclick="$(this).hide();" data-toggle="collapse" href="#Act1">+AgregarActividad</button>

                                                <div class="collapse" id="Act1">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <select id="IdActividadesSelect2" class="form-control" oninput="$('#IdModalidadesSelect2').removeClass('hidden');">
                                                                <option value="volvo">Volvo</option>
                                                                <option value="saab">Saab</option>
                                                                <option value="mercedes">Mercedes</option>
                                                                <option value="audi">Audi</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <select id="IdModalidadesSelect2" class="form-control hidden" oninput="$('#IdNivelesSelect2').removeClass('hidden');">
                                                                <option value="volvo">Volvo</option>
                                                                <option value="saab">Saab</option>
                                                                <option value="mercedes">Mercedes</option>
                                                                <option value="audi">Audi</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <select id="IdNivelesSelect2" class="form-control hidden">
                                                                <option value="volvo">Volvo</option>
                                                                <option value="saab">Saab</option>
                                                                <option value="mercedes">Mercedes</option>
                                                                <option value="audi">Audi</option>
                                                            </select>
                                                        </div>

                                                    </div>
                                                    <button type="button" id="AddAct2" class="btn btn-link" data-toggle="collapse" href="#Act2">+AgregarActividad</button>
                                                    <div class="collapse" id="Act2">
                                                        <button type="button" id="AddAct3" class="btn btn-link" data-toggle="collapse" href="#Act3">+AgregarActividad</button>

                                                    </div>
                                                </div>









                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </div><!-- /.modal-content--> 
                                </div> <!--/.modal-dialog --> 
                            </div> <!--/.modal --> 
                            <input type="text" style="display: none; visibility: hidden;" class="form-control" id="actNombreForm">
                        </div>
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
</div>
<script>
    $('#FechaNacimientoForm').datepicker({
        format: "dd/mm/yyyy",
        endDate: "today",
        language: "es",
        autoclose: true,
    });
    document.getElementById("BtnModificar").style.display = 'none';
    document.getElementById("BtnEliminar").style.display = 'none';
    document.getElementById("BtnAceptar").style.display = 'none';
    var VecElementos = [];
//    $.ajax({
//        type: "POST",
//        url: "<?php echo URL; ?>cliente/listadoDropdowns",
//        success: function (respuesta) {
//            var myObj = JSON.parse(respuesta);
//            for (vector in myObj) {
//                var txt = "";
//                for (element in myObj[vector]) {
//                    txt += "<option value='" + myObj[vector][element].id + "'>" + myObj[vector][element].Nombre + "</option>";
//                }
//                VecElementos.push(txt);
//            }
//            var i = 0;
//            var selects = document.getElementById("Formu").getElementsByTagName("select");
//            for (select in selects) {
//                selects[select].innerHTML = VecElementos[i];
//                i++;
//            }
//        }
//    });
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
                var id = VecClientes[indexes].idClientes;
                var url = "<?php echo URL; ?>cliente/traerCliente";
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
                        document.getElementById("IdLocalidadesSelect").style.display = 'none';
                        document.getElementById("IdGrupoFactorSanguineoSelect").style.display = 'none';
                        document.getElementById("IdCategoriasSelect").style.display = 'none';
//                        document.getElementById("IdActividadesSelect").style.display = 'none';
                        document.getElementById("IdSedesSelect").style.display = 'none';
                        document.getElementById("BtnModificar").style.display = 'inline-block';
                        document.getElementById("BtnEliminar").style.display = 'inline-block';
                        document.getElementById("BtnAceptar").style.display = 'none';
                    }
                });
            }
        });
    }
    function AgregarUsuario()
    {
        document.getElementById("IdLocalidadesSelect").style.display = 'none';
        document.getElementById("IdGrupoFactorSanguineoSelect").style.display = 'none';
        document.getElementById("IdCategoriasSelect").style.display = 'none';
        //document.getElementById("IdActividadesSelect").style.display = 'none';
        document.getElementById("IdSedesSelect").style.display = 'none';
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
        document.getElementById("BtnAceptar").style.display = 'inline-block';
        document.getElementById("BtnAgregar").style.display = 'none';
        document.getElementById("BtnModificar").style.display = 'none';
        document.getElementById("BtnEliminar").style.display = 'none';
    }
    function ModificarUsuario()
    {
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
        document.getElementById("BtnAceptar").style.display = 'inline-block';
        document.getElementById("BtnAgregar").style.display = 'none';
        document.getElementById("BtnModificar").style.display = 'none';
        document.getElementById("BtnEliminar").style.display = 'none';
    }
    var vec = [];
    function EnviarUsuario()
    {
        var nombre = document.getElementById("NombresForm").value;
        var apellido = document.getElementById("ApellidosForm").value;
        var sede = document.getElementById("IdSedesSelect").value;
        var categoria = document.getElementById("IdCategoriasSelect").value;
        if (nombre === "" || apellido == "" || sede == "" || categoria == "")
        {
            alert("Los siguientes campos son absolutamente obligatorios: Nombre, Apelliido, Sede, Actividades y Categor�a\n\
(Se recomienda llenar todos)");
        } else {
            vec = [];
            var x = document.getElementById("Formu").getElementsByTagName("input");
            var z = document.getElementsByClassName("checkbox");
            document.getElementById("locNombreForm").value = document.getElementById("IdLocalidadesSelect").value;
            document.getElementById("sangNombreForm").value = document.getElementById("IdGrupoFactorSanguineoSelect").value;
            document.getElementById("catNombreForm").value = document.getElementById("IdCategoriasSelect").value;
            //document.getElementById("actNombreForm").value = document.getElementById("IdActividadesSelect").value;
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
                    var z = document.getElementById("Formu").getElementsByClassName("checkbox");
                    for (var i = 0; i < z.length; i++) {
                        z[i].disabled = true;
                        z[i].style.display = 'none';
                    }
                    document.getElementById("BtnAgregar").style.display = 'inline-block';
                    document.getElementById("BtnModificar").style.display = 'none';
                    document.getElementById("BtnEliminar").style.display = 'none';
                    document.getElementById("BtnAceptar").style.display = 'none';
                    $('#TablaClientes').DataTable().clear().draw().ajax.reload();
                }
            });
        }
    }
    function EliminarUsuario() {
        var r = confirm("Est�s muy recontra segur�sima que quer�s borrar a este alumno?\n\
                        Esta funcionalidad se ha creado solo para casos extremos.");
        if (r == true) {
            $.ajax({
                type: "POST",
                url: '<?php echo URL; ?>cliente/eliminarCliente',
                data: "data=" + document.getElementById("idClientes").innerHTML,
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
                    document.getElementById("BtnAgregar").style.display = 'inline-block';
                    document.getElementById("BtnModificar").style.display = 'none';
                    document.getElementById("BtnEliminar").style.display = 'none';
                    document.getElementById("BtnAceptar").style.display = 'none';
                    $('#TablaClientes').DataTable().clear().draw().ajax.reload();
                }
            });
        }
    }
</script>