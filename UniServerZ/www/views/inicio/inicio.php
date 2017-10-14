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
  FechaFinan: document.getElementById("FechaFinan"),
  FechaFinan1: document.getElementById("FechaFinan1"),
  FechaFinan2: document.getElementById("FechaFinan2"),
  GraficoLinea: document.getElementById("GraficoLinea"),
  GraficoBarra: document.getElementById("GraficoBarra"),
  GraficoFondos: document.getElementById("GraficoFondos"),
  porcentajeMeses: document.getElementById("porcentajeMeses"),

  ResumenEg: document.getElementById("ResumenEg"),
  ResumenIn: document.getElementById("ResumenIn"),
  TotBal: document.getElementById("TotBal"),
  idMesesSelect: document.getElementById("idMesesSelect"),
  IdActividadesSelect1: document.getElementById("IdActividadesSelect1"),
  IdActividadesSelect2: document.getElementById("IdActividadesSelect2"),
  idFondosSelect: document.getElementById("idFondosSelect"),
  $TablaVentas: $("#TablaVentas"),
  $TablaGanancias: $("#TablaGanancias"),
  $TablaEgresos: $("#TablaEgresos"),
  $TablaIngresos: $("#TablaIngresos"),
  $TablaBalance: $("#TablaBalance"),
};

  var idMeses = new XMLHttpRequest();
  idMeses.open("POST", "<?php echo URL; ?>help/Dropdown/idMeses");
  idMeses.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  idMeses.onreadystatechange = function() {
    if(idMeses.readyState === XMLHttpRequest.DONE && idMeses.status === 200) {
      Elementos.idMesesSelect.innerHTML = optionCrear(JSON.parse(idMeses.responseText)[0]);
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
  xhr.open("POST", "<?php echo URL; ?>index/finanzas");
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
mesesFondos.open("POST", "<?php echo URL; ?>index/mesesFondos");
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


Elementos.idMesesSelect.addEventListener('change', function(){
  let porcentajeAsistencias = new XMLHttpRequest();
  porcentajeAsistencias.open("POST", "<?php echo URL; ?>index/porcentajeAsistencias");
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
  porcentajeAsistencias.send("data=" + Elementos.idMesesSelect.value);
});


Elementos.IdActividadesSelect2.addEventListener('change', function(){
  let graficoSexoActividad = new XMLHttpRequest();
  graficoSexoActividad.open("POST", "<?php echo URL; ?>index/graficoSexoActividad");
  graficoSexoActividad.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  graficoSexoActividad.onreadystatechange = function() {
    if(graficoSexoActividad.readyState === XMLHttpRequest.DONE && graficoSexoActividad.status === 200) {
      Elementos.GraficoBarra.innerHTML="";
      Morris.Bar({
        element: 'GraficoBarra',
        data: JSON.parse(graficoSexoActividad.responseText),
        xkey: 'Actividad',
        ykeys: ['CantHom', 'CantMuj'],
        hideHover: true,
        labels: ['Hombres', 'Mujeres']
      });
    }
  };
  graficoSexoActividad.send("data=" + Elementos.IdActividadesSelect2.value);
});

Elementos.IdActividadesSelect1.addEventListener('change', function(){
  let graficoEdadActividad = new XMLHttpRequest();
  graficoEdadActividad.open("POST", "<?php echo URL; ?>index/graficoEdadActividad");
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
  corteProd.open("POST", "<?php echo URL; ?>index/corteProd");
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

var morososActividad = new XMLHttpRequest();
morososActividad.open("POST", "<?php echo URL; ?>index/morososActividad");
morososActividad.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
morososActividad.onreadystatechange = function() {
  if(morososActividad.readyState === XMLHttpRequest.DONE && morososActividad.status === 200) {
    let respuesta = JSON.parse(morososActividad.responseText);
    let columnas = {Actividad: 'Actividad', Fecha: 'Fecha/Mes', Monto: 'Monto debido'};
    for (pers in respuesta) {
      Elementos.TablaDeud.appendChild(generarTablaCheta(columnas, respuesta[pers], pers, 'idClientes'));
    }
  }
};
morososActividad.send();

var morososExceso = new XMLHttpRequest();
morososExceso.open("POST", "<?php echo URL; ?>index/morososExceso");
morososExceso.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
morososExceso.onreadystatechange = function() {
  if(morososExceso.readyState === XMLHttpRequest.DONE && morososExceso.status === 200) {
    let respuesta = JSON.parse(morososExceso.responseText);
    let columnas = {Actividad: 'Actividad', Fecha: 'La semana del', Asistencias: 'Cantidad de asistencias', MaxXSemana: 'Máximo permitido'};
    for (pers in respuesta) {
      Elementos.TablaExc.appendChild(generarTablaCheta(columnas, respuesta[pers], pers, 'idClientes', true));
    }
  }
};
morososExceso.send();

var morososMatricula = new XMLHttpRequest();
morososMatricula.open("POST", "<?php echo URL; ?>index/morososMatricula");
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
