<?php include('../../Suministros/header.php'); ?>

<link rel="stylesheet" href="../../Css/Styles_categorias.css">
<!-- Vista de productos para agregar al carrito -->
<section class="my-3">
    <div class="container-fluid">
        <div class="row">
            <!-- Filtro -->
            <div class="col-md-3">
                <div class="card-header">
                    <h2 class="mt-2 mb-4 text-center"><strong>BUSCAR</strong></h2>
                </div>
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item border rounded-5 bg-dark">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed border rounded-5 bg-dark text-light" type="button" data-bs-toggle="collapse" data-bs-target="#filtroCollapse" aria-expanded="false" aria-controls="filtroCollapse">
                                Filtros
                            </button>
                        </h2>
                        <div id="filtroCollapse" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <form method="GET">
                                    <div class="mb-3">
                                        <label for="precio" class="form-label text-light">Precio</label>
                                        <input type="text" class="form-control bg-dark text-light" name="precio" id="precio" placeholder="Precio" value="<?php echo isset($_GET['precio']) ? $_GET['precio'] : ''; ?>">
                                    </div>

                                    <div class="mb-3">
                                        <label for="categoria" class="form-label text-light">Categoría</label>
                                        <select class="form-select bg-dark text-light" name="categoria" id="categoria">
                                            <option value="" selected>Seleccionar Categoría</option>
                                            <?php
                                            require("../../Suministros/conexion.php");
                                            $sqlCategorias = $conexion->query("SELECT * FROM categorias");
                                            while ($categoria = $sqlCategorias->fetch_assoc()) :
                                            ?>
                                                <option value="<?php echo $categoria['id']; ?>" <?php echo (isset($_GET['categoria']) && $_GET['categoria'] == $categoria['id']) ? 'selected' : ''; ?>><?php echo $categoria['nombre']; ?></option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="cantidad" class="form-label text-light">Cantidad mínima</label>
                                        <input type="number" class="form-control bg-dark text-light" name="cantidad" id="cantidad" placeholder="Cantidad mínima" value="<?php echo isset($_GET['cantidad']) ? $_GET['cantidad'] : ''; ?>">
                                    </div>

                                    <div class="mb-3">
                                        <label for="nombre" class="form-label text-light">Nombre del producto</label>
                                        <input type="text" class="form-control bg-dark text-light" name="nombre" id="nombre" placeholder="Nombre del producto" value="<?php echo isset($_GET['nombre']) ? $_GET['nombre'] : ''; ?>">
                                    </div>

                                    <button type="submit" class="btn btn-primary form-control">Filtrar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Productos -->
            <div class="col-md-9">
                <div class="card-header">
                    <h2 class="mt-2 mb-4"><strong>¡PRODUCTOS DISPONIBLES!</strong></h2>
                </div>
                <!-- Lista de productos -->
                <div class="container">
                    <div class="row row-cols-1 row-cols-md-3 g-4">
                        <?php
                        // Paginación
                        $productosPorPagina = 12;
                        $paginaActual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
                        $inicio = ($paginaActual > 1) ? ($paginaActual * $productosPorPagina - $productosPorPagina) : 0;

                        // Construir la consulta base
                        $sql = "SELECT * FROM productos WHERE estado = (SELECT id FROM parametros WHERE valor = 'Activo')";

                        // Aplicar filtros si existen
                        $filtros = [];

                        if (isset($_GET['precio']) && $_GET['precio'] != '') {
                            $precio = $_GET['precio'];

                            // Verificar si es un rango o un valor específico
                            if (strpos($precio, '-') !== false) {
                                // Es un rango, dividir en mínimo y máximo
                                list($precioMin, $precioMax) = explode('-', $precio);

                                $filtros[] = "precio >= $precioMin AND precio <= $precioMax";
                            } else {
                                // Es un valor específico
                                $filtros[] = "precio = $precio";
                            }
                        }

                        if (isset($_GET['categoria']) && $_GET['categoria'] != '') {
                            $filtros[] = "categoria = " . $_GET['categoria'];
                        }

                        if (isset($_GET['cantidad']) && $_GET['cantidad'] != '') {
                            $filtros[] = "cantidad = " . $_GET['cantidad'];
                        }

                        if (isset($_GET['nombre']) && $_GET['nombre'] != '') {
                            $filtros[] = "nombre LIKE '%" . $_GET['nombre'] . "%'";
                        }

                        if (!empty($filtros)) {
                            $sql .= " AND " . implode(" AND ", $filtros);
                        }

                        // Agregar limit y ejecutar la consulta
                        $sql .= " LIMIT $inicio, $productosPorPagina";
                        $resultado = $conexion->query($sql);

                        while ($producto = $resultado->fetch_assoc()) :
                        ?>
                            <!-- Producto -->
                            <div class="col mb-4">
                                <div class="card text-bg-dark h-100">
                                    <img src="../../Img/<?php echo $producto['imagen']; ?>" class="card-img-top product-image mt-1" alt="<?php echo $producto['nombre']; ?>">
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title product-title"><?php echo $producto['nombre']; ?></h5>
                                        <p class="card-text product-info flex-fill"><?php echo $producto['descripcion']; ?></p>
                                        <p class="card-text product-info">$<?php echo $producto['precio']; ?></p>
                                        <button onclick="<?php echo isset($_SESSION['id_usuario']) ? "agregarAlCarrito('" . $producto['nombre'] . "', " . $producto['precio'] . ", '" . $producto['imagen'] . "', '" . $producto['descripcion'] . "');" : "window.location.href='../login.php'"; ?>" class="btn btn-primary mt-auto"><i class="fas fa-shopping-cart"></i> Agregar al Carrito</button>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>

                <!-- Paginación de Bootstrap -->
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        <?php
                        $totalProductos = $conexion->query("SELECT COUNT(*) FROM productos WHERE estado = (SELECT id FROM parametros WHERE valor = 'Activo')")->fetch_row()[0];
                        $totalPaginas = ceil($totalProductos / $productosPorPagina);

                        for ($i = 1; $i <= $totalPaginas; $i++) : ?>
                            <li class="page-item <?php echo ($i == $paginaActual) ? 'active' : ''; ?>">
                                <a class="page-link" href="?pagina=<?php echo $i; ?>"><?php echo $i; ?></a>
                            </li>
                        <?php endfor; ?>
                    </ul>
                </nav>
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