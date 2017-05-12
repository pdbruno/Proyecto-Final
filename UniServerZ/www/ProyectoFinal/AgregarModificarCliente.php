<?php

include ("conexion.php");
$data = json_decode($_POST["data"], TRUE);
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
    $data[38]
)";
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
//$resultado = mysqli_query($mysqli, $sql);
if ($mysqli->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "</br>" . $mysqli->error;
}
$mysqli->close();
