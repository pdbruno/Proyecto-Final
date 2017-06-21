<?php

//namespace Models;

//class Conexion_Model extends Model {
//
//    private $host = 'localhost';
//    private $db = 'dbproyectofinal';
//    private $user = 'root';
//    private $pass = 12345;
//    private $charset = 'utf8';
//    private $DBH;
//
//    public function __construct() {
//        
//    }
//
//    public function cerrarConexion() {
//        $this->$DBH = null;
//    }
//
//    public function consultaSimple($STH) {
//        $STH->execute();
//    }
//
//    public function consultaRetorno($STH) {
//
//        $STH->execute();
//        $outp = $STH->fetch_all();
//
//        return $outp;
//    }
//
//    public function multiQuery($sql) {
//        $todo = array();
//        if ($this->mysqli->multi_query($sql)) {
//            do {
//                if ($result = $this->mysqli->store_result()) {
//                    while ($row = $result->fetch_row()) {
//                        $elemento['id'] = htmlentities($row[0]);
//                        $elemento['Nombre'] = htmlentities($row[1]);
//                        $dropdown[] = $elemento;
//                    }
//                    $result->free();
//                }
//                if ($this->mysqli->more_results()) {
//                    $todo[] = $dropdown;
//                    $dropdown = array();
//                }
//            } while ($this->mysqli->next_result());
//            $todo[] = $dropdown;
//            return $todo;
//        } else {
//            die("Connection failed: " . $this->mysqli->connect_error);
//        }
//    }
//
//}
