<?php 
    if($_POST){
        $new_password = $_POST['password1'];
        $new_password2 = $_POST['password2'];

        if(empty($new_password) || empty($new_password2)){
            echo '<script lenguage="javascript"> alert("Los campos no deben estar vaciós"); window.history.back(); </script>';
        }elseif($new_password !== $new_password2){
            echo '<script lenguage="javascript"> alert("Las contraseñas no coinciden"); window.history.back(); </script>';
        }else{
            $hashed_password = sha1($new_password);
            require "conexion.php";
            session_start();
            $ID=$_SESSION['ID'];
            
            $sql = "UPDATE sr_med SET Password='$hashed_password' WHERE ID='$ID'";
                // Ejecutar la consulta
            if ($mysqli->query($sql) === TRUE) {
                // Mostrar mensaje de éxito
                //echo "Registro exitoso!";
                // Redireccionar a la página de inicio de sesión
                
                echo '<script lenguage="javascript"> alert("Tú contraseña fue cambiada con exitó "); window.location.href="../index.php";</script>';
                exit();
            } else {
                // Mostrar mensaje de error
                echo "Error al icambiar tú contraseña: " . $conexion->error;
            }        
        }
    }
?>