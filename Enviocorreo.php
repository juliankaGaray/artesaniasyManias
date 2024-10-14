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
    <!-- estilo adicional -->
    <link href="app/css/styles.css" rel="stylesheet" />
  </head>
  <body>
    
  <?php
  $error = "";
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if (empty($_POST["nombre"]) || empty($_POST["email"]) || empty($_POST["mensaje"])) {
          $error = "El Nombre, Email y Mensaje son obligatorios.";
      } else {
          // Aquí puedes procesar el formulario, como enviar un correo.
          // espacio para la lógica de manejo de datos.
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
          <li><a class="dropdown-item" href="ejercicio1.php">Ejercicio 1</a></li>
          <li><a class="dropdown-item" href="ejercicio2.php">Ejercicio 2</a></li>
			    <li><a class="dropdown-item" href="ejercicio3.php">Ejercicio 3</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="banner.php">formulario login</a></li>
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

  <!-- Formulario de contacto -->
  <form class="container-fluid" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <section class="py-5">
      <div class="container px-5">
        <div class="bg-light rounded-4 py-5 px-4 px-md-5">
          <div class="text-center mb-5">
          <div class="text-center mb-5">
          <div class="feature  text-white rounded-3 mb-3">
          <img src="docs/assets/images/icons/mail.svg" alt="Icono personalizado" class="svg-icon">
          </div>
            <h1 class="fw-bolder">Contáctanos</h1>
            <p class="lead fw-normal text-muted mb-0">Estamos aquí para ayudarte. Envíanos tus comentarios o preguntas.</p>
          </div>
          <div class="row gx-5 justify-content-center">
            <div class="col-lg-8 col-xl-6">
              <!-- nombre input-->
              <div class="form-floating mb-3">
                <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Tu Nombre">
                <label for="nombre">Nombre</label>
              </div>
              <!-- correo input-->
              <div class="form-floating mb-3">
                <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com">
                <label for="email">Correo Electrónico</label>
              </div>
              <!-- mensaje input -->
              <div class="form-floating mb-3">
                <textarea class="form-control" name="mensaje" id="mensaje" placeholder="Escribe tu mensaje aquí" style="height: 150px"></textarea>
                <label for="mensaje">Mensaje</label>
              </div>
              <!-- boton enviar -->
              <div class="d-grid">
                <button class="btn btn-primary btn-lg" type="submit">Enviar</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </form>

  <!-- Muestra el mensaje de error si existe -->
  <?php
  if (!empty($error)) {
      echo "<div class='alert alert-danger mt-3'>$error</div>";
  }
  ?>

  <!-- Footer-->
  <footer class="bg-dark py-4 mt-auto">
    <div class="container px-5">
      <div class="row align-items-center justify-content-between flex-column flex-sm-row">
        <div class="col-auto"><div class="small m-0 text-white">Garay &copy; Programa Ingeniería de Sistemas</div></div>
        <div class="col-auto">
          <a class="link-light small" href="#!">Modalidad Virtual</a>
          <span class="text-white mx-1">&middot;</span>
          <a class="link-light small" href="#!">Ingeniería Web I</a>
          <span class="text-white mx-1">&middot;</span>
          <a class="link-light small" href="#!">Uniminuto</a>
        </div>
      </div>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/popper.js@1.14.1/dist/umd/popper.min.js" crossorigin="anonymous"></script>
  <script src="dist/scripts/flat-ui.js"></script>
  <script src="docs/assets/js/application.js"></script>
  </body>
</html>
