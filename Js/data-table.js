$(document).ready(function() {
    $('#table_responsive').DataTable({
        "responsive": true, // Habilitar el modo responsive
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json" // Establecer el idioma a español
        }
    });
});