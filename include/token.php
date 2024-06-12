<?php
    session_start();
    
    if(isset($_POST['Token'])){
        // Comprobamos si el token enviado es igual al almacenado en la variable de sesión
        if($_POST['Token'] === $_SESSION['token']){
            //Si el token es correcto se pasara al registro de la nueva contraseña
            echo '<script lenguage="javascript"> alert("Token validado"); window.location.href="../Nueva_Contraseña.php"; </script>';
        }else{
                // El token es inválido, mostramos un mensaje de error
            echo '<script language="javascript"> alert("El Token es incorrecto, da click en aceptar que reenvies el código de nuevo"); window.location.href"../restablecer_contra.html"; </script>';
        }
    }else{       
    } 
  ?>