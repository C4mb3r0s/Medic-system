<?php
    require "conexion.php";
    session_start();

    if($_POST){
      $Usuario = $_POST['Usuario'];
      $Contraseña = $_POST['Password'];

      $sql ="SELECT ID, Nombre, Puesto, Especialidad, Correo, Usuario, Password FROM sr_med WHERE Usuario='$Usuario'";
      $RESULTADO = $mysqli->query($sql);
      $num = $RESULTADO->num_rows;

      if($num>0){
        $row = $RESULTADO->fetch_assoc();
        $Contraseña_bd = $row['Password'];/**Usuario de la bd */
        $_SESSION['Puesto'] = $row['Puesto']; /* jalamos el valor de puesto de la bd para hacer la comparacion*/
        $pass_c = sha1($Contraseña); //*El que el usuario ingresa 
        if($Contraseña_bd === $pass_c){
          $_SESSION['ID'] = $row['ID'];
          $_SESSION['Nombre'] = $row['Nombre'];
          $_SESSION['Especialidad'] = $row['Especialidad'];
            if($_SESSION['Puesto'] === 'Medico'){
              header("Location: ../dashboard_medico.php");
            }elseif($_SESSION['Puesto'] === 'Recepcionista'){
              header("Location: ../dashboard_recep.php");
            }elseif($_SESSION['Puesto'] === 'ADMINISTRADOR'){
              header("Location: ../Administrador.php");
            }
        }else{
          echo '<script language="javascript"> alert("La contraseña es incorrecta."); window.history.back(); </script>';
        }
      }else{
        echo '<script language="javascript"> alert("El usuario no existe"); window.history.back(); </script>';
      }
    }
?>
