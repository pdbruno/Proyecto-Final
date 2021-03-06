<link href="<?php echo URL; ?>views/recursos/bootstrap-datepicker/css/bootstrap-datepicker3.standalone.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo URL; ?>views/recursos/bootstrap-table/bootstrap-table.min.css">
<div class="col-lg-6">
  <div class="row hidden escondible" id="PanelDeudas">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading" role="button" id="headingOne" data-toggle="collapse" href="#collapseOne" class="panel-title">
        </div>
        <div id="collapseOne" class="panel-collapse collapse" role="tabpanel">
          <div class="panel-body">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>Actividad</th>
                  <th>Fecha</th>
                  <th>Monto</th>
                </tr>
              </thead>
              <tbody id="TablaMor">
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
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
</div>
<div class="col-lg-6">
  <div class="row hidden escondible escondible2" id="IngresoFecha">
    <div class="col-lg-12">
      <div class="input-group">
        <input type="text" class="form-control disab" id="FechaForm" name="FechaForm" placeholder="Fecha de la clase">
        <span class="input-group-btn">
          <button class="btn btn-default disab" id="FechaAceptar" type="button">Aceptar</button>
        </span>
      </div>
    </div>
  </div>
  <div class="row hidden escondible escondible2" id="IngresoMes">
    <div class="col-lg-6">
      <input type="text" class="form-control disab" id="MesForm" name="MesForm" placeholder="Mes a pagar">
    </div>
    <div class="col-lg-6">
      <button type="button" id="Semestre" class="btn btn-primary" data-toggle="button" aria-pressed="false" autocomplete="off">Semestre</button>
    </div>
  </div>
  <div class="row hidden escondible escondible2" id="SemestrePicker">
    <div class="col-lg-12">
      <div class="btn-group center-block" data-toggle="buttons">
        <label class="btn btn-default active" id="semestre1">
          <input type="radio" class="disab" name="1erSemestre" autocomplete="off"> 1er semestre
        </label>
        <label class="btn btn-default" id="semestre2">
          <input type="radio" class="disab" name="2doSemestre" autocomplete="off"> 2do Semestre
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
      <button class="btn btn-default" id="Enviar" type="button">Aceptar</button>
    </div>
  </div>
</div>
<script src="<?php echo URL; ?>views/recursos/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo URL; ?>views/recursos/bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js" charset="UTF-8"></script>
<script src="<?php echo URL; ?>views/recursos/bootstrap-table/bootstrap-table.min.js"></script>
<script src="<?php echo URL; ?>views/recursos/bootstrap-table/bootstrap-table-es-AR.min.js"></script>
