<!-- PHP PARA AGREGAR UN REGISTRO -->
<?php

    require_once "conexion.php"; // Incluir el archivo de conexión a la base de datos

    // Obtener los datos del formulario o de cualquier otra fuente
    //$nombre_busqueda = $_GET['nombre_busqueda'];
    
    // Llamar a la función de conexión a la base de datos
    $conn = connectDB();


    
   
     // if(isset($_POST['Resguardo']) && isset($_POST['No_Serie'])) {
       // $Resguardo = $_POST['Resguardo'];
        //$No_Serie = $_POST['No_Serie'];
        
        //if(!empty($Resguardo) && !empty($No_Serie)) {
          // Procesar la información para agregar el elemento
          // ...

          if ($_SERVER['REQUEST_METHOD'] === 'POST') {

          $Resguardo = $_POST['Resguardo'];
          $No_Serie = $_POST['No_Serie'];
          $Tipo = $_POST['Tipo'];
          $Modelo = $_POST['Modelo'];
          $Marca = $_POST['Marca'];

         
              // Consulta SQL para obtener registros de la tabla de alumnos
              $query = "INSERT INTO equipos (Resguardo, No_Serie, Tipo, Modelo, Marca) 
              VALUES ('".$Resguardo."','".$No_Serie."','".$Tipo."','".$Modelo."','".$Marca."')";

              $resultado = mysqli_query($conn, $query);

              if (!$resultado) {
                  echo "<script language='javaScript'>
                          alert('ERROR: Los datos NO fueron ingresados a la BD');
                       </script>";
              }else{
                 header('Location: tabla-de-equipos.php?formulario_enviado=true');
                  exit;
              }
               mysqli_close($conn);
          }
      
          
          
        //} else {
          // Mostrar un mensaje de error si los campos requeridos están vacíos
          //echo "Por favor, complete todos los campos requeridos";
        //}
     // }

?>
