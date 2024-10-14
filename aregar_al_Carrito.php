<?php 
session_start(); // Iniciar la sesión
include_once "ventas/base_de_datos.php"; // Asegúrate de que esta ruta sea correcta

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $imagen = $_POST['imagen'];

    // Verificar si el producto ya está en el carrito
    $productoExistente = false;
    foreach ($_SESSION['carrito'] as $item) {
        if ($item['id'] == $id) {
            $productoExistente = true;
            break;
        }
    }

    // Si el producto no está en el carrito, lo agregamos
    if (!$productoExistente) {
        $_SESSION['carrito'][] = [
            'id' => $id,
            'descripcion' => $descripcion,
            'precio' => $precio,
            'imagen' => $imagen
        ];
    }

    // Redirigir de nuevo a la página de productos
    header("Location: carrito.php"); // Cambia a la ruta correcta de tu carrito
    exit();
}
?>
