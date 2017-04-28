<?php
include ("conexion.php");

$idClientes = $_POST['data'];
var_dump($idClientes);
$sql = "SELECT * FROM clientes WHERE idClientes='$idClientes'";
$resultado = mysqli_query($mysqli, $sql);
if (!$resultado) {
    die("Error");
} else {
    $Vec["data"] = [];
    while ($data = mysqli_fetch_assoc($resultado)) {
        $Vec["data"][] = array_map("utf8_encode", $data);
    }
    echo json_encode($Vec);
}
mysqli_free_result($result);
mysqli_close($conn);
?>