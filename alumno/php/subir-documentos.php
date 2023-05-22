<?php
    session_start();

    require_once "conexion.php"; // Incluir el archivo de conexión a la base de datos
    
    // Llamar a la función de conexión a la base de datos
    $conn = connectDB();

    if (isset($_SESSION['correo']) && isset($_SESSION['contraseña'])) {
        // Directorio de destino para guardar los archivos PDF
        $directorioDestino = "archivosPDF/";

        // Obtener información del archivo
        $nombreArchivo = $_FILES['archivoPDF']['name'];
        $archivoTemporal = $_FILES['archivoPDF']['tmp_name'];

        // Mover el archivo temporal al directorio de destino
        move_uploaded_file($archivoTemporal, $directorioDestino.$nombreArchivo);

        // Obtener los datos de la sesión
        $correo = $_SESSION['correo'];
        $contraseña = $_SESSION['contraseña'];

        // Consulta SQL utilizando un JOIN para obtener el código del usuario actual
        $query = "SELECT codigo FROM cuentas WHERE correo = '$correo' AND contraseña = '$contraseña'";
        $resultado = mysqli_query($conn, $query);

        if (mysqli_num_rows($resultado) > 0) {
            $fila = mysqli_fetch_assoc($resultado);
            $codigoUsuario = $fila['codigo'];
    
            // Realizar la inserción en la tabla "prestamos" utilizando el código del usuario
            $queryInsercion = "INSERT INTO documentos (codigo,nombre) VALUES ('$codigoUsuario','$nombreArchivo')";
            $resultadoInsercion = mysqli_query($conn, $queryInsercion);
    
            if ($resultadoInsercion) {
                header('Location: solicitud-aceptada-externo.html.php');
            } else {
                echo "Error al insertar el código en la tabla documentos";
            }
        } else {
            echo "No se encontró el usuario en la tabla cuentas";
        }
    } else {
        echo "Sesión no iniciada";
    }

    $conn->close();
?>