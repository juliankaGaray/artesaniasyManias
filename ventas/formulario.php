<?php include_once "encabezado.php" ?>

<div class="col-xs-12">
    <h1>Nuevo producto</h1>
    <form method="post" action="nuevo.php" enctype="multipart/form-data"> <!-- Añadir enctype -->
        <label for="codigo">Código de barras:</label>
        <input class="form-control" name="codigo" required type="text" id="codigo" placeholder="Escribe el código">

        <label for="descripcion">Descripción:</label>
        <textarea required id="descripcion" name="descripcion" cols="30" rows="5" class="form-control"></textarea>

        <label for="precioVenta">Precio de venta:</label>
        <input class="form-control" name="precioVenta" required type="number" id="precioVenta" placeholder="Precio de venta">

        <label for="precioCompra">Precio de compra:</label>
        <input class="form-control" name="precioCompra" required type="number" id="precioCompra" placeholder="Precio de compra">

        <label for="existencia">Existencia:</label>
        <input class="form-control" name="existencia" required type="number" id="existencia" placeholder="Cantidad o existencia">

        <label for="imagen">Imagen:</label> <!-- Campo para subir imagen -->
        <input class="form-control" name="imagen" required type="file" id="imagen" accept="image/*"> <!-- Solo acepta imágenes -->

        <br><br>
        <input class="btn btn-success" type="submit" value="Guardar">
        <a href="index.php" class="btn btn-danger" type="onclick">volver</a>
    </form>
</div>
<?php include_once "pie.php" ?>
