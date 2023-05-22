<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de préstamos</title>
    <link rel="shortcut icon" href="/imgs/icono.png">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    
    <!-- Iconos Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/administrador/CSS/lista-de-prestamos.css">

    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>
    
    <div class="container-fluid">
        <div class="col" >
            <div class="row">
                    <div class="row" style="justify-content: left;">
                        <div class="regresar col-lg-2 col-xs-11 col-ms-11 col-md-4 col-xl-2">
                        <nav>
                            <ul class="pagination1 mb-4">
                                <li class="page-item" style="text-align: center;"><a class="page-link" href="/administrador/html/menu-gestec.html"> << Regresar</a></li>
                            </ul>
                        </nav>
                        </div>
                    </div>


                    <div class="row">
                        <h1 class="text-center"> Lista de Préstamos </h1>
                    </div>
    
                    <div class="row" >
                        <hr>
                    </div>
                    
                  

                    <div class="table-responsive col-lg-12">
                        <div class="table-wrapper">
                          <table>
                            <thead>
                              <tr>
                                <!-- <th class="th1">Seleccionar</th> -->
                                <th class="th2">Folio</th>
                                <th class="th2">ID</th>
                                <th class="th1">Código</th>
                                <th> Fecha y hora del préstamo </th>
                                <th> Fecha y hora de devolución </th>
                                <th class="th1">Tipo</th>
                                <th class="th1">Estatus</th>
                                <th> Acciones </th>
                              </tr>
                            </thead>
                            <tbody>


  <?php
  	require_once "conexion.php"; // Incluir el archivo de conexión a la base de datos

      // Obtener los datos del formulario o de cualquier otra fuente
      //$nombre_busqueda = $_GET['nombre_busqueda'];
      
      // Llamar a la función de conexión a la base de datos
      $conn = connectDB();
      
      // Consulta SQL para obtener registros de la tabla de alumnos
      $query = "SELECT * FROM prestamos";
      $resultado = mysqli_query($conn, $query);
      
      // Verificar si se obtuvieron resultados
      if (mysqli_num_rows($resultado) > 0) {
          // Recorrer los resultados y mostrarlos en pantalla o utilizarlos de otra forma
          while ($fila = mysqli_fetch_assoc($resultado)) {
  ?>
              <tr>
                </td>
                <td><?php echo $fila['Folio']; ?></td>
                <td><?php echo $fila['ID']; ?></td>
                <td><?php echo $fila['Codigo']; ?></td>
                <td><?php echo $fila['Fecha_Prestamo']; ?></td>
                <td><?php echo $fila['Fecha_Devolucion']; ?></td>
                <td><?php echo $fila['Tipo']; ?></td>
                <td><?php echo $fila['Estatus']; ?></td>
                <td>
                   <button type="button" class="btn btn-danger" onclick="confirmarEliminar(<?php echo $fila['Folio']; ?>)">
                           Eliminar
                   </button>
                </td>
              </tr>
    <?php 
            }
      } else {
         // No se encontraron resultados
         echo "No se encontro ningun equipo";
      }
        // Cerrar la conexión a la base de datos
        mysqli_close($conn);
    ?>
                            </tbody>
                          </table>
                        </div>
                      </div>

            </div>
        </div>
       
        
    </div>

     <!-- **********************************************************************************************************************************************************************************************************************************************-->

     <!-- Modal ELIMINAR-->

                  <!-- Modal de confirmación de eliminación -->
                  <div class="modal fade" id="eliminarModal" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <h5 class="modal-title" id="modalEliminarLabel">Confirmar eliminación</h5>
                              </div>
                              <div class="modal-body">
                                  ¿Está seguro de que desea eliminar este registro?
                                  <form method="POST" action="eliminarP.php" id="eliminarForm">
                                            <input type="hidden" name="Folio" id="Folio">
                                  </form>
                              </div>
                              <div class="modal-footer">
                                  
                                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">  Cancelar </button>
                                      
                                      <button type="button" class="btn btn-danger" onclick="eliminarRegistro(event)">Eliminar</button>


                              </div>
                          </div>
                      </div>
                  </div>

                      <script>
                          function confirmarEliminar(Folio) {
                            $('#Folio').val(Folio);
                            $('#eliminarModal').modal('show');
                          }

                         function eliminarRegistro(event) {
                              var Folio = $('#Folio').val();

                              // Cancelar el envío automático del formulario
                              event.preventDefault();

                              // Enviar la solicitud AJAX para eliminar el registro
                              $.ajax({
                                  type: 'POST',
                                  url: 'eliminarP.php',
                                  data: {
                                    Folio: Folio,
                                    
                                  },
                                  success: function(response) {
                                    // Mostrar el segundo modal aquí
                                    $('#exampleModalToggle2').modal('show');
                                    $('#eliminarModal').modal('hide');
                                  },
                                  error: function() {
                                    // Manejar el error si ocurre
                                    alert('Error al editar el registro');
                                  }
                                });
                              }
                        </script>

                 <!-- Este es el modal secundario cuando se elimina un registro -->

                  <div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                          <i class="bi bi-check-circle-fill text-center m-3"></i>
                          <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">¡Registro eliminado!</h1>
                          <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                        </div>
                        <div class="modal-body">
                            <p style="text-align: center;">Se eliminó el registro de la lista</p>
                        </div>
                        <div class="modal-footer">
                          
                          <button type="button" class="btn btn-secondary" onclick="redirigir()">Aceptar</button>
                         
                        </div>
                      </div>
                    </div>
                  </div>

                    <!-- Esta función funciona para redirigir y cerrar los modales secundarios de crear un registro y de editar un registro -->
                          
                      <script>
                            function redirigir() {
                            window.location.href = 'lista-de-prestamos.php';
                            }
                      </script>

    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

  </body>

</html>