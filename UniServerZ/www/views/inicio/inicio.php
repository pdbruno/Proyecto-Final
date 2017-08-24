<script>
var Elementos = {
  TablaMor: document.getElementById("TablaMor"),
  ListaMatr: "",
  ListaDeud: "",
};
var request = $.ajax({
  url: "<?php echo URL; ?>index/morososMatricula",
  type: "post",
});
request.done(function (respuesta){
  var Matr = JSON.parse(respuesta)
  let l = Matr.length;
  let texto = "";
  document.getElementById("CantMatr").innerHTML = l;
  for (var i = 0; i < l; i++) {
    texto += "<tr>";
    texto+="<td>" + Matr[i].Nombres + "</td>";
    texto+="</tr>";
  }
  TablaMor.innerHTML = texto;
});

$('#ModalMor').on('show.bs.modal', function (event) {
  let button = $(event.relatedTarget); // Button that triggered the modal
  let titulo = button.data('titulo'); // Extract info from data-* attributes
  let head = button.data('head');
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  let modal = $(this);
  modal.find('.modal-title').text(titulo);
  modal.find('.modal-body thead tr').html(head);
})
</script>
