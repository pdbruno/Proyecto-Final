<?php

$sql['host'] = 'localhost';
$sql['user'] = 'root';
$sql['password'] = 12345;
$sql['db'] = 'dbproyectofinal';

$mysqli = new mysqli($sql['host'], $sql['user'], $sql['password'],$sql['db']);
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
?>
