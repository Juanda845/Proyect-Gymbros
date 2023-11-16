// SCRIPT PARA EL ALMACENAMIENTO DEL CARRITO

// Obtener el carrito desde el almacenamiento local
let carrito = JSON.parse(localStorage.getItem('carrito')) || [];

// Función para mostrar el carrito en la página de carrito
function mostrarCarrito() {
    const carritoContainer = document.getElementById('carrito');
    carritoContainer.innerHTML = ''; // Limpiar el contenido anterior

    // Calcular el precio total
    let precioTotal = 0;

    // Actualizar el número de productos en el título
    const numProductos = carrito.length;
    const tituloCarrito = document.querySelector('.card-title-2 span');
    tituloCarrito.textContent = numProductos;

    // Función para formatear un número como moneda colombiana (COP)
    function formatCurrency(number) {
        const formatter = new Intl.NumberFormat('es-CO', {
            style: 'currency',
            currency: 'COP',
        });
        return formatter.format(number);
    }

    // Generar la estructura del carrito
    carrito.forEach((producto) => {
        const cantidad = producto.cantidad;

        const productoHTML = `
        <!-- Fila del producto -->
        <div class="card border border-dark-subtle shadow-0 mt-3">
            <div class="m-4">
                <!-- Imagen y detalles del producto -->
                <div class="row gy-3">
                    <div class="col-lg-5">
                        <div class="me-lg-5">
                            <div class="d-flex">
                                <!-- Agrega la imagen del producto aquí -->
                                <img src="../../Img/${producto.imagen}" class="img-product img-fluid border rounded me-3" alt="${producto.nombre}" />
                                <div class="info-products">
                                    <a href="#" class="nav-link">${producto.nombre}</a>
                                    <p class="text-muted">${producto.descripcion}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Columna de cantidad y precio -->
                    <div class="col-lg-2 col-sm-6 col-6 d-flex flex-row flex-lg-column flex-xl-row text-nowrap">
                        <div class="">
                            <input type="number" max="50" min="1" class="input-calculo form-control me-4" value="${cantidad}" onchange="actualizarCantidad('${producto.nombre}', this.value)">
                        </div>
                        <div class="">
                            <text class="h6">${formatCurrency(producto.precio * cantidad)}</text> <br />
                            <small class="text-muted text-nowrap">${formatCurrency(producto.precio)}/por artículo</small>
                        </div>
                    </div>
                    <!-- Columna de botón de eliminación -->
                    <div class="col-lg col-sm-6 col-12">
                        <div class="float-md-end mt-2">
                            <button type="button" class="btn btn-danger border icon-hover-danger w-100" onclick="eliminarProducto('${producto.nombre}')"><i class="fa-solid fa-trash"></i> Eliminar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr /> <!-- Línea separadora entre productos -->
    `;

        carritoContainer.innerHTML += productoHTML;

        // Actualizar el precio total
        precioTotal += producto.precio * cantidad;
    });

    // Actualizar el precio total en el elemento correspondiente
    const precioTotalElement = document.getElementById('precioTotal');
    precioTotalElement.textContent = formatCurrency(precioTotal);
}

// Función para eliminar un producto del carrito por nombre
function eliminarProducto(nombreProducto) {
    // Filtrar el carrito para excluir el producto a eliminar
    carrito = carrito.filter((producto) => producto.nombre !== nombreProducto);

    // Actualizar el carrito en el almacenamiento local
    localStorage.setItem('carrito', JSON.stringify(carrito));

    // Llamar a la función para mostrar el carrito actualizado
    mostrarCarrito();
}

// Función para actualizar la cantidad de un producto en el carrito
function actualizarCantidad(nombreProducto, nuevaCantidad) {
    nuevaCantidad = parseInt(nuevaCantidad);

    // Si el campo está vacío o no es un número, establecerlo como 0
    if (isNaN(nuevaCantidad) || nuevaCantidad <= 0) {
        nuevaCantidad = 1;
    } else if (nuevaCantidad > 50) {
        // Si es mayor a 50, establecerlo como 50
        nuevaCantidad = 50;
    }

    // Buscar el producto en el carrito y actualizar la cantidad
    const producto = carrito.find((p) => p.nombre === nombreProducto);
    if (producto) {
        producto.cantidad = nuevaCantidad;

        // Actualizar el carrito en el almacenamiento local
        localStorage.setItem('carrito', JSON.stringify(carrito));

        // Llamar a la función para mostrar el carrito actualizado
        mostrarCarrito();
    }
}

// Llamar a la función para mostrar el carrito cuando se cargue la página
mostrarCarrito();


// SCRIPT PARA LAS ALERTAS DEL SELECT

// Esperar a que el contenido del DOM esté completamente cargado
document.addEventListener('DOMContentLoaded', () => {
    const selectPayment = document.querySelector('.select-payment');
    const realizarCompraBtn = document.getElementById('showAlertBtn-payment');

    // Función para mostrar un mensaje emergente
    function showMessage(message) {
        Swal.fire({
            icon: 'error',
            title: '¡ATENCIÓN!',
            text: message,
            confirmButtonText: 'OK',
            allowOutsideClick: false, // No permitir cerrar la alerta haciendo clic afuera
            allowEscapeKey: false, // No permitir cerrar la alerta presionando la tecla Esc
        });
    }

    // Función para mostrar un mensaje de éxito y redirigir a index.php
    function showSuccessMessage() {
        Swal.fire({
            icon: 'success',
            title: 'COMPRA REALIZADA',
            text: 'Su pedido será entregado pronto.',
            confirmButtonText: 'OK',
            allowOutsideClick: false,
            allowEscapeKey: false,
        }).then(() => {
            // Redirigir a index.php después de mostrar el mensaje de éxito
            window.location.href = 'index.php';

            // Limpiar el carrito en el almacenamiento local
            localStorage.removeItem('carrito');
        });
    }

    // Función para verificar si el carrito está vacío
    function isCarritoVacio() {
        // Obtener el carrito desde el almacenamiento local
        const carrito = JSON.parse(localStorage.getItem('carrito')) || [];
        return carrito.length === 0;
    }

    // Habilitar/deshabilitar el botón y cambiar el estilo según el método de pago seleccionado
    selectPayment.addEventListener('change', () => {
        if (selectPayment.value !== '0') { // Si se selecciona cualquier método de pago
            // Habilitar el botón y quitar el estilo
            realizarCompraBtn.disabled = false;
            realizarCompraBtn.style.cssText = '';
        } else {
            // Deshabilitar el botón y aplicar el estilo
            realizarCompraBtn.disabled = true;
        }
    });

    // Mostrar SweetAlert cuando se hace clic en el botón "Realizar compra"
    realizarCompraBtn.addEventListener('click', () => {
        if (isCarritoVacio()) {
            showMessage('Tu carrito está vacío. Agrega productos antes de realizar la compra.');
            return; // Evitar continuar con la ejecución si el carrito está vacío
        }

        // Resto de tu lógica para manejar los métodos de pago aquí
        if (selectPayment.value === '1') { // PAGO CONTRA ENTREGA
            // Mostrar un mensaje de confirmación
            Swal.fire({
                icon: 'question',
                title: '¡PAGO CONTRA ENTREGA!',
                text: '¿Seguro que quieres realizar esta compra?',
                showCancelButton: true,
                confirmButtonText: 'Sí, confirmar',
                cancelButtonText: 'Cancelar',
                allowOutsideClick: false, // No permitir cerrar la alerta haciendo clic afuera
                allowEscapeKey: false, // No permitir cerrar la alerta presionando la tecla Esc
            }).then((result) => {
                if (result.isConfirmed) {
                    // Simular una compra exitosa
                    setTimeout(() => {
                        showSuccessMessage();
                    }, 1000); // Aquí puedes ajustar el tiempo de espera antes de mostrar la alerta de éxito
                }
            });
        } else if (selectPayment.value === '2') { // PASO PSE
            // Mostrar la alerta de información personalizada
            const infoAlert = Swal.fire({
                icon: 'info',
                title: '¡ATENCIÓN USUARIOS!',
                text: 'Próximamente incluiremos nuestra pasarela de pagos. Atentamente: 11-2 / GYMBROS',
                confirmButtonText: 'OK',
                allowOutsideClick: false, // Permitir cerrar la alerta haciendo clic afuera
                allowEscapeKey: false, // Permitir cerrar la alerta presionando la tecla Esc
            });

            infoAlert.then((result) => {
                if (result.isConfirmed) {
                    // El usuario hizo clic en el botón "OK", puedes realizar acciones adicionales aquí si es necesario
                }
            });
        } else {
            // Mostrar la alerta para el método de pago no seleccionado
            showMessage('Por favor, seleccione un método de pago para continuar.');
        }
    });
});