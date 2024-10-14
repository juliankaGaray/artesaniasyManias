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

$error = "";
$exito = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validación de campos del formulario
    if (empty($_POST["nombre"]) || empty($_POST["apellido"]) || empty($_POST["edad"]) || empty($_POST["ciudad"]) || empty($_POST["celular"]) || empty($_POST["usuario"]) || empty($_POST["password"])) {
        $error = "Todos los campos son obligatorios.";
    } else {
        // Obtener los datos del formulario
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $edad = $_POST["edad"];
        $ciudad = $_POST["ciudad"];
        $celular = $_POST["celular"];
        $usuario = $_POST["usuario"];
        $password = $_POST["password"];

        // Inserción del nuevo usuario
        $sql_usuario = "INSERT INTO usuarios (usuario, pass) VALUES ('$usuario', '$password')";
        
        if ($conexion->query($sql_usuario) === TRUE) {
            $usuarios_id = $conexion->insert_id; // Obtener el ID del nuevo usuario

            // Inserción de los datos en la tabla registro
            $sql_registro = "INSERT INTO registro (nombre, apellido, edad, ciudad, celular, usuarios_id) VALUES ('$nombre', '$apellido', '$edad', '$ciudad', '$celular', '$usuarios_id')";

            if ($conexion->query($sql_registro) === TRUE) {
                $exito = "Registro insertado con éxito";
            } else {
                $error = "Error al insertar en registro: " . $conexion->error;
            }
        } else {
            $error = "Error al insertar usuario: " . $conexion->error;
        }
    }
}

// Cerrar la conexión
$conexion->close();
?>
