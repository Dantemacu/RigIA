
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir Prenda</title>
    <script src="https://kit.fontawesome.com/a6f001e2da.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="SubirPrenda.css">
    <script src="Home.js"></script>
</head>
<body>

    <script src="drawer-prenda.js"></script>
    
    <header>
        <div class="logo">
            <img src="../Images/Logo.png" alt="logo">
            <a href="Home.html">Rig<span>IA</span></a>
        </div>
        
        <div class="barra">
           <a href="#"> <i id="barra-opn" class="fa-solid fa-bars"></i> </a>
        </div>

        <nav class="barra-options">
            <i id="barra-close" class="fa-solid fa-xmark"></i>
            <ul class="conf">
                <li> <i class="fa-solid fa-user"></i> <a href="Home.html">Perfil</a></li>
                <li> <i class="fa-solid fa-gear"></i> <a href="Configuracion.html">Configuracion</a></li>
                <li> <i class="fa-solid fa-shirt"></i> <a href="SubirPrenda.php">Subir prenda</a> </li>
                <li> <i class="fa-solid fa-folder-closed"></i> <a href="TuArmario.html">Armario</a> </li>
                <li> <i class="fa-solid fa-magnifying-glass"></i><a href="Busqueda.html"> Búsqueda</a></li>
            </ul>
        </nav>
    </header>
    
    <main>
        <h1>Subir Prenda</h1>
    
        <button id="open-drawer">Subir tu prenda aca <i class="fa-solid fa-arrow-down"></i></button>

    </main> 

    <div class="drawer">
        <div class="barrita-drawer">
          <p id="close-drawer">--------</p>
        </div>

        <div class="drawer-content">

            <div class="image-item">
              <button id="camara-btn"><img src="../Images/Group 38Camara.png" alt=""></button>
              <p>Cámara</p>
            </div>

            <div class="image-item">
                <button id="galeriaBtn"><img src="../Images/Group 39Galeria.png" alt=""></button>
                <p>Galeria</p>
                <input type="file" id="galeriaInput" style="display: none;" accept="image/*">
                <label for="galeriaInput"></label>
            </div>

        </div>

        <p class="texto-liso"> (La foto debe tener un fondo liso y la prenda debe estar bien estirada)</p>

    </div>
    
      <div class="drawer-background" id="drawer-background"></div>
<script>
    document.getElementById("galeriaBtn").addEventListener("click", function() {
        document.getElementById("galeriaInput").click();
    });

    document.getElementById("camera-btn").addEventListener("click", function() {
        
    });
</script>
</body>
</html>


<?php
/*include("conexion.php");

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
                            $sql = "INSERT INTO Rigia (Imagenes, nombre_prenda, descripcion, nombre_archivo, tipo_archivo) VALUES (?, ?, ?, ?, ?)";
                            $stmt = $mysqli->prepare($sql);
                            $stmt->bind_param("sssss", $archivo, $nombre, $descripcion, $archivo, $tipo);

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
}*/
?>
