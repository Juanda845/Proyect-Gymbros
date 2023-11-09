<?php
include("../Suministros/conexion.php");

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$estado = $_POST['estado'];

$sql = "UPDATE categorias SET
        nombre='" . $nombre . "',
        estado='" . $estado . "' WHERE id = '" . $id . "'";

if ($resultado = $conexion->query($sql)) {
    header("location:../Views/Administrador/crud_categorias.php?edited_categoria=true");
} else {
    echo "Datos no editados";
}
