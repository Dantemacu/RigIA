<?php
$mail= $_POST;

$_ENV = parse_ini_file('.env');
$mysqli = mysqli_init();
$mysqli->ssl_set(NULL, NULL, "./cacert.pem", NULL, NULL);
$mysqli->real_connect($_ENV["HOST"], $_ENV["USERNAME"], $_ENV["PASSWORD"], $_ENV["DATABASE"]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar contraseña</title>
</head>
<body>
    <h1>SOS UN BOLUDO</h1>
<form action="" method="post">
    <label for="Correo">Ingrese su correo electrónico vinculado a la cuenta:</label>
    <input type="mail" id="Correo" name="RecuperacionContra"required><br>
</form>
</body>
</html>

<?php
//--VERIFICACIÓN MAIL REPETIDO--
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $verificationCode = mt_rand(100000, 999999);
    $mail = $_POST["RecuperacionContra"];
    $query_check_mail = "SELECT Mail FROM InicioSesion WHERE Mail = ?";
    $stmt_check_mail = $mysqli->prepare($query_check_mail);
    $stmt_check_mail->bind_param("s", $mail);
    $stmt_check_mail->execute();
    $stmt_check_mail->store_result();
    if ($stmt_check_mail->num_rows > 0) {
        echo "El correo electrónico es correcto.";
        $to = $mail;
        $subject = "Código de Verificación";
        $message = "Su código de verificación es: " . $verificationCode;
        $headers = "From: tu-correo@example.com" . "\r\n";
        mail($to, $subject, $message, $headers);
        echo "El correo fue enviado";
}
else{
    echo "El correo ingresado no existe.";
}
}
?>