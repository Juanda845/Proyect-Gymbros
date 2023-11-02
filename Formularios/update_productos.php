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
                    <a class="nav-link " href="../Views/Administrador/crud_productos.php"><button type="button" class="btn btn-outline-danger">Cancelar</button></a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                <div class="card-header justify-content-center">
                    <div class="card-title text-center mb-4 col-12 d-grid justify-content-center">
                        <h2 class="border border-2 border-dark rounded-4 p-2"><strong>EDITAR - PRODUCTOS</strong></h2>
                    </div>

                    <div class="container-fluid mb-5">
                        <form action="../CRUD/editar_productos.php" method="POST" enctype="multipart/form-data">
                            <?php
                            include_once("../Suministros/conexion.php");
                            $sql = "SELECT * FROM productos WHERE id =" . $_REQUEST['id'];
                            $resultado = $conexion->query($sql);
                            $row = $resultado->fetch_assoc();
                            ?>

                            <input type="Hidden" class="form-control" name="id" value="<?php echo $row['id']; ?>">

                            <div class="row">
                                <!-- Columna izquierda -->
                                <div class="col-12 col-md-6">
                                    <div class="mb-5 col-12 mx-auto">
                                        <label for="Nombre" class="form-label">Nombre</label>
                                        <input type="text" class="form-control" name="nombre" id="Nombre" placeholder="Nombre" required value="<?php echo $row['nombre']; ?>">
                                    </div>
                                    <div class="mb-5 col-12 mx-auto">
                                        <label for="Precio" class="form-label">Precio</label>
                                        <input type="number" min="1" class="form-control" name="precio" id="Precio" placeholder="Precio" required value="<?php echo $row['precio']; ?>">
                                    </div>
                                    <div class="mb-5 col-12 mx-auto">
                                        <label for="Cantidad" class="form-label">Cantidad</label>
                                        <input type="number" min="1" class="form-control" name="cantidad" id="Cantidad" placeholder="Cantidad" required value="<?php echo $row['cantidad']; ?>">
                                    </div>
                                    <div class="mb-5 col-12 mx-auto">
                                        <label for="Imagen" class="form-label">Imagen</label>
                                        <input type="file" class="form-control" name="imagen" id="Imagen" accept="image/*">
                                    </div>
                                </div>
                                <!-- Columna derecha -->
                                <div class="col-12 col-md-6">
                                    <div class="mb-5 col-12 mx-auto">
                                        <label for="categoria" class="form-label">Categoría</label>
                                        <select id="categoria" class="form-select" name="categoria" required>
                                            <?php
                                            $sqlCategorias = $conexion->query("SELECT * FROM categorias");
                                            while ($categoria = $sqlCategorias->fetch_assoc()) {
                                                $selected = ($categoria['id'] == $row['categoria']) ? "selected" : "";
                                                echo "<option value='" . $categoria['id'] . "' $selected>" . $categoria['nombre'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-5 col-12 mx-auto">
                                        <label for="proveedor" class="form-label">Proveedor</label>
                                        <select id="proveedor" class="form-select" name="proveedor" required>
                                            <?php
                                            $sql = $conexion->query("SELECT * FROM proveedores");
                                            while ($proveedor = $sql->fetch_assoc()) {
                                                $selected = ($proveedor['id'] == $row['proveedor']) ? "selected" : "";
                                                echo "<option value='" . $proveedor['id'] . "' $selected>" . $proveedor['nombre'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-5 col-12 mx-auto">
                                        <label for="Estado" class="form-label">Estado</label>
                                        <select id="Estado" class="form-select" name="estado" required>
                                            <?php
                                            $sql = $conexion->query("SELECT * FROM parametros WHERE id IN (1, 2)");
                                            while ($parametro = $sql->fetch_assoc()) {
                                                $selected = ($parametro['id'] == $row['estado']) ? "selected" : "";
                                                echo "<option value='" . $parametro['id'] . "' $selected>" . $parametro['valor'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-5 col-12 mx-auto">
                                        <label for="descripcion" class="form-label">Descripción</label>
                                        <textarea type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Descripción" required><?php echo $row['descripcion']; ?></textarea>
                                    </div>
                                </div>
                                <div class="mb-5 text-center">
                                    <button type="submit" class="btn btn-primary col-6">Guardar Cambios</button>
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