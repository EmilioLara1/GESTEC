<?php
    session_start();
    // Incluimos el archivo de conexión a la base de datos
    require_once "conexion.php";
    
    // Si el formulario ha sido enviado
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        // Recibimos los datos del formulario
        $codigo = $_GET['codigo'];

		$nombres = $_GET['nombres'];

		$paterno = $_GET['paterno'];

		$materno = $_GET['materno'];

		$carrera = $_GET['carrera'];

		$domicilio = $_GET['domicilio'];

        $colonia = $_GET['colonia'];

		$celular = $_GET['celular'];

        // Creamos la conexión a la base de datos
        $conn = connectDB();
    
        // Comprobamos si el correo ya está registrado en la base de datos
        $query = "SELECT * FROM usuarios WHERE codigo = '$codigo'";
        $resultado = $conn->query($query);
    
        if ($resultado->num_rows > 0) {
            // Si el correo ya está registrado, redirigimos al usuario al primer paso del formulario con un mensaje de error
            $_SESSION['mensaje'] = 'El código ya está registrado.';
            header('Location: datos-generales.html');
            exit;
        } else {
            // Si el correo no está registrado, almacenamos los datos en una sesión y redirigimos al usuario al segundo paso del formulario
            $_SESSION['codigo'] = $codigo;
            $_SESSION['nombres'] = $nombres;
            $_SESSION['paterno'] = $paterno;
            $_SESSION['materno'] = $materno;
            $_SESSION['carrera'] = $carrera;
            $_SESSION['domicilio'] = $domicilio;
            $_SESSION['colonia'] = $colonia;
            $_SESSION['celular'] = $celular;
            header('Location: finalizar-registro.html');
            exit;
        }
    }


	/* if (isset($_REQUEST['siguiente'])) {

		require_once "conexion.php"; // Incluir el archivo de conexión a la base de datos

        // Llamar a la función de conexión a la base de datos
        $conn = connectDB();
		
        // Verificar si se ha enviado el formulario de la página 1
        $codigo = $_GET['codigo'];

		$nombres = $_GET['nombres'];

		$paterno = $_GET['paterno'];

		$materno = $_GET['materno'];

		$carrera = $_GET['carrera'];

		$domicilio = $_GET['domicilio'];

        $colonia = $_GET['colonia'];

		$celular = $_GET['celular'];

        // Insertar los datos en la tabla "datos"
        $query = "INSERT INTO usuarios (Codigo, Nombres, Ape_Pat, Ape_Mat, Carrera, Domicilio, Colonia, Celular) VALUES ('$codigo', '$nombres', '$paterno', '$materno', '$carrera', '$domicilio', '$colonia', '$celular')";
        mysqli_query($conn, $query);

        if (mysqli_num_rows($resultado) > 0) {
            echo "El usuario ya existe";
        } else {
            // Inicio de sesión fallido
            echo "Registro exitoso";
        }
        
        // Cerrar la conexión a la base de datos
        mysqli_close($conn);
	} */
?>