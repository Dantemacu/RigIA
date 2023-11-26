<?php
session_start();
require ("DbConfiguracion.php");

// RECUPERAR EL ID Y EL NOMBRE DEL USUARIO LOGEADO
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

//var_dump ($_SESSION['UsuarioActivo']);
//var_dump ($idUsuarioActivo);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tu-armario</title>
    <link rel="stylesheet" href="TuArmario.css">
    <script src="https://kit.fontawesome.com/a6f001e2da.js" crossorigin="anonymous"></script>
</head>
<body>
    
     <script src="Home.js"></script>
     <script src="drawer.js"></script>

    <header>
        <div class="logo">
            <img src="../Images/Logo.png" alt="logo">
            <a href="Home.php">Rig<span>IA</span></a>
        </div>
        
        <div class="barra">
           <a href="#"> <i id="barra-opn" class="fa-solid fa-bars"></i> </a>
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

    <main>
        <h1>Tu Armario</h1>
        <p class="Prendas">Tus prendas </p>
    </main>


    <div class="pie">
    <?php
    // QUERY PARA MOSTRAR LAS IMAGENES SUBIDAS POR EL USUARIO ACTIVO
    $sql_imagenes = "SELECT id_imagenes, nombre_archivo FROM imagenes WHERE id_usuario = ?";
    $stmt_imagenes = $mysqli->prepare($sql_imagenes);
    $stmt_imagenes->bind_param("i", $idUsuarioActivo);
    $stmt_imagenes->execute();
    $result_imagenes = $stmt_imagenes->get_result();
    
    if ($result_imagenes->num_rows > 0) {
      while ($row_imagen = $result_imagenes->fetch_assoc()) {
          $imagenID = $row_imagen['id_imagenes'];
          $nombreArchivo = $row_imagen['nombre_archivo'];
          $imagenURL = "../ImagenesPrendas/" . $nombreArchivo;
  
          // Muestra la imagen y el botón de eliminación
          echo '<div class="item">';
          echo '<img src="' . $imagenURL . '" alt="Prenda del usuario" class="user-img">';
          echo '<a class="open-drawer">';
          echo '<a  class="punto-open">... </a>';
          //href="TresPuntosHome.php"
          echo '</a>';
          echo '</div>';

      }
    } else {
      // Muestra un mensaje si el usuario no tiene imágenes de prendas subidas
      echo 'No has subido ninguna prenda aún.';
      echo '<a href="SubirFoto2.php"><img src="../Images/CuadradoImagen.png" alt="Subir Imagen"></a>';
    }
    ?>


    
      <div class="drawer">
        <div class="barrita-drawer">
          <p id="close-drawer">--------------------------</p>
        </div>
        <ul>
          <li>Añadir a favoritos</li> 
          <li>Añadir etiqueta</li>
          <li>Editar etiqueta</li>
        </ul>
        <?php
        echo '<a class="editar-nombre-link" href="editarNombre.php?id=' . $imagenID . '&nombreArchivo=' . urlencode($nombreArchivo) . '">Editar Nombre</a>';
        ?>
        <br>
        <?php
          echo '<a href="eliminar_Imagen.php?id=' . $imagenID . '">Eliminar ultima imagen subida</a>';
          
      ?>
      </div>
    
      <div class="drawer-background" id="drawer-background"></div>

</body>

</html>