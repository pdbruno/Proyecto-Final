<?php

class Help_Model extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function nuevoObjeto($data, $tipo) {
        $obj['id'.$tipo] = $data[0];
        $obj['Nombre'] = $data[1];
        return $obj;
    }

}
