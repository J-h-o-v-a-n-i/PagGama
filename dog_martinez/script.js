const mapa = L.map('mapa').setView([20.0708, -97.0608], 14);

L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(mapa);

let marcador;

// CLICK EN MAPA
mapa.on('click', e => {

if(marcador) mapa.removeLayer(marcador);

marcador = L.marker(e.latlng).addTo(mapa);

lat.value = e.latlng.lat;
lng.value = e.latlng.lng;

});

// UBICACIÓN POR COLONIA
const inputUbicacion = document.querySelector("input[name='ubicacion']");

inputUbicacion.addEventListener("change", function(){

let lugar = inputUbicacion.value + ", Martinez de la Torre, Veracruz";

fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(lugar)}`)
.then(res=>res.json())
.then(data=>{

if(data.length > 0){

let latitud = data[0].lat;
let longitud = data[0].lon;

mapa.setView([latitud,longitud],15);

if(marcador) mapa.removeLayer(marcador);

marcador = L.marker([latitud,longitud]).addTo(mapa);

lat.value = latitud;
lng.value = longitud;

}else{
alert("Ubicación no encontrada");
}

});

});

// FORM
formPerro.addEventListener("submit", e => {

e.preventDefault();

let datos = new FormData(formPerro);

fetch("guardar.php",{method:"POST",body:datos})
.then(()=>{

alert("Reporte publicado");
formPerro.reset();
cargarPerros();

});

});

// CARGAR DATOS
function cargarPerros(){

fetch("obtener.php")
.then(r=>r.json())
.then(data=>{

lista.innerHTML="";

data.forEach(p=>{

lista.innerHTML+=`
<div class="card">

<img src="imagenes/${p.foto}">

<div class="card-body">

<h3>${p.nombre}</h3>

<p>${p.tipo}</p>

<p>${p.descripcion}</p>

<p>📍 ${p.ubicacion}</p>

<p>❤️ ${p.likes} | Estado: ${p.estado}</p>

<button onclick="darLike(${p.id})">👍</button>
<button onclick="resolver(${p.id})">✔</button>

<input id="c${p.id}" placeholder="Comentario">
<button onclick="comentar(${p.id})">💬</button>

${p.comentarios.map(c=>`<p>💬 ${c.comentario}</p>`).join("")}

</div>

</div>
`;

});

});

}

// FUNCIONES
function darLike(id){
fetch("like.php",{method:"POST",body:new URLSearchParams({id})})
.then(()=>cargarPerros());
}

function comentar(id){
let texto = document.getElementById("c"+id).value;

fetch("comentarios.php",{
method:"POST",
body:new URLSearchParams({id,comentario:texto})
}).then(()=>cargarPerros());
}

function resolver(id){
fetch("resolver.php",{method:"POST",body:new URLSearchParams({id})})
.then(()=>cargarPerros());
}

function mostrarLogin(){
window.location="login_facebook.html";
}

document.getElementById("fotoPerfil")?.addEventListener("change", function(){

let archivo = this.files[0];

let datos = new FormData();
datos.append("foto", archivo);

fetch("subir_foto.php",{
method:"POST",
body:datos
})
.then(()=>location.reload());

});

cargarPerros();