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
    
    // Definir las rutas absolutas para las carpetas de destino
    $directorioVentas = __DIR__ . '/uploads/'; // Ruta absoluta para ventas
    $directorioCompras = __DIR__ . '/../compras/uploads/'; // Ruta absoluta para compras

    // Verifica si la carpeta de compras existe, si no, crea la carpeta
    if (!is_dir($directorioCompras)) {
        mkdir($directorioCompras, 0755, true);
    }

    // Verifica si la carpeta de ventas existe, si no, crea la carpeta
    if (!is_dir($directorioVentas)) {
        mkdir($directorioVentas, 0755, true);
    }

    // Mover el archivo subido a la carpeta de ventas
    if (move_uploaded_file($_FILES['imagen']['tmp_name'], $directorioVentas . $nombreArchivo)) {
        // Ahora movemos el archivo a la carpeta de compras
        if (copy($directorioVentas . $nombreArchivo, $directorioCompras . $nombreArchivo)) {
            // Preparar la consulta SQL para insertar el nuevo producto
            $sentencia = $base_de_datos->prepare("INSERT INTO productos (codigo, descripcion, precioCompra, precioVenta, existencia, imagen) VALUES (?, ?, ?, ?, ?, ?)");
            $rutaImagen = '/uploads/' . $nombreArchivo; // Ruta relativa para guardar en la base de datos
            $sentencia->execute([$codigo, $descripcion, $precioCompra, $precioVenta, $existencia, $rutaImagen]);

            echo "Producto agregado exitosamente.";
        } else {
            echo "Error al copiar la imagen a la carpeta de compras.";
        }
    } else {
        echo "Error al subir la imagen.";
    }
}
include('pie.php');
?>
