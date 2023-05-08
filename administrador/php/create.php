<?php
	require_once "conexion.php"; // Incluir el archivo de conexión a la base de datos

    // Obtener los datos del formulario o de cualquier otra fuente
    //$nombre_busqueda = $_GET['nombre_busqueda'];
    
    // Llamar a la función de conexión a la base de datos
    $conn = connectDB();
    
    // Consulta SQL para obtener registros de la tabla de alumnos
    $query = "SELECT * FROM equipos";
    $resultado = mysqli_query($conn, $query);
    
    // Verificar si se obtuvieron resultados
    if (mysqli_num_rows($resultado) > 0) {
        // Recorrer los resultados y mostrarlos en pantalla o utilizarlos de otra forma
        while ($fila = mysqli_fetch_assoc($resultado)) {

            ?>
              <tr>
                 <td scope="row">
                     <div>
                        <input class="form-check-input" type="checkbox" id="checkboxNoLabel" value="" aria-label="...">
                     </div>
                </td>
                <td><?php echo $fila['ID']; ?></td>
                <td><?php echo $fila['Resguardo']; ?></td>
                <td><?php echo $fila['No_Serie']; ?></td>
                <td><?php echo $fila['Tipo']; ?></td>
                <td><?php echo $fila['Modelo']; ?></td>
                <td><?php echo $fila['Marca']; ?></td>
              </tr>
            <?php 

            //echo $fila['ID'] . " - " . $fila['Resguardo'] . " - " . $fila['No_Serie'] . " - " . 
            // $fila['Tipo'] . " - " . $fila['Modelo'] ."<br>";
        }
    } else {
        // No se encontraron resultados
        echo "No se encontraron alumnos con el nombre ingresado.";
    }
    
    // Cerrar la conexión a la base de datos
    mysqli_close($conn);
?>