<?php
require 'DbConfiguracion.php';





//--VERIFICACIÓN NOMBRE REPETIDO-->
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $nombre = $_POST["Nombre"];
  $query_check_duplicate = "SELECT Nombre FROM InicioSesion WHERE Nombre = ?";
  $stmt_check_duplicate = $mysqli->prepare($query_check_duplicate);
  $stmt_check_duplicate->bind_param("s", $nombre);
  $stmt_check_duplicate->execute();
  $stmt_check_duplicate->store_result();
  
  if ($stmt_check_duplicate->num_rows > 0) {
      echo "El nombre ya está en uso. Por favor, elige otro.";
  } else {
    //--VERIFICACIÓN MAIL REPETIDO--
      $mail = $_POST["Mail"];
      $query_check_mail = "SELECT Mail FROM InicioSesion WHERE Mail = ?";
      $stmt_check_mail = $mysqli->prepare($query_check_mail);
      $stmt_check_mail->bind_param("s", $mail);
      $stmt_check_mail->execute();
      $stmt_check_mail->store_result();

      if ($stmt_check_mail->num_rows > 0) {
          echo "El correo electrónico ya está en uso. Por favor, elige otro.";
      } else {
          $query_insert = "INSERT INTO InicioSesion (Nombre, Mail, Contrasenia) VALUES (?, ?, ?)";
          $stmt_insert = $mysqli->prepare($query_insert);
          $stmt_insert->bind_param("sss", $_POST["Nombre"], $_POST["Mail"], $_POST["Contrasenia"]);

          if ($stmt_insert->execute()) {
              echo "Actualización exitosa";
              header("location: ../FrontEnd/Home.html");
          } else {
              echo "Error al actualizar: " . $stmt_insert->error;
          }
      }
  }
}

?>