<?php
require("DbConfiguracion.php");

session_start();

var_dump ($_SESSION['UsuarioActivo']);

// Obtener el nombre de usuario desde la sesión
$nombreUsuario = $_SESSION['UsuarioActivo'];

// Realizar la consulta para obtener el ID correspondiente al nombre de usuario
$sql = "SELECT ID FROM InicioSesion WHERE Mail = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("s", $nombreUsuario);

if ($stmt->execute()) {
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $fila = $result->fetch_assoc();
        $idUsuarioActivo = $fila['ID'];
        // Ahora $idUsuarioActivo contiene el ID correspondiente al nombre de usuario
    } else {
        // El usuario no fue encontrado en la base de datos, maneja esto apropiadamente
    }
} else {
    // Error en la ejecución de la consulta, maneja esto apropiadamente
}

var_dump ("Numero de ID:");
var_dump ($idUsuarioActivo);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['guardar'])) {
        if (isset($_FILES['nombreArchivo']) && isset($_FILES['nombreArchivo']['name'])) {
            $archivo = $_FILES['nombreArchivo']['name'];
            $tipo = $_FILES['nombreArchivo']['type'];
            $tamano = $_FILES['nombreArchivo']['size'];
            $temp = $_FILES['nombreArchivo']['tmp_name'];

            $carpetaDestino = 'C:/xampp/htdocs/RigIA/RigIA/ImagenesPrendas/';
            $rutaArchivo = $carpetaDestino . $archivo;

            if (!((strpos($tipo, "gif") !== false || strpos($tipo, "jpeg") !== false || strpos($tipo, "jpg") !== false || strpos($tipo, "png") !== false) && ($tamano < 2000000))) {
                echo '<div><b>Error. La extensión o el tamaño de los archivos no es correcta.<br/>
                - Se permiten archivos .gif, .jpg, .png, y deben ser de 2 MB como máximo.</b></div>';
            } else {
                if (move_uploaded_file($temp, $rutaArchivo)) {
                    $nombrePrenda = $_POST['nombre_prenda'];
                    $TipoPrenda = $_POST['tipo'];
                    $Etiqueta = $_POST['Etiqueta'];

                    if (strlen($nombrePrenda) <= 100) {
                        $sql = "INSERT INTO imagenes (nombre_prenda, nombre_archivo, tipo_archivo, id_usuario, tipo_prenda, etiqueta) VALUES (?, ?, ?, ?, ?, ?)";
                        $stmt = $mysqli->prepare($sql);
                        $stmt->bind_param("sssiss", $nombrePrenda, $archivo, $tipo, $idUsuarioActivo, $TipoPrenda, $Etiqueta);

                        if ($stmt->execute()) {
                            echo "Los datos se han insertado correctamente en la base de datos.";
                            echo '<script>
                                    // Actualiza la imagen después de la subida
                                    document.getElementById("imagenSubida").src = "../ImagenesPrendas/' . $archivo . '";
                                </script>';
                        } else {
                            echo "Error al insertar los datos en la base de datos: " . $mysqli->error;
                        }
                    } else {
                        echo "Error: El nombre debe tener menos de 100 caracteres y la descripción menos de 200 caracteres.";
                    }
                } else {
                    echo '<div><b>Error al mover el archivo a la carpeta de destino.</b></div>';
                }
            }
        } else {
            echo "Por favor, selecciona un archivo para subir.";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Mi Armario</title>
</head>
<body>
    <h1>Mi Armario</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        Añadir imagen: <input name="nombreArchivo" id="nombreArchivo" type="file"/><br>
        <!-- Muestra la imagen subida -->
        <img id="imagenSubida" src="" alt="Imagen Subida"><br>
        
        <label for="nombre_prenda">Nombre de la prenda:</label>
        <input type="text" name="nombre_prenda" id="nombre_prenda" maxlength="100" required><br><br>

        <label for="lang">Tipo de prenda</label>
        <select name="tipo" id="tipo" required>
            <option value="Remera">Remera</option>
            <option value="Campera">Campera</option>
            <option value="Pantalon">Pantalon</option>
            <option value="Calzado">Calzado</option>
            <option value="MangaLarga">Manga Larga</option>
            <option value="Gorro">Gorro</option>
            <option value="Vestido">Vestido</option>
            <option value="Camisa">Camisa</option>
            <option value="Short">Short</option>
            <option value="Pollera">Pollera</option>
        </select>

        <label for="lang">Etiqueta</label>
        <select name="Etiqueta" id="Etiqueta" required>
            <option value="Formal">Formal</option>
            <option value="Informal">Informal</option>
            <option value="Casual">Casual</option>
        </select>

    



        <input type="submit" name="guardar" value="Enviar">
    </form>
</body>
</html>
