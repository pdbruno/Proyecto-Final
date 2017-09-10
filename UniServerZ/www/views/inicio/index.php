<link rel="stylesheet" href="<?php echo URL; ?>views/recursos/bootstrap-table/bootstrap-table.min.css">
<link href="<?php echo URL; ?>views/recursos/bootstrap-datepicker/css/bootstrap-datepicker3.standalone.min.css" rel="stylesheet">
<link href="<?php echo URL; ?>views/recursos/bootstrap-datepicker/css/bootstrap-datepicker3.standalone.min.css" rel="stylesheet">
<div class="row">
  <div class="col-lg-6">
    <ul class="nav nav-tabs nav-justified" role="tablist">
      <li role="presentation" class="active"><a href="#matricula" aria-controls="matricula" role="tab" data-toggle="tab">Matrícula</a></li>
      <li role="presentation"><a href="#deudas" aria-controls="deudas" role="tab" data-toggle="tab">Deudas</a></li>
      <li role="presentation"><a href="#exceso" aria-controls="exceso" role="tab" data-toggle="tab">Exceso de asistencia</a></li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
      <div role="tabpanel" class="tab-pane fade in active" id="matricula">
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
      <div role="tabpanel" class="tab-pane fade" id="deudas">
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
      <div role="tabpanel" class="tab-pane fade" id="exceso">
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
  <div class="col-lg-6">
    <div class="row">
      <ul class="nav nav-tabs nav-justified" role="tablist">
        <li role="presentation" class="active"><a href="#ventas" aria-controls="matricula" role="tab" data-toggle="tab">Productos por ventas</a></li>
        <li role="presentation"><a href="#ganancias" aria-controls="deudas" role="tab" data-toggle="tab">Productos por ganancias</a></li>
      </ul>
    </div>

    <div class="row">
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade in active" id="ventas">
          <div class="table-responsive">
            <table id="productosVentas" class="table table-hover" data-toggle="table" data-url="<?php echo URL;?>index/productosVentas" data-search='true' cellspacing="0" width="100%"  >
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
            <table id="productosGanancias" class="table table-hover" data-toggle="table" data-url="<?php echo URL;?>index/productosGanancias" data-search='true' cellspacing="0" width="100%"  >
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
    </div>

    <div class="row">
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
</div>
