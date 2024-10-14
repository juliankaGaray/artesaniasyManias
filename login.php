

<?php
session_start();
include('controllers/connection.php'); // Incluir el archivo connection.php

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
                // Si el rol no está mapeado, redirigir a una página de error o logout
                header("Location: logout.php");
            }
            exit();
        } else {
            // Si las credenciales no son válidas
            echo "Usuario o contraseña incorrectos.";
        }
    } else {
        echo "Error al preparar la consulta: " . $conn->error;
    }

    // Cerrar la conexión
    $conn->close();
}
?>
<?php include('header.php') ?>

<!-- Mostrar mensajes -->
<div class="container mt-3">
<?php if (!empty($error)): ?>
    <div class="alert alert-danger"><?php echo $error; ?></div>
<?php endif; ?>
</div>



<!-- formulario de login-->
<form class="container-fluid" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <section class="py-5">
        <div class="container px-5">
            <div class="bg-light rounded-4 py-5 px-4 px-md-5">
                <div class="text-center mb-5">
                    <div class="feature text-white rounded-3 mb-3">
                        <img src="docs/assets/images/icons/clipboard.svg" alt="Icono personalizado" class="svg-icon">
                    </div>
                    <h1 class="fw-bolder">Inicia sesión</h1>
                    <p class="lead fw-normal text-muted mb-0">Introduce tus credenciales</p>
                </div>
                <div class="row gx-5 justify-content-center">
                    <div class="col-lg-8 col-xl-6">
                        <div class="form-floating mb-3">
                            <input type="text" name="usuario" class="form-control" id="usuario" placeholder="miusuario00" required>
                            <label for="usuario">Usuario</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" name="password" class="form-control" id="password" placeholder="Contraseña" required>
                            <label for="password">Contraseña</label>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                            <a class="small" href="recuperarcontraseña.php">olvido la contraseña</a>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                            <a class="small" href="registro.php">registrate</a>
                        </div>
                        <div class="d-grid">
                            <button class="btn btn-primary btn-lg" type="submit">Enviar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include('footer.php') ?>