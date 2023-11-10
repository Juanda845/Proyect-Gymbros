<?php include('../../Suministros/header.php'); ?>

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