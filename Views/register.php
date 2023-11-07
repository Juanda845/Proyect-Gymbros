<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../Css/Styles_register.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
</head>

<body>
    <section class="vh-100 gradient-custom">
        <div class="container-fluid py-3 h-100 w-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-12 col-lg-12 col-xl-7">
                    <div class="card bg-dark text-white" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">
                            <h2 class="fw-bold mb-3">¡REGÍSTRATE AHORA!</h2>
                            <img src="../Img/logo.jpg" alt="logo" class="image-logo mb-4">
                            <form action="../Suministros/registro_usuarios.php" method="POST">
                                <div class="row">
                                    <div class="col-md-6 mb-5">
                                        <div class="form-group text-start">
                                            <label for="Nombres" class="form-label">Nombres</label>
                                            <input type="text" class="form-control" name="nombres" id="Nombres" placeholder="Nombres" value="<?php echo isset($_GET['nombres']) ? $_GET['nombres'] : ''; ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="form-group text-start">
                                            <label for="Apellidos" class="form-label">Apellidos</label>
                                            <input type="text" class="form-control" name="apellidos" id="Apellidos" placeholder="Apellidos" value="<?php echo isset($_GET['apellidos']) ? $_GET['apellidos'] : ''; ?>" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-5 mt-2">
                                        <div class="form-group text-start">
                                            <label for="Correo" class="form-label">Correo</label>
                                            <input type="email" class="form-control" name="correo" id="Correo" placeholder="Correo" value="<?php echo isset($_GET['correo']) ? $_GET['correo'] : ''; ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-5 mt-2">
                                        <div class="form-group text-start position-relative">
                                            <label for="Contraseña" class="form-label">Contraseña</label>
                                            <input type="password" class="form-control" name="contraseña" id="Contraseña" placeholder="Contraseña" required>
                                            <i class="fa fa-eye-slash password-toggle" id="togglePassword"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-5 mt-2">
                                        <div class="form-group text-start">
                                            <button type="submit" class="btn btn-outline-primary form-control">Registrarse</button>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-5 mt-2">
                                        <div class="form-group text-start position-relative">

                                            <a class="nav-link" href="./login.php"><button type="button" class="btn btn-outline-danger form-control">Cancelar</a>
                                        </div>
                                    </div>
                                </div>

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
        if (isset($_GET['error']) && $_GET['error'] === "existente") {
        ?>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Este correo ya pertenece a una cuenta.',
            });
        <?php
        }
        ?>
    </script>

    <script>
        <?php if (isset($_GET['error']) && $_GET['error'] === "contraseña_invalida") { ?>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'La contraseña debe tener al menos 8 caracteres y contener al menos una letra mayúscula, una letra minúscula y un valor númerico.',
            });
        <?php } ?>
    </script>
</body>

</html>