<?php
session_start();

$id_registro = $_SESSION['id_registro'];

echo '<script type="text/javascript">
        var result = confirm("Irás directo a tu inicio, ¿Estas seguro de salir?");

        if (result) {
            window.location.href = "out_questions2.php?id_registro=' . $id_registro . '";
        } else {
            window.history.back();
        }
      </script>';
?>