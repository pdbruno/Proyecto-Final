<?php

class logIn_Model extends Model {

  public function __construct() {
    parent::__construct();
  }

  public function logIn($data)
  {
      $outp = $this->db->getRow("SELECT * FROM usuarios WHERE idUsuarios = ?i", $data->idUsuarios);
      if (password_verify($data->Password, $outp['Password'])) {
        echo "si";
      } else {
        echo "no";
      }

  }

}
