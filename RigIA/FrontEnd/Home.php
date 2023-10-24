<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>RigIA</title>
  <link rel="stylesheet" href="Home.css">
  <script src="https://kit.fontawesome.com/a6f001e2da.js" crossorigin="anonymous"></script>
</head>

<body>
  <script src="Home.js"></script>
  <script src="drawer.js"></script>
  <header>
    <div class="logo">
      <img src="../Images/Logo.png" alt="logo">
      <a href="Home.html" class="title-logo">Rig<span>IA</span></a>
    </div>

    <div class="barra">
      <a> <i id="barra-opn" class="fa-solid fa-bars"></i> </a>
    </div>

    <nav class="barra-options">
      <i id="barra-close" class="fa-solid fa-xmark"></i>
      <ul class="conf">
        <li> <i class="fa-solid fa-user"></i> <a href="Home.html">Perfil</a></li>
        <li> <i class="fa-solid fa-gear"></i> <a href="Configuracion.html">Configuracion</a></li>
        <li> <i class="fa-solid fa-shirt"></i> <a href="SubirPrenda.php">Subir prenda</a> </li>
        <li> <i class="fa-solid fa-folder-closed"></i> <a href="TuArmario.html">Armario</a> </li>
        <li> <i class="fa-solid fa-magnifying-glass"></i><a href="Busqueda.html"> Búsqueda</a></li>
      </ul>
      
    </nav>


  </header>

  <section class="hero">
    <div class="container">
      <img src="../Images/FotoPerfil.png" alt="Foto de perfil">
      <h4>Nombre</h4>
      <a href="EditarPerfil.html">
        <p class="edit-perfil">Editar Perfil</p>
      </a>
      <p class="Outfits">Tus Outfits</p>
    </div>
  </section>



  <div class="pie">
    <div class="item">
      <!-- Agrega un elemento img para mostrar la imagen recién subida -->
      <img id="imagenRecienSubida" src="" alt="Imagen recién subida">
      <a class="open-drawer">
        <p class="punto-open">...</p>
      </a>
    </div>
    <div class="item">
      <img src="../Images/Cuadrado.png" alt="TuOutfit">
      <a class="open-drawer">
        <p class="punto-open">...</p>
      </a>
    </div>
    <div class="item">
  <img src="../Images/Cuadrado.png" alt="TuOutfit">
  <a class="open-drawer">
    <p class="punto-open">...</p>
  </a>
</div>
<div class="item">
  <img src="../Images/Cuadrado.png" alt="TuOutfit">
  <a class="open-drawer">
    <p class="punto-open">...</p>
  </a>
</div>
  </div>


  <div class="drawer">
    <div class="barrita-drawer">
      <p id="close-drawer">--------------------------</p>
    </div>
    <ul>
      <a href="" id="addFavorites">Añadir a favoritos</a> 
      <a href=""id="addTag">Añadir etiqueta</a>
      <a href=""id="editTag">Editar etiqueta</a>
      <a href=""id="editName">Editar Nombre</a>
    </ul>
  </div>

  <div class="drawer-background" id="drawer-background"></div>
</body>
<script>
  // Después de cargar la página o cuando sea necesario, actualiza la imagen
// Esto podría hacerse en una función, un evento o cualquier otro lugar adecuado
const imgElement = document.getElementById("imagenRecienSubida");
const urlImagenRecienSubida = "C:\xampp\htdocs\RigIA\RigIA\ImagenesPrendas"; // Reemplaza con la URL real

// Verifica si la URL de la imagen es válida y, si es así, actualiza la imagen
if (urlImagenRecienSubida) {
  imgElement.src = urlImagenRecienSubida;
}

</script>
</html>

<?php