<?php
session_start();
include "conexion.php";

$correo = $_POST['correo'];
$password = md5($_POST['password']);

$resultado = $conexion->query("SELECT * FROM usuarios WHERE correo='$correo' AND password='$password'");

if($resultado->num_rows > 0){

$usuario = $resultado->fetch_assoc();

$_SESSION['usuario'] = $usuario['nombre'];
$_SESSION['foto'] = $usuario['foto'];

echo "ok";

}else{
echo "error";
}
?>