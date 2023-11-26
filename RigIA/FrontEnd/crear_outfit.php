<?php
require("DbConfiguracion.php");

$tipoPrenda{remera,pantalon,calzado};

// Función para obtener una imagen aleatoria de un tipo específico
function obtenerImagenAleatoria($tipoPrenda) {
    global $mysqli;
    $sql = "SELECT id_imagenes, nombre_archivo FROM imagenes WHERE tipo_prenda = ? AND id_usuario = ? ORDER BY RAND() LIMIT 1";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("si", $tipoPrenda, $_SESSION['IDUsuarioActivo']);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row;
    } else {
        return null;
    }
}

?>
