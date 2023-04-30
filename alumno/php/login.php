<?php
	require_once "conexion.php"; // Incluir el archivo de conexión a la base de datos

    // Obtener los datos del formulario
    $correo = $_GET['correo'];
    $contraseña = $_GET['contraseña'];
    
    // Llamar a la función de conexión a la base de datos
    $conn = connectDB();
    
    // Consulta SQL para verificar si el usuario y contraseña son válidos
    $query = "SELECT * FROM administrador WHERE correo = '$correo' AND contraseña = '$contraseña'";
    $resultado = mysqli_query($conn, $query);
    
    // Verificar si se obtuvieron resultados
    if (mysqli_num_rows($resultado) > 0) {
        echo "Inicio de sesión exitoso";
        /* header("Location:menu-gestec.html"); */
    } else {
        // Inicio de sesión fallido
        echo "Usuario o contraseña incorrectos";
    }
    
    // Cerrar la conexión a la base de datos
    mysqli_close($conn);
?>