<?php

include('../app/config.php');
include('literal.php');

date_default_timezone_set("America/Caracas");
$fechaHora = date("Y-m-d h:i:s");
$dia = date("d");
$mes = date('m');

// Arreglos para los nombres de los meses
$meses = [
    "1" => "Enero",
    "2" => "Febrero",
    "3" => "Marzo",
    "4" => "Abril",
    "5" => "Mayo",
    "6" => "Junio",
    "7" => "Julio",
    "8" => "Agosto",
    "9" => "Septiembre",
    "10" => "Octubre",
    "11" => "Noviembre",
    "12" => "Diciembre"
];

$mes = isset($meses[$mes]) ? $meses[$mes] : "Mes desconocido";
$ano = date('Y');

// Recuperar los parámetros de la URL
$id_informacion = isset($_GET['id_informacion']) ? $_GET['id_informacion'] : null;
$nro_factura = isset($_GET['nro_factura']) ? $_GET['nro_factura'] : null;
$id_cliente = isset($_GET['id_cliente']) ? $_GET['id_cliente'] : null;

if (is_null($id_informacion) || is_null($nro_factura) || is_null($id_cliente)) {
    echo 'Error: Faltan parámetros necesarios.';
    exit; // Terminar el script si faltan parámetros
}

// Recuperar el departamento o ciudad de la tabla informaciones
try {
    $query_info = $pdo->prepare("SELECT * FROM tb_informaciones WHERE id_informacion = :id_informacion AND estado = '1'");
    $query_info->bindParam(':id_informacion', $id_informacion);
    $query_info->execute();
    $infos = $query_info->fetchAll(PDO::FETCH_ASSOC);

    $departamento_ciudad = '';
    foreach ($infos as $info) {
        $departamento_ciudad = $info['departamento_ciudad'];
    }

    $fecha_factura = $departamento_ciudad . ", " . $dia . " de " . $mes . " de " . $ano;

    $fecha_ingreso = $_GET['fecha_ingreso'];
    $hora_ingreso = $_GET['hora_ingreso'];
    $fecha_salida = date('Y-m-d');
    $hora_salida = date('H:i');

    // Calcular la diferencia entre el tiempo de entrada y de salida
    $fecha_hora_ingreso = $fecha_ingreso . " " . $hora_ingreso;
    $fecha_hora_salida = $fecha_salida . " " . $hora_salida;

    $fecha_hora_ingreso = new DateTime($fecha_hora_ingreso);
    $fecha_hora_salida = new DateTime($fecha_hora_salida);
    $diff = $fecha_hora_ingreso->diff($fecha_hora_salida);

    $tiempo = $diff->days . " días con " . $diff->h . " horas con " . $diff->i . " minutos";

    $cuviculo = $_GET['cuviculo'];
    $detalle = "Servicio de parqueo de " . $tiempo;

    // Calcular el precio del cliente en horas
    $query_precios = $pdo->prepare("SELECT * FROM tb_precios WHERE cantidad = :cantidad AND detalle = 'HORAS' AND estado = '1'");
    $query_precios->bindParam(':cantidad', $diff->h);
    $query_precios->execute();
    $datos_precios = $query_precios->fetchAll(PDO::FETCH_ASSOC);

    $precio_hora = 0;
    foreach ($datos_precios as $datos_precio) {
        $precio_hora = $datos_precio['precio'];
    }

    // Calcular el precio del cliente en días
    $precio_dia = 0;
    $query_precios_dias = $pdo->prepare("SELECT * FROM tb_precios WHERE cantidad = :cantidad AND detalle = 'DIAS' AND estado = '1'");
    $query_precios_dias->bindParam(':cantidad', $diff->days);
    $query_precios_dias->execute();
    $datos_precios_dias = $query_precios_dias->fetchAll(PDO::FETCH_ASSOC);
    foreach ($datos_precios_dias as $datos_precios_dia) {
        $precio_dia = $datos_precios_dia['precio'];
    }

    $precio_final = $precio_dia + $precio_hora;
    $cantidad = "1";
    $total = ($precio_final * $cantidad);
    $monto_total = $total;

    $monto_literal = numtoletras($monto_total);
    $user_sesion = $_GET['user_sesion'];

    // Rescatando los datos del cliente
    $query_clientes = $pdo->prepare("SELECT * FROM tb_clientes WHERE id_cliente = :id_cliente AND estado = '1'");
    $query_clientes->bindParam(':id_cliente', $id_cliente);
    $query_clientes->execute();
    $datos_clientes = $query_clientes->fetchAll(PDO::FETCH_ASSOC);

    $nombre_cliente = '';
    $nit_ci_cliente = '';
    $placa_auto = '';

    foreach ($datos_clientes as $datos_cliente) {
        $id_cliente = $datos_cliente['id_cliente'];
        $nombre_cliente = $datos_cliente['nombre_cliente'];
        $nit_ci_cliente = $datos_cliente['nit_ci_cliente'];
        $placa_auto = $datos_cliente['placa_auto'];
    }

    $qr = "Factura realizada por el sistema de paqueo, al cliente " . $nombre_cliente . " con CI/NIT: " . $nit_ci_cliente . " con el vehiculo con número de placa " . $placa_auto . " y esta factura se generó en " . $fecha_factura . " a hr: " . $hora_salida;

    // Inserción en la tabla de facturaciones
    $sentencia = $pdo->prepare('INSERT INTO tb_facturaciones
    (id_informacion,nro_factura,id_cliente,fecha_factura,fecha_ingreso,hora_ingreso,fecha_salida,hora_salida,tiempo,cuviculo,detalle,precio,cantidad,total,monto_total,monto_literal,user_sesion,qr, fyh_creacion, estado)
    VALUES (:id_informacion,:nro_factura,:id_cliente,:fecha_factura,:fecha_ingreso,:hora_ingreso,:fecha_salida,:hora_salida,:tiempo,:cuviculo,:detalle,:precio,:cantidad,:total,:monto_total,:monto_literal,:user_sesion,:qr,:fyh_creacion,:estado)');

    $sentencia->bindParam(':id_informacion', $id_informacion);
    $sentencia->bindParam(':nro_factura', $nro_factura);
    $sentencia->bindParam(':id_cliente', $id_cliente);
    $sentencia->bindParam(':fecha_factura', $fecha_factura);
    $sentencia->bindParam(':fecha_ingreso', $fecha_ingreso);
    $sentencia->bindParam(':hora_ingreso', $hora_ingreso);
    $sentencia->bindParam(':fecha_salida', $fecha_salida);
    $sentencia->bindParam(':hora_salida', $hora_salida);
    $sentencia->bindParam(':tiempo', $tiempo);
    $sentencia->bindParam(':cuviculo', $cuviculo);
    $sentencia->bindParam(':detalle', $detalle);
    $sentencia->bindParam(':precio', $precio_final);
    $sentencia->bindParam(':cantidad', $cantidad);
    $sentencia->bindParam(':total', $total);
    $sentencia->bindParam(':monto_total', $monto_total);
    $sentencia->bindParam(':monto_literal', $monto_literal);
    $sentencia->bindParam(':user_sesion', $user_sesion);
    $sentencia->bindParam(':qr', $qr);
    $sentencia->bindParam(':fyh_creacion', $fechaHora);
    $estado_del_registro = 1; // Definir el estado del registro
    $sentencia->bindParam(':estado', $estado_del_registro);

    if ($sentencia->execute()) {
        echo 'success';

        $estado_espacio = "LIBRE";
        $fechaHora = date("Y-m-d h:i:s");
        $sentencia = $pdo->prepare("UPDATE tb_mapeos SET
        estado_espacio = :estado_espacio,
        fyh_actualizacion = :fyh_actualizacion 
        WHERE nro_espacio = :nro_espacio");
        $sentencia->bindParam(':estado_espacio', $estado_espacio);
        $sentencia->bindParam(':fyh_actualizacion', $fechaHora);
        $sentencia->bindParam(':nro_espacio', $cuviculo);
        $sentencia->execute();

        $estado_espacio_ticket = "LIBRE";
        $sentencia = $pdo->prepare("UPDATE tb_tickets SET
        estado = :estado_espacio_ticket
        WHERE id_ticket = :id_ticket");
        $sentencia->bindParam(':estado_espacio_ticket', $estado_espacio_ticket);
        $sentencia->bindParam(':id_ticket', $id_informacion);
        $sentencia->execute();
    } else {
        echo 'Error: No se pudo registrar la factura.';
    }
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}

?>
