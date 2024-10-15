<?php include('encabezado.php') ?>

<?php

function luhn($number) {
    $vali = true;
    $sum = 0;
    foreach(array_reverse(str_split($number)) as $num) {
        $sum += array_sum(str_split(($vali = !$vali) ? $num * 2 : $num));
    }
    return $sum % 10 == 0; 
}
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Usuarios</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="usuarios.php">Usuarios</a></li>
    </ol>

    <div class="card mb-4">
        <div class="card-body">
            <div class="container-fluid px-4">
                <h1 class="mt-4">Verificación de Tarjeta</h1>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Verificación Número de tarjeta 
                    </div>
                    <div>
                        <form action="" method="POST" class="td">
                            <div class="mb-3">
                                <label for="tarjeta" class="form-label"> ingrese su Número de tarjeta</label>
                                <input type="text" class="form-control" id="tarjeta" name="tarjeta" placeholder="Ingrese número de tarjeta sin espacios" required>
                            </div>
                            <button type="submit" class="btn btn-success">Validar tarjeta</button>
                        </form>

                        <?php
                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            $tarjeta = $_POST['tarjeta'];

                           
                            if (!is_numeric($tarjeta)) {
                                echo "<div class='alert alert-danger mt-3'>El número ingresado no es válido. Asegúrese de ingresar solo dígitos.</div>";
                            } else {
                                if (luhn($tarjeta)) {
                                    echo "<div class='alert alert-success mt-3'>El número de tarjeta es válido.</div>";
                                } else {
                                    echo "<div class='alert alert-danger mt-3'>El número de tarjeta no es válido.</div>";
                                }
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('pie.php') ?>
