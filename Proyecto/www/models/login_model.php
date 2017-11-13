<?php

class logIn_Model extends Model {

  public function __construct() {
    parent::__construct();
  }

  public function logIn($data)
  {
      $outp = $this->db->getRow("SELECT * FROM usuarios WHERE idUsuarios = ?i", $data->idUsuarios);
      if (password_verify($data->Password, $outp['Password'])) {
        $_SESSION['logueado'] = true;
        $_SESSION['rol'] = $data->idUsuarios;
        $_SESSION['UsuarioDB'] = $outp['Nombre'];
        $_SESSION['ContraDB'] = $data->Password;
        echo "si";
      } else {
        echo "no";
      }
  }

  public function checkContra($Password)
  {
      $outp = $this->db->getCol("SELECT Password FROM usuarios WHERE idUsuarios IN (1, 2)");
      if (password_verify($Password, $outp[0]) || password_verify($Password, $outp[1])) {
        echo "si";
      } else {
        echo "no";
      }
  }

}
