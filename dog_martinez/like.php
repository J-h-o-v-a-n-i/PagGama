<?php
include "conexion.php";

$id = $_POST['id'];

$conexion->query("UPDATE perros SET likes = likes + 1 WHERE id='$id'");

echo "ok";
?>