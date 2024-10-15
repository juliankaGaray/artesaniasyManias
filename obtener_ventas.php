<?php

    include 'base_de_datos.php';  // Asegúrate de que este archivo esté bien configurado para conectar a la base de datos

    // Consulta SQL
    $query = "SELECT DATE(fecha) AS fecha_venta, SUM(total) AS total_ventas FROM ventas GROUP BY DATE(fecha) ORDER BY fecha_venta ASC";
    
    try {
        
        // Preparar y ejecutar la consulta
        $statement = $base_de_datos->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);  // Asegúrate de que esté usando PDO::FETCH_ASSOC
        
        // Arrays para almacenar los datos
        $fechas = array();
        $totales = array();
        
        // Recorrer los resultados
        foreach ($result as $row) {
            $fechas[] = $row['fecha_venta'];  // Asegúrate de usar el nombre del índice correcto
            $totales[] = $row['total_ventas'];
        }

        // Enviar los datos como JSON
        echo json_encode(array("fechas" => $fechas, "totales" => $totales));

    } catch (Exception $e) {
        echo "Error al obtener los datos: " . $e->getMessage();
    }
?>
