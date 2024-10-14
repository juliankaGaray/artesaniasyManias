<?php
    // Incluir el archivo de conexión
    include_once('conexion.php');

    class Google {
        private $db;

        public function __construct() {
            // Usar la función conexion() para obtener la conexión a la base de datos
            $this->db = conexion();
        }

        public function get_lat_lng($value) {
            // Preparar la consulta SQL
            $stmt = $this->db->prepare("SELECT tienda_latitud, tienda_longitud FROM tbl_tienda WHERE tienda_id = ? LIMIT 1");
            $stmt->bind_param("s", $value);
            $stmt->execute();
            $result = $stmt->get_result();

            // Inicializar variables lat y lng
            $lat = 0;
            $lng = 0;

            if ($row = $result->fetch_assoc()) {
                $lat = $row['tienda_latitud'];
                $lng = $row['tienda_longitud'];
            }

            // Cerrar la declaración
            $stmt->close();

            // Devolver un array con latitud y longitud
            $array = array('lat' => $lat, 'lng' => $lng);
            return $array;
        }

        public function get_stores() {
            // Preparar la consulta SQL
            $sql = "SELECT tienda_id, tienda_nombre FROM tbl_tienda ORDER BY tienda_nombre";
            $result = $this->db->query($sql);

            $option = '';

            // Generar opciones para un select
            while ($row = $result->fetch_assoc()) {
                $id = $row['tienda_id'];
                $name = $row['tienda_nombre'];
                $option .= '<option value="' . $id . '">' . $name . ' - B</option>';
            }

            // Cerrar la conexión después de usarla
            $this->db->close();

            return $option;
        }
    }

    // Comprobar si se ha enviado el valor por POST
    if (isset($_POST['value'])) {
        $class = new Google;
        $run = $class->get_lat_lng($_POST['value']);
        exit(json_encode($run));
    }
?>
