<?php
include "conexion.php";

$resultado = $conexion->query("SELECT * FROM perros ORDER BY id DESC");

$datos = [];

while($fila = $resultado->fetch_assoc()){

$id = $fila['id'];

$comentarios = $conexion->query("SELECT * FROM comentarios WHERE id_perro=$id");

$lista = [];

while($c = $comentarios->fetch_assoc()){
$lista[] = $c;
}

$fila['comentarios'] = $lista;

$datos[] = $fila;
}

echo json_encode($datos);
?>