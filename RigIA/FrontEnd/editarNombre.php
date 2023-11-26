<?php
require("DbConfiguracion.php");

// Verifica si se ha proporcionado un ID de imagen válido
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $imagenID = $_GET['id'];
    $nombreArchivo = urldecode($_GET['nombreArchivo']);
    

    $sql_editarNombre = "UPDATE imagenes SET nombre_archivo = ? WHERE id_imagenes = ?";
    $stmt_editarNombre = $mysqli->prepare($sql_editarNombre);
    $stmt_editarNombre->bind_param("si",$nombreArchivo, $imagenID);

    if ($stmt_editarNombre->execute()) {
        // Eliminación exitosa, redirige a la página principal o muestra un mensaje
        header("Location: TuArmario.php");
        exit();
    } else {
        // Error al eliminar, muestra un mensaje de error
        echo "Error al eliminar la imagen.";
    }

    $stmt_editarNombre->close();
}

// Si no se proporciona un ID válido, muestra un mensaje de error
echo "ID de imagen no válido.";

?>