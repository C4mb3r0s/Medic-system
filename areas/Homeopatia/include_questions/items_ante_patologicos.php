<?PHP
require "conexion.php";
$close3 = 'disabled';

// Verificar si se envió el formulario de registro
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    session_start();
    $id_registro = $_SESSION['id_registro'];
    $tabaquismo = $_POST['tabaquismo'];
    $tabpas= $_POST['tabpas'];
    $inicio = $_POST['inicio'];
    $cantidad = $_POST['cantidad'];
    $ext_tab = $_POST['ext_tab'];
    $hepaticos = $_POST['hepaticos'];
    $quiro = $_POST['quirurgicos'];
    $hosp = $_POST['hospitalizacion'];
    $cardiacos = $_POST['cardiacos'];
    $renal = $_POST['renal'];
    $hiper = $_POST['hipertensivos'];
    $diabeticos = $_POST['diabeticos'];
    $fracturas = $_POST['fracturas'];
    $neuro = $_POST['neurologicos'];
    $observaciones = $_POST['observa'];
    $_SESSION['close3'] = $close3;


        // Preparar la consulta de inserción
        $consulta = "INSERT INTO personalespat (ID_Registro, Tabaquismo, Tabpasivo, Inicio, Cantidad, ExTabaquismo, Hepatico, Cardiacas, Diabeticos, Quirurgicos, Renal, Fracturas, Hospitalizacion, Hipertensivos, Neurologicos, Observaciones)
                     VALUES ('$id_registro','$tabaquismo', '$tabpas','$inicio','$cantidad','$ext_tab','$hepaticos','$cardiacos','$diabeticos','$quiro','$renal','$fracturas','$hosp','$hiper','$neuro','$observaciones')";

        // Ejecutar la consulta
        if ($mysqli->query($consulta) === TRUE) {
            // Mostrar mensaje de éxito
            //echo "Registro exitoso!";
            // Redireccionar a la página de inicio de sesión
                     
            echo '<script language="javascript"> alert("Antecedentes Patológicos agregados correctamente"); window.history.back(); </script>';
            exit();
        } else {
            // Mostrar mensaje de error
            echo "Error al insertar datos en la tabla usuarios: " . $conexion->error;
        }
    
}
 
// Cerrar la conexión
$mysqli->close();


?>