<?PHP
$close8 = 'disabled';
require "conexion.php";

// Verificar si se envió el formulario de registro
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    session_start();
    $id_registro = $_SESSION['id_registro'];
    $oftal = $_POST['oftal'];
    $_SESSION['close8'] = $close8;

    $consulta = "UPDATE evaluaciones SET Generales ='$oftal' WHERE ID_Registro='$id_registro'";       


        // Ejecutar la consulta
        if ($mysqli->query($consulta) === TRUE) {
            // Mostrar mensaje de éxito
            //echo "Registro exitoso!";
            // Redireccionar a la página de inicio de sesión    
           // Establecer cookie de datos guardados
  
            echo '<script language="javascript"> alert("Evaluaciones agregadas correctamente"); window.history.back(); </script>';
            exit();
        } else {
            // Mostrar mensaje de error
            echo "Error al insertar datos en la tabla usuarios: " . $conexion->error;
        }
    
}
 
// Cerrar la conexión
$mysqli->close();


?>