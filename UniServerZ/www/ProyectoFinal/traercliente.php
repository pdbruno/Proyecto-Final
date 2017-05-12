<?php

include ("conexion.php");

$idClientes = $_POST['data'];
$sql = "SELECT clientes.idClientes,clientes.Nombres,clientes.Apellidos,clientes.FechaNacimiento,clientes.DNI,clientes.Domicilio, localidades.Nombre as locNombre,clientes.CPostal,clientes.TelCel,clientes.Ocupacion,clientes.Email,clientes.Facebook,clientes.AutorizaWeb,clientes.AptoMedico,clientes.CoberturaMedica,clientes.NumSocioMed,clientes.TelEmergencias, grupofactorsanguineo.Nombre as sangNombre,clientes.Alergia,clientes.Patologia,clientes.IntQuirurgica,clientes.Lesion,clientes.Medicacion,clientes.Observaciones,clientes.PadMadTut,clientes.TelPadMadTut,clientes.CelPadMadTut,clientes.EmailPadMadTut,clientes.SeVaSolo,clientes.Retirar1NomAp,clientes.Retirar1DNI,clientes.Retirar2NomAp,clientes.Retirar2DNI,clientes.Retirar3NomAp,clientes.Retirar3DNI,clientes.Activo,clientes.EsInstructor,
actividades.Nombre as actNombre, categorias.Nombre as catNombre, sedes.Nombre as sedNombre
FROM clientes
LEFT JOIN actividades ON clientes.idActividades = actividades.IdActividades
LEFT JOIN categorias ON clientes.idCategorias = categorias.idCategorias
LEFT JOIN grupofactorsanguineo ON clientes.IdGrupoFactorSanguineo = grupofactorsanguineo.idIdGrupoFactorSanguineo
LEFT JOIN localidades ON clientes.IdLocalidades = localidades.idLocalidades
LEFT JOIN sedes ON clientes.IdSedes = sedes.idSedes
WHERE idClientes=$idClientes";
$resultado = mysqli_query($mysqli, $sql);
if (!$resultado) {
    echo mysqli_error($conn);
} else {
    $outp = array();
    $outp = $resultado->fetch_all(MYSQLI_ASSOC);
    foreach ($outp[0] as $key => $value) {
        $output[$key] = htmlentities($value);
    }
    echo json_encode($outp);
}
mysqli_free_result($result);
mysqli_close($conn);
?>