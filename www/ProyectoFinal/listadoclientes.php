<?php

include ("conexion.php");

$sql = "SELECT idClientes, Nombres, Apellidos FROM clientes";
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
mysqli_close($mysqli);
?>