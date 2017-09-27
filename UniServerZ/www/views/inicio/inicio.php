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
  IdActividadesSelect1: document.getElementById("IdActividadesSelect1"),
  IdActividadesSelect2: document.getElementById("IdActividadesSelect2"),
  idFondosSelect: document.getElementById("idFondosSelect"),
  $TablaVentas: $("#TablaVentas"),
  $TablaGanancias: $("#TablaGanancias"),
  $TablaEgresos: $("#TablaEgresos"),
  $TablaIngresos: $("#TablaIngresos"),
  $TablaBalance: $("#TablaBalance"),
};
var idActividades = $.ajax({
  url: "<?php echo URL; ?>help/Dropdown/idActividades",
  type: "post"
});

var idSubctividades = $.ajax({
  url: "<?php echo URL; ?>help/Dropdown/idSubactividades",
  type: "post"
});


$.when( idActividades, idSubctividades ).done(function ( v1, v2 ) {
  let actividades = JSON.parse(v1[0])[0]; // "Fish"
  let subactividades = JSON.parse(v2[0])[0]; // "Fish"
  let todo = optionCrear(actividades.concat(subactividades));
  Elementos.IdActividadesSelect1.innerHTML = todo;
  Elementos.IdActividadesSelect2.innerHTML = todo;
});


function traerFinanzas(datos = ""){
  request = $.ajax({
    url: "<?php echo URL; ?>index/finanzas",
    type: "post",
    data: "idFondos=" + Elementos.idFondosSelect.value + "&data=" + datos
  });
  request.done(function (respuesta){
    respuesta = JSON.parse(respuesta);
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
    Elementos.TotBal.innerHTML = "$" + (respuesta[4]['Ingreso Total']['Total'] - respuesta[3]['Egreso Total']['Total']);
  });
}

request = $.ajax({
  url: "<?php echo URL; ?>help/Dropdown/idFondos",
  type: "post"
});
request.done(function (respuesta){
  Elementos.idFondosSelect.innerHTML = optionCrear(JSON.parse(respuesta)[0]);
});
Elementos.idFondosSelect.addEventListener('change', function(){
  traerFinanzas();
});


request = $.ajax({
  url: "<?php echo URL; ?>index/mesesFondos",
  type: "post"
});
request.done(function (respuesta){
  respuesta = JSON.parse(respuesta);
  Elementos.GraficoFondos.innerHTML="";
  Morris.Area({
    element: 'GraficoFondos',
    data: respuesta[0],
    xkey: 'Fecha',
    ykeys: respuesta[1],
    behaveLikeLine: true,
    labels: respuesta[1]
  });
});



Elementos.porcentajeMeses.addEventListener('change', function(){
  var request = $.ajax({
    url: "<?php echo URL; ?>index/porcentajeAsistencias",
    type: "post",
    data: "data=" + Elementos.porcentajeMeses.value
  });
  request.done(function (respuesta){
    Elementos.TablaPorcentaje.innerHTML = "";
    respuesta = JSON.parse(respuesta);
    let columnas = {Nombres: 'Nombre', Porcentaje: 'Porcentaje de asistencias este mes (%)'};
    for (act in respuesta) {
      Elementos.TablaPorcentaje.appendChild(generarTablaCheta(columnas, respuesta[act], act, 'idActividades'));
    }
  });
});


Elementos.IdActividadesSelect2.addEventListener('change', function(){
  var request = $.ajax({
    url: "<?php echo URL; ?>index/graficoSexoActividad",
    type: "post",
    data: "data=" + Elementos.IdActividadesSelect2.value
  });
  request.done(function (respuesta){
    Elementos.GraficoBarra.innerHTML="";
    Morris.Bar({
      element: 'GraficoBarra',
      data: JSON.parse(respuesta),
      xkey: 'Actividad',
      ykeys: ['CantHom', 'CantMuj'],
      hideHover: true,
      labels: ['Hombres', 'Mujeres']
    });
  });
});

Elementos.IdActividadesSelect1.addEventListener('change', function(){
  var request = $.ajax({
    url: "<?php echo URL; ?>index/graficoEdadActividad",
    type: "post",
    data: "data=" + Elementos.IdActividadesSelect1.value
  });
  request.done(function (respuesta){
    respuesta = JSON.parse(respuesta);
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
  });
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
  var request = $.ajax({
    url: "<?php echo URL; ?>index/corteProd",
    type: "post",
    data: "data=" + JSON.stringify({Fecha1: Elementos.FechaProd1.value, Fecha2: Elementos.FechaProd2.value})
  });
  request.done(function (respuesta){
    respuesta = respuesta.split("_");
    respuesta[0] = JSON.parse(respuesta[0]);
    respuesta[1] = JSON.parse(respuesta[1]);
    Elementos.$TablaVentas.bootstrapTable('load', respuesta[0]);
    Elementos.$TablaGanancias.bootstrapTable('load', respuesta[1]);
  });
});

Elementos.FechaFinan.addEventListener('click', function(){
  traerFinanzas(JSON.stringify({Fecha1: Elementos.FechaFinan1.value, Fecha2: Elementos.FechaFinan2.value}));
});


var request = $.ajax({
  url: "<?php echo URL; ?>index/morososActividad",
  type: "post",
});
request.done(function (respuesta){
  respuesta = JSON.parse(respuesta);
  let columnas = {Actividad: 'Actividad', Fecha: 'Fecha/Mes', Monto: 'Monto debido'};
  for (pers in respuesta) {
    Elementos.TablaDeud.appendChild(generarTablaCheta(columnas, respuesta[pers], pers, 'idClientes'));
  }
});

var request = $.ajax({
  url: "<?php echo URL; ?>index/morososExceso",
  type: "post",
});
request.done(function (respuesta){
  respuesta = JSON.parse(respuesta);
  let columnas = {Actividad: 'Actividad', Fecha: 'La semana del', Asistencias: 'Cantidad de asistencias', MaxXSemana: 'Máximo permitido'};
  for (pers in respuesta) {
    Elementos.TablaExc.appendChild(generarTablaCheta(columnas, respuesta[pers], pers, 'idClientes'));
  }
});


var request = $.ajax({
  url: "<?php echo URL; ?>index/morososMatricula",
  type: "post",
});
request.done(function (respuesta){
  let Matr = JSON.parse(respuesta)
  let l = Matr.length;
  let texto = "";
  for (var i = 0; i < l; i++) {
    texto += "<tr>";
    texto+="<td>" + Matr[i].Nombres + "</td>";
    texto+="</tr>";
  }
  Elementos.TablaMat.innerHTML = texto;
});


$('#myTabs a').click(function (e) {
  e.preventDefault()
  $(this).tab('show')
});

</script>
