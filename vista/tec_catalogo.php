<?php
session_start();
if (isset($_SESSION['us_tipo']) && $_SESSION['us_tipo'] == 2) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Técnico</title>
</head>
<body>
    <h1>Hola, Técnico</h1>
    <a href="../controlador/logout.php">Cerrar sesión</a>
</body>
</html>
<?php
} else {
    header('Location: ../index.php');
    exit();
}
?>
