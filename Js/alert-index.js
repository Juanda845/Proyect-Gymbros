// Script para mostrar Sweet Alert con una imagen personalizada y borde redondeado
var buttons = document.querySelectorAll('.showSweetAlert');
buttons.forEach(function(button) {
    button.addEventListener('click', function() {
        Swal.fire({
            title: "¡TE RECUERDA QUE...!",
            text: "EL DOLOR ES MOMENTANEO PERO LA GLORIA ES ETERNA",
            imageUrl: "../../Img/logo.jpg",
            imageAlt: "Imagen personalizada con borde redondeado",
            imageWidth: 300, // Ancho de la imagen
            imageHeight: 100, // Alto de la imagen
            confirmButtonColor: "#17a2b8", // Color del botón de confirmación
            customClass: {
                image: 'border-rounded-image'
            }
        });
    });
});