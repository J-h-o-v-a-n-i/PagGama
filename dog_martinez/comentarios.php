<?php
include "conexion.php";

$id = $_POST['id'];
$comentario = $_POST['comentario'];

$conexion->query("INSERT INTO comentarios(id_perro,comentario) VALUES('$id','$comentario')");

echo "ok";
?>