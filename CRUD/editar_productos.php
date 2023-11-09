<?php
include("../Suministros/conexion.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST['id']; // El ID del producto a editar

    $nombre = $_POST['nombre'];

    // Asegurarse de que los campos de precio y cantidad sean números enteros
    $precio = intval($_POST['precio']);
    $cantidad = intval($_POST['cantidad']);

    // Directorio donde se guardarán las imágenes
    $directorio_imagenes = '../Img/';

    // Verificar si se subió una nueva imagen
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $ruta_imagen = $directorio_imagenes . $_FILES['imagen']['name'];

        // Mover la nueva imagen al directorio de imágenes
        move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_imagen);

        // Actualizar la ruta de la imagen en la base de datos
        $sql_update_imagen = "UPDATE productos SET imagen = '$ruta_imagen' WHERE id = $id";
        mysqli_query($conexion, $sql_update_imagen);
    } else {
        // No se subió una nueva imagen, mantener la imagen actual
        $ruta_imagen = $_POST['imagen_actual'];
    }

    $categoria = $_POST['categoria'];
    $proveedor = $_POST['proveedor'];
    $estado = $_POST['estado'];
    $descripcion = $_POST['descripcion'];

    // Actualizar los datos en la base de datos
    $sql = "UPDATE productos 
            SET nombre = '$nombre', precio = $precio, cantidad = $cantidad, 
            categoria = '$categoria', proveedor = '$proveedor', estado = '$estado', descripcion = '$descripcion' 
            WHERE id = $id";

    $resultado = mysqli_query($conexion, $sql);

    if ($resultado === TRUE) {
        header("location:../Views/Administrador/crud_productos.php?edited_producto=true");
    } else {
        echo "Datos no actualizados";
    }
}
