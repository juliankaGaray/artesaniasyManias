<?php include('header.php'); ?>

<?php
include_once "ventas/base_de_datos.php";
$sentencia = $base_de_datos->query("SELECT * FROM productos;");
$productos = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>

<div class="container bg-white p-4" style="max-width: 1200px; border-radius: 8px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);">
  <div class="col-xs-12">
    <h1 class="text-center">Catálogo de Productos</h1>
    
    <br>
    <div class="table-responsive">
      <table class="table table-striped table-hover" style="width: 100%;">
        <thead>
          <tr>
            <th>Imagen</th>
            <th>Productos</th>
            <th>Precio</th>
            <th>Realiza tu compra</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($productos as $producto){ ?>
          <tr>
            <td>
                <img src="ventas/uploads/<?php echo str_replace('uploads/', '', $producto->imagen) ?>" 
                     alt="<?php echo $producto->descripcion ?>" 
                     style="width: 100%; max-width: 150px; height: auto; border: 2px solid #007bff; border-radius: 5px; box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);">
            </td>
            <td><?php echo $producto->descripcion ?></td>
            <td><?php echo $producto->precioVenta ?></td>
            <td>
              <a class="btn btn-success" href="/compras/vender.php?id=<?php echo $producto->id; ?>">
                  <i class="fas fa-shopping-cart"></i> Comprar
              </a>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php include('footer.php'); ?>
