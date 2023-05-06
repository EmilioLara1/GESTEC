<?php
    session_start();
    // Incluimos el archivo de conexión a la base de datos
    require_once "conexion.php";
    
    // Si el formulario ha sido enviado
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Recibimos los datos del formulario
        $codigo = $_POST['codigo'];

		$nombres = $_POST['nombres'];

		$paterno = $_POST['paterno'];

		$materno = $_POST['materno'];

		$carrera = $_POST['carrera'];

		$domicilio = $_POST['domicilio'];

        $colonia = $_POST['colonia'];

		$celular = $_POST['celular'];

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
?>