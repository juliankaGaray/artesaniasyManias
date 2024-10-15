<?php
include_once "base_de_datos.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $codigo = $_POST['codigo'];
    $descripcion = $_POST['descripcion'];
    $precioVenta = $_POST['precioVenta'];
    $precioCompra = $_POST['precioCompra'];
    $existencia = $_POST['existencia'];

    // Manejo de la imagen
    $imagen = null;

    // Obtener la imagen existente antes de cualquier actualización
    $sentencia = $base_de_datos->prepare("SELECT imagen FROM productos WHERE id = ?;");
    $sentencia->execute([$id]);
    $producto = $sentencia->fetch(PDO::FETCH_OBJ);
    
    // Almacena la imagen existente
    if ($producto) {
        $imagen = $producto->imagen;
    }

    // Verificar si se ha subido un nuevo archivo de imagen
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == UPLOAD_ERR_OK) {
        // Procesar la imagen
        $rutaImagen = 'uploads/'; // Ruta relativa para almacenar en la BD y acceder a la imagen
        $directorioAbsoluto = __DIR__ . '/' . $rutaImagen; // Ruta completa del servidor

        // Verifica si la carpeta 'uploads' existe, si no, crea la carpeta
        if (!is_dir($directorioAbsoluto)) {
            mkdir($directorioAbsoluto, 0777, true); // Crear la carpeta con permisos
        }

        $nombreImagen = basename($_FILES['imagen']['name']);
        $rutaDestino = $directorioAbsoluto . $nombreImagen;

        // Mueve el archivo a la carpeta de uploads
        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaDestino)) {
            $imagen = $rutaImagen . $nombreImagen; // Almacena la ruta relativa en la BD
        } else {
            // Manejar error en la carga de la imagen
            echo "Error al subir la imagen.";
            exit(); // Termina el script si no se puede subir la imagen
        }
    }

    // Actualiza el producto en la base de datos, usa la imagen nueva o la existente
    $sentencia = $base_de_datos->prepare("UPDATE productos SET codigo = ?, descripcion = ?, precioVenta = ?, precioCompra = ?, existencia = ?, imagen = ? WHERE id = ?;");
    $resultado = $sentencia->execute([$codigo, $descripcion, $precioVenta, $precioCompra, $existencia, $imagen, $id]);

    if ($resultado) {
        header("Location: listar.php"); // Redirigir después de guardar
        exit(); // Asegúrate de terminar el script después de redirigir
    } else {
        echo "Error al guardar los datos: " . implode(", ", $sentencia->errorInfo());
    }
}
?>
