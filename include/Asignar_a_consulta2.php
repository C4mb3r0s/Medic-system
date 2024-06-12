<?php
session_start();

$id_registro = $_GET['id_registro'];
          
    require "conexion.php";
    
    
    $sql = "UPDATE consultas SET HoraFech=NOW() WHERE ID_Registro='$id_registro'";
        // Ejecutar la consulta
    if ($mysqli->query($sql) === TRUE) {
    
        
        echo '<script language="javascript"> alert("Agregado a consultas del dia"); window.history.back(); </script>';
        exit();
    } else {
        // Mostrar mensaje de error
        echo "Error al cambiar tú contraseña: " . $conexion->error;
    }   


?>