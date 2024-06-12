<?PHP
require "conexion.php";
$close1 = 'disabled';

// Verificar si se envió el formulario de registro
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    session_start();
    $id_registro = $_SESSION['id_registro'];
    $fecha = $_POST['fecha'];
    $edad = $_POST['edad'];
    $sexo = $_POST['sexo'];
    $calle = $_POST['calle'];
    $colonia = $_POST['colonia'];
    $municipio = $_POST['municipio'];

    if ($municipio === '1') {
        $municipio = 'Colima';
    } elseif ($municipio === '2') {
        $municipio = 'Manzanillo';
    } elseif ($municipio === '3') {
        $municipio = 'Tecoman';
    } elseif ($municipio === '4') {
        $municipio = 'Villa de Alvarez';
    } elseif ($municipio === '5') {
        $municipio = 'Armeria';
    } elseif ($municipio === '6') {
        $municipio = 'Coquimatlan';
    } elseif ($municipio === '7') {
        $municipio = 'Comala';
    } elseif ($municipio === '8') {
        $municipio = 'Cuahutemoc';
    } elseif ($municipio === '9') {
        $municipio = 'Ixtlahuacan';
    } elseif ($municipio === '10') {
        $municipio = 'Minatitlan';
    }
    $valoracion = $_POST['valoracion'];
    $diagnostico = $_POST['diagnostico'];
    $nota = $_POST['Nota'];
    $_SESSION['close1'] = $close1;

    // Preparar la consulta de inserción
    $consulta = "UPDATE consultas 
        SET FechaNac = '$fecha',     
            Edad = '$edad', 
            Genero = '$sexo', 
            Domicilio = '$calle', 
            Colonia = '$colonia', 
            Municipio = '$municipio' 
        WHERE ID_Registro = '$id_registro'";

    // Ejecutar la consulta
    if ($mysqli->query($consulta) === TRUE) {

        $consulta2 = "INSERT INTO valoracionopto (ID_Registro, valoracion, Diagnostico, Notas) VALUES ('$id_registro','$valoracion','$diagnostico', '$nota')";

        if ($mysqli->query($consulta2) === TRUE) {

            echo '<script language="javascript"> alert("Valoracions generales agragadas correctamente"); window.history.back(); </script>';
            exit();
        } else {
            // Mostrar mensaje de error
            echo "Error al insertar datos en la tabla valoracionesopto: " . $conexion->error;
        }
    } else {
        // Mostrar mensaje de error
        echo "Error al insertar datos en la tabla consultas: " . $conexion->error;
    }
}

// Cerrar la conexión
$mysqli->close();
