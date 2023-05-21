<?php
    require_once "conexion.php";

    $conn = connectDB();

    $folio = generarFolio();

    $query = "SELECT Folio FROM prestamos WHERE Folio = '$folio'";
    $resultado = $conn->query($query);

    while (mysqli_num_rows($resultado) > 0) {
        // Si el folio ya existe, generar uno nuevo
        $folio = generarFolio();
        $query = "SELECT Folio FROM prestamos WHERE Folio = '$folio'";
        $resultado = $conn->query($query);
    }

    $query = "INSERT INTO prestamos (Folio) VALUES ('$folio')";
    if ($conn->query($query) === TRUE) {
        echo "Folio generado";
    } else {
        echo "Error al insertar el folio en la base de datos: " . $conn->error;
    }

    $conn->close();

    function generarFolio() {
        return rand(10000, 99999);
    }
?>