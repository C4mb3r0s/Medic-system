<?php
session_start(); 


if (isset($_POST['submit'])) {
    /**
     * cambio de estatus
     */
        unset($_SESSION['close']);
        $id_registro = $_SESSION['id_registro'];
    
            $Estatus = "Atendido";
            require "conexion.php";
           
            $ID=$id_registro;
            
            $sql = "UPDATE consultas SET Estatus='$Estatus' WHERE ID_Registro='$ID'";
                // Ejecutar la consulta
            if ($mysqli->query($sql) === TRUE) {
                // Mostrar mensaje de éxito
                //echo "Registro exitoso!";
                // Redireccionar a la página de inicio de sesión
                // Redirigir a otra página
                header("Location: ../dashboard_medico.php");
                exit();
            } else {
                // Mostrar mensaje de error
                echo "Error al icambiar tú contraseña: " . $conexion->error;
            }   

}
?>