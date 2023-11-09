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

<!-- Contenido principal -->
<div class="container my-5">
    <div class="row">
        <div class="col-12 col-md-8 offset-md-2 mt-5">
            <div class="card bg-dark text-white text-center my-5">
                <div class="card-body">
                    <h1 class="card-title">BIENVENIDO ADMINISTRADOR</h1>
                    <h1 class="card-title"><strong><?php echo $nombre; ?></strong></h1>
                    <h3 class="card-text"><small class="text-white">AL SISTEMA DE ADMINISTRACIÓN DE:</small></h3>
                    <img src="../../Img/logo.jpg" class="card-img img-fluid img-small" alt="Logo">
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>