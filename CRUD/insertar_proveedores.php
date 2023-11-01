<?php
include("../Suministros/conexion.php");

$nombre = $_POST['nombre'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];
$producto = $_POST['producto'];
$estado = $_POST['estado'];

$sql = "INSERT INTO proveedores(nombre, direccion, telefono, producto, estado) VALUES('$nombre', '$direccion', '$telefono', '$producto', '$estado')";

$resultado = mysqli_query($conexion, $sql);

if ($resultado === TRUE) {
    header("location:../Views/Administrador/crud_proveedores.php?added=true");
} else {
    echo "Datos no insertados";
}
