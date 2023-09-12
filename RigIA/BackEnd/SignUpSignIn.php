<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login y Registration</title>
    <link rel="stylesheet" href="SignUpSignIn.css">
    <script src="https://kit.fontawesome.com/a6f001e2da.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <div class="form-box">
            <h1 id="title">Sign Up</h1>
            <form id="authForm">
                <div class="input-group">
                    <div class="input-field" id="nameField">
                        <i class="fa-solid fa-user"></i>
                        <input type="text" name="Nombre" id="nameInput" placeholder="Nombre">
                    </div>

                    <div class="input-field">
                        <i class="fa-solid fa-envelope"></i>
                        <input type="email" name="Mail" id="emailInput" placeholder="Email">
                    </div>

                    <div class="input-field">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" name="Contrasenia" id="passwordInput" placeholder="Contraseña">
                    </div>
                    <p>Perdiste la contraseña <a href="#">Presione aqui!</a></p>
                </div>
                <div class="input-submit">
                     <button type="submit" name="submitButton" class="submit" id="Submit">
                         Ingresar
                     </button>   
                </div>
                <div class="btn-field">
                    <button type="button" id="signupBtn"> Sign Up</button>
                    <button type="button" id="signinBtn" class="disable"> Sign In</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        let signupBtn = document.getElementById("signupBtn");
        let signinBtn = document.getElementById("signinBtn");
        let nameField = document.getElementById("nameField");
        let title = document.getElementById("title");
        let Submit = document.getElementById("Submit");
        let authForm = document.getElementById("authForm");

        signinBtn.onclick = function() {
            nameField.style.maxHeight = "0";
            title.innerHTML = "Sign In";
            signupBtn.classList.add("disable");
            signinBtn.classList.remove("disable");
            Submit.innerHTML = "Ingresar";
            authForm.setAttribute("action", "signin-action"); // Cambiar la acción del formulario para el inicio de sesión
            document.getElementById("nameInput").setAttribute("name", "Nombre2"); // Cambiar el atributo name del input de nombre
            document.getElementById("passwordInput").setAttribute("name", "Contrasenia2"); // Cambiar el atributo name del input de contraseña
        }
    }
    
    signupBtn.onclick = function() {
    nameField.style.maxHeight = "60px";
    title.innerHTML = "Sign Up";
    signupBtn.classList.remove("disable");
    signinBtn.classList.add("disable");
    Submit.innerHTML = "Registrarse";
    authForm.setAttribute("action", "signup-action"); // Cambiar la acción del formulario para el registro
    document.getElementById("nameInput").setAttribute("name", "Nombre"); // Restaurar el atributo name del input de nombre
    document.getElementById("passwordInput").setAttribute("name", "Contrasenia"); // Restaurar el atributo name del input de contraseña
}
    </script>
</body>
</html>

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

// Verificar la conexión
if ($mysqli->connect_error) {
    die("Conexión fallida: " . $mysqli->connect_error);
}

// Verificar el formulario de inicio de sesión
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_mail = $_POST["nombre_mail"];
    $ContraseniaInicio = $_POST["ContraseniaInicio"];

    // Consulta para verificar las credenciales
    $sql = "SELECT * FROM InicioSesion WHERE (Nombre = ? OR Mail = ?) AND ContraseniaInicio = ?";
    $stmt_sql = $mysqli->prepare($sql);
    $stmt_sql->bind_param("sss",$nombre_mail, $nombre_mail, $ContraseniaInicio);
    $stmt_sql->execute();
    $stmt_sql->store_result();
    
    
    if ($stmt_sql->num_rows > 0) {
        echo "Inicio de sesión exitoso.";
        header("location: Menu.php");
    } else {
        echo "Credenciales incorrectas. No se puede iniciar sesión.";
    }
}
// Cerrar la conexión
$mysqli->close();
?>