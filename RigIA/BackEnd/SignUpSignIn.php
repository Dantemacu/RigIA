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
                        <input type="text" name="name" id="nameInput" placeholder="Nombre">
                    </div>

                    <div class="input-field">
                        <i class="fa-solid fa-envelope"></i>
                        <input type="email" name="email" id="emailInput" placeholder="Email">
                    </div>

                    <div class="input-field">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" name="password" id="passwordInput" placeholder="Contraseña">
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
            authForm.setAttribute("action", "signin-action"); // Change the form action for sign in
            document.getElementById("nameInput").setAttribute("name", "signin_name"); // Change name attribute for name input
        }

        signupBtn.onclick = function() {
            nameField.style.maxHeight = "60px";
            title.innerHTML = "Sign Up";
            signupBtn.classList.remove("disable");
            signinBtn.classList.add("disable");
            Submit.innerHTML = "Registrarse";
            authForm.setAttribute("action", "signup-action"); // Change the form action for sign up
            document.getElementById("nameInput").setAttribute("name", "name"); // Reset name attribute for name input
        }
    </script>
</body>
</html>