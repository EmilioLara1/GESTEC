<?php
    require_once "conexion.php";

    // Obtiene el valor del select enviado por el formulario
    $select = $_POST['select'];

    // Llamar a la función de conexión a la base de datos
    $conn = connectDB();

    // Verifica qué opción se seleccionó y redirige a la página correspondiente
    if ($select == "interno") {
        $query = "SELECT * FROM estatus_prestamos WHERE Tipo_Prestamo = 'INTERNO' AND Estatus = 'habilitado'";
        $resultado = mysqli_query($conn, $query);
        
        if (mysqli_num_rows($resultado) > 0) {
            header("Location: solicitud-aceptada-interno.html.php");
            exit();
        } else {
            header("Location: solicitud-rechazada.html");
            exit();
        }
    } else if ($select == "externo") {
        $query = "SELECT * FROM estatus_prestamos WHERE Tipo_Prestamo = 'EXTERNO' AND Estatus = 'habilitado'";
        $resultado = mysqli_query($conn, $query);

        if (mysqli_num_rows($resultado) > 0) {
            header("Location: subir-documentos.html");
            exit();
        } else {
            header("Location: convocatoria-cerrada.html");
            exit();
        }
    } else {
        // Si no se seleccionó ninguna opción, redirige a una página de error
        echo "No seleccionaste ninguna opción.";
        exit();
    }
?>