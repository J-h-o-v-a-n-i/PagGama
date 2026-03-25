<?php
$conexion = new mysqli("sqlXXX.infinityfree.com","usuario","password","basedatos");

if($conexion->connect_error){
die("Error de conexión");
}
?>