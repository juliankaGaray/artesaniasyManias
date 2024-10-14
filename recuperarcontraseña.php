<?php include('header.php') ?>

<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    if (empty($email)) {
        echo "Por favor, introduce un email.";
    } else {
        $codigoVerificacion = rand(100000, 999999); // Código de 6 dígitos

        $mail = new PHPMailer(true);

        try {
            // Configuración del servidor SMTP
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com'; // Servidor SMTP de Gmail
            $mail->SMTPAuth   = true;
            $mail->Username   = 'julcamgar@gmail.com'; // Tu dirección de correo
            $mail->Password   = 'garay_mental10427'; // Tu contraseña de correo
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            // Remitente y destinatario
            $mail->setFrom('julcamgar@gmail.com', 'Soporte');
            $mail->addAddress($email);

            // Contenido del correo
            $mail->isHTML(true);
            $mail->Subject = 'Código de verificación para recuperar contraseña';
            $mail->Body    = "Hola,<br><br>Tu código de verificación es: " . $codigoVerificacion;

            // Enviar correo
            $mail->send();
            echo 'El código de verificación ha sido enviado a tu correo electrónico.';
        } catch (Exception $e) {
            echo "Hubo un problema al enviar el correo: {$mail->ErrorInfo}";
        }

        // Guardamos el código en la sesión
        session_start();
        $_SESSION['codigo_verificacion'] = $codigoVerificacion;
        $_SESSION['email'] = $email;
    }
}

?>

    <form method="post" action="">
        <section class="py-5">
            <div class="container px-5">
                <div class="bg-light rounded-4 py-5 px-4 px-md-5">
                    <div class="text-center mb-5">
                        <div class="text-center mb-5">
                            <div class="feature  text-white rounded-3 mb-3">
                                 <img src="docs/assets/images/icons/lock.svg" alt="Icono personalizado" class="svg-icon">
                            </div>
                                <h1 class="fw-bolder">Recuperar contraseaña</h1>
                                <!-- Nombre input -->
                            <div class="form-floating mb-3">
                                <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Tu Nombre" required>
                                <label for="nombre">Nombre</label>
                            </div>

                                <!-- Correo input -->
                            <div class="form-floating mb-3">
                                <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com" required>
                                <label for="email">Correo Electrónico</label>
                            </div>

                                <button class="btn btn-primary" type="submit">Enviar</button>
                        </div>
                    </div>
                </div>
            </div>
        </seccion>
    </form> 
    
    <?php include('footer.php');?>


