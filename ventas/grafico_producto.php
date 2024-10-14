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
    <div class="container-fluid px-4">
        <h1 class="mt-4">Gráfico de Productos Más Vendidos</h1>
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
</body>
</html>
