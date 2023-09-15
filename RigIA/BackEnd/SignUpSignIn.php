<?php
require 'DbConfiguracion.php';

// Verificar si se ha enviado un formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["form_type"])) {
        $form_type = $_POST["form_type"];

        if ($form_type === "register") {
            // Procesar el formulario de registro
            $nombre = isset($_POST['Nombre']) ? $_POST['Nombre'] : '';
            $mail = isset($_POST['Mail']) ? $_POST['Mail'] : '';
            $contrasenia = isset($_POST['Contrasenia']) ? $_POST['Contrasenia'] : '';

            // Validar campos en blanco
            if (empty($nombre) || empty($mail) || empty($contrasenia)) {
                echo "Todos los campos son obligatorios. Por favor, completa todos los campos.";
            } else {
                // Verificar si el nombre o el correo electrónico ya existen
                $query_check_duplicate = "SELECT Nombre, Mail FROM InicioSesion WHERE Nombre = ? OR Mail = ?";
                $stmt_check_duplicate = $mysqli->prepare($query_check_duplicate);
                $stmt_check_duplicate->bind_param("ss", $nombre, $mail);
                $stmt_check_duplicate->execute();
                $stmt_check_duplicate->store_result();

                if ($stmt_check_duplicate->num_rows > 0) {
                    echo "El nombre o el correo electrónico ya están en uso. Por favor, elige otros.";
                } else {
                    // Insertar el nuevo usuario en la base de datos
                    $query_insert = "INSERT INTO InicioSesion (Nombre, Mail, Contrasenia) VALUES (?, ?, ?)";
                    $stmt_insert = $mysqli->prepare($query_insert);
                    $stmt_insert->bind_param("sss", $nombre, $mail, $contrasenia);

                    if ($stmt_insert->execute()) {
                        echo "Registro exitoso";
                        header("location: /FrontEnd/Home.html");
                    } else {
                        echo "Error al registrar el usuario: " . $stmt_insert->error;
                    }
                }
            }
        } elseif ($form_type === "login") {
            // Procesar el formulario de inicio de sesión
            $Nombre = $_POST['Nombre'];
            $Contrasenia = $_POST['Contrasenia'];

            // Verificar si los campos están vacíos
            if (empty($Nombre) || empty($Contrasenia)) {
                echo "Todos los campos son obligatorios. Por favor, completa todos los campos.";
            } else {
                // Consulta para verificar las credenciales
                $sql = "SELECT * FROM InicioSesion WHERE (Nombre = ? OR Mail = ?)";
                $stmt_sql = $mysqli->prepare($sql);
                $stmt_sql->bind_param("ss", $Nombre, $Nombre);
                $stmt_sql->execute();
                $result = $stmt_sql->get_result();

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    if (password_verify($Contrasenia, $row["Contrasenia"])) {
                        echo "Inicio de sesión exitoso.";
                        header("location: Home.html");
                    } else {
                        echo "Contraseña incorrecta. No se puede iniciar sesión.";
                    }
                } else {
                    echo "Credenciales incorrectas. No se puede iniciar sesión.";
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login y Registro</title>
    <link rel="stylesheet" href="SignUpSignIn.css">
    <script src="https://kit.fontawesome.com/a6f001e2da.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <div class="form-box">
            <h1 id="title">Sign Up</h1>
            <form id="authForm" action="" method="POST">
            <input type="hidden" name="form_type" value="register"> <!-- Valor "register" para el formulario de registro -->
                <div class="input-group">
                    <div class="input-field" id="nameField">
                        <i class="fas fa-user"></i>
                        <input type="text" name="Nombre" id="nameInput" placeholder="Nombre">
                    </div>

                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <input type="email" name="Mail" id="emailInput" placeholder="Email">
                    </div>

                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="Contrasenia" id="passwordInput" placeholder="Contraseña">
                    </div>
                    <p>¿Olvidaste la contraseña? <a href="#">Presiona aquí</a></p>
                </div>
                <div class="input-submit">
                    <button type="submit" name="submitButton" class="submit" id="Submit">
                        Ingresar
                    </button>
                </div>
                <div class="btn-field">
                    <button type="button" id="signupBtn"> Registrarse</button>
                    <button type="button" id="signinBtn" class="disable"> Iniciar Sesión</button>
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
        let nameInput = document.getElementById("nameInput");
        let passwordInput = document.getElementById("passwordInput");

        signinBtn.onclick = function() {
            nameField.style.maxHeight = "0";
            title.innerHTML = "Iniciar Sesión";
            signupBtn.classList.remove("disable");
            signinBtn.classList.add("disable");
            Submit.innerHTML = "Ingresar";
            //authForm.setAttribute("action", "SignUpQuery.php"); // Cambiar la acción del formulario para el inicio de sesión
            nameInput.setAttribute("name", "Nombre2"); // Cambiar el atributo name del input de nombre
            passwordInput.setAttribute("name", "Contrasenia2"); // Cambiar el atributo name del input de contraseña
            document.getElementById("form_type").value = "login"; 
        }


        signupBtn.onclick = function() {
            nameField.style.maxHeight = "60px";
            title.innerHTML = "Registrarse";
            signupBtn.classList.add("disable");
            signinBtn.classList.remove("disable");
            Submit.innerHTML = "Registrarse";
            //authForm.setAttribute("action", "signup-action.php"); // Cambiar la acción del formulario para el registro
            nameInput.setAttribute("name", "Nombre"); // Restaurar el atributo name del input de nombre
            passwordInput.setAttribute("name", "Contrasenia"); // Restaurar el atributo name del input de contraseña
            document.getElementById("form_type").value = "register";
        }
    </script>
</body>
</html>
header