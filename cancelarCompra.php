<?php
session_start();

// Vaciar el carrito
unset($_SESSION['carrito']);

// Redirigir de nuevo al carrito
header("Location: carrito.php");
exit;
?>
