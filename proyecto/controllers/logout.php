<?php
session_start(); // Inicia la sesión

// Debug: Mostrar contenido de la sesión antes de destruir
echo "Contenido de la sesión antes de destruir: ";
print_r($_SESSION);

if (isset($_SESSION['usuario'])) {
    session_unset(); // Libera todas las variables de sesión
    session_destroy(); // Destruye la sesión
}

// Debug: Mostrar contenido de la sesión después de destruir
echo "Contenido de la sesión después de destruir: ";
print_r($_SESSION);

// Redirige al usuario a la página de inicio o al login
header("Location: /login.php");
exit();
?>
