<?php
    // Obtiene el valor del select enviado por el formulario
    $select = $_POST['select'];

    // Verifica qué opción se seleccionó y redirige a la página correspondiente
    if ($select == "interno") {
        header("Location: pagina1.php");
        exit();
    } else if ($select == "externo") {
        header("Location: pagina2.php");
        exit();
    } else {
        // Si no se seleccionó ninguna opción, redirige a una página de error
        echo "No seleccionaste ninguna opción.";
        exit();
    }
?>