<?php 
session_start(); // Iniciar la sesión
include('header.php'); 
include_once "ventas/base_de_datos.php";

// Verificar que haya productos en el carrito
if (!isset($_SESSION['carrito']) || empty($_SESSION['carrito'])) {
    echo "<h2>No hay productos en el carrito para procesar la venta.</h2>";
    exit;
}

// Obtener el total de la venta
$totalVenta = $_POST['total'];

// Comenzar la transacción
try {
    $base_de_datos->beginTransaction();

    // Insertar la venta en la tabla de ventas
    $sentencia = $base_de_datos->prepare("INSERT INTO ventas (total) VALUES (:total)");
    $sentencia->execute([':total' => $totalVenta]);
    $idVenta = $base_de_datos->lastInsertId(); // Obtener el ID de la venta

    // Insertar cada producto en la tabla de detalles de la venta
    foreach ($_SESSION['carrito'] as $item) {
        $sentenciaDetalle = $base_de_datos->prepare("INSERT INTO detalles_venta (venta_id, producto_id, cantidad, precio) VALUES (:venta_id, :producto_id, :cantidad, :precio)");
        $sentenciaDetalle->execute([
            ':venta_id' => $idVenta,
            ':producto_id' => $item['id'],
            ':cantidad' => $item['cantidad'],
            ':precio' => $item['precio'],
        ]);

        // Actualizar el inventario
        $sentenciaInventario = $base_de_datos->prepare("UPDATE productos SET stock = stock - :cantidad WHERE id = :id");
        $sentenciaInventario->execute([
            ':cantidad' => $item['cantidad'],
            ':id' => $item['id'],
        ]);
    }

    // Confirmar la transacción
    $base_de_datos->commit();

    // Vaciar el carrito
    unset($_SESSION['carrito']);

    // Mostrar un mensaje de éxito
    echo "<h2>La venta se ha procesado con éxito. Total: $" . number_format($totalVenta, 2) . "</h2>";

} catch (Exception $e) {
    // Revertir los cambios en caso de error
    $base_de_datos->rollBack();
    echo "<h2>Error al procesar la venta: " . $e->getMessage() . "</h2>";
}

include('footer.php'); 
?>
