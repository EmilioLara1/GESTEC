<?php
	require_once "conexion.php"; // Incluir el archivo de conexión a la base de datos

    // Obtener los datos del formulario o de cualquier otra fuente
    $folio = $_GET['folio'];
    
    // Llamar a la función de conexión a la base de datos
    $conn = connectDB();
    
    // Consulta SQL para obtener registros de la tabla de alumnos
    // Consulta SQL para obtener los campos de la tabla "usuarios" basado en el campo "Código" de la tabla "prestamos"
    $query = "SELECT u.Nombres, u.Ape_Pat, u.Ape_Mat, u.Carrera, u.Domicilio, u.Colonia, u.Celular, u.Codigo
              FROM prestamos AS p
              JOIN usuarios AS u ON p.Codigo = u.Codigo
              WHERE p.Folio = $folio";

    $resultado = mysqli_query($conn, $query);
    
    // Verificar si se obtuvieron resultados
    if (mysqli_num_rows($resultado) > 0) {
        // Recorrer los resultados y mostrarlos en pantalla o utilizarlos de otra forma
        while ($fila = mysqli_fetch_assoc($resultado)) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Revisar datos del usuario</title>
    <link rel="shortcut icon" href="icono.png">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    
    <!-- Iconos Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="datos-usuario-gestec.css">
</head>

<body>
    <div class="container-fluid">
            <div class="row">
                <div class="col-auto h-auto">
                <form>
                    <div class="row">
                        <h1 class="text-center">Datos del usuario</h1>
    
                        <p class="lead text-center"><strong>Revisa que todos los datos sean correctos</strong> para continuar con el préstamo</p>
                    </div>
    
                    <div class="row">
                        <hr>
                    </div>
    
                    <div class="row">
                        <div class="col">
                            <div class="row">
                                <div class="col-auto contenido m-2">
                                    <div class="row">
                                       
                                            <label class="form-label fw-bold p-0 m-0">Nombre(s)</label>
                                        
                                            <p class="text-center border rounded p-1"><?php echo $fila['Nombres']; ?></p>
                                        
                                    </div>
            
                                    <div class="row ">
                                      
                                            <label class="form-label fw-bold p-0 m-0">Apellido paterno</label>
                                      
                                            <p class="text-center border rounded p-1"><?php echo $fila['Ape_Pat']; ?></p>
                                        
                                    </div>
                    
                                    <div class="row ">
                                       
                                            <label class="form-label fw-bold p-0 m-0">Apellido materno</label>
                                       
                                            <p class="text-center border rounded p-1"><?php echo $fila['Ape_Mat']; ?></p>
                                        
                                    </div>
            
                                    <div class="row ">
                                        
                                            <label class="form-label fw-bold p-0 m-0">Carrera</label>
                                        
                                            <p class="text-center border rounded p-1"><?php echo $fila['Carrera']; ?></p>
                                        
                                    </div>
                                </div>
            
                                <div class="col-auto contenido m-2">
                                    <div class="row ">
                                            
                                            <label class="form-label fw-bold p-0 m-0">Domicilio (Calle y número, ej. Juarez 513)</label>
                                        
                                            <p class="text-center border rounded p-1"><?php echo $fila['Domicilio']; ?></p>
                                    
                                    </div>

                                    <div class="row ">
                                        
                                            <label class="form-label fw-bold p-0 m-0">Colonia</label>
                                        
                                            <p class="text-center border rounded p-1"><?php echo $fila['Colonia']; ?></p>
                                        
                                    </div>
                    
                                    <div class="row ">
                                        
                                            <label class="form-label fw-bold p-0 m-0">Celular</label>
                                        
                                            <p class="text-center border rounded p-1"><?php echo $fila['Celular']; ?></p>
                                        
                                    </div>
            
                                    <div class="row ">
                                        
                                            <label class="form-label fw-bold p-0 m-0">Código</label>
                                       
                                            <p class="text-center border rounded p-1"><?php echo $fila['Codigo']; ?></p>
                                        
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-auto">
                                    <div class="row">
                                                
                                        <label class="form-label fw-bold p-0 m-0 text-center">Documentos</label>
                                    
                                        <button type="button" class="btn btn-primary btn-sm text-center">Abrir PDF</button>
                                            
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
    
                    <div class="row">
                        <nav>
                            <ul class="pagination m-4">
                              <li class="page-item"><a class="page-link" href="buscar-folio.html">Regresar</a></li>
                              <li class="page-item active"><a class="page-link" href="datos-usuario-gestec.php">1</a></li>
                              <li class="page-item"><a class="page-link" href="registrar-prestamo-gestec.html.php">2</a></li>
                              <li class="page-item"><a class="page-link" href="registrar-prestamo-gestec.html.php">Siguiente</a></li>
                            </ul>
                        </nav>
                        <a class="cancel text-center" href="menu-gestec.html">Cancelar</a>
                    </div>
                </div>
                </form>
            </div>
        
    </div>

    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

</body>
</html>


    <?php 

        
            }
        } else {
            // No se encontraron resultados
            echo "No se encontro ningun registro";
        }
        
        // Cerrar la conexión a la base de datos
        mysqli_close($conn);
    ?>