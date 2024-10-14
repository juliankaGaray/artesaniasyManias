<?php include('header.php') ?>

<?php
// Código de conexión a la base de datos
$host = "localhost";
$usuario = "root";
$pass = "";
$base_de_datos = "calse_4"; 

$conexion = new mysqli($host, $usuario, $pass, $base_de_datos);

// Verificar la conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Mensaje de error por campos vacíos o éxito
$error = "";
$exito = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validación de campos del formulario
    if (empty($_POST["nombre"]) || empty($_POST["apellido"]) || empty($_POST["edad"]) || empty($_POST["ciudad"]) || empty($_POST["celular"]) || empty($_POST["usuario"]) || empty($_POST["pass"]) || empty($_POST["rol"])) {
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
        $pass = $_POST["pass"];
        
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
                $stmt_usuario->bind_param("ssi", $usuario, $pass, $rol_id);
                
                if ($stmt_usuario->execute()) {
                    // 2. Inserta en la tabla `registro`
                    $sql_registro = "INSERT INTO registro (nombre, apellido, edad, ciudad, celular, usuarios_id) VALUES (?, ?, ?, ?, ?, ?)";
                    $stmt_registro = $conexion->prepare($sql_registro);

                    if ($stmt_registro) {
                        // Obtén el ID del último usuario insertado
                        $usuarios_id = $conexion->insert_id;
                        $stmt_registro->bind_param("ssissi", $nombre, $apellido, $edad, $ciudad, $celular, $usuarios_id);
                        
                        if ($stmt_registro->execute()) {
                            $exito = "Registro insertado con éxito en las tablas 'usuarios' y 'registro'.";
                        } else {
                            $error = "Error al insertar en la tabla registro: " . $stmt_registro->error;
                        }
                        
                        // Cerrar la sentencia preparada de registro
                        $stmt_registro->close();
                    } else {
                        $error = "Error al preparar la consulta de registro: " . $conexion->error;
                    }
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

<div class="page-header align-items-start min-vh-100">
    <div class="container my-auto">
        <div class="row">
            <div class="col-lg-6 col-md-8 col-12 mx-auto">
                <div class="card z-index-0 fadeIn3 fadeInBottom">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                            <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Formulario de Registro</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Mostrar mensajes de error o éxito -->
                        <?php if (!empty($error)): ?>
                            <div class="alert alert-danger"><?php echo $error; ?></div>
                        <?php elseif (!empty($exito)): ?>
                            <div class="alert alert-success"><?php echo $exito; ?></div>
                        <?php endif; ?>

                        <!-- Formulario de registro -->
                        <form role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="text-start">
                            <div class="input-group input-group-outline my-3">
                                <label class="form-label">Nombre</label>
                                <input type="text" name="nombre" class="form-control" required>
                            </div>
                            <div class="input-group input-group-outline my-3">
                                <label class="form-label">Apellido</label>
                                <input type="text" name="apellido" class="form-control" required>
                            </div>
                            <div class="input-group input-group-outline my-3">
                                <label class="form-label">Edad</label>
                                <input type="number" name="edad" class="form-control" required>
                            </div>
                            <div class="input-group input-group-outline my-3">
                                <label class="form-label">Ciudad</label>
                                <input type="text" name="ciudad" class="form-control" required>
                            </div>
                            <div class="input-group input-group-outline my-3">
                                <label class="form-label">Celular</label>
                                <input type="number" name="celular" class="form-control" required>
                            </div>
                            <div class="input-group input-group-outline my-3">
                                <label class="form-label">Usuario</label>
                                <input type="text" name="usuario" class="form-control" required>
                            </div>
                            <div class="input-group input-group-outline my-3">
                                <label class="form-label">Rol</label>
                                <input type="text" name="rol" class="form-control" required>
                            </div>
                            <div class="input-group input-group-outline my-3">
                                <label class="form-label">Contraseña</label>
                                <input type="password" name="pass" class="form-control" required>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2">Registrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
