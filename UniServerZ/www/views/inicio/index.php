<link rel="stylesheet" href="<?php echo URL; ?>views/recursos/bootstrap-table/bootstrap-table.min.css">
<!-- Morris Charts CSS -->
<link href="<?php echo URL; ?>views/recursos/vendor/morrisjs/morris.css" rel="stylesheet">
<link href="<?php echo URL; ?>views/recursos/bootstrap-datepicker/css/bootstrap-datepicker3.standalone.min.css" rel="stylesheet">
<link href="<?php echo URL; ?>views/recursos/bootstrap-datepicker/css/bootstrap-datepicker3.standalone.min.css" rel="stylesheet">
<div class="row">
  <div class="col-lg-6">
    <div class="panel panel-info">
      <div class="panel-heading">
        <h3 class="panel-title">Cantidad personas de cada edad por actividad</h3>
        <select class="form-control" id="IdActividadesSelect1"></select>
      </div>
      <div class="panel-body">
        <div id="GraficoLinea"></div>
      </div>
    </div>
    <div class="panel panel-danger">
      <div class="panel-heading">
        <h3 class="panel-title">Gente mala</h3>
      </div>
      <ul class="nav nav-tabs nav-justified" role="tablist">
        <li role="presentation" class="active"><a href="#Matricula" aria-controls="matricula" role="tab" data-toggle="tab">Matrícula</a></li>
        <li role="presentation"><a href="#Deudas" aria-controls="deudas" role="tab" data-toggle="tab">Deudas</a></li>
        <li role="presentation"><a href="#Exceso" aria-controls="exceso" role="tab" data-toggle="tab">Exceso de asistencia</a></li>
      </ul>
      <!-- Tab panes -->
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade in active" id="Matricula">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Nombre</th>
              </tr>
            </thead>
            <tbody id="TablaMat">
            </tbody>
          </table>
        </div>
        <div role="tabpanel" class="tab-pane fade" id="Deudas">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Nombre</th>
              </tr>
            </thead>
            <tbody id="TablaDeud">
            </tbody>
          </table>
        </div>
        <div role="tabpanel" class="tab-pane fade" id="Exceso">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Nombre</th>
              </tr>
            </thead>
            <tbody id="TablaExc">
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="panel panel-success">
      <div class="panel-heading">
        <h3 class="panel-title">Finanzas</h3>
        <select class="form-control" id="idFondosSelect"></select>
      </div>
      <ul class="nav nav-tabs nav-justified" role="tablist">
        <li role="presentation" class="active"><a href="#Egresos" aria-controls="matricula" role="tab" data-toggle="tab">Egresos</a></li>
        <li role="presentation"><a href="#Ingresos" aria-controls="deudas" role="tab" data-toggle="tab">Ingresos Brutos</a></li>
        <li role="presentation"><a href="#Balance" aria-controls="deudas" role="tab" data-toggle="tab">Balance</a></li>
      </ul>

      <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade in active" id="Egresos">
          <div class="panel-body">
            <dl class="dl-horizontal" id="ResumenEg">
            </dl>
          </div>

          <div class="table-responsive">
            <table id="TablaEgresos" class="table table-hover" data-toggle="table" data-search='true' cellspacing="0" width="100%"  >
              <thead>
                <tr>
                  <th data-field='Fecha' data-sortable='true'>Fecha</th>
                  <th data-field='Nombre' data-sortable='true'>Nombre</th>
                  <th data-field='Tipo' data-sortable='true'>Tipo</th>
                  <th data-field='Monto' data-sortable='true'>Monto ($)</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
        <div role="tabpanel" class="tab-pane fade" id="Ingresos">

          <div class="panel-body">
            <dl class="dl-horizontal" id="ResumenIn">
            </dl>
          </div>

          <div class="table-responsive">
            <table id="TablaIngresos" class="table table-hover" data-toggle="table" data-search='true' cellspacing="0" width="100%"  >
              <thead>
                <tr>
                  <th data-field='Fecha' data-sortable='true'>Fecha</th>
                  <th data-field='Nombre' data-sortable='true'>Nombre</th>
                  <th data-field='Tipo' data-sortable='true'>Tipo</th>
                  <th data-field='Monto' data-sortable='true'>Monto ($)</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
        <div role="tabpanel" class="tab-pane fade" id="Balance">
          <div class="panel-body">
            <dl class="dl-horizontal">
              <dt>El balance es de</dt>
              <dd id="TotBal">...</dd>
            </dl>
          </div>


          <div class="table-responsive">
            <table id="TablaBalance" class="table table-hover" data-toggle="table" data-row-style="rowStyle" data-search='true' cellspacing="0" width="100%"  >
              <thead>
                <tr>
                  <th data-field='Fecha' data-sortable='true'>Fecha</th>
                  <th data-field='Nombre' data-sortable='true'>Nombre</th>
                  <th data-field='Tipo' data-sortable='true'>Tipo</th>
                  <th data-field='Monto' data-sortable='true'>Monto ($)</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
      <div class="panel-body">
        <div class="col-lg-10">
          <div class="input-daterange input-group" id="datepickerFinanzas">
            <input type="text" class="form-control" name="start" id="FechaFinan1" />
            <span class="input-group-addon">hasta</span>
            <input type="text" class="form-control" name="end" id="FechaFinan2" />
          </div>
        </div>
        <div class="col-lg-2">
          <button class="btn btn-default" id="FechaFinan" type="button">Aceptar</button>
        </div>
      </div>

    </div>
  </div>
  <div class="col-lg-6">
    <div class="panel panel-info">
      <div class="panel-heading">
        <h3 class="panel-title">Cantidad de hombres y mujeres por actividad</h3>
        <select class="form-control" id="IdActividadesSelect2"></select>
      </div>
      <div class="panel-body">
        <div id="GraficoBarra"></div>
      </div>
    </div>
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Venta de productos</h3>
      </div>
      <ul class="nav nav-tabs nav-justified" role="tablist">
        <li role="presentation" class="active"><a href="#ventas" aria-controls="matricula" role="tab" data-toggle="tab">Productos por ventas</a></li>
        <li role="presentation"><a href="#ganancias" aria-controls="deudas" role="tab" data-toggle="tab">Productos por ganancias</a></li>
      </ul>
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade in active" id="ventas">
          <div class="table-responsive">
            <table id="TablaVentas" class="table table-hover" data-toggle="table" data-url="<?php echo URL;?>index/productosVentas" data-search='true' cellspacing="0" width="100%"  >
              <thead>
                <tr>
                  <th data-field='Nombre' data-sortable='true'>Nombre</th>
                  <th data-field='Cantidad' data-sortable='true'>Cantidad</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
        <div role="tabpanel" class="tab-pane fade" id="ganancias">
          <div class="table-responsive">
            <table id="TablaGanancias" class="table table-hover" data-toggle="table" data-url="<?php echo URL;?>index/productosGanancias" data-search='true' cellspacing="0" width="100%"  >
              <thead>
                <tr>
                  <th data-field='Nombre' data-sortable='true'>Nombre</th>
                  <th data-field='Monto' data-sortable='true'>Monto ($)</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
      <div class="panel-body">
        <div class="col-lg-10">
          <div class="input-daterange input-group" id="$datepickerProd">
            <input type="text" class="form-control" name="start" id="FechaProd1" />
            <span class="input-group-addon">hasta</span>
            <input type="text" class="form-control" name="end" id="FechaProd2" />
          </div>
        </div>
        <div class="col-lg-2">
          <button class="btn btn-default" id="FechaProd" type="button">Aceptar</button>
        </div>
      </div>

    </div>
    <div class="panel panel-warning">
      <div class="panel-heading">
        <h3 class="panel-title">Porcentaje de asistencias</h3>
        <select class="form-control" id="porcentajeMeses">
          <option value="1">Enero</option>
          <option value="2">Febrero</option>
          <option value="3">Marzo</option>
          <option value="4">Abril</option>
          <option value="5">Mayo</option>
          <option value="6">Junio</option>
          <option value="7">Julio</option>
          <option value="8">Agosto</option>
          <option value="9">Septiembre</option>
          <option value="10">Octubre</option>
          <option value="11">Noviembre</option>
          <option value="12">Diciembre</option>
        </select>

      </div>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Actividad</th>
          </tr>
        </thead>
        <tbody id="TablaPorcentaje">
        </tbody>
      </table>
    </div></div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          Gráfico temporal de fondos
        </div>
        <div class="panel-body">
          <div id="GraficoFondos">
          </div>
        </div>
      </div>
    </div>
  </div>
