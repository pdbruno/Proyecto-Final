<?php

class Model {

    function __construct() {
        $opts = array(
            'user' => 'root',
            'pass' => '12345',
            'db' => 'dbproyectofinal',
            'charset' => 'utf8'
        );
        $this->db = new SafeMySQL($opts);
    }

}
