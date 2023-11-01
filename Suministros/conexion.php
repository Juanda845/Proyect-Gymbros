<?php
$host = 'localhost'; // Dirección del servidor
$usuario = 'root'; // Nombre de usuario root
$contrasena = ''; // La contraseña
$base_datos = 'gymbros'; // Nombre de la base de datos

// Crea la conexión a la base de datos
$conexion = new mysqli($host, $usuario, $contrasena, $base_datos);

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
} else {
    // echo "Conexión exitosa a la base de datos gymbros";
}
