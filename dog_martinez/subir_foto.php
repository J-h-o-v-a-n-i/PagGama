<?php
session_start();
include "conexion.php";

$nombre = $_SESSION['usuario'];

$foto = $_FILES['foto']['name'];
$temp = $_FILES['foto']['tmp_name'];

move_uploaded_file($temp, "imagenes_perfil/".$foto);

$conexion->query("UPDATE usuarios SET foto='$foto' WHERE nombre='$nombre'");

$_SESSION['foto'] = $foto;

echo "ok";
?>