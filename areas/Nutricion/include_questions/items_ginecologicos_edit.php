<?PHP
require "conexion.php";
$close4 = 'disabled';

// Verificar si se envió el formulario de registro
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    session_start();
    $id_registro = $_SESSION['id_registro'];
    $fecha = $_POST['fecha'];
    $resultado = $_POST['resultado'];
    $_SESSION['close4'] = $close4;

    $consulta = "UPDATE ginecoobs SET FechaMasto ='$fecha', Resultado='$resultado' 
     WHERE ID_Registro='$id_registro'";

        // Preparar la consulta de inserción
        //$consulta = "INSERT INTO ginecoobs (ID_Registro, FechaMasto, Resultado)
          //           VALUES ('$id_registro', '$fecha', '$resultado')";

        // Ejecutar la consulta
        if ($mysqli->query($consulta) === TRUE) {
            // Mostrar mensaje de éxito
            //echo "Registro exitoso!";
            // Redireccionar a la página de inicio de sesión
                     
            echo '<script language="javascript"> alert("Antecedentes agregados correctamente"); window.history.back(); </script>';
            exit();
        } else {
            // Mostrar mensaje de error
            echo "Error al insertar datos en la tabla usuarios: " . $conexion->error;
        }
    
}
 
// Cerrar la conexión
$mysqli->close();


?>