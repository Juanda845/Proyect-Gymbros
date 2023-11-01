<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GYMBROS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand p-2" href="../login.php"><img src="../../Img/logo.jpg" width="160" height="50"></a>
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
        <form class="form-inline d-flex gap-4">
            <button class="btn btn-outline-success my-2 my-sm-0" id="searchButton" type="button">Buscar</button>
            <input class="form-control mr-sm-2" type="search" id="searchInput" placeholder="Buscar producto" aria-label="Search">
        </form>
    </nav>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>