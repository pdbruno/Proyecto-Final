<link rel="stylesheet" href="<?php echo URL; ?>views/recursos/bootstrap-table/bootstrap-table.min.css">
<script src="<?php echo URL; ?>views/recursos/bootstrap-table/bootstrap-table.min.js"></script>
<script src="<?php echo URL; ?>views/recursos/bootstrap-table/bootstrap-table-es-AR.min.js"></script>
<div class="row">
  <div class="col-lg-6">
    <div class="panel panel-default">
      <div class="panel-heading">Listado de <?php echo $this->sujeto; ?>
      </div>
      <div class="table-responsive col-sm-12">
        <table  id="Tabla" class="table table-hover" data-toggle="table" data-url="<?php echo URL; ?>help/listarElementos/<?php echo $this->sujeto; ?>" data-search='true' cellspacing="0" width="100%"  >
          <thead>
            <tr>
              <th data-field="Nombre" data-sortable='true'>Nombre</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>
  <div id="Formu" class="col-lg-6" style="height: 100%;">
    <div class="panel panel-default">
      <ul class="list-group">
        <form class="form-horizontal">
          <li class="list-group-item">
            <div class="form-group">
              <label class="col-sm-2 control-label">Id:</label>
              <div class="col-sm-10">
                <p id="id<?php echo $this->sujeto; ?>" class="form-control-static"></p>
                <input type="text" class="form-control hidden" id="id<?php echo $this->sujeto; ?>Form" placeholder="Se mira y no se toca" disabled>
                <!--Si alguien ve esto ayudenme, me tienen captivo programando las 24hs OH NO AHI VIENE ASDSDADAASDAWRARBJK-->
              </div>
            </div>
          </li>
          <li class="list-group-item">
            <div class="form-group">

              <label class="col-sm-2 control-label">Nombre:</label>
              <div class="col-sm-10">
                <p id="Nombre" class="form-control-static"></p>
                <input type="text" class="form-control hidden" id="NombreForm" placeholder="Nombre">
              </div>
            </div>
          </li>
        </form>
      </ul>
    </div>
    <button type="button" id="BtnAgregar" class="btn btn-default">Agregar</button>
    <button type="button" id="BtnModificar" onclick="modoFormulario('Modificar')" class="btn btn-primary hidden">Modificar</button>
    <button type="button" id="BtnAceptar" onclick="Enviar()" class="btn btn-success hidden">Aceptar</button>
    <button type="button" id="BtnEliminar" onclick="Eliminar()" class="btn btn-danger hidden">Eliminar</button>
  </div>
</div>
<script src="<?php echo URL; ?>views/recursos/logicaABM.js"></script>
<?php require 'abmsecundario.php' ?>
