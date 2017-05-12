<?php
include ("conexion.php");

$idClientes = $_POST['data'];
$sql = "DELETE FROM clientes WHERE idClientes = $idClientes";
$resultado = mysqli_query($mysqli, $sql);
if ($resultado) {
    echo "Exitosamente borrado";
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}

mysqli_close($conn);
?>