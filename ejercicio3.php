<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>calse web I distancia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Loading Bootstrap -->
    <link href="dist/css/vendor/bootstrap.min.css" rel="stylesheet">

    <!-- Loading Flat UI -->
    <link href="dist/css/flat-ui.css" rel="stylesheet">
    <link href="docs/assets/css/demo.css" rel="stylesheet">

    <link rel="shortcut icon" href="dist/favicon.ico">
	<!-- estilo 2   --> <link href="app/css/styles.css" rel="stylesheet" />
  </head>
  <body>
    
  <?php
  $error = "";
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if (empty($_POST["email"]) || empty($_POST["password"])) {
          $error = "El Email y la Contraseña son obligatorios.";
      } else {
          // Procesa el formulario si Email y Password están llenos
          // espacio parala  lógica de manejo de datos.
      }
  }
  ?>

  <!-- inicio del navBar -->
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php">ingeniería web 1</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php">inicio</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Ejercicios
            </a>
            <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="registro.php">Ejercicio 1</a></li>
            <li><a class="dropdown-item" href="ejercicio2.php">Ejercicio 2</a></li>
			      <li><a class="dropdown-item" href="ejercicio3.php">Ejercicio 3</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="login.php">formulario login</a></li>
              <li><a class="dropdown-item" href="Enviocorreo.php">formulario Envio correo</a></li>
			  <li><a class="dropdown-item" href="recolecciondatos.php">formulario Recolección de datos</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled" aria-disabled="true"></a>
          </li>
        </ul>
        <form class="d-flex" role="search" method="GET" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input class="form-control me-2" type="search" name="query" placeholder="Buscar" aria-label="Search" required>
        <button class="btn btn-outline-success" type="submit">Buscar</button>
      </form>

      <?php
        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['query'])) {
            $query = htmlspecialchars(trim($_GET['query']));
            
            // Redirigir si se busca "inicio"
            if (strcasecmp($query, 'inicio') === 0) {
                header("Location: index.php");
                exit;
            }
            elseif (strcasecmp($query, 'ejercicios') === 0) {
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

  

  <!-- Footer-->
  <footer class="bg-dark py-4 mt-auto">
            <div class="container px-5">
                <div class="row align-items-center justify-content-between flex-column flex-sm-row">
                    <div class="col-auto"><div class="small m-0 text-white">Garay &copy; Programa_ ingenieria de sistemas</div></div>
                    <div class="col-auto">
                        <a class="link-light small" href="#!">modalidad virtual</a>
                        <span class="text-white mx-1">&middot;</span>
                        <a class="link-light small" href="#!">Ingeniería web I</a>
                        <span class="text-white mx-1">&middot;</span>
                        <a class="link-light small" href="#!">Uniminuto</a>
                    </div>
                </div>
            </div>
        </footer>

  

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <!-- Bootstrap 4 requires Popper.js -->
    <script src="https://unpkg.com/popper.js@1.14.1/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="http://vjs.zencdn.net/6.6.3/video.js"></script>
    <script src="dist/scripts/flat-ui.js"></script>
    <script src="docs/assets/js/application.js"></script>
  </body>
</html>
