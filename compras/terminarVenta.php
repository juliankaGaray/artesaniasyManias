<?php
if (!isset($_POST["total"])) exit;

session_start();

$total = $_POST["total"];
include_once "base_de_datos.php";

$ahora = date("Y-m-d H:i:s");

// Insertar la venta en la tabla "ventas"
$sentencia = $base_de_datos->prepare("INSERT INTO ventas(fecha, total) VALUES (?, ?);");
$sentencia->execute([$ahora, $total]);

// Obtener el ID de la venta recién creada
$sentencia = $base_de_datos->prepare("SELECT id FROM ventas ORDER BY id DESC LIMIT 1;");
$sentencia->execute();
$resultado = $sentencia->fetch(PDO::FETCH_OBJ);

$idVenta = $resultado === false ? 1 : $resultado->id;

// Iniciar transacción para insertar productos y actualizar existencias
$base_de_datos->beginTransaction();
$sentenciaProductosVendidos = $base_de_datos->prepare("INSERT INTO productos_vendidos(id_producto, id_venta, cantidad) VALUES (?, ?, ?);");
$sentenciaExistencia = $base_de_datos->prepare("UPDATE productos SET existencia = existencia - ? WHERE id = ?;");

foreach ($_SESSION["carrito"] as $producto) {
    // Sumar el total de los productos en la venta
    $subtotal = $producto->precioVenta * $producto->cantidad;
    $total += $subtotal; // Si necesitas calcular el total aquí, pero este valor ya debería estar en la consulta de la venta
    $sentenciaProductosVendidos->execute([$producto->id, $idVenta, $producto->cantidad]);
    $sentenciaExistencia->execute([$producto->cantidad, $producto->id]);
}

$base_de_datos->commit();

// Limpiar el carrito
unset($_SESSION["carrito"]);
$_SESSION["carrito"] = [];

// Redirigir al usuario con el estado de la venta
header("Location: ./vender.php?status=1&id=" . $idVenta); // Pasar el ID de la venta para imprimir el ticket
?>
