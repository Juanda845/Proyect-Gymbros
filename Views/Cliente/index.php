<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GYMBROS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="../../Css/Styles_index.css">
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark p-1">
        <?php
        session_start();
        if (isset($_SESSION['id_usuario']) && $_SESSION['id_usuario'] !== null) {
            echo '<a class="navbar-brand" href="#">';
        } else {
            echo '<a class="navbar-brand" href="../login.php">';
        }
        ?>
        <img src="../../Img/logo.jpg" width="160" height="50">
        </a>
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
                <li class="nav-item">
                    <a class="nav-link mt-2" href="carrito.php"><i class="fa-solid fa-cart-shopping fa-xl" style="color: #ffffff;"></i> CARRITO</a>
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

    <div class="container my-3">
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


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.js"></script>
    <script src="../../Js/alert-index.js"></script>
</body>

</html>