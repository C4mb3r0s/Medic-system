<?PHP
require "conexion.php";
$close5 = 'disabled';

// Verificar si se envió el formulario de registro
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    session_start();
    $id_registro = $_SESSION['id_registro'];
    $fecha = $_POST['fecha'];
    $sinto_start = $_POST['sinto_start'];
    $descripcion = $_POST['descripcion'];
    $_SESSION['close5'] = $close5;

    $consulta = "UPDATE padecimientoactual SET FechaInicio ='$fecha', Sintomas='$sinto_start', DescripcionEvol='$descripcion' 
    WHERE ID_Registro='$id_registro'";

        // Ejecutar la consulta
        if ($mysqli->query($consulta) === TRUE) {
            // Mostrar mensaje de éxito
            //echo "Registro exitoso!";
            // Redireccionar a la página de inicio de sesión
                     
            echo '<script language="javascript"> alert("Padecimiento agregado correctamente"); window.history.back(); </script>';
            exit();
        } else {
            // Mostrar mensaje de error
            echo "Error al insertar datos en la tabla usuarios: " . $conexion->error;
        }
    
}
 
// Cerrar la conexión
$mysqli->close();


?>