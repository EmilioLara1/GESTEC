<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar préstamo</title>
    <link rel="shortcut icon" href="icono.png">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    
    <!-- Iconos Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="registrar-prestamo-gestec.css">
</head>

<body>
    <div class="container-fluid">
        <div class="col">
            <div class="row">
                <form action="registrar-prestamo-gestec.php" method="POST">
                    <div class="row">
                        <h1 class="text-center">Registrar préstamo</h1>
    
                        <p class="lead text-center">Ingresa los datos correspondientes para <strong>finalizar el préstamo</strong></p>
                    </div>
    
                    <div class="row">
                        <hr>
                    </div>
    
                    <div class="row m-4">
                        <div class="col-auto">
                            <div class="row m-4 content">
                                <div class="col-auto">
                                    <label class="p-0 m-2"><strong>Selecciona el tipo de equipo*</strong></label>
                                    <select class="form-select" name="tipo">
                                        <option selected>Selecciona una opción</option>
                                        <option value="Laptop">Laptop y cargador</option>
                                        <option value="Tablet">Tablet y cargador</option>
                                        <option value="Cable VGA">Cable VGA</option>
                                        <option value="Cable Ethernet">Cable Ethernet</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="row m-4 content">
                                <div class="col-auto">
                                    <label class="p-0 m-2"><strong>ID del equipo*</strong></label>
                                    <select class="form-select" name="id">
                                        <option selected>Selecciona una opción</option>
                                        <?php
                                            require_once "conexion.php";
                                        
                                            // Llamar a la función de conexión a la base de datos
                                            $conn = connectDB();

                                            $query = "SELECT ID FROM equipos";
                                            $resultado = mysqli_query($conn, $query);

                                            while ($fila = mysqli_fetch_assoc($resultado)) {
                                                echo "<option value='" . $fila['ID'] . "'>" . $fila['ID'] . "</option>";
                                            }

                                            mysqli_free_result($resultado);
                                            mysqli_close($conn);
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
    
                    <div class="row">
                        <nav>
                            <ul class="pagination m-4">
                                <li class="page-item disabled"><a class="page-link" href="datos-usuario-gestec.php">Regresar</a></li>
                                <li class="page-item disabled"><a class="page-link" href="datos-usuario-gestec.php">1</a></li>
                                <li class="page-item active"><a class="page-link" href="registrar-prestamo-gestec.html.php">2</a></li>
                                <li class="page-item"><button type="submit" class="page-link">Finalizar</button></li>
                            </ul>
                        </nav>
                        <a class="cancel text-center" href="menu-gestec.html">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>