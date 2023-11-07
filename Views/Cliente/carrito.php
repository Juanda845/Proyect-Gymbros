<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header("location:../login.php");
    exit();
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Carrito de compras</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="../../Css/Styles_carrito.css">
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark p-1">
        <a class="navbar-brand" href="../Cliente/index.php"><img src="../../Img/logo.jpg" width="160" height="50"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarCollapse">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link mt-2" href="categorias.php"><i class="fa-solid fa-dumbbell fa-xl" style="color: #ffffff;"></i> PRODUCTOS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mt-2" href="perfil.php"><i class="fa-solid fa-circle-user fa-xl" style="color: #ffffff;"></i> PERFIL</a>
                </li>
                <?php
                if (isset($_SESSION['id_usuario'])) {
                    // El usuario está logueado, muestra el botón de "Cerrar Sesión" con el estilo deseado
                    echo '<li class="nav-item"><a class="nav-link mb-1" href="../../Suministros/logout.php"><button type="button" class="btn btn-outline-danger"><i class="fa-solid fa-door-open"></i> Cerrar Sesión</button></a></li>';
                }
                ?>
            </ul>
        </div>
    </nav>

    <!-- Sección del Carrito de Compras -->
    <section class="mt-5">
        <div class="container">
            <div class="row">
                <!-- Carrito -->
                <div class="col-md-9">
                    <div class="card p-1">
                        <div class="container-titles d-flex">
                            <h4 class="card-title-1 m-2">Tu carrito de compras</h4>
                            <h6 class="card-title-2 mt-3">(<span id="numProductos"></span>) Productos</h6>
                        </div>
                    </div>
                    <div class="card border border-dark-subtle shadow-0 mt-3">
                        <div class="m-4" id="carrito">
                            <!-- Aquí se mostrarán los productos en el carrito -->
                        </div>
                    </div>
                </div>
                <!-- Carrito -->
                <!-- Resumen -->
                <div class="col-md-3 sm-mt-2">
                    <div class="card shadow-0 border border-dark-subtle">
                        <div class="card-body text-center"> <!-- Añade 'text-center' para centrar el contenido -->
                            <!-- Detalles del resumen -->
                            <div>
                                <label for="selectPayment" class="h5"><strong>MÉTODOS DE PAGO</strong></label>
                                <select class="select-payment form-select mb-2" id="selectPayment" aria-label="SELECCIONAR">
                                    <option selected disabled>SELECCIONAR</option>
                                    <option value="1">PAGO CONTRA ENTREGA</option>
                                    <option value="2">PASO PSE</option>
                                </select>
                            </div>
                            <hr />
                            <div class="d-flex justify-content-between">
                                <p class="mb-2">Precio total:</p>
                                <p class="mb-2 fw-bold" id="precioTotal">$0.00</p>
                            </div>
                            <!-- Botones para la compra -->
                            <div class="mt-3">
                                <a id="showAlertBtn-payment" href="#" class="btn btn-1 w-100 shadow-0 mb-2"><i class="fa-solid fa-bag-shopping"></i> Realizar compra</a>
                                <a href="categorias.php" class="btn btn-2 btn-light w-100 mt-2 text-dark">Volver a la tienda</a>
                            </div>
                            <!-- Métodos de pago -->

                            <div class="mt-5">
                                <h5 class="mb-2">MÉTODOS DE PAGO</h5>
                                <div class="mt-3">
                                    <img src="../../Img/pagos.png" class="img-fluid" alt="...">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Resumen -->
            </div>
        </div>
    </section>
    <!-- Bootstrap JS y SweetAlert2 JS y Javascript-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
    <script src="../../Js/carrito.js"></script>
</body>

</html>