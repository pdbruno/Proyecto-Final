<script type="text/javascript">
var Elementos = {
  idUsuariosSelect: document.getElementById("idUsuariosSelect"),
  Password: document.getElementById("Password"),
  BtnAceptar: document.getElementById("BtnAceptar"),
  Error: document.getElementById("Error"),
  Grupo: document.getElementById("Grupo"),
};

Elementos.BtnAceptar.addEventListener("click", function() {
  Elementos.Grupo.className = "form-group";
  Elementos.Error.classList.add("hidden");
  Elementos.Error.innerHTML = "";
  if (Elementos.Password.value == "") {
    Elementos.Error.innerHTML = "Ingrese una Contraseña";
    Elementos.Error.classList.remove("hidden");
    Elementos.Grupo.classList.add("has-warning");
  }else {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "<?php echo URL; ?>login/logIn");
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
      if(xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
        if (xhr.responseText == "no") {
          Elementos.Error.innerHTML = "Contraseña Incorrecta";
          Elementos.Error.classList.remove("hidden");
          Elementos.Grupo.classList.add("has-error");
        }else {
          window.location.replace("<?php echo URL; ?>");
        }
      }
    };
    xhr.send("data=" + JSON.stringify({idUsuarios: Elementos.idUsuariosSelect.value, Password: Elementos.Password.value}));
  }
});
</script>
