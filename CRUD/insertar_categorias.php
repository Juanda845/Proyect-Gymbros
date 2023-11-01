<?php
include("../Suministros/conexion.php");

$nombre = $_POST['nombre'];
$estado = $_POST['estado'];

$sql = "INSERT INTO categorias(nombre,estado) VALUES('$nombre','$estado')";

$resultado = mysqli_query($conexion, $sql);

if ($resultado === TRUE) {
    header("location:../Views/Administrador/crud_categorias.php?added=true");
} else {
    echo "Datos no insertados";
}