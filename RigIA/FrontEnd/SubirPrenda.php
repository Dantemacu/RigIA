
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
            <a href="Home.php">Rig<span>IA</span></a>
        </div>
        
        <div class="barra">
           <a href="#"> <i id="barra-opn" class="fa-solid fa-bars"></i> </a>
        </div>

        <nav class="barra-options">
            <i id="barra-close" class="fa-solid fa-xmark"></i>
            <ul class="conf">
                <li> <i class="fa-solid fa-user"></i> <a href="Home.php">Perfil</a></li>
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
              <button id="camara-btn" onclick="window.location.href='camara.html'"><img src="../Images/Group 38Camara.png" alt=""></button>
              <p>Cámara</p>
            </div>

            <div class="image-item">
    
            <form id="subirFotoForm" action="SubirFoto2.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="form_type" value="galeria">
                <!-- Botón de galería con redirección -->
                <button id="galeriaBtn" type="button" onclick="window.location.href='SubirFoto2.php'">
                <img src="../Images/Group 39Galeria.png" alt="">
            </button>
            <p>Galeria</p>
        </form>
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
