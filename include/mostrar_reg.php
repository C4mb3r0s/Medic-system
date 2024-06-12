<?php
session_start();
if (isset($_POST['submit'])) {
    
    $id_registro = $_POST['id_registro']; 
    $_SESSION['id_registro'] = $id_registro;
    if($_SESSION['id_registro']==true){
        header("Location: ../Mostrar_reg.php");
    }else{
        echo 'error';
    }
}
?>