<?php
    session_start();

    require_once "conexion.php";

    if(isset($_POST['submit'])) {
        // Obtener el nombre del archivo PDF desde la base de datos
        $conn = connectDB();
        $consulta = "SELECT codigo FROM  ORDER BY id DESC LIMIT 1";
        $consulta = "SELECT nombre FROM documentos ORDER BY id DESC LIMIT 1";
        $resultado = mysqli_query($conexion, $consulta);
        $fila = mysqli_fetch_assoc($resultado);
        $nombreArchivo = $fila['nombre'];
        mysqli_close($conexion);

        // Generar el enlace para mostrar el archivo en el navegador
        echo "<a href='archivosPDF/$nombreArchivo' target='_blank'>Mostrar archivo</a>";
    }
?>