<?php include('../../Suministros/header.php'); ?>

<div class="col-12">
    <div id="carouselExampleRide" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="../../Img/fondogym.jpg" class="d-block w-100" style="max-height: 50vh;" alt="...">
                <div class="carousel-caption d-block">
                    <button class="btn btn-outline-warning showSweetAlert"><strong>¡GYMBROS 🏋🏻‍♀️!</strong></button>
                    <h1>DE PARTE DE GYMBROS...</h1>
                    <p>NO ERES LO QUE LOGRAS - ERES LO QUE SUPERAS. 🔥</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="../../Img/fondogym-2.jpg" class="d-block w-100" style="max-height: 50vh;" alt="...">
                <div class="carousel-caption d-block">
                    <button class="btn btn-outline-warning showSweetAlert"><strong>¡GYMBROS 🏋🏻‍♀️!</strong></button>
                    <h1>DE PARTE DE GYMBROS...</h1>
                    <p>LOS LOGROS NO SON MAGIA - SON TRABAJO DURO Y DEDICACIÓN. 💪🏻</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="../../Img/fondogym-3.jpg" class="d-block w-100" style="max-height: 50vh;" alt="...">
                <div class="carousel-caption d-block">
                    <button class="btn btn-outline-warning showSweetAlert"><strong>¡GYMBROS 🏋🏻‍♀️!</strong></button>
                    <h1>DE PARTE DE GYMBROS...</h1>
                    <p>SUEÑA SIN MIEDOS - ENTRENA SIN LÍMITES. 💆🏻‍♂️</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleRide" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleRide" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>

<div class="container mt-5 mb-5">
    <div class="row align-items-center">
        <div class="col-sm-12 col-md-8 col-lg-8 col-xl-8">
            <h1 class="text-center title-bienvenida">BIENVENIDOS A GYMBROS</h1>
            <p class="text-justify">
                ¡Bienvenido a Gymbros, tu aliado en la búsqueda de una vida más saludable y enérgica! Ofrecemos una amplia variedad de suplementos de alta calidad para impulsar tu acondicionamiento físico y bienestar. Explora nuestros productos, obtén consejos nutricionales valiosos y descubre una rutina de 6 días para principiantes. En Gymbros, no solo vendemos suplementos, sino que también proporcionamos información y apoyo para tu toma de decisiones. Únete a nuestra comunidad y juntos construyamos un camino hacia un estilo de vida activo y saludable. ¡Bienvenido a Gymbros, donde tu salud es nuestra prioridad número uno!
            </p>
            <a href="../register.php"><button class="btn btn-primary mb-2">¡UNETE AHORA!</button></a>
        </div>
        <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
            <img src="../../Img/gym-mancuerna.jpg" alt="image" class="img-fluid">
        </div>
    </div>
</div>

<hr>

<div class="container mt-5">
    <div class="row">
        <h1 class="display-3">Nuestra Tienda</h1>
        <p class="text-justify">
            En nuestra tienda de suplementos deportivos, ofrecemos una amplia variedad de productos para ayudarte a alcanzar tus objetivos de fitness. Tenemos suplementos proteicos, quemadores de grasa, barras de proteínas y mucho más. Todos nuestros productos son de alta calidad y seleccionados por nuestro equipo de expertos en nutrición. Explora nuestra tienda en línea o en nuestro gimnasio.
        </p>
    </div>

    <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php
        require("../../Suministros/conexion.php");

        // Realiza una consulta SQL para obtener los datos de los primeros 3 productos activos
        $sql = "SELECT * FROM productos
            WHERE estado = (SELECT id FROM parametros WHERE valor = 'Activo')
            LIMIT 3";
        $resultado = $conexion->query($sql);

        while ($producto = $resultado->fetch_assoc()) :
        ?>
            <!-- Producto -->
            <div class="col">
                <div class="card mb-4" style="height: 420px;"> <!-- Ajusta los valores según tus necesidades -->
                    <img src="../../Img/<?php echo $producto['imagen']; ?>" class="card-img-top mt-2 img-fluid" style="height: 250px;" alt="<?php echo $producto['nombre']; ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $producto['nombre']; ?></h5>
                        <p class="card-text"><?php echo $producto['descripcion']; ?></p>
                        <a href="categorias.php" class="btn btn-primary form-control">Ver mas . . . <i class="fa-solid fa-cart-shopping" style="color: #ffffff;"></i></a>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.js"></script>
<script src="../../Js/alert-index.js"></script>
</body>

</html>