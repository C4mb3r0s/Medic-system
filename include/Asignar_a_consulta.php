<?php

if (isset($_POST['submit'])) {
    $id_registro = $_POST['id_registro']; 


    echo '<script type="text/javascript">
        var result = confirm("Se asignara el paciente de nuevo a las consultas, ¿Estas seguro?");

        if (result) {
            window.location.href = "Asignar_a_consulta2.php?id_registro=' . $id_registro . '";
        } else {
            window.history.back();
        }
      </script>';
    }
?>
