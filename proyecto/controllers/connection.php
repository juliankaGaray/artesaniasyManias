<?php 
// Código de conexión a la base de datos
function conexion(){
    $host = "localhost";
    $usuario = "root";
    $password = "";
    $base_de_datos = "calse_4"; 

    // Crear la conexión
    $conexion = new mysqli($host, $usuario, $password, $base_de_datos);

    // Verificar si hay errores de conexión
    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }

    return $conexion;
}
?>
