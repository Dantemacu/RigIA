<?php
require("DbConfiguracion.php");

// Verifica si se ha proporcionado un ID de imagen válido
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $imagenID = $_GET['id'];

    // Prepara la consulta para eliminar la imagen de la base de datos
    $sql_eliminar = "DELETE FROM imagenes WHERE id_imagenes = ?";
    $stmt_eliminar = $mysqli->prepare($sql_eliminar);
    $stmt_eliminar->bind_param("i", $imagenID);

    if ($stmt_eliminar->execute()) {
        // Eliminación exitosa, redirige a la página principal o muestra un mensaje
        header("Location: Home.php");
        exit();
    } else {
        // Error al eliminar, muestra un mensaje de error
        echo "Error al eliminar la imagen.";
    }

    $stmt_eliminar->close();
}

// Si no se proporciona un ID válido, muestra un mensaje de error
echo "ID de imagen no válido.";
?>
