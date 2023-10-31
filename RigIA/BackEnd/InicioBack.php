<?php
require 'DbConfiguracion.php';
session_start(); // Inicializa la sesión

if ($_POST['form_type'] === "login") {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST["Mail2"], $_POST["Nombre2"], $_POST["Contrasenia2"])) {
            $Mail2 = $_POST["Mail2"];
            $Nombre2 = $_POST["Nombre2"];
            $Contrasenia2 = $_POST["Contrasenia2"];
        }
    }
                
    // Consulta para verificar las credenciales
    $sql = "SELECT * FROM InicioSesion WHERE Mail = ? AND Contrasenia = ?";
    $stmt_sql = $mysqli->prepare($sql);
    $stmt_sql->bind_param("ss", $Mail2, $Contrasenia2);
    $stmt_sql->execute();
    $stmt_sql->store_result();

                
    if ($stmt_sql->num_rows > 0) {
        
        $UsuarioActivo= $_POST['Mail2'];
        $_SESSION['UsuarioActivo']=$UsuarioActivo;
        //var_dump ($_SESSION['UsuarioActivo']);
        echo "Inicio de sesión exitoso.";
        header("location: ../FrontEnd/Home.php");
    } else {
        echo "Credenciales incorrectas. No se puede iniciar sesión.";
    }
}
?>
