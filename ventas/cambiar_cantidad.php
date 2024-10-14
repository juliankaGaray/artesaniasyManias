<?php
session_start();

if (!isset($_POST["cantidad"]) || !isset($_POST["indice"])) {
    header("Location: ./vender.php?status=6"); 
    exit;
}

$cantidad = floatval($_POST["cantidad"]);
$indice = intval($_POST["indice"]);

// Asegúrar de que la cantidad es mayor que 0
if ($cantidad <= 0) {
    header("Location: ./vender.php?status=6"); 
    exit;
}

// Verifica que el índice existe en el carrito
if (!isset($_SESSION["carrito"][$indice])) {
    header("Location: ./vender.php?status=6"); 
    exit;
}


$productoCarrito = $_SESSION["carrito"][$indice];

// Consulta para obtener la existencia actual del producto
include_once "base_de_datos.php";
$sentencia = $base_de_datos->prepare("SELECT existencia FROM productos WHERE id = ? LIMIT 1;");
$sentencia->execute([$productoCarrito->id]);
$productoBD = $sentencia->fetch(PDO::FETCH_OBJ);

// Verificar si la nueva cantidad excede la existencia
if ($cantidad > $productoBD->existencia) {
    header("Location: ./vender.php?status=5"); 
    exit;
}


$_SESSION["carrito"][$indice]->cantidad = $cantidad;
$_SESSION["carrito"][$indice]->total = $cantidad * $_SESSION["carrito"][$indice]->precioVenta;


header("Location: ./vender.php");

