<?php

//namespace Models;

class cliente_Model extends Model {

    private $con;

    public function __construct() {
        require 'models/Conexion_Model.php';
        $this->con = new Conexion_Model();
    }

    public function set($atributo, $contenido) {
        $this->$atributo = $contenido;
    }

    public function get($atributo) {
        return $this->$atributo;
    }

    public function listadoClientes() {

        $sql = "SELECT idClientes, Nombres, Apellidos FROM clientes";

        $outp = $this->con->consultaRetorno($sql);
        foreach ($outp as $indice => $elemento) {
           foreach ($elemento as $key => $value) {
            $output[$indice][$key] = preg_replace_callback("/(&#[0-9]+;)/", function($m) { return mb_convert_encoding($m[1], "UTF-8", "HTML-ENTITIES"); }, $value); 
        } 
        }
        
        echo json_encode($output);
    }

    public function listadodropdowns() {
        $sql = array();
        $sql[0] = "SELECT idLocalidades as id, Nombre FROM localidades;";
        $sql[1] = "SELECT idGrupoFactorSanguineo as id, Nombre FROM grupofactorsanguineo;";
        $sql[2] = "SELECT idCategorias as id, Nombre FROM categorias;";
        $sql[3] = "SELECT idActividades as id, Nombre FROM actividades;";
        $sql[4] = "SELECT idSedes as id, Nombre FROM sedes;";
        $caca = $sql[0] . $sql[1] . $sql[2] . $sql[3] . $sql[4];
        $outp = $this->con->multiQuery($caca);
        
        foreach ($outp as $indice => $dropdown) {
           foreach ($dropdown as $key => $elemento) {
               foreach ($elemento as $lala => $value) {
                               $output[$indice][$key][$lala] = preg_replace_callback("/(&#[0-9]+;)/", function($m) { return mb_convert_encoding($m[1], "UTF-8", "HTML-ENTITIES"); }, $value); 
               }
        } 
        }
        echo json_encode($output);
    }

    public function traerCliente($idClientes) {
        $sql = "SELECT clientes.idClientes,clientes.Nombres,clientes.Apellidos,clientes.FechaNacimiento,clientes.DNI,clientes.Domicilio, localidades.Nombre as locNombre,clientes.CPostal,clientes.TelCel,clientes.Ocupacion,clientes.Email,clientes.Facebook,clientes.AutorizaWeb,clientes.AptoMedico,clientes.CoberturaMedica,clientes.NumSocioMed,clientes.TelEmergencias, grupofactorsanguineo.Nombre as sangNombre,clientes.Alergia,clientes.Patologia,clientes.IntQuirurgica,clientes.Lesion,clientes.Medicacion,clientes.Observaciones,clientes.PadMadTut,clientes.TelPadMadTut,clientes.CelPadMadTut,clientes.EmailPadMadTut,clientes.SeVaSolo,clientes.Retirar1NomAp,clientes.Retirar1DNI,clientes.Retirar2NomAp,clientes.Retirar2DNI,clientes.Retirar3NomAp,clientes.Retirar3DNI,clientes.Activo,clientes.EsInstructor,
                actividades.Nombre as actNombre, categorias.Nombre as catNombre, sedes.Nombre as sedNombre
                FROM clientes
                LEFT JOIN actividades ON clientes.idActividades = actividades.IdActividades
                LEFT JOIN categorias ON clientes.idCategorias = categorias.idCategorias
                LEFT JOIN grupofactorsanguineo ON clientes.IdGrupoFactorSanguineo = grupofactorsanguineo.idGrupoFactorSanguineo
                LEFT JOIN localidades ON clientes.IdLocalidades = localidades.idLocalidades
                LEFT JOIN sedes ON clientes.IdSedes = sedes.idSedes
                WHERE idClientes=$idClientes";
        $outp = $this->con->consultaRetorno($sql);
        foreach ($outp as $indice => $elemento) {
           foreach ($elemento as $key => $value) {
            $output[$indice][$key] = preg_replace_callback("/(&#[0-9]+;)/", function($m) { return mb_convert_encoding($m[1], "UTF-8", "HTML-ENTITIES"); }, $value); 
        } 
        }
        
        echo json_encode($output);
    }

    public function eliminarCliente($idClientes) {
        $sql = "DELETE FROM clientes WHERE idClientes = $idClientes";
        $this->con->consultaSimple($sql);
    }

    public function agregarModificarCliente($info) {
        $caca = json_decode($info, TRUE);
        foreach ($caca as $indice => $elemento) {
            $data[$indice] = htmlentities($elemento, ENT_QUOTES);
        }
        for ($x = 0; $x <= 40; $x++) {
            if ($data[$x] != "") {
                if (gettype($data[$x]) == 'string') {
                    $data[$x] = "'" . $data[$x] . "'";
                }
            } else {
                $data[$x] = 'null';
            }
        }

        if ($data[0] == 'null') {
            array_shift($data);
            $sql = "INSERT INTO
                    clientes(       
                    Nombres,
                    Apellidos,
                    FechaNacimiento,
                    DNI,
                    Domicilio,
                    IdLocalidades,
                    CPostal,
                    TelCel,
                    Ocupacion,
                    Email,
                    Facebook,
                    AutorizaWeb,
                    AptoMedico,
                    CoberturaMedica,
                    NumSocioMed,
                    TelEmergencias,
                    IdGrupoFactorSanguineo,
                    Alergia,
                    Patologia,
                    IntQuirurgica,
                    Lesion,
                    Medicacion,
                    Observaciones,
                    PadMadTut,
                    TelPadMadTut,
                    CelPadMadTut,
                    EmailPadMadTut,
                    SeVaSolo,
                    Retirar1NomAp,
                    Retirar1DNI,
                    Retirar2NomAp,
                    Retirar2DNI,
                    Retirar3NomAp,
                    Retirar3DNI,
                    Activo,
                    EsInstructor,
                    IdCategorias,
                    IdActividades,
                    IdSedes
                    )
                    VALUES($data[0],
                    $data[1],
                    $data[2],
                    $data[3],
                    $data[4],
                    $data[5],
                    $data[6],
                    $data[7],
                    $data[8],
                    $data[9],
                    $data[10],
                    $data[11],
                    $data[12],
                    $data[13],
                    $data[14],
                    $data[15],
                    $data[16],
                    $data[17],
                    $data[18],
                    $data[19],
                    $data[20],
                    $data[21],
                    $data[22],
                    $data[23],
                    $data[24],
                    $data[25],
                    $data[26],
                    $data[27],
                    $data[28],
                    $data[29],
                    $data[30],
                    $data[31],
                    $data[32],
                    $data[33],
                    $data[34],
                    $data[35],
                    $data[36],
                    $data[37],
                    $data[38])";
        } else {
            $sql = "UPDATE
                    clientes
                    SET
                    Nombres = $data[1],
                    Apellidos = $data[2],
                    FechaNacimiento = $data[3],
                    DNI = $data[4],
                    Domicilio = $data[5],
                    IdLocalidades = $data[6],
                    CPostal = $data[7],
                    TelCel = $data[8],
                    Ocupacion = $data[9],
                    Email = $data[10],
                    Facebook = $data[11],
                    AutorizaWeb = $data[12],
                    AptoMedico = $data[13],
                    CoberturaMedica = $data[14],
                    NumSocioMed = $data[15],
                    TelEmergencias = $data[16],
                    IdGrupoFactorSanguineo = $data[17],
                    Alergia = $data[18],
                    Patologia = $data[19],
                    IntQuirurgica = $data[20],
                    Lesion = $data[21],
                    Medicacion = $data[22],
                    Observaciones = $data[23],
                    PadMadTut = $data[24],
                    TelPadMadTut = $data[25],
                    CelPadMadTut = $data[26],
                    EmailPadMadTut = $data[27],
                    SeVaSolo = $data[28],
                    Retirar1NomAp = $data[29],
                    Retirar1DNI = $data[30],
                    Retirar2NomAp = $data[31],
                    Retirar2DNI = $data[32],
                    Retirar3NomAp = $data[33],
                    Retirar3DNI = $data[34],
                    Activo = $data[35],
                    EsInstructor = $data[36],
                    IdCategorias = $data[37],
                    IdActividades = $data[38],
                    IdSedes = $data[39]
                    WHERE idClientes=$data[0]";
        }
        $this->con->consultaSimple($sql);
    }

}
