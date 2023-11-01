<?php
session_start();

// Destruir la sesión
session_destroy();

// Redirigir al usuario a una página de inicio o a cualquier otra página
header("location:../Views/login.php");
exit;
