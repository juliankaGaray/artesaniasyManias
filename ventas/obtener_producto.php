<?php
require 'base_de_datos.php';

try {
    $query = $base_de_datos->query("
        SELECT p.descripcion AS producto, SUM(pv.cantidad) AS total_vendido
        FROM productos_vendidos pv
        JOIN productos p ON pv.id_producto = p.id
        GROUP BY p.descripcion
    ");

    $productos = $query->fetchAll(PDO::FETCH_ASSOC);
    
    // Asegúrate de enviar esto en formato JSON si estás usando JS para graficar
    echo json_encode($productos);
} catch (Exception $e) {
    echo "Ocurrió un error al obtener los productos: " . $e->getMessage();
}
?>
