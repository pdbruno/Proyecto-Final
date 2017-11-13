<script>
var accion;
var NombrePrevio;
var tabla;
var funcAllamar = function($element){
  tabla = $element.Tables_in_dbproyectofinal;

  ElemForm.$Tabla.bootstrapTable('destroy').bootstrapTable({
    url: "<?php echo URL; ?>help/listarColumnas/" + tabla,
    columns: [{
        field: 'COLUMN_NAME',
        title: 'Nombre del campo'
    }, {
        field: 'COLUMN_COMMENT',
        title: 'Nombre posssta'
    }]
  });

  funcAllamar = function($element, field){
    $('.success').removeClass('success');
    $(field).addClass('success');
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "<?php echo URL; ?>help/traerColumna/" + tabla);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
      if(xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
        clickFila(JSON.parse(xhr.responseText)[0]);
      }
    };
    xhr.send("data=" + $element.COLUMN_NAME);
  };
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
ElemForm.BtnAgregar.addEventListener("click", function() {
  modoFormulario('Agregar');
  accion = 'Agregar';
});
ElemForm.BtnModificar.addEventListener("click", function() {
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
ElemForm.BtnAceptar.addEventListener("click", function() {
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
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "<?php echo URL; ?>help/" + url + tabla);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
      if(xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
        afterEnviar();
      }
    };
    xhr.send("data=" + JSON.stringify(vec));
  }

});

$('#Tabla').on('click-row.bs.table', function (row, $element, field) {
  funcAllamar($element, field);
});
</script>
