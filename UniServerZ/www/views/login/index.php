<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="login-panel panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Iniciar Sesión</h3>
            </div>
            <div class="panel-body">
                    <fieldset>
                        <div class="form-group">
                          <select class="form-control" id="idUsuariosSelect">
                            <option value="1">Administrador</option>
                            <option value="2">Gerente</option>
                            <option value="3">Instructor</option>
                          </select>
                        </div>
                        <div class="form-group" id="Grupo">
                          <label class="control-label hidden" id="Error"></label>
                          <input class="form-control" placeholder="Contraseña" id="Password" type="password" value="">
                        </div>
                        <button type="button" id="BtnAceptar" class="btn btn-lg btn-success btn-block">Login</button>
                    </fieldset>
            </div>
        </div>
    </div>
</div>
