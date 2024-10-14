<?php
// Incluir el archivo de conexión
include('connection.php');
$conn = conexion();

// Verifica si se ha enviado un ID a eliminar
if (isset($_POST['id'])) {
    $usuario_id = $_POST['id'];

    // Eliminar registros relacionados en la tabla registro
    $deleteRegistro = $conn->prepare("DELETE FROM registro WHERE usuarios_id = ?");
    $deleteRegistro->bind_param('i', $usuario_id); // 'i' indica que el parámetro es un entero
    $deleteRegistro->execute();

    // Ahora eliminar el usuario de la tabla usuarios
    $deleteUsuario = $conn->prepare("DELETE FROM usuarios WHERE ID = ?");
    $deleteUsuario->bind_param('i', $usuario_id);
    $deleteUsuario->execute();

    // Verifica si se eliminaron filas
    if ($deleteRegistro->affected_rows > 0 || $deleteUsuario->affected_rows > 0) {
        $mensaje = "Usuario eliminado correctamente.";
        $tipo_mensaje = "success"; // Estilo para mensaje de éxito
    } else {
        $mensaje = "No se pudo eliminar el usuario o no se encontró.";
        $tipo_mensaje = "danger"; // Estilo para mensaje de error
    }
} else {
    $mensaje = "No se ha especificado un ID de usuario.";
    $tipo_mensaje = "warning"; // Estilo para mensaje de advertencia
}

// HTML para mostrar el mensaje
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado de Eliminación</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="alert alert-<?php echo $tipo_mensaje; ?>" role="alert">
            <?php echo $mensaje; ?>
        </div>
        <a href="/proyecto/usuarios.php" class="btn btn-primary">Regresar a Usuarios</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
