<?php include('header.php') ?>

<?php
// Código de conexión a la base de datos
$host = "localhost";
$usuario = "root";
$password = "";
$base_de_datos = "calse_4"; 

$conexion = new mysqli($host, $usuario, $password, $base_de_datos);

// Verificar la conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Mensaje de error por campos vacíos o éxito
$error = "";
$exito = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validación de campos del formulario
    if (empty($_POST["nombre"]) || empty($_POST["apellido"]) || empty($_POST["edad"]) || empty($_POST["ciudad"]) || empty($_POST["celular"]) || empty($_POST["usuario"]) || empty($_POST["password"]) || empty($_POST["rol"])) {
        $error = "Todos los campos son obligatorios.";
    } else {
        // Obtener los datos del formulario
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $edad = (int)$_POST["edad"];
        $ciudad = $_POST["ciudad"];
        $celular = (int)$_POST["celular"];
        $usuario = $_POST["usuario"];
        $rol = $_POST["rol"];
        $password = $_POST["password"];
        
        // 1. Inserta primero en la tabla `usuarios`
        $sql_usuario = "INSERT INTO usuarios (usuario, pass, rol_id) VALUES (?, ?, ?)";
        $stmt_usuario = $conexion->prepare($sql_usuario);
        
        // Obtén el ID del rol basado en el nombre del rol ingresado
        $sql_rol_id = "SELECT id FROM roles WHERE nombre = ?";
        $stmt_rol_id = $conexion->prepare($sql_rol_id);
        $stmt_rol_id->bind_param("s", $rol);
        $stmt_rol_id->execute();
        $stmt_rol_id->store_result();
        
        // Verifica si el rol existe
        if ($stmt_rol_id->num_rows > 0) {
            $stmt_rol_id->bind_result($rol_id);
            $stmt_rol_id->fetch();
            
            // Ahora inserta el usuario con el rol encontrado
            if ($stmt_usuario) {
                $stmt_usuario->bind_param("ssi", $usuario, $password, $rol_id);
                
                if ($stmt_usuario->execute()) {
                    $exito = "Registro insertado con éxito.";
                } else {
                    $error = "Error al insertar en usuarios: " . $stmt_usuario->error;
                }
                
                // Cerrar la sentencia preparada de usuario
                $stmt_usuario->close();
            } else {
                $error = "Error al preparar la consulta de usuarios: " . $conexion->error;
            }
        } else {
            $error = "El rol especificado no existe.";
        }
        
        // Cerrar la sentencia preparada de rol_id
        $stmt_rol_id->close();
    }
}

// Cerrar la conexión
$conexion->close();
?>

<!-- Mostrar mensajes -->
<div class="container mt-3">
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php elseif (!empty($exito)): ?>
        <div class="alert alert-success"><?php echo $exito; ?></div>
    <?php endif; ?>
</div>

<!-- Formulario de registro -->
<form class="container-fluid" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <section class="py-5">
        <div class="container px-5">
            <div class="bg-light rounded-4 py-5 px-4 px-md-5">
                <div class="text-center mb-5">
                    <div class="feature text-white rounded-3 mb-3">
                        <img src="docs/assets/images/icons/clipboard.svg" alt="Icono personalizado" class="svg-icon">
                    </div>
                    <h1 class="fw-bolder">Formulario de Registro</h1>
                    <p class="lead fw-normal text-muted mb-0">Inicia tu registro</p>
                </div>
                <div class="row gx-5 justify-content-center">
                    <div class="col-lg-8 col-xl-6">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <div class="mb-3">
                            <label for="apellido" class="form-label">Apellido</label>
                            <input type="text" class="form-control" id="apellido" name="apellido" required>
                        </div>
                        <div class="mb-3">
                            <label for="edad" class="form-label">Edad</label>
                            <input type="number" class="form-control" id="edad" name="edad" required>
                        </div>
                        <div class="mb-3">
                            <label for="ciudad" class="form-label">Ciudad</label>
                            <input type="text" class="form-control" id="ciudad" name="ciudad" required>
                        </div>
                        <div class="mb-3">
                            <label for="celular" class="form-label">Celular</label>
                            <input type="number" class="form-control" id="celular" name="celular" required>
                        </div>
                        <div class="mb-3">
                            <label for="usuario" class="form-label">Usuario</label>
                            <input type="text" class="form-control" id="usuario" name="usuario" required>
                        </div>
                        <div class="mb-3">
                            <label for="rol" class="form-label">Rol</label>
                            <input type="text" class="form-control" id="rol" name="rol" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Registrar</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</form>

<?php include('footer.php') ?>
