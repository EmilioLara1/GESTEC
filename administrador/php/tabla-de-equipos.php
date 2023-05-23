<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de equipos</title>
    <link rel="shortcut icon" href="icono.png">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    
    <!-- Iconos Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="tabla-de-equipos.css">

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
                                <li class="page-item" style="text-align: center;"><a class="page-link" href="menu-gestec.html">Regresar</a></li>
                            </ul>
                        </nav>
                        </div>
                    </div>


                    <div class="row">
                        <h1 class="text-center">Administrar equipos</h1>
                    </div>
    
                    <div class="row" >
                        <hr>
                    </div>
                    
                    <div class= "row m col-lg-12">
                        <!-- MODAL -->
                        <!-- Button trigger modal -->
                        <div class="col" style="text-align: left;">
                        <button class="btn btn-success" data-bs-target="#exampleModalToggle4" data-bs-toggle="modal">
                            Agregar equipo
                        </button><br/>
                      </div>
                  </div>
                    </div>
                  

                    <div class="table-responsive col-lg-12">
                        <div class="table-wrapper">
                          <table>
                            <thead>
                              <tr>
                                <!-- <th class="th1">Seleccionar</th> -->
                                <th class="th2">ID</th>
                                <th class="th1">Resguardo</th>
                                <th>Número de serie</th>
                                <th class="th1">Tipo</th>
                                <th>Modelo</th>
                                <th>Marca</th>
                                <th>Acciones</th>
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
    $query = "SELECT * FROM equipos";
    $resultado = mysqli_query($conn, $query);
    
    // Verificar si se obtuvieron resultados
    if (mysqli_num_rows($resultado) > 0) {
        // Recorrer los resultados y mostrarlos en pantalla o utilizarlos de otra forma
        while ($fila = mysqli_fetch_assoc($resultado)) {
?>

              <tr>
                 <!-- <td scope="row">
                     <div>
                        <input class="form-check-input" type="checkbox" id="checkboxNoLabel" value="" aria-label="...">
                     </div> -->
                </td>
                <td><?php echo $fila['ID']; ?></td>
                <td><?php echo $fila['Resguardo']; ?></td>
                <td><?php echo $fila['No_Serie']; ?></td>
                <td><?php echo $fila['Tipo']; ?></td>
                <td><?php echo $fila['Modelo']; ?></td>
                <td><?php echo $fila['Marca']; ?></td>
                <td>
                    <button type="button" class="btn btn-primary" data-bs-target="#editarModal" data-bs-toggle="modal" 
                        onclick="mostrarModalEditar(<?php echo $fila['ID']; ?>, '<?php echo $fila['Resguardo']; ?>', 
                        '<?php echo $fila['No_Serie']; ?>', '<?php echo $fila['Tipo']; ?>', '<?php echo $fila['Modelo']; ?>', 
                        '<?php echo $fila['Marca']; ?>')">
                            Editar
                    </button>
                    - 
                   <button type="button" class="btn btn-danger" onclick="confirmarEliminar(<?php echo $fila['ID']; ?>)">
                           Eliminar
                    </button>
                </td>
              </tr>
    <?php 

                //echo $fila['ID'] . " - " . $fila['Resguardo'] . " - " . $fila['No_Serie'] . " - " . 
                // $fila['Tipo'] . " - " . $fila['Modelo'] ."<br>";
            }
        } else {
            // No se encontraron resultados
            echo "No se encontró ningún equipo";
        }
        
        // Cerrar la conexión a la base de datos
        mysqli_close($conn);
    ?>

 <!-- Agregar más filas según sea necesario -->
                            </tbody>
                          </table>

                          
                        </div>
                      </div>
            </div>
        </div>
       
        
    </div>

      <!-- Modal ELIMINAR-->

                  <!-- Modal de confirmación de eliminación -->
                  <div class="modal fade" id="eliminarModal" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <h5 class="modal-title" id="modalEliminarLabel">Confirmar eliminación</h5>
                                  <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span> 
                                  </button> -->
                              </div>
                              <div class="modal-body">
                                  ¿Está seguro de que desea eliminar este registro?
                                  <form method="POST" action="eliminar.php" id="eliminarForm">
                                            <input type="hidden" name="ID" id="ID">
                                  </form>
                              </div>
                              <div class="modal-footer">
                                  
                                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                      
                                      <button type="button" class="btn btn-danger" onclick="eliminarRegistro(event)">Eliminar</button>


                              </div>
                          </div>
                      </div>
                  </div>

                  <script>
                      function confirmarEliminar(ID) {
                        $('#ID').val(ID);
                        $('#eliminarModal').modal('show');
                      }

                     function eliminarRegistro(event) {
                          var ID = $('#ID').val();

                          // Cancelar el envío automático del formulario
                          event.preventDefault();

                          // Enviar la solicitud AJAX para eliminar el registro
                          $.ajax({
                              type: 'POST',
                              url: 'eliminar.php',
                              data: {
                                ID: ID,
                                
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
                  
                 



                   <!-- Modal CREAR-->  

                   <div class="modal fade" id="exampleModalToggle4" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Nuevo registro</h1>
                          <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                        </div>
                        <div class="modal-body f">
                        <form  id="formulario" action="crear.php" method="post">
                            <div class="mb-2">
                              <label for="recipient-name" class="col-form-label">Resguardo:</label>
                              <input type="text" class="form-control" id="Resguardo" name="Resguardo" required>
                            </div>
                            <div class="mb-2">
                              <label for="recipient-name" class="col-form-label">No. de serie:</label>
                              <input type="text" class="form-control" id="No_Serie" name="No_Serie" required>
                            </div>
                            <div class="mb-2">
                              <label for="recipient-name" class="col-form-label">Tipo:</label>
                              <select class="form-select" name="Tipo" id="Tipo">
                                  <option selected>Selecciona una opción</option>
                                  <option value="Laptop">Laptop</option>
                                  <option value="Tablet">Tablet</option>
                                  <option value="Cable VGA">Cable VGA</option>
                                  <option value="Cable Ethernet">Cable Ethernet</option>
                              </select>
                            </div>
                            <div class="mb-2">
                              <label for="recipient-name" class="col-form-label">Modelo:</label>
                              <input type="text" class="form-control" id="Modelo" name="Modelo">
                            </div>
                            <div class="mb-2">
                              <label for="recipient-name" class="col-form-label">Marca:</label>
                              <input type="text" class="form-control" id="Marca" name="Marca">
                            </div>
                          
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>

                                <button type="button" name="enviar" class="btn btn-primary" onclick="mostrarModal()">Confirmar</button>

                             <!-- <input type="submit" name="enviar" value="AGREGAR"> -->
                            </div>
                        </form>
                      </div>
                    </div>
                  </div>


                  <!-- Este es el modal secundario cuando se crea un registro -->
                   <div class="modal fade" id="exampleModalToggle42" aria-hidden="true" aria-labelledby="exampleModalToggleLabel42" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                          <i class="bi bi-check-circle-fill text-center m-3"></i>
                          <h1 class="modal-title fs-5" id="exampleModalToggleLabel42">¡Registro exitoso!</h1>
                          <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                        </div>
                        <div class="modal-body">
                            <p style="text-align: center;">Se añadio el nuevo registro a la lista</p>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" onclick="redirigir()">Aceptar</button>
                          
                        </div>
                      </div>
                    </div>
                  </div>

                <script>
                    function validarCampos() {
                      var resguardo = document.getElementById("Resguardo").value;
                      var no_serie = document.getElementById("No_Serie").value;

                      if (resguardo === "" || no_serie === "") {
                        alert("Por favor, complete todos los campos");
                        return false;
                      }

                      return true;
                    }

                    function mostrarModal() {
                      if (validarCampos()) {
                        // Asignar la acción del formulario a una variable
                        var formAction = document.getElementById("formulario").action;

                        // Cancelar el envío automático del formulario
                        event.preventDefault();

                        // Enviar el formulario con AJAX
                        $.ajax({
                          url: formAction,
                          type: "POST",
                          data: $("#formulario").serialize(),
                          success: function() {
                            // Mostrar el modal después de enviar el formulario
                            setTimeout(function() {
                              $('#exampleModalToggle42').modal('show');
                              $('#exampleModalToggle4').modal('hide');
                            }, 500);
                          },
                          error: function() {
                            alert("Ha ocurrido un error al enviar el formulario.");
                          }
                        });
                      }
                    }

                    // Agregar el evento submit al formulario
                    document.getElementById("formulario").addEventListener("submit", function(event) {
                      event.preventDefault(); // Cancelar el envío automático del formulario
                      mostrarModal(); // Llamar a la función mostrarModal() para enviar el formulario con AJAX
                    });
                </script>


                    <!-- Esta función funciona para redirigir y cerrar los modales secundarios 
                        de crear un registro y de editar un registro -->
                    <script>
                            function redirigir() {
                              window.location.href = 'tabla-de-equipos.php';
                            }
                    </script>




                  <!-- Modal EDITAR-->

                  <div class="modal fade" id="editarModal" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Editar registro</h1>
                          <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                        </div>
                        <div class="modal-body f">
                          <form method="POST" action="editar.php" id="editarForm">
                            <input type="hidden" name="ID" id="editarID">
                            <div class="mb-2">
                                <label for="editar-resguardo" class="col-form-label">Resguardo:</label>
                                <input type="text" class="form-control" name="resguardo" id="editar-resguardo">
                            </div>
                            <div class="mb-2">
                                <label for="editar-numeroSerie" class="col-form-label">No. de serie:</label>
                                <input type="text" class="form-control" name="numeroSerie" id="editar-numeroSerie">
                            </div>
                            <div class="mb-2">
                                <label for="editar-tipo" class="col-form-label">Tipo:</label>
                                <input type="text" class="form-control" name="tipo" id="editar-tipo">
                            </div>
                            <div class="mb-2">
                                <label for="editar-modelo" class="col-form-label">Modelo:</label>
                                <input type="text" class="form-control" name="modelo" id="editar-modelo">
                            </div>
                            <div class="mb-2">
                                <label for="editar-marca" class="col-form-label">Marca:</label>
                                <input type="text" class="form-control" name="marca" id="editar-marca">
                            </div>
                          </form>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                          <button type="submit" form="editarForm" class="btn btn-primary" onclick="editarRegistro(event)">Confirmar</button>

                        </div>
                      </div>
                    </div>
                  </div>

                    <script>
                      function mostrarModalEditar(ID, resguardo, numeroSerie, tipo, modelo, marca) {
                        $('#editarID').val(ID);
                        $('#editar-resguardo').val(resguardo);
                        $('#editar-numeroSerie').val(numeroSerie);
                        $('#editar-tipo').val(tipo);
                        $('#editar-modelo').val(modelo);
                        $('#editar-marca').val(marca);
                        $('#editarModal').modal('show');
                      }


                          function editarRegistro(event) {
                            var ID = $('#editarID').val();
                            var resguardo = $('#editar-resguardo').val();
                            var numeroSerie = $('#editar-numeroSerie').val();
                            var tipo = $('#editar-tipo').val();
                            var modelo = $('#editar-modelo').val();
                            var marca = $('#editar-marca').val();

                            // Cancelar el envío automático del formulario
                            event.preventDefault();


                            $.ajax({
                              type: 'POST',
                              url: 'editar.php',
                              data: {
                                ID: ID,
                                resguardo: resguardo,
                                numeroSerie: numeroSerie,
                                tipo: tipo,
                                modelo: modelo,
                                marca: marca
                              },
                              success: function(response) {
                                // Mostrar el segundo modal aquí
                                $('#exampleModalToggle32').modal('show');
                                $('#editarModal').modal('hide');
                              },
                              error: function() {
                                // Manejar el error si ocurre
                                alert('Error al editar el registro');
                              }
                            });
                          }
                       
                    </script>


                <!-- Este es el modal secundario cuando se edita un registro -->
                  <div class="modal fade" id="exampleModalToggle32" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                          <i class="bi bi-check-circle-fill text-center m-3"></i>
                          <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">¡Registro editado!</h1>
                          <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                        </div>
                        <div class="modal-body">
                            <p style="text-align: center;">Los cambios fueron hechos</p>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" onclick="redirigir()">Aceptar</button>
                          
                        </div>
                      </div>
                    </div>
                  </div>
                  


    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>