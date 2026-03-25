<?php
session_start();

if(!isset($_SESSION['usuario'])){
    header("Location: login_facebook.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>

<meta charset="UTF-8">
<title>Dog Martínez</title>

<link rel="stylesheet" href="estilos.css">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>

</head>

<body>

<header>

<h1>🐶 Dog Martínez</h1>
<p>Ayuda a encontrar perros perdidos y rescatar animales</p>

<?php if(isset($_SESSION['usuario'])){ 

    $foto = "default.png";

    if(isset($_SESSION['foto']) && !empty($_SESSION['foto'])){
        $foto = $_SESSION['foto'];
    }
?>

<div class="perfil-box">

<img src="imagenes_perfil/<?php echo $foto; ?>" class="perfil-img">

<div class="perfil-info">
<span><?php echo $_SESSION['usuario']; ?></span>
<a href="logout.php">Cerrar sesión</a>
</div>

<label class="btn-foto">
Cambiar foto
<input type="file" id="fotoPerfil">
</label>

</div>

<?php } else { ?>

<button onclick="mostrarLogin()">Iniciar sesión</button>

<?php } ?>

</header>

<main>

<div class="panel">

<h2>Reportar perro</h2>

<form id="formPerro" enctype="multipart/form-data">

<select name="tipo">
<option>Perro perdido</option>
<option>Perro encontrado</option>
<option>Perro en situación de calle</option>
</select>

<input type="text" name="nombre" placeholder="Nombre">

<input type="text" name="ubicacion" placeholder="Colonia">

<textarea name="descripcion"></textarea>

<input type="text" name="contacto" placeholder="Teléfono">

<input type="file" name="foto" required>

<input type="hidden" name="lat" id="lat">
<input type="hidden" name="lng" id="lng">

<button>Publicar</button>

</form>

</div>

<div style="flex:1;">

<div id="mapa"></div>

<input id="buscador" placeholder="🔍 Buscar por colonia o nombre">

<section class="stats">

<div class="stat">
<h3 id="total">0</h3>
<p>Total</p>
</div>

<div class="stat">
<h3 id="perdidos">0</h3>
<p>Perdidos</p>
</div>

<div class="stat">
<h3 id="encontrados">0</h3>
<p>Encontrados</p>
</div>

</section>

<h2>🐾 Reportes</h2>

<div id="lista" class="lista"></div>

</div>

</main>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="script.js"></script>

</body>
</html>