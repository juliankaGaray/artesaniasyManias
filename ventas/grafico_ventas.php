<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Dashboard - SB Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script>
</head>
<body>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Gráfico de Ventas</h1>
        <div class="row">
            <div class="col-xl-8">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-line me-1"></i>
                        Gráfico de Ventas por Fecha
                    </div>
                    <div class="card-body">
                        <canvas id="ventasLineChart" width="100%" height="40"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Realizar la solicitud AJAX para obtener los datos de ventas
            $.ajax({
                url: 'obtener_ventas.php', // El archivo PHP donde obtienes los datos
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    // Generar el gráfico de líneas usando Chart.js
                    var ctx = document.getElementById('ventasLineChart').getContext('2d');
                    var ventasLineChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: data.fechas, // Fechas obtenidas de la BD
                            datasets: [{
                                label: 'Ventas realizadas',
                                data: data.totales, // Totales obtenidos de la BD
                                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                borderColor: 'rgba(54, 162, 235, 1)',
                                borderWidth: 2,
                                fill: true,
                                tension: 0.4 // Curvatura de la línea
                            }]
                        },
                        options: {
                            scales: {
                                x: {
                                    title: {
                                        display: true,
                                        text: 'Fecha de Venta'
                                    }
                                },
                                y: {
                                    beginAtZero: true,
                                    title: {
                                        display: true,
                                        text: 'Total de Ventas'
                                    }
                                }
                            },
                            responsive: true,
                            plugins: {
                                legend: {
                                    display: true
                                }
                            }
                        }
                    });
                },
                error: function(xhr, status, error) {
                    console.log("Error en la solicitud AJAX: ", error);
                }
            });
        });
    </script>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body>
</html>
