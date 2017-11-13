<link href="<?php echo URL; ?>views/recursos/bootstrap-datepicker/css/bootstrap-datepicker3.standalone.min.css" rel="stylesheet">
<div class="col-lg-3">
  <div class="row">
    <div class="input-group">
      <input type="text" class="form-control" id="FechaForm" name="FechaForm" placeholder="Fecha de la clase">
      <span class="input-group-btn">
        <button class="btn btn-default" id="BTNfecha" type="button">Aceptar</button>
      </span>
    </div>
  </div>
  <div class="row hidden" id="ListaEventos" style="max-height: 50vh; overflow-y:scroll;">
    <div class="panel panel-default">
      <div class="panel-heading">Listado de Eventos Recientes
      </div>
      <div class="table-responsive col-sm-12">
        <table class="table table-hover" >
          <thead>
            <tr>
              <th>Actividad</th>
            </tr>
          </thead>
          <tbody id="TablaActividades">
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="row hidden" id="Profesorado">
    <input type="text" class="form-control" id="ProfeForm" name="ProfeForm" data-provide="typeahead" placeholder="Nombe o Apellido del instructor">
    <div class="list-group" id="ListaInstructores" style="max-height: 30vh; overflow-y:scroll;">
    </div>
  </div>
</div>
<div class="col-lg-9 hidden" id="Asistencia">
  <input type="text" class="form-control" id="NombreForm" name="NombreForm" data-provide="typeahead" placeholder="Nombe o Apellido del alumno">
  <div class="list-group" id="ListaClientes" style="max-height: 85vh; overflow-y:scroll;">
  </div>
  <button class="btn btn-default" id="BTNenviar" type="button">Enviar lista de asistencia</button>
</div>
<script src="<?php echo URL; ?>views/recursos/bootstrap3-typeahead.min.js"></script>
<script src="<?php echo URL; ?>views/recursos/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo URL; ?>views/recursos/bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js" charset="UTF-8"></script>
