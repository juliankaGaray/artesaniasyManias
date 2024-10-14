<?php
// Include the main TCPDF library (search for installation path).
require_once('../app/templeates/TCPDF-main/tcpdf.php');
include('../app/config.php'); // Incluir el archivo de configuración

// Obtener la conexión a la base de datos
$conexion = conexion(); // Llamar a la función de conexión

// Cargar el encabezado
$query_informacions = "SELECT * FROM tb_informaciones WHERE estado = '1'";
$result_informacions = $conexion->query($query_informacions);
$informacions = $result_informacions->fetch_all(MYSQLI_ASSOC);

$informacion = isset($informacions[0]) ? $informacions[0] : null; // Obtener la primera información
if ($informacion) {
    $id_informacion = $informacion['id_informacion'];
    $nombre_parqueo = $informacion['nombre_parqueo'];
    $actividad_empresa = $informacion['actividad_empresa'];
    $sucursal = $informacion['sucursal'];
    $direccion = $informacion['direccion'];
    $zona = $informacion['zona'];
    $telefono = $informacion['telefono'];
    $departamento_ciudad = $informacion['departamento_ciudad'];
    $pais = $informacion['pais'];
}

// Rescatar la información de la factura
$query_facturas = "SELECT * FROM tb_facturaciones WHERE estado = '1'";
$result_facturas = $conexion->query($query_facturas);

// Comprobar si la consulta fue exitosa y si hay resultados
if ($result_facturas && $result_facturas->num_rows > 0) {
    $facturas = $result_facturas->fetch_all(MYSQLI_ASSOC);
    $factura = $facturas[0]; // Obtener la primera factura

    // Obtener los datos de la factura
    $id_facturacion = $factura['id_facturacion'];
    $nro_factura = $factura['nro_factura'];
    $id_cliente = $factura['id_cliente'];
    $fecha_factura = $factura['fecha_factura'];
    $fecha_ingreso = $factura['fecha_ingreso'];
    $hora_ingreso = $factura['hora_ingreso'];
    $fecha_salida = $factura['fecha_salida'];
    $hora_salida = $factura['hora_salida'];
    $tiempo = $factura['tiempo'];
    $cuviculo = $factura['cuviculo'];
    $detalle = $factura['detalle'];
    $precio = $factura['precio'];
    $cantidad = $factura['cantidad'];
    $total = $factura['total'];
    $monto_total = $factura['monto_total'];
    $monto_literal = $factura['monto_literal'];
    $user_sesion = $factura['user_sesion'];
    $qr = $factura['qr'];
} else {
    // Manejar el caso en que no hay facturas
    die("No se encontraron facturas o hubo un error en la consulta.");
}

// Rescatando los datos del cliente
if (isset($id_cliente)) {
    $query_clientes = "SELECT * FROM tb_clientes WHERE id_cliente = $id_cliente AND estado = '1'";
    $result_clientes = $conexion->query($query_clientes);

    // Comprobar si la consulta fue exitosa y si hay resultados
    if ($result_clientes && $result_clientes->num_rows > 0) {
        $datos_clientes = $result_clientes->fetch_all(MYSQLI_ASSOC);
        $datos_cliente = $datos_clientes[0]; // Obtener el primer cliente

        // Obtener los datos del cliente
        $nombre_cliente = $datos_cliente['nombre_cliente'];
        $nit_ci_cliente = $datos_cliente['nit_ci_cliente'];
        $placa_auto = $datos_cliente['placa_auto'];
    } else {
        // Manejar el caso en que no hay clientes o hubo un error
        die("No se encontraron clientes o hubo un error en la consulta.");
    }
} else {
    // Manejar el caso en que no hay un id_cliente válido
    die("No se encontró un id_cliente válido en la factura.");
}

// Rescatando los datos del cliente
$query_clientes = "SELECT * FROM tb_clientes WHERE id_cliente = $id_cliente AND estado = '1'";
$result_clientes = $conexion->query($query_clientes);
$datos_clientes = $result_clientes->fetch_all(MYSQLI_ASSOC);

$datos_cliente = isset($datos_clientes[0]) ? $datos_clientes[0] : null; // Obtener el primer cliente
if ($datos_cliente) {
    $nombre_cliente = $datos_cliente['nombre_cliente'];
    $nit_ci_cliente = $datos_cliente['nit_ci_cliente'];
    $placa_auto = $datos_cliente['placa_auto'];
}

// Crear nuevo documento PDF
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, array(79, 175), true, 'UTF-8', false);

// Configurar información del documento
$pdf->setCreator(PDF_CREATOR);
$pdf->setAuthor('Sistema de parqueo');
$pdf->setTitle('Sistema de parqueo');
$pdf->setSubject('Sistema de parqueo');
$pdf->setKeywords('TCPDF, PDF, example, test, guide');

// Eliminar encabezado/pie de página por defecto
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// Establecer fuente monoespaciada predeterminada
$pdf->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// Establecer márgenes
$pdf->setMargins(5, 5, 5);

// Configurar saltos de página automáticos
$pdf->setAutoPageBreak(true, 5);

// Establecer factor de escala de imagen
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// Configurar cadenas dependientes del idioma (opcional)
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
    require_once(dirname(__FILE__) . '/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// Establecer fuente
$pdf->setFont('Helvetica', '', 7);

// Agregar una página
$pdf->AddPage();

// Crear contenido HTML
$html = '
<div>
    <p style="text-align: center">
        <b>' . $nombre_parqueo . '</b> <br>
        ' . $actividad_empresa . ' <br>
        SUCURSAL No ' . $sucursal . ' <br>
        ' . $direccion . ' <br>
        ZONA: ' . $zona . ' <br>
        TELÉFONO: ' . $telefono . ' <br>
        ' . $departamento_ciudad . ' - ' . $pais . ' <br>
        --------------------------------------------------------------------------------
         <b>FACTURA Nro.</b> ' . $nro_factura . '
        --------------------------------------------------------------------------------
        <div style="text-align: left">
            <b>DATOS DEL CLIENTE</b> <br>
            <b>SEÑOR(A): </b> ' . $nombre_cliente . ' <br>
            <b>NIT/CI.: </b> ' . $nit_ci_cliente . '  <br>
            <b>Fecha de la factura: </b> ' . $fecha_factura . ' <br>
            -------------------------------------------------------------------------------- <br>
        <b>De: </b> ' . $fecha_ingreso . '<b> Hora: </b>' . $hora_ingreso . '<br>
        <b>A: </b> ' . $fecha_salida . '  <b>Hora: </b>' . $hora_salida . '<br>
        <b>Tiempo:  </b> ' . $tiempo . '<br>
         -------------------------------------------------------------------------------- <br>
         <table border="1" cellpadding="3">
         <tr>
            <td style="text-align: center" width="99px"><b>Detalle</b></td>    
            <td style="text-align: center" WIDTH="45PX"><b>Precio</b></td>    
            <td style="text-align: center" width="45px"><b>Cantidad</b></td>    
            <td style="text-align: center" width="45px"><b>Total</b></td>    
         </tr>
         <tr>
            <td>' . $detalle . '</td>
            <td style="text-align: center">Bs. ' . $precio . '</td>
            <td style="text-align: center">' . $cantidad . '</td>
            <td style="text-align: center">Bs. ' . $total . '</td>
         </tr>
         </table>
         <p style="text-align: right">
         <b>Monto Total: </b> Bs. ' . $monto_total . '
        </p>
        <p>
            <b>Son: </b>' . $monto_literal . '
        </p>
        <br>
         -------------------------------------------------------------------------------- <br>
         <b>USUARIO:</b> ' . $user_sesion . ' <br><br><br><br><br><br><br><br>
         
        <p style="text-align: center">
        </p>
        <p style="text-align: center">
        <img src="../app/qrcodes/' . $qr . '" width="80px" height="80px">
        </p>
    </div>
</div>';

// Escribir el contenido HTML en el PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Cerrar y enviar el PDF
$pdf->Output('factura.pdf', 'I');

// Cerrar la conexión
$conexion->close();
?>
