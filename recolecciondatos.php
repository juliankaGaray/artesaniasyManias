<?php include('header.php') ?>
    
  <?php
  $error = "";
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if (empty($_POST["nombre"]) || empty($_POST["email"]) || empty($_POST["mensaje"])) {
          $error = "El Nombre, Email y Mensaje son obligatorios.";
      } else {
          
      }
  }
  ?>



  <!-- Formulario de contacto -->
  <form class="container-fluid" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <section class="py-5">
      <div class="container px-5">
        <div class="bg-light rounded-4 py-5 px-4 px-md-5">
          <div class="text-center mb-5">
          <div class="text-center mb-5">
          <div class="feature  text-white rounded-3 mb-3">
          <img src="docs/assets/images/icons/clipboard.svg" alt="Icono personalizado" class="svg-icon">
          </div>
          <h1 class="fw-bolder">Recolección de datos</h1>
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

      <!-- Edad input -->
      <div class="form-floating mb-3">
        <input type="number" name="edad" class="form-control" id="edad" placeholder="Tu Edad"  min="1" step="1" required>
        <label for="edad">Edad</label>
      </div>

      <!-- País input -->
      <div class="form-floating mb-3">
        <input type="text" name="pais" class="form-control" id="pais" placeholder="Tu País" pattern="[A-Za-z\s]+" title="Solos se permiten letras y espacios" required>
        <label for="pais">País</label>
      </div>
     

      <!-- Botón enviar -->
      <button class="btn btn-primary" type="submit">Enviar</button>
      
    </form>

    <!-- Mostrar datos ingresados -->
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtener los valores del formulario
        $nombre = htmlspecialchars($_POST['nombre']);
        $email = htmlspecialchars($_POST['email']);
        $edad = htmlspecialchars($_POST['edad']);
        $pais = htmlspecialchars($_POST['pais']);

        // Imprimir los valores
        echo "<div class='mt-5'>";
        echo "<h3>Hola <p><strong>$nombre</strong>  tus datos son:</p></h3>";
        echo "<p><strong>Nombre:</strong> $nombre</p>";
        echo "<p><strong>Correo Electrónico:</strong> $email</p>";
        echo "<p><strong>Edad:</strong> $edad</p>";
        echo "<p><strong>País:</strong> $pais</p>";
        echo "</div>";
    }
    ?>
  </div>
  </div>
      </div>
    </section>
    <?php include('footer.php') ?>