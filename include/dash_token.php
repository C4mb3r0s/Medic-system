<?php
require 'conexion.php';
session_start();


if($_POST){
    $email = $_POST['email'];
    
    $sql = "SELECT ID, Nombre, Puesto, Especialidad, Correo, Usuario, Password  FROM sr_med WHERE Correo = '$email'";
    $RESULTADO = $mysqli->query($sql);
    $num = $RESULTADO->num_rows;

    if ($num > 0){

        $row = $RESULTADO->fetch_assoc();
        $email_bd = $row['Correo']; /**Se realiza la asiciacion con el email de la bd */

        if($email_bd === $email){ /**comparacion de los email*/
            session_start();
            $_SESSION['ID'] = $row['ID'];
            $_SESSION['Nombre'] = $row['Nombre'];
            $_SESSION['Email'] = $row['Correo'];

            header ("Location: Mail.php");
            exit();
        }else{
            echo '<script lenguage="javascript"> alert("El correo no existe"); window.history.back(); </script>';
        }
    }else{
        echo '<script lenguage="javascript"> alert("El correo no existe"); window.history.back(); </script>';
    }
}


?>