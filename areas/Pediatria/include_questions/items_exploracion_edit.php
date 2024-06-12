<?PHP
require "conexion.php";
$close7 = 'disabled';

// Verificar si se envió el formulario de registro
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    session_start();
    $id_registro = $_SESSION['id_registro'];
    $cabeza = $_POST['cabeza'];
    $cuello = $_POST['cuello'];
    $torax = $_POST['torax'];
    $mamas = $_POST['mamas'];
    $abdomen = $_POST['abdomen'];
    $extremidades = $_POST['extremidades'];
    $inspec = $_POST['inspec'];
    $_SESSION['close7'] = $close7;

    $consulta = "UPDATE exploracion SET Cabeza ='$cabeza', Cuello ='$cuello', Torax = '$torax', Mamas='$mamas',
                Abdomen = '$abdomen', Extremidades ='$extremidades', Inspeccion ='$inspec' WHERE ID_Registro='$id_registro'";
     
        // Ejecutar la consulta
        if ($mysqli->query($consulta) === TRUE) {
            // Mostrar mensaje de éxito
            //echo "Registro exitoso!";
            // Redireccionar a la página de inicio de sesión
                     
            echo '<script language="javascript"> alert("Exploración agregada correctamente"); window.history.back(); </script>';
            exit();
        } else {
            // Mostrar mensaje de error
            echo "Error al insertar datos en la tabla usuarios: " . $conexion->error;
        }
    
}
 
// Cerrar la conexión
$mysqli->close();


?>