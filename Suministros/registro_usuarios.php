<?php
include("../Suministros/conexion.php");

$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$correo = $_POST['correo'];
$contraseña = $_POST['contraseña']; // Contraseña sin encriptar
$rol = 2;  // Establece el valor del rol como 2 (cliente)
$estado = 1;  // Establece el valor del estado como 1 (activo)

// Validación de la contraseña
if (strlen($contraseña) < 8 || !preg_match('/[A-Z]/', $contraseña) || !preg_match('/[a-z]/', $contraseña) || !preg_match('/[0-9]/', $contraseña) || preg_match('/[^a-zA-Z0-9]/', $contraseña)) {
    // La contraseña no cumple con los requisitos, mostrar la sweet_alert
    header("location:../Views/register.php?error=contraseña_invalida&nombres=$nombres&apellidos=$apellidos&correo=$correo&rol=$rol&estado=$estado");
    exit;
}

// Verificar si el correo ya existe en la base de datos
$consulta = "SELECT correo FROM usuarios WHERE correo = '$correo'";
$resultado = mysqli_query($conexion, $consulta);

if (mysqli_num_rows($resultado) > 0) {
    // El correo ya existe, mostrar la sweet_alert
    header("location:../Views/register.php?error=existente&nombres=$nombres&apellidos=$apellidos&correo=$correo&rol=$rol&estado=$estado");
} else {
    // El correo no existe, encriptar la contraseña y realizar la inserción
    $contraseñaEncriptada = password_hash($contraseña, PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios(nombres, apellidos, correo, contraseña, rol, estado) VALUES('$nombres', '$apellidos', '$correo', '$contraseñaEncriptada', '$rol', '$estado')";
    
    $resultado = mysqli_query($conexion, $sql);

    if ($resultado === TRUE) {
        header("location:../Views/login.php?added=true");
    } else {
        echo "Datos no insertados";
    }
}
?>

