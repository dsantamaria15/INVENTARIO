<?php
include_once '../modelo/Usuario.php';
session_start();

$user = $_POST['user'] ?? null;
$pass = $_POST['pass'] ?? null;
$usuario = new Usuario();

if (!empty($_SESSION['us_tipo'])) {
    switch ($_SESSION['us_tipo']) {
        case 1:
            header('Location: ../vista/adm_catalogo.php');
            break;
        case 2:
            header('Location: ../vista/tec_catalogo.php');
            break;
    }
    exit();
} elseif ($user && $pass) {
    $usuario->loguearse($user, $pass);

    if (!empty($usuario->objetos)) {
        foreach ($usuario->objetos as $objeto) {
            $_SESSION['usuario'] = $objeto->id_usuario;
            $_SESSION['us_tipo'] = $objeto->us_tipo;
            $_SESSION['nombre_us'] = $objeto->nombre_us;
        }

        switch ($_SESSION['us_tipo']) {
            case 1:
                header('Location: ../vista/adm_catalogo.php');
                break;
            case 2:
                header('Location: ../vista/tec_catalogo.php');
                break;
        }
        exit();
    } else {
        header('Location: ../vista/login.php?error=1');
        exit();
    }
} else {
    header('Location: ../index.php?error=2');
    exit();
}
?>