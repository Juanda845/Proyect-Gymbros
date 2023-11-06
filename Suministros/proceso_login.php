<?php
session_start();
include("conexion.php");

if (isset($_POST['logueo'])) {
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];

    $query = "SELECT * FROM usuarios WHERE correo = '$correo'";
    $resultado = mysqli_query($conexion, $query);

    if (mysqli_num_rows($resultado) > 0) {
        $usuario = mysqli_fetch_assoc($resultado);

        if ($usuario['estado'] == 2) {
            // Usuario inactivo, asigna un mensaje de error
            $login_error = "Este usuario está inactivo.";
        } elseif (password_verify($contraseña, $usuario['contraseña'])) {
            // Los datos son correctos, configura la sesión y redirige
            $_SESSION['id_usuario'] = $usuario['id'];
            $_SESSION['correo'] = $usuario['correo'];
            $_SESSION['rol'] = $usuario['rol'];

            $nombre = $usuario['nombres'];
            $_SESSION['nombre'] = $nombre;

            if ($usuario['rol'] == 1) {
                // Usuario es administrador, redirige a la carpeta de administrador
                header("location:../Views/Administrador/index_admin.php");
                exit;
            } elseif ($usuario['rol'] == 2) {
                // Usuario es cliente, redirige a la carpeta de cliente
                header("location:../Views/Cliente/index.php");
                exit;
            }
        } else {
            // Datos incorrectos
            $login_error = "Los datos ingresados no son correctos.";
        }
    } else {
        // Usuario no encontrado
        $login_error = "El correo ingresado no está registrado. Por favor, regístrate si quieres continuar.";
    }
}
?>
