<?PHP
require "conexion.php";
$close6 = 'disabled';

// Verificar si se envió el formulario de registro
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    session_start();
    $id_registro = $_SESSION['id_registro'];
    $resp = $_POST['resp'];
    $cardio = $_POST['cardio'];
    $digestivo = $_POST['digestivo'];
    $urinario = $_POST['urinario'];
    $hemo = $_POST['hemo'];
    $endocrino = $_POST['endocrino'];
    $sis_nerv = $_POST['sis_nerv'];
    $osteo = $_POST['osteo'];
    $tegumentos = $_POST['tegumentos'];
    $_SESSION['close6'] = $close6;

    $consulta = "UPDATE interrogatorioaparatos SET Respiratorio='$resp', Cardio='$cardio', Digestivo='$digestivo', 
                Urinario='$urinario', Hemolinfatico='$hemo', Endocrino='$endocrino', SistemaNervioso='$sis_nerv', 
                OsteoMuscular='$osteo', Tegumentos='$tegumentos' WHERE ID_Registro = '$id_registro'";
        
        // Ejecutar la consulta
        if ($mysqli->query($consulta) === TRUE) {
            // Mostrar mensaje de éxito
            //echo "Registro exitoso!";
            // Redireccionar a la página de inicio de sesión
                     
            echo '<script language="javascript"> alert("Interrogatorio agregado correctamente"); window.history.back(); </script>';
            exit();
        } else {
            // Mostrar mensaje de error
            echo "Error al insertar datos en la tabla usuarios: " . $conexion->error;
        }
    
}
 
// Cerrar la conexión
$mysqli->close();


?>