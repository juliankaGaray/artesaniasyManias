<?php include('header.php'); ?>
    
    <!-- Formulario de contacto -->
  <!-- -------- START HEADER 8 w/ card over right bg image ------- -->
  <section>
      <div class="page-header min-vh-100">
        <div class="container">
          <div class="row">
            <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 start-0 text-center justify-content-center flex-column">
              <div class="position-relative h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center" style="background-image: url('kit-master/assets/img/logofucsia.png'); background-size: cover;" loading="lazy"></div>
            </div>
            <div class="col-xl-6 col-lg-0 col-md-7 d-flex flex-column ms-auto me-auto ms-lg-auto me-lg-0">
              <div class="card d-flex blur justify-content-center shadow-lg my-sm-0 my-sm-6 mt-8 mb-5">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                  <div class="bg-gradient-primary shadow-primary border-radius-lg p-3">
                    <h3 class="text-white text-primary mb-0">Envianos tus comentarios</h3>
                  </div>
                </div>
                <div class="card-body">
                  <p class="pb-3">
                  Si tiene más preguntas, envíe un correo electrónico a artesaniasymanias@correo.com
                  o contáctenos mediante nuestro formulario de contacto.
                  </p>
                  <form id="contact-form" method="post" autocomplete="off" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="card-body p-0 my-3">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="input-group input-group-static mb-4">
                            <label>Nombre</label>
                            <input type="text" class="form-control" placeholder="Nombre completo">
                          </div>
                        </div>
                        <div class="col-md-6 ps-md-2">
                          <div class="input-group input-group-static mb-4">
                            <label>Correo</label>
                            <input type="email" class="form-control" placeholder="corre@dominio.com">
                          </div>
                        </div>
                      </div>
                      <div class="form-group mb-0 mt-md-0 mt-4">
                        <div class="input-group input-group-static mb-4">
                          <label>Cómo te podemos ayudar?</label>
                          <textarea name="message" class="form-control" id="message" rows="6" placeholder="Mensaje 250 caracteres"></textarea>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12 text-center">
                          <button type="submit" class="btn bg-gradient-primary mt-3 mb-0">enviamos tu mensaje</button>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

        <!-- Muestra el mensaje de error si existe -->
        <?php
        if (!empty($error)) {
            echo "<div class='alert alert-danger mt-3'>$error</div>";
        }
        ?>
      </div>
    </div>

  <?php include('footer.php'); ?>