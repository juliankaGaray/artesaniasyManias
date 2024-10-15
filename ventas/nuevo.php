<?php
include_once "base_de_datos.php"; // Asegúrate de incluir tu archivo de conexión
include('encabezado.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener datos del formulario
    $codigo = $_POST['codigo'];
    $descripcion = $_POST['descripcion'];
    $precioVenta = $_POST['precioVenta'];
    $precioCompra = $_POST['precioCompra'];
    $existencia = $_POST['existencia'];

    // Manejar la subida de imagen
    $nombreArchivo = $_FILES['imagen']['name'];
    $rutaDestino = 'uploads/' . $nombreArchivo; // Ruta relativa

    // Mover el archivo subido a la carpeta deseada
    if (move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaDestino)) {
        // Preparar la consulta SQL para insertar el nuevo producto
        $sentencia = $base_de_datos->prepare("INSERT INTO productos (codigo, descripcion, precioCompra, precioVenta, existencia, imagen) VALUES (?, ?, ?, ?, ?, ?)");
        $sentencia->execute([$codigo, $descripcion, $precioCompra, $precioVenta, $existencia, $rutaDestino]);

        echo "Producto agregado exitosamente.";
    } else {
        echo "Error al subir la imagen.";
    }
}
include('pie.php');
?>
