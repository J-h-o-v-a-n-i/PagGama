<?php
include "conexion.php";

$id = $_POST['id'];

$conexion->query("UPDATE perros SET estado='Resuelto' WHERE id='$id'");

echo "ok";
?>