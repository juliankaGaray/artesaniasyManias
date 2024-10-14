<?php 
include('app/config.php');
$conexion = conexion(); // Llamar la función para obtener la conexión a la base de datos
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="public/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body style="background-image: url('public/imagenes/piso.jpg');
    background-repeat: no-repeat;
    z-index: -3;
    background-size: 100vw 100vh">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">
        <img src="<?php echo $URL;?>/public/imagenes/auto1.png" width="20" height="30" alt="" loading="lazy">
        SISPARQUEO
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">INICIO <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">SOBRE NOSOTROS</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    PROMOCIONES
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">MENSUALES</a>
                    <a class="dropdown-item" href="#">DÍAS</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">FICHAS</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">CONTACTANOS</a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        </form>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            Ingresar
        </button>
    </div>
</nav>

<br>

<div class="container">
    <div class="row">
    <?php
        $query_mapeos = "SELECT * FROM tb_mapeos WHERE estado = '1'";
        $resultado = $conexion->query($query_mapeos); // Ejecutar consulta con mysqli
        
        if ($resultado) {
            while ($mapeo = $resultado->fetch_assoc()) { // Obtener resultados como array asociativo
                $id_map = $mapeo['id_map'];
                $nro_espacio = $mapeo['nro_espacio'];
                $estado_espacio = $mapeo['estado_espacio'];

                if ($estado_espacio == "LIBRE") { ?>
                    <div class="col">
                        <center>
                            <h2><?php echo $nro_espacio; ?></h2>
                            <button class="btn btn-success" style="width: 100%;height: 114px">
                                <p><?php echo $estado_espacio; ?></p>
                            </button>
                        </center>
                    </div>
                <?php } elseif ($estado_espacio == "OCUPADO") { ?>
                    <div class="col">
                        <center>
                            <h2><?php echo $nro_espacio; ?></h2>
                            <button class="btn btn-info">
                                <img src="<?php echo $URL; ?>/public/imagenes/auto1.png" width="60px" alt="">
                            </button>
                            <p><?php echo $estado_espacio; ?></p>
                        </center>
                    </div>
                <?php }
            }
        } else {
            echo "Error en la consulta: " . $conexion->error;
        }
    ?>
    </div>
</div>

<script src="public/js/jquery-3.5.1.min.js"></script>
<script src="public/js/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="public/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
</body>
</html>
