<?php
//INDEX DE IMAGENES
$nombre= $_POST;
$_POST["Imagen"]="";
var_dump ($_POST);
require 'DbConfiguracion.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Indez de imagenes</title>
</head>
<body>
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="text" name="nombre" placeholder="Nombre..." value=""/><br><br>
        <input type="file" id = imagen name="imagen"/><br><br>
        <input type="submit" value="Aceptar">
    </form>
</body>
</html>


<?php
    $nombre = $_POST["imagen"];
    $query_insert = "INSERT INTO Ropa (Imagen) VALUES (?)";
    $stmt_insert = $mysqli->prepare($query_insert);
    $stmt_insert->bind_param("s", $_POST["imagen"]);
?>
