<?php
//var_dump ($_POST);
$_ENV = parse_ini_file('.env');
$mysqli = mysqli_init();
$mysqli->ssl_set(NULL, NULL, "./cacert.pem", NULL, NULL);
$mysqli->real_connect($_ENV["HOST"], $_ENV["USERNAME"], $_ENV["PASSWORD"], $_ENV["DATABASE"]);
?>

<!--=====HTML======-->  
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <h2> Sign Up </h2>
  <!-- Formulario -->
  <form action="" method="POST">
    <label for="Nombre">Nombre:</label>
    <input type="text" name="Nombre"><br>
    
    <label for="Mail">Mail:</label>
    <input type="email" name="Mail"><br>
    
    <label for="Contrasenia">Contraseña:</label>
    <input type="password" name="Contrasenia"><br>
    
    <input type="submit" value="Enviar"><br><br>
  </form>
  <a href="./Registro.php">Sign Up</a>
  <a href="./InicioSesion.php">Sign In</a>
</body>
</html>


<!--VERIFICACIÓN NOMBRE REPETIDO-->
<?php
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
              header("location: Menu.php");
          } else {
              echo "Error al actualizar: " . $stmt_insert->error;
          }
      }
  }
}

?>