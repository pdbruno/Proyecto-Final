<script>
var Elementos = {
  TablaMor: document.getElementById("TablaMor"),
  ListaMatr: "",
  ListaDeud: []
};
$('.collapse').collapse()
var request = $.ajax({
  url: "<?php echo URL; ?>index/morososActividad",
  type: "post",
});
request.done(function (respuesta){
  let Mor = JSON.parse(respuesta)
  let l = 0;
  for (x in Mor) {
    l++;
    let trpricipal = document.createElement("tr");
    let tdpricipal = document.createElement("td");
    tdpricipal.style.padding = 0;
    trpricipal.appendChild(tdpricipal);

    let listgroup = document.createElement("div");
    listgroup.className = "list-group";
    listgroup.style.margin = 0;
    tdpricipal.appendChild(listgroup);

    let listgroupitem = document.createElement("a");
    listgroupitem.className = "list-group-item";
    listgroupitem.href = "#" + + Mor[x][0].idClientes;
    listgroupitem.innerHTML = x;
    listgroupitem.style.border = "none";
    listgroupitem.setAttribute("data-toggle", "collapse");
    listgroup.appendChild(listgroupitem);

    let collapse = document.createElement("div");
    collapse.className = "collapse";
    collapse.id = Mor[x][0].idClientes;
    tdpricipal.appendChild(collapse);

    let table = document.createElement("table");
    table.className = "table table-hover";
    collapse.appendChild(table);

    let thead = document.createElement("thead");
    table.appendChild(thead);

    let trsecundario = document.createElement("tr");
    thead.appendChild(trsecundario);

    let thAct = document.createElement("th");
    thAct.innerHTML = "Actividad";
    trsecundario.appendChild(thAct);
    let thFec = document.createElement("th");
    thFec.innerHTML = "Fecha";
    trsecundario.appendChild(thFec);
    let thMon = document.createElement("th");
    thMon.innerHTML = "Monto";
    trsecundario.appendChild(thMon);

    let tbody = document.createElement("tbody");
    table.appendChild(tbody);
    let ll = Mor[x].length;
    for (let i = 0; i < ll; i++) {
      tbody.appendChild(verDeudas(Mor[x][i]));
    }
    Elementos.ListaDeud.push(trpricipal);
  }
  document.getElementById("CantDeud").innerHTML = l;
});


var request = $.ajax({
  url: "<?php echo URL; ?>index/morososMatricula",
  type: "post",
});
request.done(function (respuesta){
  let Matr = JSON.parse(respuesta)
  let l = Matr.length;
  let texto = "";
  document.getElementById("CantMatr").innerHTML = l;
  for (var i = 0; i < l; i++) {
    texto += "<tr>";
    texto+="<td>" + Matr[i].Nombres + "</td>";
    texto+="</tr>";
  }
  Elementos.ListaMatr = texto;
});

$('#ModalMor').on('show.bs.modal', function (event) {
  let button = $(event.relatedTarget); // Button that triggered the modal
  let titulo = button.data('titulo'); // Extract info from data-* attributes
  let head = button.data('head');
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  let modal = $(this);
  modal.find('.modal-title').text(titulo);
});

document.getElementById("VerMat").addEventListener("click", function() {
  Elementos.TablaMor.innerHTML = Elementos.ListaMatr;
});

document.getElementById("VerDeud").addEventListener("click", function() {
  Elementos.TablaMor.innerHTML = "";
  let l = Elementos.ListaDeud.length;
  for (var i = 0; i < l; i++) {
    Elementos.TablaMor.appendChild(Elementos.ListaDeud[i]);
  }
});
</script>
