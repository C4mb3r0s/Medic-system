<?PHP
require "conexion.php";
$close1 = 'disabled';

// Verificar si se envió el formulario de registro
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    session_start();
    $id_registro = $_SESSION['id_registro'];
    $presionart = $_POST['presionart'];
    $satuoxig = $_POST['satuoxig'];
    $frecuenciacard = $_POST['frecuenciacard'];
    $peso = $_POST['peso'];
    $temperatura = $_POST['temperatura'];
    $talla = $_POST['talla'];
    $frecresp = $_POST['frecresp'];
    $indmasa = $_POST['indmasa'];
    
    $_SESSION['close1'] = $close1;

        // Preparar la consulta de inserción
        $consulta = "INSERT INTO signosvitales (ID_Registro, PresionArt, SaturacionOx, FrecuenciaCar, PesoActual, Temperatura, Talla, FrecuenciaRes, IndiceMasaCorp)
                     VALUES ('$id_registro','$presionart','$satuoxig','$frecuenciacard','$peso','$temperatura','$talla','$frecresp','$indmasa')";

        // Ejecutar la consulta
        if ($mysqli->query($consulta) === TRUE) {
            // Mostrar mensaje de éxito
            //echo "Registro exitoso!";
            // Redireccionar a la página de inicio de sesión
                     
            echo '<script language="javascript"> alert("Signos agregados correctamente"); window.history.back(); </script>';
            exit();
        } else {
            // Mostrar mensaje de error
            echo "Error al insertar datos en la tabla usuarios: " . $conexion->error;
        }
    
}
 
// Cerrar la conexión
$mysqli->close();


?>
