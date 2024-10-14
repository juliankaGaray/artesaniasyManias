<?php 
session_start(); // Iniciar la sesión
include('header.php'); 
include_once "ventas/base_de_datos.php";

// Inicializar el carrito si no está configurado
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

// Consultar los productos
$sentencia = $base_de_datos->query("SELECT * FROM productos;");
$productos = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>

<div class="container-fluid bg-white p-4" style="border-radius: 8px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);">
    <div class="col-xs-12">
        <h1>Productos</h1>
        <br>
        <div class="table-responsive">
            <table class="table table-bordered" style="width: 100%;">
                <thead>
                    <tr>
                        <th>Productos</th>
                        <th>Precio</th>
                        <th>Imagen</th> <!-- Nueva columna para la imagen -->
                        <th>Agregar al carrito</th> <!-- Nueva columna para acciones -->
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($productos as $producto) { ?>
                    <tr>
                        <td><?php echo $producto->descripcion ?></td>
                        <td><?php echo $producto->precioVenta ?></td>
                        <td>
                            <img src="ventas/uploads/<?php echo str_replace('uploads/', '', $producto->imagen) ?>" alt="<?php echo $producto->descripcion ?>" style="width: 50px; height: auto;">
                        </td>
                        <td>
                            <!-- Formulario para agregar al carrito -->
                            <form action="agregar_al_carrito.php" method="POST">
                                <input type="hidden" name="id" value="<?php echo $producto->id; ?>">
                                <input type="hidden" name="descripcion" value="<?php echo $producto->descripcion; ?>">
                                <input type="hidden" name="precio" value="<?php echo $producto->precioVenta; ?>">
                                <input type="hidden" name="imagen" value="<?php echo $producto->imagen; ?>">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-shopping-cart"></i> Agregar al carrito
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Mostrar el carrito -->
    <h2>Carrito de Compras</h2>
    <div>
        <?php if (!empty($_SESSION['carrito'])): ?>
            <ul class="list-group">
                <?php foreach ($_SESSION['carrito'] as $item): ?>
                    <li class="list-group-item">
                        <?php echo $item['descripcion'] . ' - $' . $item['precio']; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No hay productos en el carrito.</p>
        <?php endif; ?>
    </div>
</div>

<?php include('footer.php'); ?>
