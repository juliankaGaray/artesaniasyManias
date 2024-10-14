<?php

include $_SERVER['DOCUMENT_ROOT'] . '/logistica/app/config.php'; // Ajusta la ruta para incluir config.php

session_start();
if (isset($_SESSION['usuario_sesion'])) {
    $usuario_sesion = $_SESSION['usuario_sesion'];

    // Obtener la conexión
    $conexion = conexion(); // Llama a la función para establecer la conexión

    // Verificar si la conexión fue exitosa
    if ($conexion) {
        // Consulta para obtener los datos del usuario
        $query_usuario_sesion = $conexion->prepare("SELECT * FROM usuarios WHERE email = ? AND estado = '1'");

        // Verifica si la preparación de la consulta fue exitosa
        if ($query_usuario_sesion) {
            $query_usuario_sesion->bind_param("s", $usuario_sesion); // "s" indica que el parámetro es una cadena
            $query_usuario_sesion->execute();

            // Obtener el resultado
            $resultado = $query_usuario_sesion->get_result();

            // Verifica si hay resultados
            if ($resultado->num_rows > 0) {
                // Usar fetch_assoc() para obtener el resultado como un arreglo asociativo
                $usuarios_sesion = $resultado->fetch_assoc(); // Solo se espera un único usuario

                // Acceder a los valores
                $id_user_sesion = isset($usuarios_sesion['id']) ? $usuarios_sesion['id'] : null;
                $nombres_sesion = isset($usuarios_sesion['usuario']) ? $usuarios_sesion['usuario'] : null;
                $email_sesion = isset($usuarios_sesion['email']) ? $usuarios_sesion['email'] : null;
                $rol_sesion = isset($usuarios_sesion['rol']) ? $usuarios_sesion['rol'] : null;

                // Puedes usar los valores aquí
            } else {
                echo "No se encontraron usuarios activos.";
            }
        } else {
            echo "Error al preparar la consulta SQL.";
        }
    } else {
        echo "Error al conectar a la base de datos.";
    }
} else {
    echo "Para ingresar a esta plataforma debe iniciar sesión";
    header('Location: ' . $URL . '/login');
    exit(); // Asegúrate de salir después de redirigir
}
?>
    