<?php
// Habilitar el manejo de errores
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the main TCPDF library (search for installation path).
require_once('../app/templeates/TCPDF-main/tcpdf.php');
include('../app/config.php');

// Cargar la conexión a la base de datos
$conexion = conexion(); // Llamada a la función de conexión



// Inicializar variables con valores predeterminados
$nombre_parqueo = 'Nombre del parqueo no disponible';
$actividad_empresa = 'Actividad de la empresa no disponible';
$sucursal = 'Sucursal no disponible';
$direccion = 'Dirección no disponible';
$zona = 'Zona no disponible';
$telefono = 'Teléfono no disponible';
$departamento_ciudad = 'Departamento/Ciudad no disponible';
$pais = 'País no disponible';

// Cargar el encabezado
$query_informacions = "SELECT * FROM tb_informaciones WHERE estado = '1'";
$result = $conexion->query($query_informacions);

// Comprobar si se obtuvieron resultados
if ($result && $result->num_rows > 0) {
    $informacions = $result->fetch_all(MYSQLI_ASSOC);
    foreach ($informacions as $informacion) {
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
}

// Create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, array(79, 80), true, 'UTF-8', false);

// Set document information
$pdf->setCreator(PDF_CREATOR);
$pdf->setAuthor('Nicola Asuni');
$pdf->setTitle('TCPDF Example 002');
$pdf->setSubject('TCPDF Tutorial');
$pdf->setKeywords('TCPDF, PDF, example, test, guide');

// Remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// Set default monospaced font
$pdf->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// Set margins
$pdf->setMargins(5, 5, 5);

// Set auto page breaks
$pdf->setAutoPageBreak(true, 5);

// Set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// Set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
    require_once(dirname(__FILE__) . '/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// Set font
$pdf->setFont('Helvetica', '', 7);

// Add a page
$pdf->AddPage();

// Create some HTML content
$html = '
<div>
    <p style="text-align: center">
        <b>' . htmlspecialchars($nombre_parqueo) . '</b> <br>
        ' . htmlspecialchars($actividad_empresa) . ' <br>
        SUCURSAL No ' . htmlspecialchars($sucursal) . ' <br>
        ' . htmlspecialchars($direccion) . ' <br>
        ZONA: ' . htmlspecialchars($zona) . ' <br>
        TELÉFONO: ' . htmlspecialchars($telefono) . ' <br>
        ' . htmlspecialchars($departamento_ciudad) . ' - ' . htmlspecialchars($pais) . ' <br>
        --------------------------------------------------------------------------------
        <div style="text-align: left">
            <b>DATOS DEL CLIENTE</b> <br>
            <b>SEÑOR(A): </b> FREDDY EDDY HILARI MICHUA <br>
            <b>NIT/CI.: </b> 12345678  <br>
            -------------------------------------------------------------------------------- <br>
        <b>Cuviculo de parqueo: </b> 10 <br>
        <b>Fecha de ingreso: </b> 26/09/2022 <br>
        <b>Hora de ingreso: </b> 18:00 <br>
         -------------------------------------------------------------------------------- <br>
         <b>USUARIO:</b> FREDDY EDDY HILARI MICHUA
        </div>
    </p>
</div>
';

// Output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// Close and output PDF document
$pdf->Output('example_002.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
