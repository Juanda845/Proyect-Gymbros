<?php
include("../Suministros/conexion.php");

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];
$producto = $_POST['producto'];
$estado = $_POST['estado'];

$sql = "UPDATE proveedores SET
        nombre='" . $nombre . "',
        direccion='" . $direccion . "',
        telefono='" . $telefono . "',
        producto='" . $producto . "',
        estado='" . $estado . "' WHERE id = '" . $id . "'";

if ($resultado = $conexion->query($sql)) {
    header("location:../Views/Administrador/crud_proveedores.php?edited=true");
} else {
    echo "Datos no editados";
}
