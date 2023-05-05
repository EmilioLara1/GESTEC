<?php
    session_start();
    // Incluimos el archivo de conexión a la base de datos
    require_once "conexion.php";
    
    // Si el formulario ha sido enviado
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        // Recibimos los datos del formulario
        $correo = $_GET['correo'];
        $contraseña = $_GET['contraseña'];
        $confirmarContraseña = $_GET['confirmarContraseña'];
    
        // Comprobamos que las contraseñas coinciden
        if ($contraseña != $confirmarContraseña) {
            // Si las contraseñas no coinciden, redirigimos al usuario al segundo paso del formulario con un mensaje de error
            $_SESSION['mensaje'] = 'Las contraseñas no coinciden.';
            header('Location: finalizar-registro.html');
            exit;
        } else {
            // Si las contraseñas coinciden, obtenemos los datos almacenados en la sesión
            $codigo = $_SESSION['codigo'];

            $nombres = $_SESSION['nombres'];

            $paterno = $_SESSION['paterno'];

            $materno = $_SESSION['materno'];

            $carrera = $_SESSION['carrera'];

            $domicilio = $_SESSION['domicilio'];

            $colonia = $_SESSION['colonia'];

            $celular = $_SESSION['celular'];
    
            // Creamos la conexión a la base de datos
            $conn = connectDB();

            // Creamos la consulta SQL para insertar los datos del usuario en la tabla "datos_generales"
            $queryUsuarios = "INSERT INTO usuarios (Codigo, Nombres, Ape_Pat, Ape_Mat, Carrera, Domicilio, Colonia, Celular) VALUES ('$codigo', '$nombres', '$paterno', '$materno', '$carrera', '$domicilio', '$colonia', '$celular')";

            // Ejecutamos la consulta SQL para insertar los datos del usuario en la tabla "datos_generales"
            if ($conn->query($queryUsuarios) === TRUE) {
                // Si la consulta se ejecutó correctamente, creamos la consulta SQL para insertar los datos del usuario en la tabla "usuarios"
                $queryCuentas = "INSERT INTO cuentas (Codigo, Correo, Contraseña) VALUES ('$codigo', '$correo', '$contraseña')";

                // Ejecutamos la consulta SQL para insertar los datos del usuario en la tabla "usuarios"
                if ($conn->query($queryCuentas) === TRUE) {
                    // Si la consulta se ejecutó correctamente, redirigimos al usuario a la página de inicio con un mensaje de éxito
                    $_SESSION['mensaje'] = 'El registro se ha realizado correctamente.';
                    header('Location: registro-exitoso.html');
                    exit;
                } else {
                    // Si la consulta no se ejecutó correctamente, redirigimos al usuario al segundo paso del formulario con un mensaje de error
                    $_SESSION['mensaje'] = 'Ha ocurrido un error al registrar el usuario en la base de datos.';
                    header('Location: finalizar-registro.html');
                    exit;
                }
            } else {
                // Si la consulta no se ejecutó correctamente, redirigimos al usuario al segundo paso del formulario con un mensaje de error
                $_SESSION['mensaje'] = 'Ha ocurrido un error al registrar el usuario en la base de datos.';
                header('Location: finalizar-registro.html');
                exit;
            }
        }

    } else {
        // Si el formulario no ha sido enviado, redirigimos al usuario a la primera página del formulario
        header('Location: datos-generales.html');
        exit;
    }



    /* require_once "conexion.php"; // Incluir el archivo de conexión a la base de datos
    
    // Verificar si se ha enviado el formulario de la página 1
    $correo = $_GET['correo'];

    $contraseña = $_GET['contraseña'];

    // Llamar a la función de conexión a la base de datos
    $conn = connectDB();

    // Insertar los datos en la tabla "datos"
    $query = "INSERT INTO cuentas (Correo, Contraseña) VALUES ('$correo', '$contraseña')";

    if ($conn->query($query) === TRUE) {
        echo "Usuario registrado correctamente";
    } else {
        echo "Error al registrar el usuario: " . $conn->error;
    }
    
    // Cerrar la conexión a la base de datos
    mysqli_close($conn); */
?>