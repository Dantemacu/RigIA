<?php
require("DbConfiguracion.php");

//session_start();

$tipoPrenda=array("Remera","Pantalon","Calzado");

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

// QUERY PARA MOSTRAR LAS IMAGENES SUBIDAS POR EL USUARIO ACTIVO

foreach($tipoPrenda as $valor){



    $sql_imagenes = "SELECT  id_imagenes, nombre_archivo, tipo_prenda FROM imagenes WHERE id_usuario = ? AND tipo_prenda = ? LIMIT 1";
    $stmt_imagenes = $mysqli->prepare($sql_imagenes);
    $stmt_imagenes->bind_param("is", $idUsuarioActivo, $valor);
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
          //href="TresPuntosHome.php"
          echo '</a>';
          echo '</div>';
    
      }
    } else {

    }

}



?>
