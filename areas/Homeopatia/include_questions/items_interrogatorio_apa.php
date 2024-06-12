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


        // Preparar la consulta de inserción
        $consulta = "INSERT INTO interrogatorioaparatos (ID_Registro, Respiratorio, Cardio, Digestivo, Urinario, Hemolinfatico, Endocrino, SistemaNervioso, OsteoMuscular, Tegumentos)
                     VALUES ('$id_registro', '$resp', '$cardio', '$digestivo', '$urinario', '$hemo', '$endocrino', '$sis_nerv', '$osteo', '$tegumentos')";

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