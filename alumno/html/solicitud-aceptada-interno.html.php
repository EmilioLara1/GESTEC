<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    
    <!-- Iconos Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/alumno/css/solicitud-aceptada-interno.css">

    <title>¡Solicitud aceptada!</title>
    <link rel="shortcut icon" href="/imgs/icono.png">
</head>

<body>
    <div class="container-fluid p-0">
        <div class="row">
            <!-- Imagen -->
            <div class="col-auto p-0 h-100">
                <img src="/imgs/gestec-cta.png" class="img-fluid h-100">
            </div>

            <!-- Contenido -->
            <div class="col p-0">
                <div class="row">
                    <div class="col h-auto">
                        <div class="row">
                            <i class="bi bi-check-circle-fill text-center m-3"></i>

                            <h1 class="h-auto text-center">¡Solicitud aceptada!</h1>

                            <p class="lead text-center">Preséntate en el área de préstamos (abajo de las escaleras del edificio K) con tu <strong>folio y crendecial de estudiante </strong></p>
                        </div>

                        <div class="row">
                            <p class="lead text-center folio">Folio</p>
                        </div>
                        <div class="row">
                            <p class="lead text-center">
                                <?php
                                    session_start();

                                    require_once "conexion.php";

                                    $conn = connectDB();

                                    if (isset($_SESSION['correo']) && isset($_SESSION['contraseña'])) {

                                        $folio = generarFolio();

                                        $query = "SELECT Folio FROM prestamos WHERE Folio = '$folio'";
                                        $resultado = $conn->query($query);

                                        while (mysqli_num_rows($resultado) > 0) {
                                            // Si el folio ya existe, generar uno nuevo
                                            $folio = generarFolio();
                                            $query = "SELECT Folio FROM prestamos WHERE Folio = '$folio'";
                                            $resultado = mysqli_query($conn, $query);
                                        }
                                    
                                        // Obtener los datos de la sesión
                                        $correo = $_SESSION['correo'];
                                        $contraseña = $_SESSION['contraseña'];
                                        
                                    
                                        // Consulta SQL utilizando un JOIN para obtener el código del usuario actual
                                        $query = "SELECT codigo FROM cuentas WHERE correo = '$correo' AND contraseña = '$contraseña'";
                                        $resultado = mysqli_query($conn, $query);
                                    
                                        // Verificar si se obtuvieron resultados
                                        if (mysqli_num_rows($resultado) > 0) {
                                            $fila = mysqli_fetch_assoc($resultado);
                                            $codigoUsuario = $fila['codigo'];

                                            $select = $_SESSION['select'];
                                    
                                            // Realizar la inserción en la tabla "prestamos" utilizando el código del usuario
                                            $queryInsercion = "INSERT INTO prestamos (folio,codigo,tipo) VALUES ('$folio','$codigoUsuario','$select')";
                                            $resultadoInsercion = mysqli_query($conn, $queryInsercion);
                                    
                                            if ($resultadoInsercion) {
                                                echo $folio;
                                                $_SESSION['folio'] = $folio;
                                            } else {
                                                echo "Error al insertar el código en la tabla prestamos";
                                            }
                                        } else {
                                            echo "No se encontró el usuario en la tabla cuentas";
                                        }
                                    } else {
                                        echo "Sesión no iniciada";
                                    }

                                    $conn->close();

                                    function generarFolio() {
                                        return rand(10000, 99999);
                                    }
                                ?>
                            </p>
                        </div>
                        <div class="row">
                            <hr>
                        </div>

                        <div class="row">
                            <button type="button" class="btn btn-outline-secondary">Cerrar sesión</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

</body>
</html>