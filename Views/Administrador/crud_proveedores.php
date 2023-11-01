<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
    // La sesión no está iniciada, redirige al inicio de sesión
    header("location:../login.php");
    exit;
}
// Obtén el nombre del usuario de la sesión
$nombre = $_SESSION['nombre'];
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Configuración de la página -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ADMIN - GYMBROS</title>

    <!-- Enlaces a archivos de estilo CSS y fuentes -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="../../Css/Styles_crud.css">
</head>

<body>
    <!-- Barra de navegación -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand p-2" href="index_admin.php"><img src="../../Img/logo.jpg" width="160" height="50"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <!-- Enlaces de navegación -->
                <div class="navbar-nav d-flex gap-4">
                    <a class="nav-link" href="crud_categorias.php">Categorías</a>
                    <a class="nav-link" href="crud_detalle_factura.php">Detalle_factura</a>
                    <a class="nav-link" href="crud_facturas.php">Facturas</a>
                    <a class="nav-link" href="crud_parametros.php">Parámetros</a>
                    <a class="nav-link" href="crud_productos.php">Productos</a>
                    <a class="nav-link" href="crud_proveedores.php">Proveedores</a>
                    <a class="nav-link" href="crud_roles.php">Roles</a>
                    <a class="nav-link" href="crud_usuarios.php">Usuarios</a>
                </div>
                <!-- Botón para cerrar sesión -->
                <div class="navbar-nav ms-auto">
                    <a class="nav-link" href="../../Suministros/logout.php"><button type="button" class="btn btn-outline-danger">Cerrar Sesión</button></a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                <div class="card-header justify-content-center">
                    <div class="card-title text-center col-12 d-grid justify-content-center">
                        <h1 class="border border-2 border-dark rounded-4 p-2"><strong>BIENVENIDO ADMINISTRADOR <span><?php echo $nombre; ?></span></strong></h1>
                    </div>
                    <div class="card-title text-center mb-4 col-12 d-grid justify-content-center">
                        <h2 class="border border-2 border-dark rounded-4 p-2"><strong>CRUD - PROVEEDORES</strong></h2>
                    </div>
                    <div class="container-fluid mb-5">
                        <a class="nav-link" href="../../Formularios/create_proveedores.php"><button type="button" class="btn btn-success mb-2">Nuevo registro <i class="fa-solid fa-file-circle-plus fa-lg" style="color: #ffffff;"></i></button></a>
                        <table id="table_responsive" class="table table-dark table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col">id</th>
                                    <th scope="col">nombre</th>
                                    <th scope="col">direccion</th>
                                    <th scope="col">telefono</th>
                                    <th scope="col">producto</th>
                                    <th scope="col">estado</th>
                                    <th scope="col">acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // PHP: Consulta y procesamiento de datos
                                require("../../Suministros/conexion.php");
                                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
                                    $proveedorId = $_POST['id'];

                                    // Realiza una consulta para verificar el estado actual
                                    $checkQuery = "SELECT estado FROM proveedores WHERE id = ?";
                                    $checkStmt = $conexion->prepare($checkQuery);
                                    $checkStmt->bind_param("i", $proveedorId);
                                    $checkStmt->execute();
                                    $checkStmt->bind_result($estadoActual);
                                    $checkStmt->fetch();
                                    $checkStmt->close();

                                    if ($estadoActual == 1) {
                                        // Si el estado es activo, cambia a inactivo
                                        $updateQuery = "UPDATE proveedores SET estado = 2 WHERE id = ?";
                                        $updateStmt = $conexion->prepare($updateQuery);
                                        $updateStmt->bind_param("i", $proveedorId);

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
                                    "SELECT proveedores.id, proveedores.nombre, proveedores.direccion, proveedores.telefono, proveedores.producto, parametros.valor AS estado
                                        FROM proveedores
                                        INNER JOIN parametros ON proveedores.estado = parametros.id
                                    "
                                );
                                while ($resultado = $sql->fetch_assoc()) {
                                ?>
                                    <tr>
                                        <!-- Datos de categoría en cada fila -->
                                        <th scope="row"><?php echo $resultado['id'] ?></th>
                                        <th><?php echo $resultado['nombre'] ?></th>
                                        <th><?php echo $resultado['direccion'] ?></th>
                                        <th><?php echo $resultado['telefono'] ?></th>
                                        <th><?php echo $resultado['producto'] ?></th>
                                        <th><?php echo $resultado['estado'] ?></th>
                                        <th>
                                            <!-- Botón para editar la categoría -->
                                            <a class="btn btn-warning" href="../../Formularios/update_proveedores.php?id=<?php echo $resultado['id'] ?>"><i class="fa-solid fa-pen-to-square" style="color: #000000;"></i></a>
                                            <!-- Botón para cambiar el estado de la categoría -->
                                            <button class="btn btn-danger <?php echo ($resultado['estado'] == 'inactivo') ? 'inactivo' : ''; ?>" data-id="<?php echo $resultado['id'] ?>"><i class="fa-solid fa-trash" style="color: #000000;"></i></button>
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
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            $('#table_responsive').DataTable({
                "responsive": true, // Habilitar el modo responsive
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json" // Establecer el idioma a español
                }
            });
        });
    </script>

    <script>
        <?php
        if (isset($_GET['added']) && $_GET['added'] == 'true') {
            echo 'Swal.fire({
            title: "¡Éxito!",
            text: "Proveedor agregado correctamente.",
            icon: "success",
            confirmButtonText: "OK"
        }).then(function() {
            // Elimina los parámetros de la URL
            var cleanUrl = window.location.href.split("?")[0];
            window.history.replaceState({}, document.title, cleanUrl);
            location.reload(); // Recarga la página
        });';
        }
        ?>
    </script>

    <script>
        <?php
        if (isset($_GET['edited']) && $_GET['edited'] == 'true') {
            echo 'Swal.fire({
            title: "¡Éxito!",
            text: "Proveedor editado correctamente.",
            icon: "success",
            confirmButtonText: "OK"
        }).then(function() {
            // Elimina los parámetros de la URL
            var cleanUrl = window.location.href.split("?")[0];
            window.history.replaceState({}, document.title, cleanUrl);
            location.reload(); // Recarga la página
        });';
        }
        ?>
    </script>

    <script>
        $(document).on('click', 'button.btn-danger', function() {
            var proveedorId = $(this).data('id');
            var isInactive = $(this).hasClass('inactivo');

            // Verificar si el registro está inactivo
            if (isInactive) {
                mostrarErrorAlerta();
            } else {
                mostrarConfirmacionAlerta(proveedorId);
            }

            function mostrarErrorAlerta() {
                Swal.fire({
                    title: 'Error',
                    text: 'Este registro ya está desactivado.',
                    icon: 'error',
                });
            }

            function mostrarConfirmacionAlerta(proveedorId) {
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: '¿Quieres cambiar el estado de este proveedor?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Sí',
                    cancelButtonText: 'No',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'POST',
                            data: {
                                id: proveedorId
                            }, // Envía el ID de la proveddor
                            success: function(response) {
                                mostrarRegistroDesactivadoAlerta();
                            },
                        });
                    }
                });
            }

            function mostrarRegistroDesactivadoAlerta() {
                Swal.fire({
                    title: '¡Éxito!',
                    text: 'Registro desactivado correctamente.',
                    icon: 'success',
                }).then(function() {
                    location.reload(); // Recarga la página
                });
            }
        });
    </script>
</body>

</html>