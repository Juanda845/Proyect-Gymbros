    <!DOCTYPE html>
    <html lang="es">

    <head>
        <!-- Metadatos -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Título de la Página -->
        <title>Listado de Pedido</title>
        <!-- Favicon y Hojas de Estilo -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="../../Css/Styles_categorias.css">
    </head>

    <body>

        <nav class="navbar navbar-expand-md navbar-dark bg-dark">
            <a class="navbar-brand" href="../login.php"><img src="../../Img/logo.jpg" width="160" height="50"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav ms-auto d-flex gap-3">
                    <li class="nav-item active">
                        <a class="nav-link" href="categorias.php"><i class="fa-solid fa-dumbbell fa-xl" style="color: #ffffff;"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="perfil.php"><i class="fa-solid fa-circle-user fa-xl" style="color: #ffffff;"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="carrito.php"><i class="fa-solid fa-cart-shopping fa-xl" style="color: #ffffff;"></i></a>
                    </li>
                </ul>
            </div>
            <div class="navbar-nav ms-auto d-flex gap-5">
                <?php
                session_start();
                if (isset($_SESSION['id_usuario'])) {
                    // El usuario está logueado, muestra el botón de "Cerrar Sesión"
                    echo '<a class="nav-link" href="../../Suministros/logout.php"><button type="button" class="btn btn-outline-danger">Cerrar Sesión</button></a>';
                }
                ?>
            </div>
        </nav>

        <!-- Vista de productos para agregar al carrito -->
        <section class="my-3">
            <div class="container">
                <div class="row">
                    <!-- Productos -->
                    <div class="col-md-9">
                        <div class="card-header">
                            <h3 class="mb-3">Productos Disponibles</h3>
                        </div>
                        <!-- Lista de productos -->
                        <div class="row">
                            <?php
                            require("../../Suministros/conexion.php");

                            // Realiza una consulta SQL para obtener los datos de productos
                            $sql = "SELECT * FROM productos
                            WHERE estado = (SELECT id FROM parametros WHERE valor = 'Activo')";
                            $resultado = $conexion->query($sql);

                            while ($producto = $resultado->fetch_assoc()) :
                            ?>
                                <!-- Producto -->
                                <div class="col-md-4 mb-4">
                                    <div class="card card-container">
                                        <img src="../../Img/<?php echo $producto['imagen']; ?>" class="card-img-top product-image" alt="<?php echo $producto['nombre']; ?>">
                                        <div class="card-body">
                                            <h5 class="card-title product-title"><?php echo $producto['nombre']; ?></h5>
                                            <p class="card-text product-info"><?php echo $producto['descripcion']; ?></p>
                                            <p class="card-text product-info">$<?php echo $producto['precio']; ?></p>
                                            <button onclick="<?php echo isset($_SESSION['id_usuario']) ? "agregarAlCarrito('" . $producto['nombre'] . "', " . $producto['precio'] . ", '" . $producto['imagen'] . "', '" . $producto['descripcion'] . "');" : "window.location.href='../login.php'"; ?>" class="btn btn-primary"><i class="fas fa-shopping-cart"></i> Agregar al Carrito</button>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Bootstrap JS y SweetAlert2 JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
        <script src="../../Js/categorias.js"></script>
    </body>

    </html>