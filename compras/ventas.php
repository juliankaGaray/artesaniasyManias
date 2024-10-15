<?php include_once "encabezado.php"; ?>
<?php
include_once "base_de_datos.php";
$sentencia = $base_de_datos->query("SELECT ventas.total, ventas.fecha, ventas.id, GROUP_CONCAT(productos.codigo, '..', productos.descripcion, '..', productos_vendidos.cantidad SEPARATOR '__') AS productos FROM ventas INNER JOIN productos_vendidos ON productos_vendidos.id_venta = ventas.id INNER JOIN productos ON productos.id = productos_vendidos.id_producto GROUP BY ventas.id ORDER BY ventas.id;");
$ventas = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>

<div class="container bg-white p-4" style="max-width: 1200px; border-radius: 8px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);">
    <div class="col-xs-12">
        <h1 class="text-center">Ventas</h1>
        <div class="text-right">
            <a class="btn btn-success" href="./vender.php">Nueva <i class="fa fa-plus"></i></a>
        </div>
        <br>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>Número</th>
                        <th>Fecha</th>
                        <th>Productos vendidos</th>
                        <th>Total</th>
                        <th>Ticket</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($ventas as $venta){ ?>
                    <tr>
                        <td><?php echo $venta->id ?></td>
                        <td><?php echo $venta->fecha ?></td>
                        <td>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Código</th>
                                            <th>Descripción</th>
                                            <th>Cantidad</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach(explode("__", $venta->productos) as $productosConcatenados){ 
                                        $producto = explode("..", $productosConcatenados);
                                        ?>
                                        <tr>
                                            <td><?php echo $producto[0] ?></td>
                                            <td><?php echo $producto[1] ?></td>
                                            <td><?php echo $producto[2] ?></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </td>
                        <td><?php echo $venta->total ?></td>
                        <td><a class="btn btn-info" href="<?php echo "imprimirTicket.php?id=" . $venta->id; ?>"><i class="fa fa-print"></i></a></td>
                        <td><a class="btn btn-danger" href="<?php echo "eliminarVenta.php?id=" . $venta->id; ?>"><i class="fa fa-trash"></i></a></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include_once "pie.php"; ?>
