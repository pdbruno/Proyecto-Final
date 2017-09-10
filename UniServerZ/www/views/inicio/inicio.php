<script>
var Elementos = {
  TablaMat: document.getElementById("TablaMat"),
  TablaDeud: document.getElementById("TablaDeud"),
  TablaExc: document.getElementById("TablaExc"),
  ListaMatr: "",
  ListaDeud: []
};
$('.collapse').collapse();

var request = $.ajax({
  url: "<?php echo URL; ?>help/listarColumnas/deudas",
  type: "post",
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
