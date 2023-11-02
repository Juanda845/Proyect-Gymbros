<?php
include("../Suministros/conexion.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = $_POST['nombre'];

    // Asegurarse de que los campos de precio y cantidad sean números enteros
    $precio = intval($_POST['precio']);
    $cantidad = intval($_POST['cantidad']);

    // Directorio donde se guardarán las imágenes
    $directorio_imagenes = '../Img/';

    // Verificar si se subió una imagen
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $ruta_imagen = $directorio_imagenes . $_FILES['imagen']['name'];

        // Mover la imagen al directorio de imágenes
        move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_imagen);
    } else {
        // Manejo de error si no se sube una imagen
        $ruta_imagen = '';
    }

    $categoria = $_POST['categoria'];
    $proveedor = $_POST['proveedor'];
    $estado = $_POST['estado'];
    $descripcion = $_POST['descripcion'];

    // Insertar los datos en la base de datos
    $sql = "INSERT INTO productos (nombre, precio, cantidad, imagen, categoria, proveedor, estado, descripcion) 
            VALUES ('$nombre', $precio, $cantidad, '$ruta_imagen', '$categoria', '$proveedor', '$estado', '$descripcion')";

    $resultado = mysqli_query($conexion, $sql);

    if ($resultado === TRUE) {
        header("location:../Views/Administrador/crud_productos.php?added=true");
    } else {
        echo "Datos no insertados";
    }
}
?>
