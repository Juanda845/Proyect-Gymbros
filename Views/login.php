    <?php
    session_start();
    session_destroy();

    include("../Suministros/proceso_login.php");
    ?>
    <!doctype html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Inicio de sesión</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
        <link rel="stylesheet" href="../Css/Styles_login.css">
    </head>

    <body>
        <section class="vh-100 gradient-custom">
            <div class="container py-3 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                        <div class="card bg-dark text-white" style="border-radius: 1rem;">
                            <div class="card-body p-5 text-center">
                                <form action="" method="POST">
                                    <h2 class="fw-bold mb-3 text-uppercase">INICIO DE SESIÓN</h2>
                                    <a href="./Cliente/index.php"><img src="../Img/logo.jpg" alt="logo" class="image-logo mb-5"></a>
                                    <h6 class="text-white-50 mb-5">¡Por favor, introduce tu correo y contraseña!</h6>

                                    <div class="mb-4 mt-3">
                                        <input type="email" class="form-control" name="correo" id="Correo" placeholder="Correo" required>
                                    </div>

                                    <div class="mt-4 position-relative">
                                        <input type="password" class="form-control" name="contraseña" id="Contraseña" placeholder="Contraseña" required>
                                        <i class="fa fa-eye-slash password-toggle" id="togglePassword"></i>
                                    </div>
                                    <div class="mb-4 mt-2 text-center">
                                        <button type="submit" class="btn btn-outline-primary col-6 mt-5" name="logueo">INICIAR SESIÓN</button>
                                    </div>
                                    <p>¿No tienes una cuenta? <a href="./register.php" class="text-white-50 fw-bold">Registrate</a></p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.js"></script>
        <script src="../Js/eye.js"></script>


        <script>
            <?php
            if (isset($_GET['added']) && $_GET['added'] == 'true') {
                echo 'Swal.fire({
                title: "¡Éxito!",
                text: "Su cuenta ha sido creado correcta.",
                icon: "success",
                confirmButtonText: "OK"
            }).then(function() {
                // Elimina los parámetros de la URL
                var cleanUrl = window.location.href.split("?")[0];
                window.history.replaceState({}, document.title, cleanUrl);
                location.reload(); // Recarga la página
            });';
            }
            ?>
        </script>


        <?php
        if (isset($login_error)) {
            echo '<script>
                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: "' . $login_error . '"
                        });
                    </script>';
        }
        ?>

    </body>

    </html>