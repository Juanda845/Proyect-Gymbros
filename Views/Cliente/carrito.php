<?php
include('../../Suministros/header.php');
if (!isset($_SESSION['id_usuario'])) {
    header("location:../login.php");
    exit();
}
?>

<link rel="stylesheet" href="../../Css/Styles_carrito.css">

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