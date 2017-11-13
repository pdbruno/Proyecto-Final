<script src="<?php echo URL; ?>views/recursos/bootstrap-table/bootstrap-table.min.js"></script>
<script src="<?php echo URL; ?>views/recursos/bootstrap-table/bootstrap-table-es-AR.min.js"></script>
<script src="<?php echo URL; ?>views/recursos/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo URL; ?>views/recursos/bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js" charset="UTF-8"></script>
<!-- Morris Charts JavaScript -->
<script src="<?php echo URL; ?>views/recursos/vendor/raphael/raphael.min.js"></script>
<script src="<?php echo URL; ?>views/recursos/vendor/morrisjs/morris.min.js"></script>
<script>
var Elementos = {
  TablaMat: document.getElementById("TablaMat"),
  TablaDeud: document.getElementById("TablaDeud"),
  TablaExc: document.getElementById("TablaExc"),
  TablaPorcentaje: document.getElementById("TablaPorcentaje"),
  FechaProd: document.getElementById("FechaProd"),
  FechaProd1: document.getElementById("FechaProd1"),
  FechaProd2: document.getElementById("FechaProd2"),
  FechaExam: document.getElementById("FechaExam"),
  FechaExam1: document.getElementById("FechaExam1"),
  FechaExam2: document.getElementById("FechaExam2"),
  FechaFinan: document.getElementById("FechaFinan"),
  FechaFinan1: document.getElementById("FechaFinan1"),
  FechaFinan2: document.getElementById("FechaFinan2"),
  GraficoLinea: document.getElementById("GraficoLinea"),
  GraficoBarraAct: document.getElementById("GraficoBarraAct"),
  GraficoFondos: document.getElementById("GraficoFondos"),
  GraficoBarraExam: document.getElementById("GraficoBarraExam"),
  porcentajeMeses: document.getElementById("porcentajeMeses"),
  TriggerCollapseFinanzas: document.getElementById("TriggerCollapseFinanzas"),
  AceptarContra: document.getElementById("AceptarContra"),
  Password: document.getElementById("Password"),

  ResumenEg: document.getElementById("ResumenEg"),
  ResumenIn: document.getElementById("ResumenIn"),
  TotBal: document.getElementById("TotBal"),
  idMesesSelectAsis: document.getElementById("idMesesSelectAsis"),
  idMesesSelectExceso: document.getElementById("idMesesSelectExceso"),
  IdActividadesSelect1: document.getElementById("IdActividadesSelect1"),
  IdActividadesSelect2: document.getElementById("IdActividadesSelect2"),
  idFondosSelect: document.getElementById("idFondosSelect"),
  $ModalContra: $("#ModalContra"),
  $TablaVentas: $("#TablaVentas"),
  $TablaGanancias: $("#TablaGanancias"),
  $TablaEgresos: $("#TablaEgresos"),
  $TablaIngresos: $("#TablaIngresos"),
  $TablaBalance: $("#TablaBalance"),
  $CollapseFinanzas: $("#CollapseFinanzas"),
};

Elementos.TriggerCollapseFinanzas.addEventListener('click', function(){
  if ( Elementos.$CollapseFinanzas.hasClass('in')) {
    Elementos.$CollapseFinanzas.collapse('hide');
  }else {
    Elementos.$ModalContra.modal('show');
  }
});

Elementos.AceptarContra.addEventListener('click', function(){
  if (Elementos.Password.value != "") {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "<?php echo URL; ?>login/checkContra");
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
      if(xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
        Elementos.Password.value = "";
        if (xhr.responseText == 'si') {
          Elementos.$CollapseFinanzas.collapse('show');
          Elementos.$ModalContra.modal('hide');
        }else {
          alert("Contraseña Incorrecta");
        }
      }
    };
    xhr.send("data=" + Elementos.Password.value);
  }
});

var idMeses = new XMLHttpRequest();
idMeses.open("POST", "<?php echo URL; ?>help/Dropdown/idMeses");
idMeses.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
idMeses.onreadystatechange = function() {
  if(idMeses.readyState === XMLHttpRequest.DONE && idMeses.status === 200) {
    Elementos.idMesesSelectAsis.innerHTML = optionCrear(JSON.parse(idMeses.responseText)[0]);
    Elementos.idMesesSelectExceso.innerHTML = optionCrear(JSON.parse(idMeses.responseText)[0]);
    let index = new Date().getMonth() + 1;
    Elementos.idMesesSelectAsis.selectedIndex = index;
    Elementos.idMesesSelectExceso.selectedIndex = index;

  }
};
idMeses.send();

var idActividades = new Promise(function(resolve, reject) {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "<?php echo URL; ?>help/Dropdown/idActividades");
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function() {
    if(xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
      resolve(xhr.responseText);
    }
  };
  xhr.send();
});
var idSubactividades = new Promise(function(resolve, reject) {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "<?php echo URL; ?>help/Dropdown/idSubactividades");
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function() {
    if(xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
      resolve(xhr.responseText);
    }
  };
  xhr.send();
});

Promise.all([idActividades, idSubactividades]).then(values => {
  let actividades = JSON.parse(values[0])[0];
  let subactividades = JSON.parse(values[1])[0];
  let todo = optionCrear(actividades.concat(subactividades));
  Elementos.IdActividadesSelect1.innerHTML = todo;
  Elementos.IdActividadesSelect2.innerHTML = todo;
});

function traerFinanzas(datos = ""){
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "<?php echo URL; ?>reporte/finanzas");
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function() {
    if(xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
      let respuesta = JSON.parse(xhr.responseText);
      Elementos.$TablaEgresos.bootstrapTable('load', respuesta[0]);
      Elementos.$TablaIngresos.bootstrapTable('load', respuesta[1]);
      Elementos.$TablaBalance.bootstrapTable('load', respuesta[2]);
      Elementos.ResumenEg.innerHTML = "";
      Elementos.ResumenIn.innerHTML = "";
      for (tot in respuesta[3]) {
        let dt = document.createElement("dt");
        dt.innerHTML = tot;
        let dd = document.createElement("dd");
        dd.innerHTML = "$" + respuesta[3][tot].Total;
        Elementos.ResumenEg.appendChild(dt);
        Elementos.ResumenEg.appendChild(dd);
      }
      for (tot in respuesta[4]) {
        let dt = document.createElement("dt");
        dt.innerHTML = tot;
        let dd = document.createElement("dd");
        dd.innerHTML = "$" + respuesta[4][tot].Total;
        Elementos.ResumenIn.appendChild(dt);
        Elementos.ResumenIn.appendChild(dd);
      }
      Elementos.TotBal.innerHTML = "$" + (respuesta[4]['Ingreso Total']['Total'] - respuesta[3]['Egreso Total']['Total']);    }
    };
    xhr.send("idFondos=" + Elementos.idFondosSelect.value + "&data=" + datos);
  }
  var idFondos = new XMLHttpRequest();
  idFondos.open("POST", "<?php echo URL; ?>help/Dropdown/idFondos");
  idFondos.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  idFondos.onreadystatechange = function() {
    if(idFondos.readyState === XMLHttpRequest.DONE && idFondos.status === 200) {
      Elementos.idFondosSelect.innerHTML = optionCrear(JSON.parse(idFondos.responseText)[0]);
    }
  };
  idFondos.send();

  Elementos.idFondosSelect.addEventListener('change', function(){
    traerFinanzas();
  });

  var mesesFondos = new XMLHttpRequest();
  mesesFondos.open("POST", "<?php echo URL; ?>reporte/mesesFondos");
  mesesFondos.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  mesesFondos.onreadystatechange = function() {
    if(mesesFondos.readyState === XMLHttpRequest.DONE && mesesFondos.status === 200) {
      let respuesta = JSON.parse(mesesFondos.responseText);
      Elementos.GraficoFondos.innerHTML="";
      Morris.Area({
        element: 'GraficoFondos',
        data: respuesta[0],
        xkey: 'Fecha',
        ykeys: respuesta[1],
        behaveLikeLine: true,
        labels: respuesta[1]
      });
    }
  };
  mesesFondos.send();

  traerAsistencias(new Date().getMonth() + 1)
  function traerAsistencias(mes) {
    let porcentajeAsistencias = new XMLHttpRequest();
    porcentajeAsistencias.open("POST", "<?php echo URL; ?>reporte/porcentajeAsistencias");
    porcentajeAsistencias.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    porcentajeAsistencias.onreadystatechange = function() {
      if(porcentajeAsistencias.readyState === XMLHttpRequest.DONE && porcentajeAsistencias.status === 200) {
        Elementos.TablaPorcentaje.innerHTML = "";
        let respuesta = JSON.parse(porcentajeAsistencias.responseText);
        let columnas = {Nombres: 'Nombre', Porcentaje: 'Porcentaje de asistencias este mes (%)'};
        for (act in respuesta) {
          Elementos.TablaPorcentaje.appendChild(generarTablaCheta(columnas, respuesta[act], act, 'idActividades'));
        }
      }
    };
    porcentajeAsistencias.send("data=" + mes);
  }

  Elementos.idMesesSelectAsis.addEventListener('change', function(){
    Elementos.TablaPorcentaje.innerHTML = "";
    traerAsistencias(idMesesSelectAsis.value);
  });
  Elementos.idMesesSelectExceso.addEventListener('change', function(){
    Elementos.TablaExc.innerHTML = "";
    esaRequest(Elementos.TablaExc, {Actividad: 'Actividad', Fecha: 'La semana del', Asistencias: 'Cantidad de asistencias', MaxXSemana: 'Máximo permitido'}, "morososExceso", "data=" + idMesesSelectExceso.value);
  });

  Elementos.FechaExam.addEventListener('click', function(){
    graficoExamen("data=" + JSON.stringify({Fecha1: Elementos.FechaExam1.value, Fecha2: Elementos.FechaExam2.value}));
  });
  graficoExamen("");
  function graficoExamen(send) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "<?php echo URL; ?>reporte/graficoExamen");
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
      if(xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
        Elementos.GraficoBarraExam.innerHTML="";
        Morris.Bar({
          element: 'GraficoBarraExam',
          data: JSON.parse(xhr.responseText),
          xkey: 'Nombre',
          ykeys: ['Cantidad'],
          hideHover: true,
          labels: ['Cantidad']
        });
      }
    };
    xhr.send(send);
  }

  Elementos.IdActividadesSelect2.addEventListener('change', function(){
    let graficoSexoActividad = new XMLHttpRequest();
    graficoSexoActividad.open("POST", "<?php echo URL; ?>reporte/graficoSexoActividad");
    graficoSexoActividad.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    graficoSexoActividad.onreadystatechange = function() {
      if(graficoSexoActividad.readyState === XMLHttpRequest.DONE && graficoSexoActividad.status === 200) {
        Elementos.GraficoBarraAct.innerHTML="";
        Morris.Bar({
          element: 'GraficoBarraAct',
          data: JSON.parse(graficoSexoActividad.responseText),
          xkey: 'Actividad',
          ykeys: ['CantMuj', 'CantHom'],
          hideHover: true,
          labels: ['Mujeres', 'Hombres']
        });
      }
    };
    graficoSexoActividad.send("data=" + Elementos.IdActividadesSelect2.value);
  });

  Elementos.IdActividadesSelect1.addEventListener('change', function(){
    let graficoEdadActividad = new XMLHttpRequest();
    graficoEdadActividad.open("POST", "<?php echo URL; ?>reporte/graficoEdadActividad");
    graficoEdadActividad.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    graficoEdadActividad.onreadystatechange = function() {
      if(graficoEdadActividad.readyState === XMLHttpRequest.DONE && graficoEdadActividad.status === 200) {
        let respuesta = JSON.parse(graficoEdadActividad.responseText);
        respuesta.sort(function(a, b) {
          return a.Edad - b.Edad;
        });
        Elementos.GraficoLinea.innerHTML="";
        Morris.Bar({
          element: 'GraficoLinea',
          data: respuesta,
          xkey: 'Edad',
          ykeys: ['CantidadMuj', 'CantidadHom'],
          parseTime: false,
          labels: ['Mujeres', 'Hombres']
        });
      }
    };
    graficoEdadActividad.send("data=" + Elementos.IdActividadesSelect1.value);
  });

  $('.collapse').collapse();
  $('.input-daterange').datepicker({
    format: "yyyy/mm/dd",
    endDate: "today",
    maxViewMode: 0,
    todayBtn: "linked",
    language: "es",
    autoclose: true,
    todayHighlight: true,
    forceParse: false
  });

  function rowStyle(row, index){
    if(row.Tipo == "Egreso" || row.Tipo == "Pago de sueldo" || row.Tipo == "Compra de stock"){
      return {classes: "danger"};
    }else{
      return {classes: "success"};
    }
  }

  Elementos.FechaProd.addEventListener('click', function(){
    let corteProd = new XMLHttpRequest();
    corteProd.open("POST", "<?php echo URL; ?>reporte/corteProd");
    corteProd.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    corteProd.onreadystatechange = function() {
      if(corteProd.readyState === XMLHttpRequest.DONE && corteProd.status === 200) {
        let respuesta = corteProd.responseText.split("_");
        respuesta[0] = JSON.parse(respuesta[0]);
        respuesta[1] = JSON.parse(respuesta[1]);
        Elementos.$TablaVentas.bootstrapTable('load', respuesta[0]);
        Elementos.$TablaGanancias.bootstrapTable('load', respuesta[1]);
      }
    };
    corteProd.send("data=" + JSON.stringify({Fecha1: Elementos.FechaProd1.value, Fecha2: Elementos.FechaProd2.value}));
  });

  Elementos.FechaFinan.addEventListener('click', function(){
    traerFinanzas(JSON.stringify({Fecha1: Elementos.FechaFinan1.value, Fecha2: Elementos.FechaFinan2.value}));
  });

  esaRequest(Elementos.TablaDeud, {Actividad: 'Actividad', Fecha: 'Fecha/Mes', Monto: 'Monto debido'}, "morososActividad");
  esaRequest(Elementos.TablaExc, {Actividad: 'Actividad', Fecha: 'La semana del', Asistencias: 'Cantidad de asistencias', MaxXSemana: 'Máximo permitido'}, "morososExceso", "data=" +  new Date().getMonth() + 1);

  function esaRequest(tabla, columnas, url, mensaje = ""){
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "<?php echo URL; ?>reporte/" + url);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
      if(xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
        let respuesta = JSON.parse(xhr.responseText);
        for (pers in respuesta) {
          tabla.appendChild(generarTablaCheta(columnas, respuesta[pers], pers, 'idClientes', url));
        }
      }
    };
    xhr.send(mensaje);
  }

  var morososMatricula = new XMLHttpRequest();
  morososMatricula.open("POST", "<?php echo URL; ?>reporte/morososMatricula");
  morososMatricula.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  morososMatricula.onreadystatechange = function() {
    if(morososMatricula.readyState === XMLHttpRequest.DONE && morososMatricula.status === 200) {
      let Matr = JSON.parse(morososMatricula.responseText)
      let l = Matr.length;
      let texto = "";
      for (var i = 0; i < l; i++) {
        texto += "<tr>";
        texto+="<td>" + Matr[i].Nombres + "</td>";
        texto+="</tr>";
      }
      Elementos.TablaMat.innerHTML = texto;
    }
  };
  morososMatricula.send();


  $('#myTabs a').click(function (e) {
    e.preventDefault()
    $(this).tab('show')
  });

</script>
