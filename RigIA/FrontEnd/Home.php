<?php
require ("DbConfiguracion.php");

session_start();

// RECUPERAR EL ID DEL USUARIO ACTIVO
$nombreUsuario = $_SESSION['UsuarioActivo'];
$sql = "SELECT ID FROM InicioSesion WHERE Mail = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("s", $nombreUsuario);

 
if ($stmt->execute()) {
  $result = $stmt->get_result();
  if ($result->num_rows > 0) {
      $fila = $result->fetch_assoc();
      $idUsuarioActivo = $fila['ID'];
    } 
    else { 
    }
  } 
  else {
}
?>


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
      <a href="Home.php" class="title-logo">Rig<span>IA</span></a>
    </div>
    
    <div class="barra">
      <a> <i id="barra-opn" class="fa-solid fa-bars"></i> </a>
    </div>

    <nav class="barra-options">
      <i id="barra-close" class="fa-solid fa-xmark"></i>
      <ul class="conf">
        <li> <i class="fa-solid fa-user"></i> <a href="Home.php">Perfil</a></li>
        <li> <i class="fa-solid fa-gear"></i> <a href="Configuracion.html">Configuracion</a></li>
        <li> <i class="fa-solid fa-shirt"></i> <a href="SubirPrenda.php">Subir prenda</a> </li>
        <li> <i class="fa-solid fa-folder-closed"></i> <a href="TuArmario.php">Armario</a> </li>
        <li> <i class="fa-solid fa-magnifying-glass"></i><a href="Busqueda.html"> Búsqueda</a></li>
        <li> <i class="fa-regular fa-square-plus"></i><a href="CrearOutfit.html"> Crear Outfit</a></li>

      </ul>
    </nav>
  </header>

  <section class="hero">
    <div class="container">
      <img src="../Images/FotoPerfil.png" alt="Foto de perfil">
      <h4><?php echo $nombreUsuario ?></h4>
      <a href="EditarPerfil.html">
        <p class="edit-perfil">Editar Perfil</p>
      </a>
      <p class="Outfits">Tus Outfits:</p>
    </div>
  </section>
</body>

<div>
<?php
/*$sql_imagenes = "SELECT id FROM outfits WHERE id_usuario = ?";
$stmt_imagenes = $mysqli->prepare($sql_imagenes);
$stmt_imagenes->bind_param("i", $idUsuarioActivo);
$stmt_imagenes->execute();
$result_imagenes = $stmt_imagenes->get_result();
if ($result_imagenes->num_rows > 0) {
  echo "Aca esta tu prenda";
}  else {
  echo "Ninguna prenda subida";
}*/ 
?>

</div>

<body>  
  <div class="drawer">
      <div class="barrita-drawer">
        <p id="close-drawer"></p>
      </div>
      <ul>
        <a href="" id="addFavorites">Añadir a favoritos</a> 
        <a href="" id="addTag">Añadir etiqueta</a>
        <a href="" id="editTag">Editar etiqueta</a>
        <a href="" id="editName">Editar Nombre</a>
        <?php
          echo '<a href="eliminar_imagen.php?id=' . $imagenID . '">Eliminar</a>';
      ?>
      </ul>
    </div>

    <div class="drawer-background" id="drawer-background"></div>
</body>
  </html>

  <?php
// Lee la información del outfit desde el archivo
$outfitData = file_get_contents("outfit_data.txt");
$outfit = json_decode($outfitData, true);
?>

