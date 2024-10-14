<?php
// Incluir la configuración de conexión
include('../app/config.php');

// Establecer la conexión a la base de datos
$pdo = conexion(); // Llama a la función de conexión

// Consulta para obtener los datos necesarios
$query_informacions = $pdo->query("SELECT * FROM tb_informaciones WHERE estado = '1'");
$informacions = $query_informacions->fetch_all(MYSQLI_ASSOC); // Usamos fetch_all para obtener todos los resultados

// Verificar si hay resultados
if (count($informacions) > 0) {
    // Obtener la primera fila de resultados
    $informacion = $informacions[0]; // Usar el primer resultado, ajusta según tus necesidades
    $nombre_parqueo = $informacion['nombre_parqueo'];
    $actividad_empresa = $informacion['actividad_empresa'];
    $sucursal = $informacion['sucursal'];
    $direccion = $informacion['direccion'];
    $zona = $informacion['zona'];
    $telefono = $informacion['telefono'];
    $departamento_ciudad = $informacion['departamento_ciudad'];
    $pais = $informacion['pais'];
} else {
    // Manejo de error si no se encuentran informaciones
    die("No se encontraron informaciones para generar el PDF.");
}

// Include the main TCPDF library (search for installation path).
require_once('../app/templeates/TCPDF-main/tcpdf.php');

// Crear nuevo documento PDF
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, array(79,175), true, 'UTF-8', false);

// Configurar información del documento
$pdf->setCreator(PDF_CREATOR);
$pdf->setAuthor('Sistema de parqueo');
$pdf->setTitle('Sistema de parqueo');
$pdf->setSubject('Sistema de parqueo');
$pdf->setKeywords('TCPDF, PDF, example, test, guide');

// Quitar encabezado y pie de página predeterminados
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// Configurar fuente predeterminada
$pdf->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// Configurar márgenes
$pdf->setMargins(5, 5, 5);

// Configurar saltos automáticos de página
$pdf->setAutoPageBreak(true, 5);

// Escala de imagen
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// Opcional: configurar cadenas dependientes del idioma
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
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
        <b>'.$nombre_parqueo.'</b> <br>
        '.$actividad_empresa.' <br>
        SUCURSAL No '.$sucursal.' <br>
        '.$direccion.' <br>
        ZONA: '.$zona.' <br>
        TELÉFONO: '.$telefono.' <br>
        '.$departamento_ciudad.' - '.$pais.' <br>
        --------------------------------------------------------------------------------
         <b>FACTURA Nro.</b> 00001
        --------------------------------------------------------------------------------
        <div style="text-align: left">
           
            <b>DATOS DEL CLIENTE</b> <br>
            <b>SEÑOR(A): </b> FREDDY EDDY HILARI MICHUA <br>
            <b>NIT/CI.: </b> 12345678  <br>
            <b>Fecha de la factura: </b> La Paz, 11 de octubre de 2022  <br>
            -------------------------------------------------------------------------------- <br>
        <b>De: </b> 11/10/2022 <b>Hora: </b>18:00<br>
        <b>A: </b> 11/10/2022  <b>Hora: </b>20:00<br>
        <b>Tiempo:  </b> 2 horas en el cuvicúlo 10<br>
         -------------------------------------------------------------------------------- <br>
         <table border="1" cellpadding="3">
         <tr>
            <td style="text-align: center" width="99px"><b>Detalle</b></td>    
            <td style="text-align: center" WIDTH="45PX"><b>Precio</b></td>    
            <td style="text-align: center" width="45px"><b>Cantidad</b></td>    
            <td style="text-align: center" width="45px"><b>Total</b></td>    
         </tr>
         <tr>
            <td>Servicio de parqueo de 2 horas</td>
            <td style="text-align: center">Bs. 10</td>
            <td style="text-align: center">1</td>
            <td style="text-align: center">Bs. 10</td>
         </tr>
         </table>
         <p style="text-align: right">
         <b>Monto Total: </b> Bs. 10
        </p>
        <p>
            <b>Son: </b>Diez 00/100 Bs.
        </p>
        <br>
         -------------------------------------------------------------------------------- <br>
         <b>USUARIO:</b> FREDDY EDDY HILARI MICHUA <br><br><br><br><br><br><br><br><br>
         
        <p style="text-align: center">
        </p>
        <p style="text-align: center">"ESTA FACTURA CONTRIBUYE AL DESARROLLO DEL PAÍS, EL USO ILÍCITO DE ÉSTA SERÁ SANCIONADO DE ACUERDO A LA LEY"
        </p>
        <p style="text-align: center"><b>GRACIAS POR SU PREFERENCIA</b></p>
        
        </div>
    </p>
</div>
';

// Salida del contenido HTML
$pdf->writeHTML($html, true, false, true, false, '');

// Generar código QR
$style = array(
    'border' => 0,
    'vpadding' => '3',
    'hpadding' => '3',
    'fgcolor' => array(0, 0, 0),
    'bgcolor' => false, //array(255,255,255)
    'module_width' => 1, // width of a single module in points
    'module_height' => 1 // height of a single module in points
);

$QR = 'Factura realizada por el sistema de parqueo HILARI WEB, al cliente Freddy Hilari con nit: 837737277323 
con el vehiculo con numero de placa 3983FREDD y esta factura se genero en 21 de octubre de 2022 a hr: 18:00';
$pdf->write2DBarcode($QR,'QRCODE,L',  22,105,35,35, $style);

// Cerrar y generar el documento PDF
$pdf->Output('example_002.pdf', 'I');

// Cerrar la conexión si es necesario
$pdo->close(); // Opcional, cierra la conexión si no la necesitas más
