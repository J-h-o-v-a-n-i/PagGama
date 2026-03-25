<?php
include "conexion.php";

$tipo = $_POST['tipo'];
$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$ubicacion = $_POST['ubicacion'];
$lat = $_POST['lat'];
$lng = $_POST['lng'];
$contacto = $_POST['contacto'];

$foto = $_FILES['foto']['name'];
$temp = $_FILES['foto']['tmp_name'];

move_uploaded_file($temp, "imagenes/".$foto);

$sql = "INSERT INTO perros(tipo,nombre,descripcion,ubicacion,lat,lng,contacto,foto)
VALUES('$tipo','$nombre','$descripcion','$ubicacion','$lat','$lng','$contacto','$foto')";

$conexion->query($sql);

echo "ok";
?>