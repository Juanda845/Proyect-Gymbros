<?php
session_start();
session_regenerate_id(true);
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?php
        // Obtén la parte de la URL después del último '/'
        $currentPage = basename($_SERVER['PHP_SELF']);

        // Define un array asociativo con títulos para cada página
        $pageTitles = array(
            'index.php' => 'GYMBROS',
            'categorias.php' => 'Categorías',
            'carrito.php' => 'Carrito de Compras',
            // Agrega más páginas según sea necesario
        );

        // Establece el título de la página actual
        echo isset($pageTitles[$currentPage]) ? $pageTitles[$currentPage] : 'GYMBROS';
        ?>
    </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="../../Css/Styles_index.css">
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark p-1">
        <?php
        if (isset($_SESSION['id_usuario']) && $_SESSION['id_usuario'] !== null) {
            echo '<a class="navbar-brand" href="index.php">';
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
                <li class="nav-item <?php echo $currentPage == 'categorias.php' ? 'active' : ''; ?>">
                    <a class="nav-link mt-2" href="categorias.php">
                        <div class="nav-item-content">
                            <i class="fa-solid fa-dumbbell fa-xl" style="color: #ffffff;"></i>
                            <span>PRODUCTOS</span>
                        </div>
                    </a>
                </li>
                <li class="nav-item <?php echo $currentPage == 'perfil.php' ? 'active' : ''; ?>">
                    <a class="nav-link mt-2" href="perfil.php">
                        <div class="nav-item-content">
                            <i class="fa-solid fa-circle-user fa-xl" style="color: #ffffff;"></i>
                            <span>PERFIL</span>
                        </div>
                    </a>
                </li>
                <li class="nav-item <?php echo $currentPage == 'carrito.php' ? 'active' : ''; ?>">
                    <a class="nav-link mt-2" href="carrito.php">
                        <div class="nav-item-content">
                            <i class="fa-solid fa-cart-shopping fa-xl" style="color: #ffffff;"></i>
                            <span>CARRITO</span>
                        </div>
                    </a>
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