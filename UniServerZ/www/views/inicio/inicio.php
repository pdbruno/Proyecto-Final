<script src="<?php echo URL; ?>views/recursos/bootstrap-table/bootstrap-table.min.js"></script>
<script src="<?php echo URL; ?>views/recursos/bootstrap-table/bootstrap-table-es-AR.min.js"></script>
<script src="<?php echo URL; ?>views/recursos/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo URL; ?>views/recursos/bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js" charset="UTF-8"></script>
<script>
var Elementos = {
  TablaMat: document.getElementById("TablaMat"),
  TablaDeud: document.getElementById("TablaDeud"),
  TablaExc: document.getElementById("TablaExc"),
  FechaProd: document.getElementById("FechaProd"),
  FechaProd1: document.getElementById("FechaProd1"),
  FechaProd2: document.getElementById("FechaProd2"),
  $productosVentas: $("#productosVentas"),
  $productosGanancias: $("#productosGanancias"),
  ListaMatr: "",
};
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

Elementos.FechaProd.addEventListener('click', function(){
  var request = $.ajax({
    url: "<?php echo URL; ?>index/corteProd",
    type: "post",
    data: "data=" + JSON.stringify({Fecha1: Elementos.FechaProd1.value, Fecha2: Elementos.FechaProd2.value})
  });
  request.done(function (respuesta){
    let Ventas = JSON.parse(respuesta.substring(0, respuesta.indexOf("]") + 1));
    let Ganancias = JSON.parse(respuesta.substring(respuesta.indexOf("]") + 1));
    Elementos.$productosVentas.bootstrapTable('load', Ventas);
    Elementos.$productosGanancias.bootstrapTable('load', Ganancias);
  });
});

var request = $.ajax({
  url: "<?php echo URL; ?>index/morososActividad",
  type: "post",
});
request.done(function (respuesta){
  respuesta = JSON.parse(respuesta);
  let columnas = {Actividad: 'Actividad', Fecha: 'Fecha/Mes', Monto: 'Monto debido'};
  for (pers in respuesta) {
    Elementos.TablaDeud.appendChild(generarTablaCheta(columnas, respuesta[pers], pers));
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
    Elementos.TablaExc.appendChild(generarTablaCheta(columnas, respuesta[pers], pers));
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
})

</script>
