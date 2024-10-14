    <?php

        include 'base_de_datos.php';

        // Consulta SQL
        $query = "SELECT DATE(fecha) AS fecha_venta, SUM(total) AS total_ventas FROM ventas GROUP BY DATE(fecha)";
        
        try {
            
            $statement = $base_de_datos->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();

            $fechas = array();
            $totales = array();
            

            foreach ($result as $row) {
                $fechas[] = $row->fecha_venta;  
                $totales[] = $row->total_ventas; 
            }

            
            echo json_encode(array("fechas" => $fechas, "totales" => $totales));

        } catch (Exception $e) {
            echo "Error al obtener los datos: " . $e->getMessage();
        }
    ?>
