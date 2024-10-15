
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>Dashboard - Productos Más Vendidos</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script>

        
    </head>
    <body>
        <!-- -------- inicio style ------- -->
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
        <img src="/kit-master/assets/img/logo-ct-dark.png" alt="Logo" style="height: 40px; margin-right: 10px;">
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
            <li><a class="dropdown-item" href="/registro.php">Registro</a></li>
            <li><a class="dropdown-item" href="/catalogo.php">Catálogo</a></li>
            
			      <li><a class="dropdown-item" href="/mision_vision.php">Misión y visión</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="/login.php">Inicio de sesión</a></li>
			<li><a class="dropdown-item" href="/Enviocorreo.php">Envio correo</a></li>
			<li><a class="dropdown-item" href="/nosotros.php">Sobre nosotros</a></li>
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
<!-- -------- fin NAVBAR ------- -->
        <div class="container bg-white p-4" style="max-width: 1200px; border-radius: 8px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);">
        <div class="col-xs-12">
            <h1 class="mt-4">Gráfico de Productos Más Vendidos</h1>
            <br>
    <div class="table-responsive">
      <table class="table table-striped table-hover" style="width: 100%;">
            <div class="row">
                <div class="col-xl-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-bar me-1"></i>
                            Productos Más Vendidos
                        </div>
                        <div class="card-body">
                            <canvas id="productosMasVendidosChart" width="100%" height="40"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </table>
    <div class="col-xl-3 col-md-6">
                                <div class="card bg-info text-white mb-4">
                                    <div class="card-body">volver</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="/ventas/index.php">ir a modulo ventas</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
    </div>

        <script>
            $(document).ready(function() {
                // Hacer la solicitud AJAX
                $.ajax({
                    url: 'obtener_producto.php', 
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        // Procesar los datos y construir el gráfico
                        const productos = data.map(item => item.producto);
                        const totales = data.map(item => item.total_vendido);

                        const ctx = document.getElementById('productosMasVendidosChart').getContext('2d');
                        const productosMasVendidosChart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: productos,
                                datasets: [{
                                    label: 'Cantidad Vendida',
                                    data: totales,
                                    backgroundColor: 'rgba(75, 192, 192, 0.6)',
                                    borderColor: 'rgba(75, 192, 192, 1)',
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Error al obtener los datos:', textStatus, errorThrown);
                    }
                });
            });
        </script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    <!-- Footer-->
<footer class="footer pt-5 mt-5">
  <div class="container">
    <div class="row">
      <div class="d-flex align-items-center">
        <a href="https://www.creative-tim.com/product/material-kit">
          <img src="/kit-master/assets/img/logo-ct-dark.png" class="footer-logo" alt="main_logo" style="height: 40px; margin-right: 10px;">
        </a>
        <h6 class="font-weight-bolder mb-0">Artesanías y Manías</h6>
      </div>
    </div>
    <div class="col-12">
      <div class="text-center">
        <p class="text-dark my-4 text-sm font-weight-normal">
         Uniminuto a disticania ingeniería de sistemas © <script>
            document.write(new Date().getFullYear())
          </script> Ejercicios 5 y 6 ingeniería Web 1 <a>Grupo 23</a>.
        </p>
      </div>
    </div>
  </div>
</footer>




</div>
</div>
  <!-- Control Center for Material UI Kit: parallax effects, scripts for the example pages etc -->
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDTTfWur0PDbZWPr7Pmq8K3jiDp0_xUziI"></script>
  <script src="kit-master/assets/js/material-kit.min.js?v=3.0.4" type="text/javascript"></script>
  <script>
  // get the element to animate
    var element = document.getElementById('count-stats');
    var elementHeight = element.clientHeight;

    // listen for scroll event and call animate function

    document.addEventListener('scroll', animate);

    // check if element is in view
    function inView() {
      // get window height
      var windowHeight = window.innerHeight;
      // get number of pixels that the document is scrolled
      var scrollY = window.scrollY || window.pageYOffset;
      // get current scroll position (distance from the top of the page to the bottom of the current viewport)
      var scrollPosition = scrollY + windowHeight;
      // get element position (distance from the top of the page to the bottom of the element)
      var elementPosition = element.getBoundingClientRect().top + scrollY + elementHeight;

      // is scroll position greater than element position? (is element in view?)
      if (scrollPosition > elementPosition) {
        return true;
      }

      return false;
    }

    var animateComplete = true;
    // animate element when it is in view
    function animate() {

      // is element in view?
      if (inView()) {
        if (animateComplete) {
          if (document.getElementById('state1')) {
            const countUp = new CountUp('state1', document.getElementById("state1").getAttribute("countTo"));
            if (!countUp.error) {
              countUp.start();
            } else {
              console.error(countUp.error);
            }
          }
          if (document.getElementById('state2')) {
            const countUp1 = new CountUp('state2', document.getElementById("state2").getAttribute("countTo"));
            if (!countUp1.error) {
              countUp1.start();
            } else {
              console.error(countUp1.error);
            }
          }
          if (document.getElementById('state3')) {
            const countUp2 = new CountUp('state3', document.getElementById("state3").getAttribute("countTo"));
            if (!countUp2.error) {
              countUp2.start();
            } else {
              console.error(countUp2.error);
            };
          }
          animateComplete = false;
        }
      }
    }

    if (document.getElementById('typed')) {
      var typed = new Typed("#typed", {
        stringsElement: '#typed-strings',
        typeSpeed: 90,
        backSpeed: 90,
        backDelay: 200,
        startDelay: 500,
        loop: true
      });
    }
  </script>
  <script>
    if (document.getElementsByClassName('page-header')) {
      window.onscroll = debounce(function() {
        var scrollPosition = window.pageYOffset;
        var bgParallax = document.querySelector('.page-header');
        var oVal = (window.scrollY / 3);
        bgParallax.style.transform = 'translate3d(0,' + oVal + 'px,0)';
      }, 6);
    }
  </script>



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
   
    