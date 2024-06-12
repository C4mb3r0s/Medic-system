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
    $neuro =$_POST['neurologicos'];
    $observaciones = $_POST['observa2'];
    $_SESSION['close3'] = $close3;

    $consulta = "UPDATE personalespat SET Tabaquismo ='$tabaquismo', Tabpasivo ='$tabpas', Inicio='$inicio', 
    Cantidad='$cantidad',    ExTabaquismo ='$ext_tab', Hepatico='$hepaticos', Cardiacas='$cardiacos',
     Diabeticos='$diabeticos', Quirurgicos='$quiro', Renal='$renal', Fracturas='$fracturas', Hospitalizacion='$hosp',
     Hipertensivos='$hiper', Neurologicos='$neuro', Observaciones='$observaciones' 
     WHERE ID_Registro='$id_registro'";
       
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