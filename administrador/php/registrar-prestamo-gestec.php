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

        // Obtener la fecha de entrega actual
        $consultaFechaPrestamo = "SELECT Fecha_Prestamo FROM prestamos WHERE ID = $id AND folio = '$folio'";
        $resultadoFechaPrestamo = mysqli_query($conn, $consultaFechaPrestamo);
        $filaFechaPrestamo = mysqli_fetch_assoc($resultadoFechaPrestamo);
        $fechaFechaPrestamo = $filaFechaPrestamo['Fecha_Prestamo'];

        // Calcular la fecha de devolución (3 horas después)
        $fechaDevolucion = date('Y-m-d H:i:s', strtotime($fechaFechaPrestamo . ' + 3 hours'));

        // Actualizar la fecha de devolución en la tabla
        $consulta = "UPDATE prestamos SET Fecha_Devolucion = '$fechaDevolucion'";

        if (mysqli_query($conn, $consulta)) {
            echo "Fecha de devolución actualizada exitosamente.";
          } else {
            echo "Error al actualizar la fecha de devolución: " . mysqli_error($conn);
          }
        
        // Ingresar estatus
        $query = "SELECT Fecha_Prestamo, Fecha_Devolucion FROM prestamos WHERE ID = $id AND folio = '$folio'";
        $resultado = mysqli_query($conn, $query);

        // Obtener las fechas de entrega y devolución
        $fila = mysqli_fetch_assoc($resultado);
        $fechaPrestamo = $fila['Fecha_Prestamo'];
        $fechaDevolucion = $fila['Fecha_Devolucion'];

        // Convertir las fechas a objetos DateTime
        $fechaPrestamoObj = new DateTime($fechaPrestamo);
        $fechaDevolucionObj = new DateTime($fechaDevolucion);

        // Calcular la diferencia en días entre las fechas
        $diferenciaDias = $fechaPrestamoObj->diff($fechaDevolucionObj);

        // Obtener la diferencia en días y horas
        $dias = $diferencia->days;
        $horas = $diferencia->h;

        // Determinar el estado del préstamo
        if ($dias > 0 || $horas > 0) {
            $estado = "RETRASADO";
            $query = "UPDATE prestamos SET Estatus = '$estatus' WHERE Folio = '$folio'";
            if ($conn->query($query) === TRUE) {
                header("Location: prestamo-denegado.html");
            } else {
                // Si la consulta no se ejecutó correctamente, redirigimos al usuario al segundo paso del formulario con un mensaje de error
                echo "Ha ocurrido un error al registrar el estatus en la base de datos";
            }
        } else {
            $estado = "ACTIVO";
            $query = "UPDATE prestamos SET Estatus = '$estatus' WHERE Folio = '$folio'";
            if ($conn->query($query) === TRUE) {
                header("Location: prestamo-resgistrado.html");
            } else {
                // Si la consulta no se ejecutó correctamente, redirigimos al usuario al segundo paso del formulario con un mensaje de error
                echo "Ha ocurrido un error al registrar el estatus en la base de datos";
            }
        }


        // Liberar memoria y cerrar la conexión
        mysqli_free_result($resultado);
        mysqli_close($conn);
    }

    
?>