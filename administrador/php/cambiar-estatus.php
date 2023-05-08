<?php
    require_once "conexion.php";

    // Procesamos los datos del formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $interno = $_POST["interno"];
        $externo = $_POST["externo"];

        $conn = connectDB();

        // Actualizamos los datos en la tabla
        $query = "UPDATE estatus_prestamos SET Estatus = '$interno' WHERE Tipo_Prestamo = 'INTERNO'";
        $resultado = mysqli_query($conn, $query);

        $query = "UPDATE estatus_prestamos SET Estatus = '$externo' WHERE Tipo_Prestamo = 'EXTERNO'";
        $resultado = mysqli_query($conn, $query);

        // Cerramos la conexión a la base de datos
        mysqli_close($conn);

        if ($resultado) {
            // Redireccionamos al usuario a otra página si se aplicaron los cambios
            header("Location: cambios-aplicados.html");
            exit();
        } else {
            // Mostramos un mensaje de error si no se pudieron aplicar los cambios
            $mensaje = "Error al actualizar los datos. Por favor, inténtelo de nuevo.";
        }
    }
?>