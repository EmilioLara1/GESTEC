<?php
function connectDB(){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "gestec";

    // Crear una conexión
    $conn = mysqli_connect($servername, $username, $password,$dbname);

    // Verificar si hay errores en la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    return $conn;
}

?>