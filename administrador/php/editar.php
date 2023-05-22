<!-- Librería jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Librería de Bootstrap -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>

<!-- PHP PARA EDITAR UN REGISTRO -->

<?php
require_once "conexion.php"; // Incluir el archivo de conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ID = $_POST['ID'];
    $resguardo = $_POST['resguardo'];
    $numeroSerie = $_POST['numeroSerie'];
    $tipo = $_POST['tipo'];
    $modelo = $_POST['modelo'];
    $marca = $_POST['marca'];

    // Llamar a la función de conexión a la base de datos
    $conn = connectDB();

    // Consulta SQL para actualizar el registro en la tabla de equipos
    $query = "UPDATE equipos SET Resguardo = '$resguardo', No_Serie = '$numeroSerie', Tipo = '$tipo', Modelo = '$modelo', Marca = '$marca' WHERE ID = $ID";

    $resultado = mysqli_query($conn, $query);

    if (!$resultado) {
        echo "<script language='javaScript'>
                  alert('ERROR: El registro NO fue actualizado en la BD');
              </script>";
    } else {
        header('Location: tabla-de-equipos.php?registro_actualizado=true');
        echo "<script language='javaScript'>
                  alert('El registro fue actualizado en la BD');
               
              </script>";
        

        exit;
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conn);

}
?>

