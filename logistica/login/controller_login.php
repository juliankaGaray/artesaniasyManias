<?php

include $_SERVER['DOCUMENT_ROOT'] . '/logistica/app/config.php';
session_start();

$usuario_user = $_POST['usuario'];
$password_user = $_POST['password_user'];

$form_login = "";
if (isset($_POST['form_login'])) {
    $form_login = 'true';
}

// Establecer la conexión
$conexion = conexion(); // Obtiene la conexión usando la función conexion()

$email_tabla = '';
$password_tabla = '';

$query_login = $conexion->prepare("SELECT * FROM usuarios WHERE email = ? AND password_user = ? AND estado = '1'");
$query_login->bind_param("ss", $usuario_user, $password_user); // Asignar parámetros
$query_login->execute();
$result = $query_login->get_result(); // Obtener resultados

$usuarios = $result->fetch_all(MYSQLI_ASSOC); // Obtener todos los usuarios en un arreglo

foreach ($usuarios as $usuario) {
    $email_tabla = $usuario['email'];
    $password_tabla = $usuario['password_user'];
}

if (($usuario_user == $email_tabla) && ($password_user == $password_tabla)) {
    $_SESSION['usuario_sesion'] = $email_tabla; // Almacenar el usuario en la sesión
    ?>
    <div class="alert alert-success" role="alert">
        Usuario Correcto
    </div>
    <script>
        location.href = "<?php echo ($form_login == "") ? "principal.php" : "../principal.php"; ?>";
    </script>
    <?php
} else {
    ?>
    <div class="alert alert-danger" role="alert">
        Error al introducir sus datos
    </div>
    <script>$('#password').val(""); $('#password').focus();</script>
    <?php
}
?>
