Elementos.$tooltips.tooltip();
var bien = true;
var l = Elementos.inputs.length;
for (var i = 0; i < l; i++) {
  Elementos[Elementos.inputs[i] + "Form"] = document.getElementById(Elementos.inputs[i] + "Form");
  Elementos[Elementos.inputs[i] + "Group"] = $("#" + Elementos.inputs[i] + "Group");
  Elementos[Elementos.inputs[i] + "Error"] = $("#" + Elementos.inputs[i] + "Error");
}
Elementos.$FechaForm.datepicker({
  format: "yyyy/mm/dd",
  startDate: "01/01/2017",
  endDate: "today",
  maxViewMode: 0,
  todayBtn: "linked",
  language: "es",
  autoclose: true,
  todayHighlight: true,
  forceParse: false
});
function lala(){
  for (var i = 0; i < 4; i++) {
    bien = true;
    Elementos[Elementos.inputs[i] + "Group"].removeClass("has-error");
    Elementos[Elementos.inputs[i] + "Error"].addClass("hidden").text("Campo Obligatorio");

    if (Elementos[Elementos.inputs[i] + "Form"].value == "") {
      Elementos[Elementos.inputs[i] + "Group"].addClass("has-error");
      Elementos[Elementos.inputs[i] + "Error"].removeClass("hidden");
      bien = false;
    }
  }
}

function err(Nom){
  Elementos[Nom + "Group"].addClass("has-error");
  Elementos[Nom + "Error"].removeClass("hidden").text("Debe ser mayor a 1");
  bien = false;
}
