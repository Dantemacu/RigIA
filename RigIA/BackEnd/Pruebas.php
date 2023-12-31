<?php
require 'DbConfiguracion.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['guardar'])) {
        if (isset($_FILES['archivo']) && isset($_FILES['archivo']['name'])) {
            // Procesar la subida de imágenes
            $archivo = $_FILES['archivo']['name'];

            if ($archivo != "") {
                $tipo = $_FILES['archivo']['type'];
                $tamano = $_FILES['archivo']['size'];
                $temp = $_FILES['archivo']['tmp_name'];

                $carpetaDestino = 'C:/xampp/htdocs/ProyectoClothify/Clothify/Imagenes/';
                $rutaArchivo = $carpetaDestino . $archivo;

                if (!((strpos($tipo, "gif") || strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")) && ($tamano < 2000000))) {
                    echo '<div><b>Error. La extensión o el tamaño de los archivos no es correcta.<br/>
                    - Se permiten archivos .gif, .jpg, .png. y de 200 kb como máximo.</b></div>';
                } else {
                    if (move_uploaded_file($temp, $rutaArchivo)) {
                        // Procesar el formulario de guardar nombre y descripción
                        $nombre = $_POST['nombre'];
                        $descripcion = $_POST['descripcion'];

                        if (strlen($nombre) <= 100 && strlen($descripcion) <= 200) {
                            // Insertar los datos en la base de datos
                            $sql = "INSERT INTO imagenes (nombre_prenda, descripcion, nombre_archivo, tipo_archivo) VALUES (?, ?, ?, ?)";
                            $stmt = $mysqli->prepare($sql);
                            $stmt->bind_param("ssss", $nombre, $descripcion, $archivo, $tipo);

                            if ($stmt->execute()) {
                                echo "Datos guardados correctamente.";
                            } else {
                                echo "Error al guardar los datos: " . $mysqli->error;
                            }

                            $stmt->close();
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
    <form action="MiArmario.php" method="POST" enctype="multipart/form-data">
        Añadir imagen: <input name="archivo" id="archivo" type="file"/><br><br>

        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" maxlength="100" required><br><br>

        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion" id="descripcion" maxlength="200" required></textarea><br><br>

        <input type="submit" name="guardar" value="Guardar">
    </form>
</body>
</html>