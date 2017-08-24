<script>
var accion;
var NombrePrevio;
var Elementos = {
  SelectTabla : document.getElementById("SelectTabla"),
};
crearCampos([
  {
    IS_NULLABLE: "NO",
    COLUMN_NAME: "COLUMN_NAME",
    DATA_TYPE: "text",
    COLUMN_COMMENT: "Nombre real",
    COLUMN_KEY: ""
  },
  {
    IS_NULLABLE: "NO",
    COLUMN_NAME: "IS_NULLABLE",
    DATA_TYPE: "tinyint",
    COLUMN_COMMENT: "Es opcional",
    COLUMN_KEY: ""
  },
  {
    IS_NULLABLE: "NO",
    COLUMN_NAME: "DATA_TYPE",
    DATA_TYPE: "int",
    COLUMN_COMMENT: "Tipo de dato",
    COLUMN_KEY: "MUL"
  },
  {
    IS_NULLABLE: "NO",
    COLUMN_NAME: "COLUMN_COMMENT",
    DATA_TYPE: "text",
    COLUMN_COMMENT: "Nombre para mostrar",
    COLUMN_KEY: ""
  }
]);
llenarDropdowns([[
  {
    id: "text",
    Nombre: "Texto"
  },
  {
    id: "decimal",
    Nombre: "Decimal (con coma)"
  },
  {
    id: "int",
    Nombre: "Entero (sin coma)"
  },
  {
    id: "date",
    Nombre: "Fecha"
  },
  {
    id: "tinyint",
    Nombre: "Verdadero/Falso"
  }
]]);
document.getElementById("BtnAgregar").addEventListener("click", function() {
  modoFormulario('Agregar');
  accion = 'Agregar';
});
document.getElementById("BtnModificar").addEventListener("click", function() {
  NombrePrevio = document.getElementById("COLUMN_NAME").innerHTML;
  modoFormulario('Modificar');
  accion = 'Modificar';
  let select = document.getElementById("DATA_TYPESelect");
  let opciones = select.options;
  let l = select.length;
  for (var j = 0; j < l; j++) {
    if (opciones[j].value == document.getElementById("DATA_TYPEForm").value) {
      select.selectedIndex = j;
      break;
    }
  }
});
document.getElementById("BtnAceptar").addEventListener("click", function() {
  let vec = beforeEnviar();
  if (vec != 'no') {
    vec.IS_NULLABLE = (vec.IS_NULLABLE === "0") ? "NOT NULL " : "";
    let url;
    if (accion == 'Agregar') {
      url = "addColumna/";
    }else if (accion == 'Modificar') {
      url = "editarColumna/";
      vec.NombrePrevio = NombrePrevio;
    }
    var request = $.ajax({
      url: "<?php echo URL; ?>help/" + url + Elementos.SelectTabla.value,
      type: "post",
      data: "data=" + JSON.stringify(vec),
    });
    request.done(function (respuesta){
      afterEnviar();
    });
  }

});
var request = $.ajax({
  url: "<?php echo URL; ?>help/listarTablas",
  type: "post",
});
request.done(function (respuesta){
  Elementos.SelectTabla.innerHTML += optionCrear(JSON.parse(respuesta));
});
Elementos.SelectTabla.addEventListener("input", function() {
  $('#TodoLoDemas').removeClass('hidden');
  $('#Tabla').bootstrapTable({
    url: "<?php echo URL; ?>help/listarColumnas/" + Elementos.SelectTabla.value,
    search: true
});
});
$('#Tabla').on('click-row.bs.table', function (row, $element, field) {
  $('.success').removeClass('success');
  $(field).addClass('success');
  let request = $.ajax({
    url: "<?php echo URL; ?>help/traerColumna/" + Elementos.SelectTabla.value,
    type: "post",
    data: "data=" + $element.COLUMN_NAME,
  });
  request.done(function (respuesta){
    clickFila(JSON.parse(respuesta)[0]);
  });
});
</script>
