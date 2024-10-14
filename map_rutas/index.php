<?php 
	include_once('class/config.php');
	include_once('class/google.php');
	$google = new Google;
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Google Maps - Rutas</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>/css/base.css">
	<!-- Incluye la API de Google Maps con tu clave API -->
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY"></script>
	<script type="text/javascript" src="<?=BASE_URL?>/js/jquery.js"></script>
	<script type="text/javascript" src="<?=BASE_URL?>/js/functions.js"></script>
</head>
<body>
	<div class="container">
		<table class="table-elements">
			<tr>
				<td>
					<!-- Botón para obtener la ubicación actual -->
					<input type="button" value="Obtener mi ubicación - A" onclick="get_my_location();" class="btn">
				</td>
				<td>
					<!-- Campos para mostrar latitud y longitud obtenidas -->
					<input type="text" placeholder="Latitud" id="my_lat" class="txt" readonly>
				</td>
				<td>
					<input type="text" placeholder="Longitud" id="my_lng" class="txt" readonly>
				</td>
				<td>
					<!-- Dropdown para seleccionar la tienda y dibujar la ruta -->
					<select class="txt" onchange="draw_rute(this.value)">
						<option value="0">Dibujar ruta con &#8595;</option>
						<?=$google->get_stores();?>
					</select>
				</td>
			</tr>
		</table>
		<!-- Div donde se mostrará el mapa -->
		<div class="map" id="map" style="width: 100%; height: 500px;"></div>
	</div>
	<script type="text/javascript">
		// Inicia el mapa cuando la página esté completamente cargada
		window.onload = function() {
			start_map();
		};
	</script>
</body>
</html>
