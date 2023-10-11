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
            <form id="authForm" action="Registro.php" method="POST">
            <input type="hidden" name="form_type" id="form_type" value=""> <!-- Valor "register" para el formulario de registro -->
                <div class="input-group">
                    <div class="input-field" id="nameField">
                        <i class="fas fa-user"></i>
                        <input type="text" name="Nombre" id="nameInput" placeholder="Nombre">
                    </div>

                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <input type="email" name="Mail" id="mailInput" placeholder="Email">
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
        let modoRegistro = true; // true = registro, false = inicio de sesión

        let signupBtn = document.getElementById("signupBtn");
        let signinBtn = document.getElementById("signinBtn");
        let nameField = document.getElementById("nameField");
        let title = document.getElementById("title");
        let Submit = document.getElementById("Submit");
        let authForm = document.getElementById("authForm");
        let nameInput = document.getElementById("nameInput");
        let mailInput = document.getElementById("mailInput");
        let passwordInput = document.getElementById("passwordInput");
        const submit = document.getElementById("Submit");

        signinBtn.onclick = function() {
            modoRegistro=false;
            nameField.style.maxHeight = "0";
            title.innerHTML = "Iniciar Sesión";
            signupBtn.classList.add("disable");
            signinBtn.classList.remove("disable");
            Submit.innerHTML = "Ingresar";
            //authForm.setAttribute("action", "SignUpQuery.php"); // Cambiar la acción del formulario para el inicio de sesión
            authForm.setAttribute("action", "InicioBack.php"); 
            nameInput.setAttribute("name", "Nombre2"); // Cambiar el atributo name del input de nombre
            mailInput.setAttribute("name", "Mail2"); 
            passwordInput.setAttribute("name", "Contrasenia2"); // Cambiar el atributo name del input de contraseña
            document.getElementById("form_type").value = "login";  
        }


        signupBtn.onclick = function() {
            modoRegistro=true;
            nameField.style.maxHeight = "60px";
            title.innerHTML = "Registrarse";
            signupBtn.classList.remove("disable");
            signinBtn.classList.add("disable");
            Submit.innerHTML = "Registrarse";
            //authForm.setAttribute("action", "signup-action.php"); // Cambiar la acción del formulario para el registro
            nameInput.setAttribute("name", "Nombre"); // Restaurar el atributo name del input de nombre
            authForm.setAttribute("action", "Registro.php"); 
            passwordInput.setAttribute("name", "Contrasenia"); // Restaurar el atributo name del input de contraseña
            document.getElementById("form_type").value = "register";
        }
    </script>
</body>
</html>

