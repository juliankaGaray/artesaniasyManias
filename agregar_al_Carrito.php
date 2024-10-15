<?php 
session_start(); // Iniciar la sesión

if (!isset($_POST['id'], $_POST['cantidad'])) {
    exit('Error: Datos no válidos');
}

// Obtener datos del producto
$id = $_POST['id'];
$cantidad = $_POST['cantidad'];

// Simular que obtienes el producto de la base de datos
// Debes implementar aquí la lógica para obtener el producto real
$producto = [
    'id' => $id,
    'descripcion' => $_POST['descripcion'],
    'precio' => $_POST['precio'],
    'imagen' => $_POST['imagen'],
];

// Verificar si el producto ya está en el carrito
$productoExistente = false;
foreach ($_SESSION['carrito'] as &$item) {
    if ($item['id'] === $id) {
        $item['cantidad'] += $cantidad; // Incrementar la cantidad
        $productoExistente = true;
        break;
    }
}

// Si no existe, agregar el producto al carrito
if (!$productoExistente) {
    $producto['cantidad'] = $cantidad; // Agregar cantidad al nuevo producto
    $_SESSION['carrito'][] = $producto;
}

// Redirigir de vuelta al carrito
header("Location: carrito.php");
exit;
?>
