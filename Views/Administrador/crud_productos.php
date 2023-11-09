<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
    // La sesión no está iniciada, redirige al inicio de sesión
    header("location:../login.php");
    exit;
}
// Obtén el nombre del usuario de la sesión
$nombre = $_SESSION['nombre'];

include('../../Suministros/header-admin.php');
?>

<div class="container my-5">
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
            <div class="card-header justify-content-center">
                <div class="card-title text-center col-12 d-grid justify-content-center">
                    <h1 class="border border-2 border-dark rounded-4 p-2"><strong>BIENVENIDO ADMINISTRADOR <span><?php echo $nombre; ?></span></strong></h1>
                </div>
                <div class="card-title text-center mb-4 col-12 d-grid justify-content-center">
                    <h2 class="border border-2 border-dark rounded-4 p-2"><strong>CRUD - PRODUCTOS</strong></h2>
                </div>
                <div class="container-fluid mb-5">
                    <a class="nav-link" href="../../Formularios/create_productos.php"><button type="button" class="btn btn-success mb-2">Nuevo registro <i class="fa-solid fa-file-circle-plus fa-lg" style="color: #ffffff;"></i></button></a>
                    <table id="table_responsive" class="table table-dark table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">nombre</th>
                                <th scope="col">precio  </th>
                                <th scope="col">cantidad</th>
                                <th scope="col">imagen</th>
                                <th scope="col">categoria</th>
                                <th scope="col">proveedor</th>
                                <th scope="col">estado</th>
                                <th scope="col">descripcion</th>
                                <th scope="col">acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require("../../Suministros/conexion.php");
                            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
                                $productoId = $_POST['id'];

                                // Realiza una consulta para verificar el estado actual
                                $checkQuery = "SELECT estado FROM productos WHERE id = ?";
                                $checkStmt = $conexion->prepare($checkQuery);
                                $checkStmt->bind_param("i", $productoId);
                                $checkStmt->execute();
                                $checkStmt->bind_result($estadoActual);
                                $checkStmt->fetch();
                                $checkStmt->close();

                                if ($estadoActual == 1) {
                                    // Si el estado es activo, cambia a inactivo
                                    $updateQuery = "UPDATE productos SET estado = 2 WHERE id = ?";
                                    $updateStmt = $conexion->prepare($updateQuery);
                                    $updateStmt->bind_param("i", $productoId);

                                    if ($updateStmt->execute()) {
                                        echo json_encode(array("success" => true, "message" => "Estado cambiado con éxito."));
                                    } else {
                                        echo json_encode(array("success" => false, "message" => "Error al cambiar el estado."));
                                    }
                                } else {
                                    echo json_encode(array("success" => false, "message" => "Este producto ya está inactivo."));
                                }
                            }

                            $sql = $conexion->query(
                                "SELECT productos.id, productos.nombre, productos.precio, productos.cantidad, productos.imagen, 
                                    categorias.nombre AS categoria, proveedores.nombre AS proveedor, parametros.valor AS estado, productos.descripcion
                                    FROM productos
                                    INNER JOIN categorias ON productos.categoria = categorias.id
                                    INNER JOIN proveedores ON productos.proveedor = proveedores.id
                                    INNER JOIN parametros ON productos.estado = parametros.id"
                            );

                            while ($resultado = $sql->fetch_assoc()) {
                            ?>
                                <tr>
                                    <th scope="row"><?php echo $resultado['id'] ?></th>
                                    <th><?php echo $resultado['nombre'] ?></th>
                                    <th><?php echo $resultado['precio'] ?></th>
                                    <th><?php echo $resultado['cantidad'] ?></th>
                                    <th><img src="../../Img/<?php echo $resultado['imagen'] ?>" alt="Imagen" width="50"></th>
                                    <th><?php echo $resultado['categoria'] ?></th>
                                    <th><?php echo $resultado['proveedor'] ?></th>
                                    <th><?php echo $resultado['estado'] ?></th>
                                    <th><?php echo $resultado['descripcion'] ?></th>
                                    <th>
                                        <div class="d-flex gap-2">
                                            <a class="btn btn-warning" href="../../Formularios/update_productos.php?id=<?php echo $resultado['id'] ?>"><i class="fa-solid fa-pen-to-square" style="color: #000000;"></i></a>
                                            <button class="btn btn-danger btn-desactivar-producto" <?php echo ($resultado['estado'] == 'inactivo') ? 'inactivo' : ''; ?>" data-id="<?php echo $resultado['id'] ?>"><i class="fa-solid fa-trash" style="color: #000000;"></i></button>
                                        </div>
                                    </th>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('../../Suministros/scripts_alertas.php'); ?>