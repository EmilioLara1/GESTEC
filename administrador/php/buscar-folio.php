<?php
    session_start();

    require_once "conexion.php"; // Incluir el archivo de conexión a la base de datos

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Obtener los datos del formulario
        $folio = $_POST['folio'];
        
        // Llamar a la función de conexión a la base de datos
        $conn = connectDB();

        // Consulta SQL para verificar si el usuario y contraseña del usuario son válidos
        $query = "SELECT * FROM prestamos WHERE folio = '$folio'";
        $resultado = mysqli_query($conn, $query);
        
        // Verificar si se obtuvieron resultados
        if (mysqli_num_rows($resultado) > 0) {
            header("Location:datos-usuario-gestec.html");
        } else {
            // Inicio de sesión fallido
            echo "Folio incorrecto o no encontrado.";
        }
        
        // Cerrar la conexión a la base de datos
        mysqli_close($conn);
    }
?>