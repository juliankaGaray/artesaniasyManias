<?php
// Incluir el archivo de conexión
include('controllers/connection.php');
include('header.php');
$conn = conexion();
// Consulta a la base de datos
  // Cambia 'registro' si es necesario
  $result = $conn->query("SELECT * FROM vista_usuarios" );
?>

                
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Usuarios</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active"><a href="usuarios.php">usuarios</a></li>
                        </ol>
                        
                        <div class="card mb-4">
                            
                            <div class="card-body">
                                
                                    
                                    <div class="container-fluid px-4">
                                        <h1 class="mt-4">Usuarios</h1>
                                        <div class="card mb-4">
                                            
                                            <div class="card-header">
                                                <i class="fas fa-table me-1"></i>
                                                Lista de Usuarios <br>
                                            </div>
                                            <div>  <br>
                                                <a class="btn btn-success" href="/registro.php">registrar usuario <i class="fa fa-plus"></i></a>
                                            </div>
                                            <div class="card-body">
                                                <table id="datatablesSimple" class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Nombre</th>
                                                            <th>Apellido</th>
                                                            <th>Edad</th>
                                                            <th>Ciudad</th>
                                                            <th>Celular</th>
                                                            <th>Usuario</th>
                                                            <th>Contraseña</th>
                                                            <th>rol</th>
                                                        </tr>
                                                    </thead>
                                                    
                                                        <?php
                                                        // Verificar si hay resultados  <tbody> <a href="/registro.php" type="button">registrar usuairo</a>
                                                        if ($result->num_rows > 0) {
                                                            // Mostrar los datos en cada fila
                                                            while ($row = $result->fetch_assoc()) {
                                                                echo "
                                                                        <tr>
                                                                    <td>" . $row['ID'] . "</td>
                                                                    <td>" . $row['nombre'] . "</td>
                                                                    <td>" . $row['apellido'] . "</td>
                                                                    <td>" . $row['edad'] . "</td>
                                                                    <td>" . $row['ciudad'] . "</td>
                                                                    <td>" . $row['celular'] . "</td>
                                                                    <td>" . $row['usuario'] . "</td>
                                                                    <td>" . $row['pass'] . "</td>
                                                                    <td>" . $row['rol_nombre'] . "</td>
                                                                    <td><a class='btn btn-primary' href='controllers/editar_usuario.php?id=" . $row['ID'] . "'>Editar</a>
                                                                        <form action='controllers/eliminar_usuario.php' method='post' style='display:inline;' onsubmit='return confirm(\"¿Estás seguro de que deseas eliminar este usuario?\");'>
                                                                            <input type='hidden' name='id' value='" . $row['ID'] . "'>
                                                                            <button type='submit' class='btn btn-danger'>Eliminar</button>
                                                                        </form>
                                                                    </td>
                                                                </tr>";
                                                                
                                                            }
                                                        } else {
                                                            echo "<tr><td colspan='8'>No hay usuarios registrados</td></tr>";
                                                        }
                                                        ?>
                                                        
                                                        
                                                    </tbody>
                                    
                                    
                                                    

                                                       

                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    </tbody>
                                
                            </div>
                            <?php include('footer.php');?>
                        
