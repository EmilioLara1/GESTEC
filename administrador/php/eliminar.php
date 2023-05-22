<!-- Librería jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Librería de Bootstrap -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>


<!-- PHP PARA ELIMINAR UN REGISTRO -->
<?php

require_once "conexion.php"; // Incluir el archivo de conexión a la base de datos

// Llamar a la función de conexión a la base de datos
$conn = connectDB();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
    $ID = $_POST['ID'];

    // Consulta SQL para eliminar un registro de la tabla de equipos
    $query = "DELETE FROM equipos WHERE ID = $ID";

    $resultado = mysqli_query($conn, $query);

    if (!$resultado) {
        echo "<script language='javaScript'>
                  alert('ERROR: El registro NO fue eliminado de la BD');
              </script>";
    } else {
        echo "<script language='javaScript'>
                  alert('El registro fue eliminado de la BD');
              </script>";
        header('Location: tabla-de-equipos.php?registro_eliminado=true');
        exit;
    }

    mysqli_close($conn);
}

?>

