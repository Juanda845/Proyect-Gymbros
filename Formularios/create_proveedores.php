<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
    // La sesión no está iniciada, redirige al inicio de sesión
    header("location:../Views/login.php");
    exit;
}
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
    <link rel="stylesheet" href="../Css/Styles_create.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand p-2" href="#"><img src="../Img/logo.jpg" width="160" height="50"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ms-auto">
                    <a class="nav-link " href="../Views/Administrador/crud_proveedores.php"><button type="button" class="btn btn-outline-danger">Cancelar</button></a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                <div class="card-header justify-content-center">
                    <div class="card-title text-center mb-4 col-12 d-grid justify-content-center">
                        <h2 class="border border-2 border-dark rounded-4 p-2"><strong>FORMULARIO - PROVEEDORES</strong></h2>
                    </div>
                    <div class="container-fluid mb-5">
                        <form action="../CRUD/insertar_proveedores.php" method="POST">
                            <div class="row">
                                <!-- Columna izquierda -->
                                <div class="col-12 col-md-6">
                                    <div class="mb-5 col-12 mx-auto">
                                        <label for="Nombre" class="form-label">Nombre</label>
                                        <input type="text" class="form-control" name="nombre" id="Nombre" placeholder="Nombre" required>
                                    </div>
                                    <div class="mb-5 col-12 mx-auto">
                                        <label for="Direccion" class="form-label">Dirección</label>
                                        <input type="text" class="form-control" name="direccion" id="Direccion" placeholder="Dirección" required>
                                    </div>
                                    <div class="mb-5 col-12 mx-auto">
                                        <label for="Telefono" class="form-label">Teléfono</label>
                                        <input type="text" class="form-control" name="telefono" id="Telefono" placeholder="Teléfono" required>
                                    </div>
                                </div>
                                <!-- Columna derecha -->
                                <div class="col-12 col-md-6">
                                    <div class="mb-5 col-12 mx-auto">
                                        <label for="Producto" class="form-label">Producto</label>
                                        <select id="Producto" class="form-select" name="producto" required>
                                            <option selected disabled>Seleccionar Producto</option>
                                            <?php
                                            include("../Suministros/conexion.php");

                                            $sql = $conexion->query("SELECT * FROM categorias");
                                            while ($resultado = $sql->fetch_assoc()) {
                                                echo "<option value='" . $resultado['id'] . "'>" . $resultado['nombre'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-5 col-12 mx-auto">
                                        <label for="Estado" class="form-label">Estado</label>
                                        <select id="Estado" class="form-select" name="estado" required>
                                            <option selected disabled>Seleccionar Estado</option>
                                            <?php
                                            include("../Suministros/conexion.php");

                                            $sql = $conexion->query("SELECT * FROM parametros WHERE id IN (1)");
                                            while ($resultado = $sql->fetch_assoc()) {
                                                echo "<option value='" . $resultado['id'] . "'>" . $resultado['valor'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-5">
                                        <label class="form-label">Enviar</label>
                                        <button type="submit" class="btn btn-primary col-12">Enviar</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>