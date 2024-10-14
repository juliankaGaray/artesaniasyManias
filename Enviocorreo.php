<?php include('header.php'); ?>
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

<?php include('footer.php'); ?>