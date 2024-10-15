<?php
session_start();
include_once "base_de_datos.php";  // Incluimos el archivo de la base de datos
include_once "encabezado.php";
if (!isset($_SESSION["carrito"])) $_SESSION["carrito"] = [];
$granTotal = 0;
?>

<!-- Contenedor principal -->
<div class="container mt-5" style="background-color: white; padding: 20px; border-radius: 5px;">
    <div class="col-xs-12">
        <h1>Comprar</h1>

        <?php
if (isset($_GET["status"])) {
    if ($_GET["status"] === "1") {
        ?>
        <div class="alert alert-success">
            <strong>¡Éxito!</strong> La venta se ha realizado correctamente.
        </div>
        <?php
				// Verifica si existe el ID de la venta en la URL
				if (isset($_GET["id"])) {
					$idVenta = $_GET["id"];
					?>
					<!-- Botón para imprimir el ticket -->
					<div class="text-center mt-4">
						<a href="imprimirTicket.php?id=<?php echo $idVenta; ?>" class="btn btn-primary">Imprimir Ticket</a>
					</div>
					<?php
				}
			} else if ($_GET["status"] === "4") {
				?>
				<div class="alert alert-warning">
					<strong>Error:</strong> El producto que buscas no existe.
				</div>
				<?php
			} else if ($_GET["status"] === "5") {
				?>
				<div class="alert alert-danger">
					<strong>Error:</strong> El producto está agotado.
				</div>
				<?php
			} else {
				?>
				<div class="alert alert-danger">
					<strong>Error:</strong> Algo salió mal mientras se realizaba la venta.
				</div>
				<?php
			}
		}
		?>

		

        <br>

        <!-- Tabla de productos disponibles -->
        <h2>Productos disponibles</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Agregar al carrito</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Consulta de todos los productos
                $productos = $base_de_datos->query("SELECT * FROM productos");
                while ($producto = $productos->fetch(PDO::FETCH_OBJ)) {
                ?>
                    <tr>
                        <!-- Columna de imagen -->
                        <td><img src="<?php echo $producto->imagen; ?>" alt="<?php echo $producto->descripcion; ?>" style="width: 100px; height: 100px;"></td>
                        <!-- Columna de nombre -->
                        <td><?php echo $producto->descripcion; ?></td>
                        <!-- Columna de precio -->
                        <td>$<?php echo $producto->precioVenta; ?></td>
                        <!-- Botón para agregar al carrito -->
                        <td>
                            <form method="post" action="agregarAlCarrito.php">
                                <input type="hidden" name="codigo" value="<?php echo $producto->codigo; ?>">
                                <button type="submit" class="btn btn-primary">Agregar al carrito</button>
                            </form>
                        </td>
                    </tr>
                <?php
                }
                ?>
				
            </tbody>
        </table>

        <br><br>
		<a href="verificacion_tarjeta.php" class="btn btn-warning">Verificación de tarjeta</a>
        <!-- Tabla del carrito -->
        <h2>Carrito</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Código</th>
                    <th>Descripción</th>
                    <th>Precio de venta</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                    <th>Quitar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($_SESSION["carrito"] as $indice => $producto) {
                    $granTotal += $producto->total;
                ?>
                    <tr>
                        <td><?php echo $producto->id ?></td>
                        <td><?php echo $producto->codigo ?></td>
                        <td><?php echo $producto->descripcion ?></td>
                        <td><?php echo $producto->precioVenta ?></td>
                        <td>
                            <form action="cambiar_cantidad.php" method="post">
                                <input name="indice" type="hidden" value="<?php echo $indice; ?>">
                                <input min="1" name="cantidad" class="form-control" required type="number" step="0.1" value="<?php echo $producto->cantidad; ?>">
                            </form>
                        </td>
                        <td><?php echo $producto->total ?></td>
                        <td><a class="btn btn-danger" href="<?php echo "quitarDelCarrito.php?indice=" . $indice ?>"><i class="fa fa-trash"></i></a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <h3>Total: <?php echo $granTotal; ?></h3>
        <form action="./terminarVenta.php" method="POST">
            <input name="total" type="hidden" value="<?php echo $granTotal; ?>">
            <button type="submit" class="btn btn-success">Terminar venta</button>
            <a href="./cancelarVenta.php" class="btn btn-danger">Cancelar venta</a>
        </form>
    </div>
</div>

<?php include_once "pie.php" ?>
