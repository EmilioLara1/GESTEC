<?php 
    require_once "conexion.php";

    // Obtiene el valor del radio enviado por el formulario
    $radioInterno = $_POST['radioInterno'];
    $radioExterno = $_POST['radioExterno'];

    // Llamar a la función de conexión a la base de datos
    $conn = connectDB();
  
    // Verifica qué opción se seleccionó y redirige a la página correspondiente
    if ($radioInterno == "internoAbierto") {
        $queryInternoAbierto = "UPDATE estatus_prestamos SET Estatus ='$radioInterno' WHERE Tipo_Prestamo = INTERNO";

        // Ejecutamos la consulta SQL para insertar los datos del usuario en la tabla "usuarios"
        if ($conn->query($queryInternoAbierto) === TRUE) {
            // Si la consulta se ejecutó correctamente, redirigimos al usuario a la página de inicio con un mensaje de éxito
            header("Location: cambios-aplicados.html");
        } else {
            // Si la consulta no se ejecutó correctamente, redirigimos al usuario al segundo paso del formulario con un mensaje de error
            echo "Cambios no aplicados";
            exit();
        }
    } else if ($radioInterno == "internoCerrado") {
        $queryInternoCerrado = "UPDATE estatus_prestamos SET Estatus ='$radioInterno' WHERE Tipo_Prestamo = INTERNO";

        // Ejecutamos la consulta SQL para insertar los datos del usuario en la tabla "usuarios"
        if ($conn->query($queryInternoCerrado) === TRUE) {
            // Si la consulta se ejecutó correctamente, redirigimos al usuario a la página de inicio con un mensaje de éxito
            header("Location: cambios-aplicados.html");
        } else {
            // Si la consulta no se ejecutó correctamente, redirigimos al usuario al segundo paso del formulario con un mensaje de error
            echo "Cambios no aplicados";
            exit();
        }
    } else {
        // Si no se seleccionó ninguna opción, redirige a una página de error
        echo "No seleccionaste ninguna opción.";
        exit();
    }
    
    if ($radioExterno == "externoAbierto") {
        $queryExternoAbierto = "UPDATE estatus_prestamos SET Estatus ='$radioExterno' WHERE Tipo_Prestamo = EXTERNO";

        // Ejecutamos la consulta SQL para insertar los datos del usuario en la tabla "usuarios"
        if ($conn->query($queryExternoAbierto) === TRUE) {
            // Si la consulta se ejecutó correctamente, redirigimos al usuario a la página de inicio con un mensaje de éxito
            header("Location: cambios-aplicados.html");
        } else {
            // Si la consulta no se ejecutó correctamente, redirigimos al usuario al segundo paso del formulario con un mensaje de error
            echo "Cambios no aplicados";
            exit();
        }
    } else if ($radioExterno == "externoCerrado") {
        $queryExternoCerrado = "UPDATE estatus_prestamos SET Estatus ='$radioExterno' WHERE Tipo_Prestamo = EXTERNO";

        // Ejecutamos la consulta SQL para insertar los datos del usuario en la tabla "usuarios"
        if ($conn->query($queryExternoCerrado) === TRUE) {
            // Si la consulta se ejecutó correctamente, redirigimos al usuario a la página de inicio con un mensaje de éxito
            header("Location: cambios-aplicados.html");
        } else {
            // Si la consulta no se ejecutó correctamente, redirigimos al usuario al segundo paso del formulario con un mensaje de error
            echo "Cambios no aplicados";
            exit();
        }
    } else {
        // Si no se seleccionó ninguna opción, redirige a una página de error
        echo "No seleccionaste ninguna opción.";
        exit();
    }
?>