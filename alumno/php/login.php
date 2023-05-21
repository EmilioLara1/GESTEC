<?php
    session_start();

    require_once "conexion.php"; // Incluir el archivo de conexión a la base de datos

    // Obtener los datos del formulario
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];
    
    // Llamar a la función de conexión a la base de datos
    $conn = connectDB();
    
    // Consulta SQL para verificar si el usuario y contraseña del administrador son válidos
    $query = "SELECT * FROM administrador WHERE correo = '$correo' AND contraseña = '$contraseña'";
    $resultadoAdministrador = mysqli_query($conn, $query);

    // Consulta SQL para verificar si el usuario y contraseña del usuario son válidos
    $query = "SELECT * FROM cuentas WHERE correo = '$correo' AND contraseña = '$contraseña'";
    $resultadoUsuario = mysqli_query($conn, $query);
    
    // Verificar si se obtuvieron resultados
    if (mysqli_num_rows($resultadoAdministrador) > 0) {
        header("Location:menu-gestec.html");
    } else {
        // Inicio de sesión fallido
        echo "Usuario o contraseña incorrectos";
    }

    if (mysqli_num_rows($resultadoUsuario) > 0) {
        $_SESSION['correo'] = $correo;
        $_SESSION['contraseña'] = $contraseña;
        header("Location:tipo-prestamo.html");
        exit;
    } else {
        // Inicio de sesión fallido
        echo "Usuario o contraseña incorrectos";
    }
    
    // Cerrar la conexión a la base de datos
    mysqli_close($conn);
?>