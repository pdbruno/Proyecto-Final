<link rel="stylesheet" href="<?php echo URL; ?>views/recursos/bootstrap-table/bootstrap-table.min.css">
<!-- Morris Charts CSS -->
<link href="<?php echo URL; ?>views/recursos/vendor/morrisjs/morris.css" rel="stylesheet">
<link href="<?php echo URL; ?>views/recursos/bootstrap-datepicker/css/bootstrap-datepicker3.standalone.min.css" rel="stylesheet">
<link href="<?php echo URL; ?>views/recursos/bootstrap-datepicker/css/bootstrap-datepicker3.standalone.min.css" rel="stylesheet">
<style media="screen">
.fixed-table-body {
  height: unset;
}
</style>
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
          <select class="form-control" id="idMesesSelectExceso">
          </select>
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

    <div class="panel panel-info">
      <div class="panel-heading">
        <h3 class="panel-title">Cantidad exámenes rendidos por categoría</h3>
      </div>
      <div class="panel-body">
        <div id="GraficoBarraExam"></div>
        <div class="col-lg-10">
          <div class="input-daterange input-group" id="$datepickerExam">
            <input type="text" class="form-control" name="start" id="FechaExam1" />
            <span class="input-group-addon">hasta</span>
            <input type="text" class="form-control" name="end" id="FechaExam2" />
          </div>
        </div>
        <div class="col-lg-2">
          <button class="btn btn-default" id="FechaExam" type="button">Aceptar</button>
        </div>
      </div>
    </div>

    <div class="panel panel-success">
      <div class="panel-heading" role="button" id="TriggerCollapseFinanzas">
        <h3 class="panel-title">Finanzas</h3>
      </div>
      <div id="ModalContra" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" >
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Ingrese la contraseña de gerente o administrador</h4>
            </div>
            <div class="modal-body">
              <input class="form-control" placeholder="Contraseña" id="Password" type="password" value="">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              <button id="AceptarContra" type="button" class="btn btn-primary">Aceptar</button>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
      <div id="CollapseFinanzas" class="panel-collapse collapse" data-toggle="false">
        <select class="form-control" id="idFondosSelect"></select>

        <ul class="nav nav-tabs nav-justified" role="tablist">
          <li role="presentation" class="active"><a href="#Egresos" aria-controls="matricula" role="tab" data-toggle="tab">Egresos</a></li>
          <li role="presentation"><a href="#Ingresos" aria-controls="deudas" role="tab" data-toggle="tab">Ingresos</a></li>
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
  </div>
  <div class="col-lg-6">
    <div class="panel panel-info">
      <div class="panel-heading">
        <h3 class="panel-title">Cantidad de hombres y mujeres por actividad</h3>
        <select class="form-control" id="IdActividadesSelect2"></select>
      </div>
      <div class="panel-body">
        <div id="GraficoBarraAct"></div>
      </div>
    </div>
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Venta de productos</h3>
      </div>
      <ul class="nav nav-tabs nav-justified" role="tablist">
        <li role="presentation" class="active"><a href="#ventas" aria-controls="matricula" role="tab" data-toggle="tab">Ventas por producto</a></li>
        <li role="presentation"><a href="#ganancias" aria-controls="deudas" role="tab" data-toggle="tab">Ganancia por producto</a></li>
      </ul>
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade in active" id="ventas">
          <div class="table-responsive">
            <table id="TablaVentas" class="table table-hover" data-toggle="table" data-url="<?php echo URL;?>reporte/productosVentas" data-search='true' cellspacing="0" width="100%"  >
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
            <table id="TablaGanancias" class="table table-hover" data-toggle="table" data-url="<?php echo URL;?>reporte/productosGanancias" data-search='true' cellspacing="0" width="100%"  >
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
      <div class="panel-body">
        <div class="col-lg-10">
          <div class="input-daterange input-group" id="$datepickerAsis">
            <input type="text" class="form-control" name="start" id="FechaAsis1" />
            <span class="input-group-addon">hasta</span>
            <input type="text" class="form-control" name="end" id="FechaAsis2" />
          </div>
        </div>
        <div class="col-lg-2">
          <button class="btn btn-default" id="FechaAsis" type="button">Aceptar</button>
        </div>
      </div>
    </div>
  </div>
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
