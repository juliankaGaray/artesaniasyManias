<?php
// Incluir el archivo de conexión
include('connection.php');
$conn = conexion();

// Verificar si se ha enviado el ID del usuario
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Consultar datos del usuario
    $stmt_usuario = $conn->prepare("SELECT * FROM usuarios WHERE ID = ?");
    $stmt_usuario->bind_param("i", $id);
    $stmt_usuario->execute();
    $resultado_usuario = $stmt_usuario->get_result();

    // Consultar datos del registro (asegurarte de que la clave foránea esté bien)
    $stmt_registro = $conn->prepare("SELECT * FROM registro WHERE usuarios_id = ?");
    $stmt_registro->bind_param("i", $id);
    $stmt_registro->execute();
    $resultado_registro = $stmt_registro->get_result();

    // Consultar todos los roles
    $stmt_roles = $conn->prepare("SELECT * FROM roles");
    $stmt_roles->execute();
    $resultado_roles = $stmt_roles->get_result();

    // Verificar si se encontró el usuario y registro
    if ($resultado_usuario->num_rows == 1 && $resultado_registro->num_rows == 1) {
        $usuario = $resultado_usuario->fetch_assoc();
        $registro = $resultado_registro->fetch_assoc();
    } else {
        die("Usuario o registro no encontrado.");
    }
} else {
    die("ID de usuario no proporcionado.");
}

// Actualizar los datos del usuario si se envía el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $edad = $_POST['edad'];
    $ciudad = $_POST['ciudad'];
    $celular = $_POST['celular'];
    $usuario_nombre = $_POST['usuario'];
    $password = $_POST['password'];
    $rol_id = $_POST['rol']; // Obtener el rol del formulario

    // Uso de consultas preparadas para evitar inyecciones SQL
    $stmt_usuario = $conn->prepare("UPDATE usuarios SET usuario = ?, pass = ?, rol_id = ? WHERE ID = ?");
    $stmt_usuario->bind_param("ssii", $usuario_nombre, $password, $rol_id, $id); // Agregar rol_id a los parámetros

    if ($stmt_usuario->execute()) {
        // Actualizar los datos en la tabla registro
        $stmt_registro = $conn->prepare("UPDATE registro SET nombre = ?, apellido = ?, edad = ?, ciudad = ?, celular = ? WHERE usuarios_id = ?");
        $stmt_registro->bind_param("ssissi", $nombre, $apellido, $edad, $ciudad, $celular, $id);

        if ($stmt_registro->execute()) {
            header("Location: ../usuarios.php"); // Redirigir después de actualizar
            exit();
        } else {
            echo "<div class='alert alert-danger'>Error al actualizar datos en registro: " . $stmt_registro->error . "</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Error al actualizar usuario: " . $stmt_usuario->error . "</div>";
    }

    // Cerrar los statements
    $stmt_usuario->close();
    $stmt_registro->close();
    $stmt_roles->close(); // Cerrar también el statement de roles
}

// Cerrar la conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Editar Usuario</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $registro['nombre']; ?>" required>
            </div>
            <div class="form-group">
                <label for="apellido">Apellido:</label>
                <input type="text" class="form-control" id="apellido" name="apellido" value="<?php echo $registro['apellido']; ?>" required>
            </div>
            <div class="form-group">
                <label for="edad">Edad:</label>
                <input type="number" class="form-control" id="edad" name="edad" value="<?php echo $registro['edad']; ?>" required>
            </div>
            <div class="form-group">
                <label for="ciudad">Ciudad:</label>
                <input type="text" class="form-control" id="ciudad" name="ciudad" value="<?php echo $registro['ciudad']; ?>" required>
            </div>
            <div class="form-group">
                <label for="celular">Celular:</label>
                <input type="text" class="form-control" id="celular" name="celular" value="<?php echo $registro['celular']; ?>" required>
            </div>
            <div class="form-group">
                <label for="usuario">Usuario:</label>
                <input type="text" class="form-control" id="usuario" name="usuario" value="<?php echo $usuario['usuario']; ?>" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" class="form-control" id="password" name="password" value="<?php echo $usuario['pass']; ?>" required>
            </div>
            <div class="form-group">
                <label for="rol">Rol:</label>
                <select class="form-control" id="rol" name="rol" required>
                    <?php while ($rol = $resultado_roles->fetch_assoc()) : ?>
                        <option value="<?php echo $rol['id']; ?>" <?php echo ($rol['id'] == $usuario['rol_id']) ? 'selected' : ''; ?>>
                            <?php echo $rol['nombre']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            <a type="button" class="btn btn-info" href="/proyecto/usuarios.php">Volver</a>
        </form>
    </div>
</body>
</html>
