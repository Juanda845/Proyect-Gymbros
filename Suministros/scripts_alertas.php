<!-- SCRIPTS GENERALES -->
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="../../Js/data-table.js"></script>

<!-- SCRIPTS Y ALERTAS DE CATEGORIA -->
<script>
    <?php
    if (isset($_GET['added_categoria']) && $_GET['added_categoria'] == 'true') {
        echo 'Swal.fire({
        title: "¡Éxito!",
        text: "Categoría agregada correctamente.",
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

<script>
    <?php
    if (isset($_GET['edited_categoria']) && $_GET['edited_categoria'] == 'true') {
        echo 'Swal.fire({
        title: "¡Éxito!",
        text: "Categoría editada correctamente.",
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

<script>
    $(document).on('click', 'button.btn-desactivar-categoria', function() {
        var categoriaId = $(this).data('id');
        var isInactive = $(this).hasClass('inactivo');

        // Verificar si el registro está inactivo
        if (isInactive) {
            mostrarErrorAlerta();
        } else {
            mostrarConfirmacionAlerta(categoriaId);
        }

        function mostrarErrorAlerta() {
            Swal.fire({
                title: 'Error',
                text: 'Este registro ya está desactivado.',
                icon: 'error',
            });
        }

        function mostrarConfirmacionAlerta(categoriaId) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: '¿Quieres cambiar el estado de esta categoría?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'POST',
                        data: {
                            id: categoriaId
                        }, // Envía el ID de la categoría
                        success: function(response) {
                            mostrarRegistroDesactivadoAlerta();
                        },
                    });
                }
            });
        }

        function mostrarRegistroDesactivadoAlerta() {
            Swal.fire({
                title: '¡Éxito!',
                text: 'Registro desactivado correctamente.',
                icon: 'success',
            }).then(function() {
                location.reload(); // Recarga la página
            });
        }
    });
</script>

<!-- SCRIPT ALERTA DE PARAMETRO -->
<script>
    <?php
    if (isset($_GET['edited_parametro']) && $_GET['edited_parametro'] == 'true') {
        echo 'Swal.fire({
        title: "¡Éxito!",
        text: "Parámetro editado correctamente.",
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

<!-- SCRIPTS Y ALERTAS DE PRODUCTO -->
<script>
    <?php
    if (isset($_GET['added_producto']) && $_GET['added_producto'] == 'true') {
        echo 'Swal.fire({
            title: "¡Éxito!",
            text: "Producto agregado correctamente.",
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

<script>
    <?php
    if (isset($_GET['edited_producto']) && $_GET['edited_producto'] == 'true') {
        echo 'Swal.fire({
            title: "¡Éxito!",
            text: "Producto editado correctamente.",
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

<script>
    $(document).on('click', 'button.btn-desactivar-producto', function() {
        var productoId = $(this).data('id');
        var isInactive = $(this).hasClass('inactivo');

        // Verificar si el registro está inactivo
        if (isInactive) {
            mostrarErrorAlerta();
        } else {
            mostrarConfirmacionAlerta(productoId);
        }

        function mostrarErrorAlerta() {
            Swal.fire({
                title: 'Error',
                text: 'Este producto ya está desactivado.',
                icon: 'error',
            });
        }

        function mostrarConfirmacionAlerta(productoId) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: '¿Quieres cambiar el estado de este producto?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'POST',
                        data: {
                            id: productoId
                        }, // Envía el ID del producto
                        success: function(response) {
                            mostrarRegistroDesactivadoAlerta();
                        },
                    });
                }
            });
        }

        function mostrarRegistroDesactivadoAlerta() {
            Swal.fire({
                title: '¡Éxito!',
                text: 'Registro desactivado correctamente.',
                icon: 'success',
            }).then(function() {
                location.reload(); // Recarga la página
            });
        }
    });
</script>

<!-- SCRIPTS Y ALERTAS DE PROVEEDORES -->
<script>
    <?php
    if (isset($_GET['added_proveedores']) && $_GET['added_proveedores'] == 'true') {
        echo 'Swal.fire({
            title: "¡Éxito!",
            text: "Proveedor agregado correctamente.",
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

<script>
    <?php
    if (isset($_GET['edited_proveedores']) && $_GET['edited_proveedores'] == 'true') {
        echo 'Swal.fire({
            title: "¡Éxito!",
            text: "Proveedor editado correctamente.",
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

<script>
    $(document).on('click', 'button.btn-desactivar-proveedor', function() {
        var proveedorId = $(this).data('id');
        var isInactive = $(this).hasClass('inactivo');

        // Verificar si el registro está inactivo
        if (isInactive) {
            mostrarErrorAlerta();
        } else {
            mostrarConfirmacionAlerta(proveedorId);
        }

        function mostrarErrorAlerta() {
            Swal.fire({
                title: 'Error',
                text: 'Este registro ya está desactivado.',
                icon: 'error',
            });
        }

        function mostrarConfirmacionAlerta(proveedorId) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: '¿Quieres cambiar el estado de este proveedor?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'POST',
                        data: {
                            id: proveedorId
                        }, // Envía el ID de la proveddor
                        success: function(response) {
                            mostrarRegistroDesactivadoAlerta();
                        },
                    });
                }
            });
        }

        function mostrarRegistroDesactivadoAlerta() {
            Swal.fire({
                title: '¡Éxito!',
                text: 'Registro desactivado correctamente.',
                icon: 'success',
            }).then(function() {
                location.reload(); // Recarga la página
            });
        }
    });
</script>

<!-- SCRIPTS Y ALERTAS DE USUARIOS -->
<script>
    <?php
    if (isset($_GET['added_usuarios']) && $_GET['added_usuarios'] == 'true') {
        echo 'Swal.fire({
            title: "¡Éxito!",
            text: "Usuario agregado correctamente.",
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

<script>
    <?php
    if (isset($_GET['edited_usuarios']) && $_GET['edited_usuarios'] == 'true') {
        echo 'Swal.fire({
            title: "¡Éxito!",
            text: "Usuario editado correctamente.",
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

<script>
    $(document).on('click', 'button.btn-desactivar-usuarios', function() {
        var usuariosId = $(this).data('id');
        var isInactive = $(this).hasClass('inactivo');

        // Verificar si el registro está inactivo
        if (isInactive) {
            mostrarErrorAlerta();
        } else {
            mostrarConfirmacionAlerta(usuariosId);
        }

        function mostrarErrorAlerta() {
            Swal.fire({
                title: 'Error',
                text: 'Este registro ya está desactivado.',
                icon: 'error',
            });
        }

        function mostrarConfirmacionAlerta(usuariosId) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: '¿Quieres cambiar el estado de este usuario?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'POST',
                        data: {
                            id: usuariosId
                        }, // Envía el ID del usuario
                        success: function(response) {
                            mostrarRegistroDesactivadoAlerta();
                        },
                    });
                }
            });
        }

        function mostrarRegistroDesactivadoAlerta() {
            Swal.fire({
                title: '¡Éxito!',
                text: 'Registro desactivado correctamente.',
                icon: 'success',
            }).then(function() {
                location.reload(); // Recarga la página
            });
        }
    });
</script>

</body>

</html>