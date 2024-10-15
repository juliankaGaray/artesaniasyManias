<?php include('header.php'); ?>

<?php
include_once "ventas/base_de_datos.php";
$sentencia = $base_de_datos->query("SELECT * FROM productos;");
$productos = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>

<div class="container-fluid bg-white p-4" style="border-radius: 8px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);">
  <div class="col-xs-12">
    <h1>Catalogo de Productos</h1>
    
    <br>
    <div class="table-responsive">
      <table class="table table-bordered" style="width: 100%;">
        <thead>
          <tr>
            
            <th>Productos</th>
            
            <th>Precio </th>
            
            <th>Imagen</th> <!-- Nueva columna para la imagen -->
            <th>Realiza tu compra</th> <!-- Nueva columna para acciones -->
          </tr>
        </thead>
        <tbody>
          <?php foreach($productos as $producto){ ?>
          <tr>
            
            <td><?php echo $producto->descripcion ?></td>
            
            <td><?php echo $producto->precioVenta ?></td>
            
            <td>
                <img src="ventas/uploads/<?php echo str_replace('uploads/', '', $producto->imagen) ?>" alt="<?php echo $producto->descripcion ?>" style="width: 50px; height: auto;">
            </td>
            <td>
              <!-- Botón para agregar a la venta -->
              <a class="btn btn-info" href="/compras/vender.php?id=<?php echo $producto->id; ?>">
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
