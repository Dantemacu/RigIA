<?php
require("DbConfiguracion.php");

session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['guardar'])) {
        if (isset($_FILES['nombreArchivo']) && isset($_FILES['nombreArchivo']['name'])) {
            // Procesar la subida de imágenes
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
                    // Procesar el formulario de guardar nombre, tipo, descripción y color
                    $nombrePrenda = $_POST['nombre_prenda'];
                    $descripcion = $_POST['descripcion'];
                    $idUsuarioActivo = $_SESSION['ID'];

                    if (strlen($nombrePrenda) <= 100 && strlen($descripcion) <= 200) {
                        // Insertar los datos en la base de datos
                        $sql = "INSERT INTO imagenes (nombre_prenda, descripcion, nombre_archivo, tipo_archivo, id_usuario) VALUES (?, ?, ?, ?, ?)";
                        $stmt = $mysqli->prepare($sql);
                        $stmt->bind_param("ssssi", $nombrePrenda, $descripcion, $archivo, $tipo, $idUsuarioActivo);

                        if ($stmt->execute()) {
                            echo "Los datos se han insertado correctamente en la base de datos.";
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
        Añadir imagen: <input name="nombreArchivo" id="nombreArchivo" type="file"/><br><br>

        <label for="nombre_prenda">Nombre de la prenda:</label>
        <input type="text" name="nombre_prenda" id="nombre_prenda" maxlength="100" required><br><br>

        <label for="tipo">Tipo de prenda:</label>
        <input type="text" name="tipo" id="tipo" maxlength="100" required><br><br>

        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion" id="descripcion" maxlength="200" required></textarea><br><br>

        <label for="color">Color:</label>
        <input type="text" name="color" id="color" maxlength="100"><br><br>

        <!-- Otros campos de entrada -->

        <!-- Agrega el botón de envío -->
        <input type="submit" name="guardar" value="Enviar">
    </form>
</body>
</html>
