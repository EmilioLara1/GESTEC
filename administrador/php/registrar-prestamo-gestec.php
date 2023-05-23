<?php
    session_start();

    require_once "conexion.php";

    // Llamar a la función de conexión a la base de datos
    $conn = connectDB();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtener el valor seleccionado del select
        $id = $_POST["id"];

        $folio = $_SESSION['folio'];

        $queryID = "UPDATE prestamos SET ID = '$id' WHERE Folio = '$folio'";
        $resultadoInsercion = mysqli_query($conn, $queryID);
        
        $query = "SELECT Fecha_Prestamo, Fecha_Devolucion FROM prestamos WHERE ID = $id AND folio = '$folio'";
        $resultado = mysqli_query($conn, $query);

        // Obtener las fechas de entrega y devolución
        $fila = mysqli_fetch_assoc($resultado);
        $fechaPrestamo = $fila['Fecha_Prestamo'];
        $fechaDevolucion = $fila['Fecha_Devolucion'];

        // Convertir las fechas a objetos DateTime
        $fechaPrestamoObj = new DateTime($fechaPrestamo);
        $fechaDevolucionObj = new DateTime($fechaDevolucion);

        // Sumar 3 horas a la fecha de préstamo
        $fechaDevolucionObj->add(new DateInterval('PT3H'));

        // Formatear la fecha de devolución
        $nuevaFechaDevolucion = $fechaDevolucionObj->format('Y-m-d H:i:s');

        // Actualizar la fecha de devolución en la base de datos
        $queryFechaDevolucion = "UPDATE prestamos SET Fecha_Devolucion = '$nuevaFechaDevolucion' WHERE Folio = '$folio'";
        $resultadoFechaDevolucion = mysqli_query($conn, $queryFechaDevolucion);

        // Obtener la fecha actual
        $fechaActual = new DateTime();
        $fechaActual->setTime(0, 0, 0);

        // Comparar solo la fecha de devolución con la fecha actual
        $fechaDevolucionComparar = $fechaDevolucionObj->format('Y-m-d H:i:s');
        $fechaActualComparar = $fechaActual->format('Y-m-d H:i:s');

        if ($fechaDevolucionComparar < $fechaActualComparar) {
            $estatus = "RETRASADO";
        } else {
            $estatus = "ACTIVO";
        }
    
        // Actualizar el estado del préstamo en la base de datos
        $queryEstatus = "UPDATE prestamos SET Estatus = '$estatus' WHERE Folio = '$folio'";
        $resultadoEstatus = mysqli_query($conn, $queryEstatus);
    
        if ($resultadoEstatus) {
            if ($estatus == "RETRASADO") {
                header("Location: prestamo-denegado.html");
            } else {
                header("Location: prestamo-registrado.html");
            }
        } else {
            // Si la consulta no se ejecutó correctamente, redirigimos al usuario al segundo paso del formulario con un mensaje de error
            echo "Ha ocurrido un error al registrar el estatus en la base de datos";
        }

        /* if ($fechaDevolucionComparar < $fechaActualComparar) {
            $estatus = "RETRASADO";
            
            // Actualizar el estado del préstamo en la base de datos
            $queryEstatus = "UPDATE prestamos SET Estatus = '$estatus' WHERE Folio = '$folio'";
            $resultadoEstatus = mysqli_query($conn, $queryEstatus);

            header("Location: prestamo-denegado.html");
        } else {
            $estatus = "ACTIVO";

            // Actualizar el estado del préstamo en la base de datos
            $queryEstatus = "UPDATE prestamos SET Estatus = '$estatus' WHERE Folio = '$folio'";
            $resultadoEstatus = mysqli_query($conn, $queryEstatus);

            header("Location: prestamo-registrado.html");
        } */

        // Liberar memoria y cerrar la conexión
        mysqli_free_result($resultado);
        mysqli_close($conn);
    }

    
?>