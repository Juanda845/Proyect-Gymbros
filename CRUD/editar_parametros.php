<?php
include("../Suministros/conexion.php");

$id = $_POST['id'];
$valor = $_POST['valor'];

$sql = "UPDATE parametros SET
        valor='" . $valor . "' WHERE id = '" . $id . "'";

if ($resultado = $conexion->query($sql)) {
    header("location:../Views/Administrador/crud_parametros.php?edited=true");
} else {
    echo "Datos no editados";
}