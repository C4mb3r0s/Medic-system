<?PHP
require "conexion.php";
$close2 = 'disabled';

// Verificar si se envió el formulario de registro
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    session_start();
    $id_registro = $_SESSION['id_registro'];

    $oncologico = $_POST['oncologico'];
    $alergicos = $_POST['alergicos'];
    $hipertensivos = $_POST['hipertensivos'];
    $diabeticos = $_POST['diabeticos'];
    $cardio =  $_POST['cardio'];
    $otros = $_POST['otros'];
    $observaciones = $_POST['observaciones'];
    $_SESSION['close2'] = $close2;

        // Preparar la consulta de inserción
        $consulta = "INSERT INTO heredofam (ID_Registro, Oncologico, Alergicos, Hipertensivos, Diabeticos, Cardiovasculares, Otros, Observaciones)
                     VALUES ('$id_registro','$oncologico','$alergicos','$hipertensivos','$diabeticos','$cardio','$otros','$observaciones')";

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