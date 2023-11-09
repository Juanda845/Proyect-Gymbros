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
                    <h2 class="border border-2 border-dark rounded-4 p-2"><strong>CRUD - FACTURAS</strong></h2>
                </div>
                <div class="container-fluid mb-5">
                    <table id="table_responsive" class="table table-dark table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">usuario</th>
                                <th scope="col">fecha de compra</th>
                                <th scope="col">estado</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('../../Suministros/scripts_alertas.php'); ?>