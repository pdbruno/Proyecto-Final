<div class="row">
  <div class="col-lg-4 col-md-6">
    <div class="panel panel-red">
      <div class="panel-heading">
        <div class="row">
          <div class="col-xs-3">
            <i class="fa fa-exclamation-triangle fa-5x"></i>
          </div>
          <div class="col-xs-9 text-right">
            <div class="huge" id="CantMatr">?</div>
            <div>Personas no han pagado la matrícula</div>
          </div>
        </div>
      </div>
      <a href="#" id="VerMat" data-toggle="modal" data-target="#ModalMor" data-titulo="Personas que no han pagado la matrícula">
        <div class="panel-footer">
          <span class="pull-left">Ver Detalles</span>
          <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
          <div class="clearfix"></div>
        </div>
      </a>
    </div>
  </div>


  <div class="col-lg-4 col-md-6">
    <div class="panel panel-yellow">
      <div class="panel-heading">
        <div class="row">
          <div class="col-xs-3">
            <i class="fa fa-bell-o fa-5x"></i>
          </div>
          <div class="col-xs-9 text-right">
            <div class="huge" id="CantDeud">?</div>
            <div>Personas deben pagar something</div>
          </div>
        </div>
      </div>
      <a href="#" id="VerDeud" data-toggle="modal" data-target="#ModalMor" data-titulo="Personas que deben pagar algo">
        <div class="panel-footer">
          <span class="pull-left">Ver Detalles</span>
          <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
          <div class="clearfix"></div>
        </div>
      </a>
    </div>
  </div>
</div>



<div class="modal fade" tabindex="-1" role="dialog" id="ModalMor">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <table class="table table-bordered" >
          <thead>
            <tr>
              <th>Nombre</th>
            </tr>
          </thead>
          <tbody id="TablaMor">
          </tbody>
        </table>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div><!-- /.modal-content-->
      </div> <!--/.modal-dialog -->
    </div> <!--/.modal -->
  </div>
</div>
