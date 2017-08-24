<link href="<?php echo URL; ?>views/recursos/bootstrap-datepicker/css/bootstrap-datepicker3.standalone.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo URL; ?>views/recursos/bootstrap-table/bootstrap-table.min.css">
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
<div class="col-lg-6">
  <div class="row hidden escondible" id="PanelActividades">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading">Actividades que realiza el cliente
        </div>
        <div class="list-group" id="ListaActividades">
        </div>
      </div>
    </div>
  </div>
  <div class="row" id="Tiempo">
    <div class="col-lg-12">
      <div class="btn-group btn-group-lg btn-group-justified" data-toggle="buttons">
        <label class="btn btn-primary hidden escondible" id="Mes">
          <input type="radio" name="options" autocomplete="off"> Mes
        </label>
        <label class="btn btn-primary hidden escondible" id="Clase">
          <input type="radio" name="options" autocomplete="off"> Clase
        </label>
        <label class="btn btn-primary hidden escondible" id="Semestre">
          <input type="radio" name="options" autocomplete="off"> Semestre
        </label>
      </div>
    </div>
  </div>
  <br>
  <div class="row hidden escondible escondible2" id="IngresoFecha">
    <div class="col-lg-12">
      <div class="input-group">
        <input type="text" class="form-control" id="FechaForm" name="FechaForm" placeholder="Fecha de la clase">
        <span class="input-group-btn">
          <button class="btn btn-default" id="FechaAceptar" type="button">Aceptar</button>
        </span>
      </div>
    </div>
  </div>
  <div class="row hidden escondible escondible2" id="IngresoMes">
    <div class="col-lg-12">
      <div class="input-group">
        <input type="text" class="form-control" id="MesForm" name="MesForm" placeholder="Mes a pagar">
      </div>
    </div>
  </div>
  <div class="row hidden escondible escondible2" id="ListaEventos">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading">Listado de Eventos Recientes
        </div>
        <div class="table-responsive col-sm-12">
          <table class="table table-hover" >
            <thead>
              <tr>
                <th class='hidden'>idEvento</th>
                <th>Actividad</th>
              </tr>
            </thead>
            <tbody id="TablaActividades">
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="row hidden escondible escondible2" id="SemestrePicker">
    <div class="col-lg-12">
      <div class="btn-group center-block" data-toggle="buttons">
        <label class="btn btn-default active" id="semestre1">
          <input type="radio" name="1erSemestre" autocomplete="off"> 1er semestre
        </label>
        <label class="btn btn-default" id="semestre2">
          <input type="radio" name="2doSemestre" autocomplete="off"> 2do Semestre
        </label>
      </div>
    </div>
  </div>
  <div class="row hidden escondible escondible2" id="MontoRow">
    <div class="col-lg-6">
      <label for="Monto">A cobrar</label>
      <div class="input-group">
        <span class="input-group-addon">$</span>
        <input type="text" id="Monto" class="form-control">
        <span class="input-group-addon">.00</span>
      </div>
      <button class="btn btn-default hidden escondible escondible2" id="Enviar" type="button">Aceptar</button>
    </div>
  </div>
</div>
<script src="<?php echo URL; ?>views/recursos/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo URL; ?>views/recursos/bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js" charset="UTF-8"></script>
<script src="<?php echo URL; ?>views/recursos/bootstrap-table/bootstrap-table.min.js"></script>
<script src="<?php echo URL; ?>views/recursos/bootstrap-table/bootstrap-table-es-AR.min.js"></script>
