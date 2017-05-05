<?php

include ("conexion.php");

$idClientes = $_POST['data'];
//SELECT clientes.*, actividades.Nombre, categorias.Nombre, grupofactorsanguineo.Nombre, localidades.Nombre, sedes.Nombre
//FROM (((((clientes
//INNER JOIN actividades ON clientes.idActividades = actividades.IdActividades)
//INNER JOIN categorias ON clientes.idCategorias = categorias.idCategorias)
//INNER JOIN grupofactorsanguineo ON clientes.IdGrupoFactorSanguineo = grupofactorsanguineo.idIdGrupoFactorSanguineo)
//INNER JOIN localidades ON clientes.IdLocalidades = localidades.idLocalidades)
//INNER JOIN sedes ON clientes.IdSedes = sedes.idSedes)
//WHERE idClientes=$idClientes
$sql = "SELECT * FROM clientes WHERE idClientes=$idClientes";
$resultado = mysqli_query($mysqli, $sql);
if (!$resultado) {
    die("Error");
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