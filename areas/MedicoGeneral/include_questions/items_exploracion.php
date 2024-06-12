<?PHP
require "conexion.php";
$close7 = 'disabled';

// Verificar si se envió el formulario de registro
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    session_start();
    $id_registro = $_SESSION['id_registro'];
    $inspec = $_POST['inspec'];
    $cabeza = $_POST['cabeza'];
    $cuello = $_POST['cuello'];
    $torax = $_POST['torax'];
    $mamas = $_POST['mamas'];
    $abdomen = $_POST['abdomen'];
    $extremidades = $_POST['extremidades'];
    $_SESSION['close7'] = $close7;
        // Preparar la consulta de inserción
        $consulta = "INSERT INTO exploracion (ID_Registro, Cabeza, Cuello, Torax, Mamas, Abdomen, Extremidades, Inspeccion)
                     VALUES ('$id_registro', '$cabeza','$cuello','$torax','$mamas','$abdomen','$extremidades','$inspec')";

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