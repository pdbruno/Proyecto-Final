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

  TotEgr: document.getElementById("TotEgr"),
  TotCom: document.getElementById("TotCom"),
  TotTotEgr: document.getElementById("TotTotEgr"),
  TotCob: document.getElementById("TotCob"),
  TotVen: document.getElementById("TotVen"),
  TotTotIng: document.getElementById("TotTotIng"),
  TotBal: document.getElementById("TotBal"),
  IdActividadesSelect1: document.getElementById("IdActividadesSelect1"),
  IdActividadesSelect2: document.getElementById("IdActividadesSelect2"),
  $TablaVentas: $("#TablaVentas"),
  $TablaGanancias: $("#TablaGanancias"),
  $TablaEgresos: $("#TablaEgresos"),
  $TablaIngresos: $("#TablaIngresos"),
  $TablaBalance: $("#TablaBalance"),
};
var request = $.ajax({
  url: "<?php echo URL; ?>help/Dropdown/idActividades",
  type: "post"
});
request.done(function (respuesta){
  respuesta = JSON.parse(respuesta);
  let op = optionCrear(respuesta[0]);
  Elementos.IdActividadesSelect1.innerHTML = op;
  Elementos.IdActividadesSelect2.innerHTML = op;
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
    Elementos.GraficoLinea.innerHTML="";
    Morris.Line({
      element: 'GraficoLinea',
      data: JSON.parse(respuesta),
      xkey: 'Edad',
      ykeys: ['CantidadMuj', 'CantidadHom'],
      parseTime: false,
      labels: ['Mujeres', 'Hombres']
    });
  });
});


Elementos.$TablaEgresos.on('load-success.bs.table', function (e, data) {
  sortAppend(data);
});
Elementos.$TablaIngresos.on('load-success.bs.table', function (e, data) {
  sortAppend(data);
});
function sortAppend(data){
  Elementos.$TablaBalance.bootstrapTable('append', data);
  let caca = Elementos.$TablaBalance.bootstrapTable('getData');
  caca.sort(function(a,b){return new Date(b.Fecha) - new Date(a.Fecha);});
  Elementos.$TablaBalance.bootstrapTable('load', caca);
}
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
  if(row.Tipo == "Egreso"){
    return {classes: "danger"};
  }else{
    if(row.Tipo == "Ingreso"){
      return {classes: "success"};
    }
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
  var request = $.ajax({
    url: "<?php echo URL; ?>index/corteFinan",
    type: "post",
    data: "data=" + JSON.stringify({Fecha1: Elementos.FechaFinan1.value, Fecha2: Elementos.FechaFinan2.value})
  });
  request.done(function (respuesta){
    respuesta = respuesta.split("_");
    let l = respuesta.length;
    for (var i = 0; i < l; i++) {
      respuesta[i] = JSON.parse(respuesta[i]);
    }
    Elementos.$TablaEgresos.bootstrapTable('load', respuesta[0]);
    Elementos.$TablaIngresos.bootstrapTable('load', respuesta[1]);
    Elementos.$TablaBalance.bootstrapTable('removeAll');
    sortAppend(respuesta[0]);
    sortAppend(respuesta[1]);
    Elementos.TotEgr.innerHTML = respuesta[2][0]["SUM(Monto)"];
    Elementos.TotCom.innerHTML = respuesta[2][1]["SUM(Monto)"];
    Elementos.TotTotEgr.innerHTML = Number(respuesta[2][0]["SUM(Monto)"]) + Number(respuesta[2][1]["SUM(Monto)"]);
    Elementos.TotCob.innerHTML = respuesta[2][0]["SUM(Monto)"];
    Elementos.TotVen.innerHTML = respuesta[2][1]["SUM(Monto)"];
    Elementos.TotTotIng.innerHTML = Number(respuesta[2][0]["SUM(Monto)"]) + Number(respuesta[2][1]["SUM(Monto)"]);
    Elementos.TotBal.innerHTML = Number(respuesta[2][0]["SUM(Monto)"]) + Number(respuesta[2][1]["SUM(Monto)"]) - Number(respuesta[2][0]["SUM(Monto)"]) - Number(respuesta[2][1]["SUM(Monto)"]);

  });
});

var EgresosTotal = $.ajax({
  url: "<?php echo URL; ?>index/finanzasEgresosTotal",
  type: "post",
});
EgresosTotal.done(function (respuesta){
  respuesta = JSON.parse(respuesta);
  Elementos.TotEgr.innerHTML = respuesta[0]["SUM(Monto)"];
  Elementos.TotCom.innerHTML = respuesta[1]["SUM(Monto)"];
  Elementos.TotTotEgr.innerHTML = Number(respuesta[0]["SUM(Monto)"]) + Number(respuesta[1]["SUM(Monto)"]);
});

var IngresosTotal = $.ajax({
  url: "<?php echo URL; ?>index/finanzasIngresosTotal",
  type: "post",
});
IngresosTotal.done(function (respuesta){
  respuesta = JSON.parse(respuesta);
  Elementos.TotCob.innerHTML = respuesta[0]["SUM(Monto)"];
  Elementos.TotVen.innerHTML = respuesta[1]["SUM(Monto)"];
  Elementos.TotTotIng.innerHTML = Number(respuesta[0]["SUM(Monto)"]) + Number(respuesta[1]["SUM(Monto)"]);
});

$.when(IngresosTotal, EgresosTotal).done(function(a1, a2){
  a1 = JSON.parse(a1[0]);
  a2 = JSON.parse(a2[0]);
  Elementos.TotBal.innerHTML = Number(a1[0]["SUM(Monto)"]) + Number(a1[1]["SUM(Monto)"]) - Number(a2[0]["SUM(Monto)"]) - Number(a2[1]["SUM(Monto)"]);
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
  url: "<?php echo URL; ?>index/porcentajeAsistencias",
  type: "post",
});
request.done(function (respuesta){
  respuesta = JSON.parse(respuesta);
  let columnas = {Nombres: 'Nombre', Porcentaje: 'Porcentaje de asistencias este mes (%)'};
  for (act in respuesta) {
    Elementos.TablaPorcentaje.appendChild(generarTablaCheta(columnas, respuesta[act], act, 'idActividades'));
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
