<?php
require 'DbConfiguracion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["submitButton"]) && $_POST["submitButton"] == "Registrarse") {
        // Lógica de registro aquí
    }
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


