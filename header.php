<?  ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Artesanías y manías</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<!-- Loading Bootstrap -->
    <link href="dist/css/vendor/bootstrap.min.css" rel="stylesheet">

    <!-- Loading Flat UI -->
    <link href="dist/css/flat-ui.css" rel="stylesheet">
    <link href="docs/assets/css/demo.css" rel="stylesheet">

    <link rel="shortcut icon" href="dist/favicon.ico">
	<!-- estilo 2   --> <link href="app/css/styles.css" rel="stylesheet" />
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="kit-master/assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="kit-master/assets/img/favicon.png">
  <title>
    Artesanías y Manias
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="kit-master/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="kit-master/assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="kit-master/assets/css/material-kit.css?v=3.0.4" rel="stylesheet" />
  <!-- Nepcha Analytics (nepcha.com) -->
  <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
  <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
</head>
  <style>
      body {
        background-image: url('kit-master/assets/img/bg15.jpg'); 
        background-size: cover; 
        background-position: center; 
        background-repeat: no-repeat; 
      }
    </style>
  </head>
  <body class="about-us bg-gray-200">
    

	<!-- inicio del navBar -->



  
	
	<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand text-black" href="index.php" rel="tooltip" title="Designed and Coded by Creative Tim" data-placement="bottom" target="_blank">
        <img src="kit-master/assets/img/logo-ct-dark.png" alt="Logo" style="height: 40px; margin-right: 10px;">
        Artesanías y Manias
      </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Inicio</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Menú
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="registro.php">Registro</a></li>
            <li><a class="dropdown-item" href="catalogo.php">Catálogo</a></li>


            
			      <li><a class="dropdown-item" href="mision_vision.php">Misión y visión</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="login.php">Inicio de sesión</a></li>
			<li><a class="dropdown-item" href="Enviocorreo.php">Envio correo</a></li>
			<li><a class="dropdown-item" href="nosotros.php">Sobre nosotros</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" aria-disabled="true"></a>
        </li>
      </ul>
      

      <?php
        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['query'])) {
            $query = htmlspecialchars(trim($_GET['query']));
            
            
            // Redirigir si se busca "inicio"
            if (strcasecmp($query, 'ejercicios') === 0) {
                header("Location: ejercicios.php");
                exit;
            }
             else {
                echo "<p>No se encontraron resultados para '<strong>$query</strong>'.</p>";
            }
        }
    ?>
    </div>
  </div>
</nav>










