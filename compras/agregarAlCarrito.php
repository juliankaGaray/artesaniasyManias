<?php
if (!isset($_POST["codigo"])) {
    echo "No se recibió código";  // Agrega un mensaje para depuración
    return;
}

$codigo = $_POST["codigo"];
include_once "base_de_datos.php";
$sentencia = $base_de_datos->prepare("SELECT * FROM productos WHERE codigo = ? LIMIT 1;");
$sentencia->execute([$codigo]);
$producto = $sentencia->fetch(PDO::FETCH_OBJ);

if (!$producto) {
    echo "Producto no encontrado";  // Depuración
    header("Location: ./vender.php?status=4");
    exit;
}

if ($producto->existencia < 1) {
    echo "Producto agotado";  // Depuración
    header("Location: ./vender.php?status=5");
    exit;
}

session_start();
$indice = false;
for ($i = 0; $i < count($_SESSION["carrito"]); $i++) {
    if ($_SESSION["carrito"][$i]->codigo === $codigo) {
        $indice = $i;
        break;
    }
}

if ($indice === false) {
    $producto->cantidad = 1;
    $producto->total = $producto->precioVenta;
    array_push($_SESSION["carrito"], $producto);
} else {
    $cantidadExistente = $_SESSION["carrito"][$indice]->cantidad;
    if ($cantidadExistente + 1 > $producto->existencia) {
        header("Location: ./vender.php?status=5");
        exit;
    }
    $_SESSION["carrito"][$indice]->cantidad++;
    $_SESSION["carrito"][$indice]->total = $_SESSION["carrito"][$indice]->cantidad * $_SESSION["carrito"][$indice]->precioVenta;
}

var_dump($_SESSION["carrito"]);  // Para revisar si se está agregando el producto correctamente

header("Location: ./vender.php");
