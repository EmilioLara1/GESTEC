<?php 
    session_start();
    session_unset();
    session_destroy(); // Cierra la sesión
    header('Location: index-usuario.html'); // Redirige al usuario a la página de inicio
    exit();
?>