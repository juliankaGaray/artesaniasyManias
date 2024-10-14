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
            <li><a class="dropdown-item" href="registro.php">Rregistro</a></li>
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



<!-- Formularioen blanco -->
<form class="container-fluid" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <section class="py-5">
    <div class="container px-5">
      <div class="bg-light rounded-4 py-5 px-4 px-md-5">
        <div class="text-center mb-5">
          <div class="feature  text-white rounded-3 mb-3">
          <img src="docs/assets/images/icons/user-interface.svg" alt="Icono personalizado" class="svg-icon">
          </div>
          <h1 class="fw-bolder">esperando instrucciones</h1>
          <p class="lead fw-normal text-muted mb-0">esperando</p>
        </div>
        <div class="row gx-5 justify-content-center">
          <div class="col-lg-8 col-xl-6">
           <!--table.table-list>tr>td.list-item*4
           form>div*3>label{Campo $}^>input[type=text]  
          form>div*3>div.form-floating.mb-3>(input[type=text name=n placeholder=Nombre required]+label[for=n]Nombre)--

          <form action="">
            <div>
              <div class="form-floating mb-3">
                <input type="text" class="form-contol" name="nombre" id="nombre" placeholder="nombre" required="required">
                <label for="nombre" class="form-label">nombre</label>
                
              </div>
            </div>
            <div>
              <div class="form-floating mb-3">
                <input type="text" class="form-contol" name="n" id="n" placeholder="nombre" required="required"><label for="n"></label>
                <Nombre></Nombre>
              </div>
            </div>
            <div>
              <div class="form-floating mb-3">
                <input type="text" class="form-contol" name="n" id="n" placeholder="nombre" required="required"><label for="n"></label>
                <Nombre></Nombre>
              </div>
            </div>
            <div>
              <div class="form-floating mb-3">
                <input type="text" class="form-contol" name="n" id="n" placeholder="nombre" required="required"><label for="n"></label>
                <Nombre></Nombre>
              </div>
            </div>
            <div>
              <div class="form-floating mb-3">
                <input type="text" class="form-contol" name="n" id="n" placeholder="nombre" required="required"><label for="n"></label>
                <Nombre></Nombre>
              </div>
            </div>
            <div>
              <div class="form-floating mb-3">
                <input type="text" class="form-contol" name="n" id="n" placeholder="nombre" required="required"><label for="n"></label>
                <Nombre></Nombre>
              </div>
            </div>
            <div>
              <div class="form-floating mb-3">
                <input type="text" class="form-contol" name="n" id="n" placeholder="nombre" required="required"><label for="n"></label>
                <Nombre></Nombre>
              </div>
            </div>
          </form>-->


          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="form-floating mb-3">
            <section class="py5">
            <div>
              <div class="mb-3"><label for="nombre" class="form-label">nombre</label><input type="text" class="form-control" name="nombre" id="nombre" placeholder="nombre" required="required"></div>
            </div>
            <div>
              <div class="mb-3"><label for="apellido" class="form-label">apellido</label><input type="text" class="form-control" name="apellido" id="apellido" placeholder="apellido" required="required"></div>
            </div>
            <div>
              <div class="mb-3"><label for="usuario" class="form-label">usuario</label><input type="text" class="form-control" name="usuario" id="usuario" placeholder="usuario" required="required"></div>
            </div>
            <div>
              <div class="mb-3"><label for="correo" class="form-label">correo</label><input type="email" class="form-control" name="email" id="email" placeholder="email@correo.com" required="required"></div>
            </div>
            </section>
          </form>
          <button class="btn btn-primary" id="submit" type="submit"></button>
          
            </div>
        </div>
      </div>
    </div>
  </section>

  

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
