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

<div class="container mt-3">
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
            <div class="card-header justify-content-center">
                <div class="card-title text-center col-12 d-grid justify-content-center">
                    <h1 class="border border-2 border-dark rounded-4 p-2"><strong>BIENVENIDO ADMINISTRADOR <span></span><?php echo $nombre; ?></strong></h1>
                </div>
                <div class="card-title text-center mb-4 col-12 d-grid justify-content-center">
                    <h2 class="border border-2 border-dark rounded-4 p-2"><strong>CRUD - PARÁMETROS</strong></h2>
                </div>
                <div class="container-fluid">
                    <table id="table_responsive" class="table table-dark table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">valor</th>
                                <th scope="col">acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require("../../Suministros/conexion.php");
                            $sql = $conexion->query("SELECT * FROM parametros");

                            while ($resultado = $sql->fetch_assoc()) {
                            ?>
                                <tr>
                                    <th scope="row"><?php echo $resultado['id'] ?></th>
                                    <th><?php echo $resultado['valor'] ?></th>
                                    <th>
                                        <!-- Botón para editar la categoría -->
                                        <a class="btn btn-warning" href="../../Formularios/update_parametros.php?id=<?php echo $resultado['id'] ?>"><i class="fa-solid fa-pen-to-square" style="color: #000000;"></i></a>
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