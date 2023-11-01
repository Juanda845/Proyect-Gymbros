$(document).ready(function() {
    $('#togglePassword').on('click', function() {
        const passwordField = $('#Contraseña');
        const passwordToggle = $(this);

        const passwordFieldType = passwordField.attr('type');
        if (passwordFieldType === 'password') {
            passwordField.attr('type', 'text');
            passwordToggle.removeClass('fa-eye-slash').addClass('fa-eye');
        } else {
            passwordField.attr('type', 'password');
            passwordToggle.removeClass('fa-eye').addClass('fa-eye-slash');
        }
    });
});