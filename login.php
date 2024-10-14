<?php
session_start();
include('controllers/connection.php'); // Incluir el archivo connection.php

$error = ""; // Variable para manejar errores

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    // Crear la conexión usando la función 'conexion' desde connection.php
    $conn = conexion(); 

    // Consulta para verificar el usuario y obtener su rol
    $query = "SELECT u.usuario, u.pass, r.nombre as rol_nombre 
              FROM usuarios u 
              JOIN roles r ON u.rol_id = r.id 
              WHERE u.usuario = ? AND u.pass = ?";
    
    // Preparar la consulta
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("ss", $usuario, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            // Login correcto
            $user = $result->fetch_assoc();
            $_SESSION['usuario'] = $user['usuario'];
            $_SESSION['rol'] = $user['rol_nombre'];
            
            // Redireccionar según el rol del usuario
            if ($user['rol_nombre'] == 'admin') {
                header("Location: proyecto/index.php"); // Página para el administrador
            } elseif ($user['rol_nombre'] == 'vendedor') {
                header("Location: ventas/index.php"); // Página para vendedores
            } elseif ($user['rol_nombre'] == 'viewer') {
                header("Location: viewer_dashboard.php"); // Página solo para vistas
            } else {
                header("Location: logout.php");
            }
            exit();
        } else {
            // Si las credenciales no son válidas
            $error = "Usuario o contraseña incorrectos.";
        }
    } else {
        $error = "Error al preparar la consulta: " . $conn->error;
    }

    // Cerrar la conexión
    $conn->close();
}
?>

<?php include('header.php'); ?>

<div class="page-header align-items-start min-vh-100">
        
    <div class="container my-auto">
        <div class="row">
            <div class="col-lg-4 col-md-8 col-12 mx-auto">
                <div class="card z-index-0 fadeIn3 fadeInBottom">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                            <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Iniciar Sesion</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Mostrar mensajes de error -->
                        <?php if (!empty($error)): ?>
                            <div class="alert alert-danger"><?php echo $error; ?></div>
                        <?php endif; ?>
                        <form role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="text-start">
                            <div class="input-group input-group-outline my-3">
                                <label class="form-label">Usuario</label>
                                <input type="text" name="usuario" class="form-control" required>
                            </div>
                            <div class="input-group input-group-outline mb-3">
                                <label class="form-label">Contraseña</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <div class="form-check form-switch d-flex align-items-center mb-3">
                                <input class="form-check-input" type="checkbox" id="rememberMe">
                                <label class="form-check-label mb-0 ms-3" for="rememberMe">Recordarme</label>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2">Iniciar sesión</button>
                            </div>
                            <p class="mt-4 text-sm text-center">
                                ¿No tienes una cuenta? <a href="registro.php">Regístrate</a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer position-absolute bottom-2 py-2 w-100">
        <div class="container">
            <div class="row align-items-center justify-content-lg-between">
                <div class="col-12 col-md-6 my-auto">
                    <div class="copyright text-center text-sm text-white text-lg-start">
                        © <script>document.write(new Date().getFullYear())</script>,
                        hecho con <i class="fa fa-heart" aria-hidden="true"></i> por
                        <a href="https://www.creative-tim.com" class="font-weight-bold text-white" target="_blank">Creative Tim</a>
                        para una mejor web.
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                        <li class="nav-item"><a href="https://www.creative-tim.com" class="nav-link text-white" target="_blank">Creative Tim</a></li>
                        <li class="nav-item"><a href="https://www.creative-tim.com/presentation" class="nav-link text-white" target="_blank">Sobre nosotros</a></li>
                        <li class="nav-item"><a href="https://www.creative-tim.com/blog" class="nav-link text-white" target="_blank">Blog</a></li>
                        <li class="nav-item"><a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-white" target="_blank">Licencia</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</div>

<?php include('footer.php'); ?>
