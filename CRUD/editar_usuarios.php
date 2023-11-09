<?php
include("../Suministros/conexion.php");

$id = $_POST['id'];
$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$correo = $_POST['correo'];
$rol = $_POST['rol'];
$estado = $_POST['estado'];

$sql = "UPDATE usuarios SET
        nombres='" . $nombres . "',
        apellidos='" . $apellidos . "',
        correo='" . $correo . "',
        rol='" . $rol . "',
        estado='" . $estado . "' WHERE id = '" . $id . "'";

if ($resultado = $conexion->query($sql)) {
    header("location:../Views/Administrador/crud_usuarios.php?edited_usuarios=true");
} else {
    echo "Datos no editados";
}