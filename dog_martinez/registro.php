<?php
include "conexion.php";

$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$password = md5($_POST['password']);

$sql = "INSERT INTO usuarios(nombre,correo,password)
VALUES('$nombre','$correo','$password')";

$conexion->query($sql);

echo "ok";
?>