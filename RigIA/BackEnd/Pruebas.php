<!--VERIFICACIÓN NOMBRE REPETIDO-->
<?php
require 'DbConfiguracion.php';



// Verificar la conexión
if ($mysqli->connect_error) {
    die("Conexión fallida: " . $mysqli->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['Nombre'])) {
        $nombre = $_POST["Nombre"];
    }
    $query_check_duplicate = "SELECT Nombre FROM InicioSesion WHERE Nombre = ?";
    $stmt_check_duplicate = $mysqli->prepare($query_check_duplicate);
    $stmt_check_duplicate->bind_param("s", $nombre);
    $stmt_check_duplicate->execute();
    $stmt_check_duplicate->store_result();

    if ($stmt_check_duplicate->num_rows > 0) {
        echo "El nombre ya está en uso. Por favor, elige otro.";
    } else {
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
                echo "Registro exitoso";
                header("location: ../FrontEnd/Home.html");
            } else {
                echo "Error al registrar: " . $stmt_insert->error;
            }
        }
    }
}



// Verificar el formulario de inicio de sesión
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['Nombre'])) {
        $Mail2 = $_POST["Mail2"];
    }
    $Nombre2 = $_POST["Nombre2"];
    $Contrasenia2 = $_POST["Contrasenia2"];

    // Consulta para verificar las credenciales
    $sql = "SELECT * FROM InicioSesion WHERE (Nombre = ? OR Mail = ?) AND Contrasenia = ?";
    $stmt_sql = $mysqli->prepare($sql);
    $stmt_sql->bind_param("sss", $Nombre2, $Mail2, $Contrasenia2);
    $stmt_sql->execute();
    $stmt_sql->store_result();

    if ($stmt_sql->num_rows > 0) {
        echo "Inicio de sesión exitoso.";
        header("location: ../FrontEnd/Home.html");
    } else {
        echo "Credenciales incorrectas. No se puede iniciar sesión.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login y Registration</title>
    <link rel="stylesheet" href="../FrontEnd/loginEstilos.css">
    <script src="https://kit.fontawesome.com/a6f001e2da.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <div class="form-box">
            <h1 id="title">Sign Up</h1>
            <form id="authForm" action="" method="POST">
            <input type="hidden" name="form_type" id="form_type" value=""> <!-- Valor "register" para el formulario de registro -->
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
                        Registrarse
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
        const submit = document.getElementById("Submit");

        signinBtn.onclick = function() {
            nameField.style.maxHeight = "0";
            title.innerHTML = "Iniciar Sesión";
            signupBtn.classList.add("disable");
            signinBtn.classList.remove("disable");
            Submit.innerHTML = "Ingresar";
            //authForm.setAttribute("action", "SignUpQuery.php"); // Cambiar la acción del formulario para el inicio de sesión
            nameInput.setAttribute("name", "Nombre2"); // Cambiar el atributo name del input de nombre
            nameInput.setAttribute("Mail", "Mail2"); 
            passwordInput.setAttribute("name", "Contrasenia2"); // Cambiar el atributo name del input de contraseña
            document.getElementById("form_type").value = "login";  
        }


        signupBtn.onclick = function() {
            nameField.style.maxHeight = "60px";
            title.innerHTML = "Registrarse";
            signupBtn.classList.remove("disable");
            signinBtn.classList.add("disable");
            Submit.innerHTML = "Registrarse";
            //authForm.setAttribute("action", "signup-action.php"); // Cambiar la acción del formulario para el registro
            nameInput.setAttribute("name", "Nombre"); // Restaurar el atributo name del input de nombre
            passwordInput.setAttribute("name", "Contrasenia"); // Restaurar el atributo name del input de contraseña
            document.getElementById("form_type").value = "register";
        }
    </script>
</body>
</html>

