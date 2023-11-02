// Obtener el carrito desde el almacenamiento local
let carrito = JSON.parse(localStorage.getItem('carrito')) || [];

// Función para agregar productos al carrito desde la página de listado
function agregarAlCarrito(nombreProducto, precioProducto, imagenProducto, descripcionProducto) {
    Swal.fire({
        title: 'Agregar al Carrito',
        html:
            '<label for="cantidad">Cantidad:</label>' +
            '<input type="number" id="cantidad" class="swal2-input" value="1" min="1" max="50">',
        showCancelButton: true,
        confirmButtonText: 'Agregar al Carrito',
        cancelButtonText: 'Cancelar',
        focusConfirm: false,
        allowOutsideClick: false,
        allowEscapeKey: false,
        preConfirm: () => {
            // Obtener la cantidad seleccionada por el usuario
            let cantidad = parseInt(document.getElementById('cantidad').value);

            // Validar que la cantidad sea mayor o igual a 1 y no exceda las 50 unidades
            if (cantidad >= 1 && cantidad <= 50) {
                // Buscar si el producto ya existe en el carrito
                const productoExistente = carrito.find((producto) => producto.nombre === nombreProducto);

                if (productoExistente) {
                    // Si el producto ya existe, incrementa la cantidad en lugar de agregarlo de nuevo
                    productoExistente.cantidad += cantidad;
                } else {
                    // Si el producto no existe, agrégalo al carrito con la cantidad seleccionada
                    const producto = {
                        nombre: nombreProducto,
                        precio: precioProducto,
                        cantidad: cantidad,
                        imagen: imagenProducto,
                        descripcion: descripcionProducto
                    };
                    carrito.push(producto);
                }
                
                // Actualizar el carrito en el almacenamiento local
                localStorage.setItem('carrito', JSON.stringify(carrito));

                // Mostrar un mensaje de confirmación y dar opción de ir al carrito o seguir comprando
                Swal.fire({
                    title: 'Producto agregado al carrito',
                    text: '¿Qué deseas hacer?',
                    icon: 'success',
                    showCancelButton: true,
                    confirmButtonText: 'Ir al Carrito',
                    cancelButtonText: 'Seguir Comprando',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Redirigir al usuario a la página de carrito
                        window.location.href = '../Cliente/carrito.php';
                    }
                });
            } else {
                // Mostrar un mensaje de error si la cantidad no es válida
                Swal.showValidationMessage('La cantidad debe ser mayor o igual a 1 y no exceder las 50 unidades.');
            }
        }
    });
}