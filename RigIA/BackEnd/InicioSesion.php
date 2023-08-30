
<?php
require 'DbConfiguracion.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Iniciar Sesión</title>
</head>
<body>
    <h2>Sign In</h2>
    <form method="post" action="">
        <label for="nombre_mail">Nombre o correo electrónico:</label>
        <input type="text" id="nombre_mail" name="nombre_mail" required><br>
        
        <label for="ContraseniaInicio">Contraseña:</label>
        <input type="password" id="ContraseniaInicio" name="ContraseniaInicio" required><br>
        
        <input type="submit" value="Enviar"><br><br>
    </form>

    <a href="./Registro.php">Sign Up</a>
    <a href="./InicioSesion.php">Sign In<br></a>
</body>
</html>
<?php
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
<!DOCTYPE html>
<html>
    <head>
    </head>
    <body>
        <br> Olvidaste tu contraseña?
        <a href="./OlvidasteContra.php">Click aca</a>
    </body>

