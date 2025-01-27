<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/css/all.min.css">
</head>
<?php
session_start();
if (!empty($_SESSION['us_tipo'])) {
    header('Location: controlador/loginController.php');
    exit();
} else {
    session_destroy();
?>
<body>
    <div class="contenedor">
        <div class="contenido-login">
            <form action="controlador/loginController.php" method="post">
                <h1>Inventario</h1>
                <div class="input-div">
                    <div class="i">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="div">
                        <label for="user">Usuario</label>
                        <input type="text" name="user" class="input" required>
                    </div>
                </div>
                <div class="input-div pass">
                    <div class="i">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="div">
                        <label for="pass">Contraseña</label>
                        <input type="password" name="pass" class="input" required>
                    </div>
                </div>
                <input type="submit" class="btn" value="Iniciar Sesión">
                <a href="">Crear Usuario</a>
            </form>
        </div>
    </div>
</body>
</html>
<?php
}
?>