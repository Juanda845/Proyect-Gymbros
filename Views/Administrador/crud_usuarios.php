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
                    <h2 class="border border-2 border-dark rounded-4 p-2"><strong>CRUD - USUARIOS</strong></h2>
                </div>
                <div class="container-fluid mb-5">
                    <a class="nav-link" href="../../Formularios/create_usuarios.php"><button type="button" class="btn btn-success mb-2">Nuevo registro <i class="fa-solid fa-file-circle-plus fa-lg" style="color: #ffffff;"></i></button></a>
                    <table id="table_responsive" class="table table-dark table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">nombres</th>
                                <th scope="col">apellidos</th>
                                <th scope="col">correo</th>
                                <th scope="col">rol</th>
                                <th scope="col">estado</th>
                                <th scope="col">acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // PHP: Consulta y procesamiento de datos
                            require("../../Suministros/conexion.php");
                            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
                                $usuariosId = $_POST['id'];

                                // Realiza una consulta para verificar el estado actual
                                $checkQuery = "SELECT estado FROM usuarios WHERE id = ?";
                                $checkStmt = $conexion->prepare($checkQuery);
                                $checkStmt->bind_param("i", $usuariosId);
                                $checkStmt->execute();
                                $checkStmt->bind_result($estadoActual);
                                $checkStmt->fetch();
                                $checkStmt->close();

                                if ($estadoActual == 1) {
                                    // Si el estado es activo, cambia a inactivo
                                    $updateQuery = "UPDATE usuarios SET estado = 2 WHERE id = ?";
                                    $updateStmt = $conexion->prepare($updateQuery);
                                    $updateStmt->bind_param("i", $usuariosId);

                                    if ($updateStmt->execute()) {
                                        echo json_encode(array("success" => true, "message" => "Estado cambiado con éxito."));
                                    } else {
                                        echo json_encode(array("success" => false, "message" => "Error al cambiar el estado."));
                                    }
                                } else {
                                    echo json_encode(array("success" => false, "message" => "Este registro ya está inactivo."));
                                }
                            }

                            $sql = $conexion->query(
                                "SELECT usuarios.id, usuarios.nombres, usuarios.apellidos, usuarios.correo, roles.rol AS rol, parametros.valor AS estado
                                    FROM usuarios
                                    INNER JOIN parametros ON usuarios.estado = parametros.id
                                    INNER JOIN roles ON usuarios.rol = roles.id                                    
                                    "
                            );
                            while ($resultado = $sql->fetch_assoc()) {
                            ?>
                                <tr>
                                    <!-- Datos de categoría en cada fila -->
                                    <th scope="row"><?php echo $resultado['id'] ?></th>
                                    <th><?php echo $resultado['nombres'] ?></th>
                                    <th><?php echo $resultado['apellidos'] ?></th>
                                    <th><?php echo $resultado['correo'] ?></th>
                                    <th><?php echo $resultado['rol'] ?></th>
                                    <th><?php echo $resultado['estado'] ?></th>
                                    <th>
                                        <!-- Botón para editar la categoría -->
                                        <a class="btn btn-warning" href="../../Formularios/update_usuarios.php?id=<?php echo $resultado['id']; ?>"><i class="fa-solid fa-pen-to-square" style="color: #000000;"></i></a>
                                        <!-- Botón para cambiar el estado de la categoría -->
                                        <button class="btn btn-danger btn-desactivar-usuarios" <?php echo ($resultado['estado'] == 'inactivo') ? 'inactivo' : ''; ?>" data-id="<?php echo $resultado['id'] ?>"><i class="fa-solid fa-trash" style="color: #000000;"></i></button>
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