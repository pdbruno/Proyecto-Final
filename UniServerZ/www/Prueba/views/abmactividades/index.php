<div class="row">
  <div class="col-lg-6">
    <div class="panel panel-default">
      <div class="panel-heading">Listado de Actividades
      </div>
      <div class="table-responsive col-sm-12">
        <table  id="Tabla" class="table table-hover" cellspacing="0" width="100%"  >
          <thead>
            <tr>
              <th>Descripción</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>
  <div id="Formu" class="col-lg-6" >
    <div class="panel panel-default">
      <ul class="list-group">
        <form class="form-horizontal">
          <li class="list-group-item">
            <div class="form-group">
              <label class="col-sm-2 control-label">Id:</label>
              <div class="col-sm-10">
                <p id="idActividades" class="form-control-static"></p>
                <input type="text" class="form-control hidden" id="idActividadesForm" placeholder="Se mira y no se toca" disabled>

              </div>
            </div>
          </li>
          <li class="list-group-item">
            <div class="form-group">

              <label class="col-sm-2 control-label">Nombre:</label>
              <div class="col-sm-10">
                <p id="Nombre" class="form-control-static"></p>
                <input type="text" class="form-control hidden" id="NombreForm" placeholder="Descripción">
              </div>

            </div>
          </li>
          <li class="list-group-item">

            <div class="form-group">
              <label class="col-sm-2 control-label">Modalidades:</label>
              <div class="col-sm-10">
                <button type="button" id="IdModalidadesVer" class="btn btn-link hidden" data-toggle="modal" data-target="#ModalVer">Ver modalidad/es</button>

                <div class="modal fade" tabindex="-1" role="dialog" id="ModalVer">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Modalidades</h4>
                      </div>
                      <div class="modal-body">
                        <table class="table table-hover" >
                          <thead>
                            <tr>
                              <th>Modalidad</th>
                            </tr>
                          </thead>
                          <tbody id="TablaModalidades">
                          </tbody>
                        </table>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                      </div><!-- /.modal-content-->
                    </div> <!--/.modal-dialog -->
                  </div> <!--/.modal -->
                </div>
                <button type="button" id="IdModalidadesSelect" class="btn btn-link hidden" data-toggle="modal" data-target="#ModalSel">Seleccionar modalidad/es</button>

              </li>
              <li class="list-group-item">
                <div class="form-group">
                  <label class="col-sm-2 control-label">Se paga por clase:</label>
                  <div class="col-sm-10">
                    <p class="intro hidden" id="XClase"></p>
                    <input type="checkbox"class="checkbox hidden" id="XClaseForm" disabled>
                  </div>
                </div>
              </li>
              <li class="list-group-item">
                <div class="form-group">
                  <label class="col-sm-2 control-label">Se paga por mes:</label>
                  <div class="col-sm-10">
                    <p class="intro hidden" id="XMes"></p>
                    <input type="checkbox"class="checkbox hidden" id="XMesForm" disabled>
                  </div>
                </div>
              </li>
              <li class="list-group-item">
                <div class="form-group">
                  <label class="col-sm-2 control-label">Se paga por semestre:</label>
                  <div class="col-sm-10">
                    <p class="intro hidden" id="XSemestre"></p>
                    <input type="checkbox"class="checkbox hidden" id="XSemestreForm" disabled>
                  </div>
                </div>
              </li>
            </form>
          </ul>
        </div>
        <button type="button" id="BtnAgregar" onclick="Agregar()" class="btn btn-default">Agregar</button>
        <button type="button" id="BtnModificar"onclick="Modificar()" class="btn btn-primary hidden">Modificar</button>
        <button type="button" id="BtnAceptar" onclick="EnviarActividad()" class="btn btn-success hidden">Aceptar</button>
        <button type="button" id="BtnEliminar" onclick="EliminarActividad()" class="btn btn-danger hidden">Eliminar</button>
      </div>
      <div class="modal fade" tabindex="-1" role="dialog" id="ModalSel">
        <div class="modal-dialog" role="document" >
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Seleccionar modalidad/es</h4>
            </div>
            <div class="modal-body" id="Selec">

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default"onclick="deshacerModal()" data-dismiss="modal">Cancelar</button>
              <button type="button" class="btn btn-primary" onclick="aceptarModal()"> Aceptar</button>
            </div>
          </div>
        </div><!-- /.modal-content-->
      </div> <!--/.modal-dialog -->
    </div>
    <script src="<?php echo URL; ?>views/recursos/logicaABM.js"></script>
    <script>
    var VecActividades = [];
    function Agregar(){
      $("#IdModalidadesSelect").removeClass("hidden");
      $("#IdModalidadesVer").addClass("hidden");
      modoFormulario("Agregar");
      deshacerModal();
    }
    function Modificar(){
      $("#IdModalidadesSelect").removeClass("hidden");
      $("#IdModalidadesVer").addClass("hidden");
      modoFormulario("Modificar");
      deshacerModal();
    }
    function deshacerModal(){
      $("#Selec").html("<div class='col-lg-7'>\
      <h5>Modalidad</h5>\
      </div>\
      <div class='row'>\
      <div class='col-lg-7'>\
      <select id='IdModalidadesSelect1' class='form-control activ'>\
      <option selected value=''>Ninguna</option>\
      </select>\
      <button type='button' id='AddAct1' class='btn btn-link' onclick='AddAct(this)' >+AgregarModalidad</button>\
      </div>");
      document.getElementById("IdModalidadesSelect1").innerHTML += optionCrear(VecModalidades);
    }

    function AddAct(bot) {
      i = bot.id.replace("AddAct", "");
      var anterior = document.getElementById("IdModalidadesSelect" + i);
      if (anterior.selectedIndex == "0") {
        alert("Seleccione una Modalidad");
      } else {
        j = Number(i) + 1;
        $("#Selec").append("<div class='row' style='margin-top: 50px;'>\
        <div class='col-lg-7'>\
        <select id='IdModalidadesSelect" + j + "' class='form-control activ'>\
        </select>\
        </div>\
        </div>\
        <button type='button' id='AddAct" + j + "' class='btn btn-link' onclick='AddAct(this)' >+AgregarModalidad</button>");
        var actual = document.getElementById("IdModalidadesSelect" + j);
        actual.innerHTML += anterior.innerHTML;
        actual.remove(anterior.selectedIndex);
        $("#AddAct" + i).addClass('hidden')
        anterior.disabled = true;
        document.getElementById("IdModalidadesSelect" + j).innerHTML += VecModalidades;
      }
    }
    var final = [];

    function aceptarModal() {
      $('#ModalSel').modal('hide');
      final = [];
      var activs = document.getElementById("Selec").getElementsByClassName("activ");
      for (var i = 0; i < activs.length; i++) {
        final[i] =  activs[i].value;
        if (activs[i] == "") {
          bien = false;
        }
      }
    }
    function optionCrear(vec) {
      var txt="";
      for (var i = 0; i < vec.length; i++) {
        if (vec[i].Nombre.length > 1) {
          txt += "<option value='" + vec[i].id + "'>" + vec[i].Nombre + "</option>";
        }
      }
      return txt;
    }
    var request = $.ajax({
      url: "<?php echo URL; ?>cliente/listadoDropdowns",
      type: "post"
    });
    request.done(function (respuesta){
      VecModalidades = JSON.parse(respuesta)[1][1];
    });
    $(document).ready(function () {
      listadoActividades();
    });
    var listadoActividades = function ()
    {
      var table = $("#Tabla").DataTable(
        {
          "ajax":
          {
            "method": "POST",
            "url": "<?php echo URL; ?>actividad/traerActividades",
            "dataSrc": function (txt)
            {
              VecActividades = [];
              for (i in txt)
              {
                var Actividad =
                {
                  idActividades: txt[i].idActividades,
                  Nombre: txt[i].Nombre
                };
                VecActividades.push(Actividad);
              }
              return VecActividades;
            }
          },
          "columns": [
            {data: "Nombre"}
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
            var request = $.ajax({
              url: "<?php echo URL; ?>actividad/traerActividad",
              type: "post",
              data: "data=" + VecActividades[indexes].idActividades,
            });
            request.done(function (respuesta){
              clickFila(JSON.parse(respuesta)[0]);
              $("#IdModalidadesSelect").addClass("hidden");
              $("#IdModalidadesVer").removeClass("hidden");
            });

          }
        });
      }

      var vec = [];
      function EnviarActividad()
      {
        var nombre = document.getElementById("NombreForm").value;
        if (nombre === "")
        {
          alert("Por favor llene el nombre thank you very much");
        } else {
          vec = [];
          vec = beforeEnviar();
          request = $.ajax({
            url: "<?php echo URL; ?>actividad/agregarModificarActividad",
            type: "post",
            data:  "data1=" + JSON.stringify(vec) + "&data2=" + JSON.stringify(final)
          });
          request.done(function (respuesta){
            afterEnviar();
          });

        }

      }
      function EliminarActividad() {
        var r = confirm("Estás muy recontra segurísima/o que querés borrar esta actividad?");
        if (r == true) {

          request = $.ajax({
            url: "<?php echo URL; ?>actividad/eliminarActividad",
            type: "post",
            data: "data=" + document.getElementById("idActividades").innerHTML,
          });
          request.done(function (respuesta){
            eliminarError(respuesta);
          });

        }
      }

      </script>
