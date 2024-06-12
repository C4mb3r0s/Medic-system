<?PHP
require 'conexion.php';

// Verificar si se envió el formulario de registro
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $Nombre = $_POST["Nombre_Com"];
    $Puesto = $_POST["Puesto"];

    if($Puesto == 1){
        $Puesto = 'Medico';
    }elseif($Puesto == 2){
        $Puesto = 'Recepcionista';
    }
    
$Especialidad = isset($_POST["Especialidad"]) ? $_POST["Especialidad"] : '';

    if($Especialidad == 1){
        $Especialidad = 'Optometrista';
    }elseif($Especialidad == 2){
        $Especialidad = 'Dental';
    }elseif($Especialidad == 3){
        $Especialidad = 'Pediatria';
    }elseif($Especialidad == 4){
        $Especialidad = 'Medico General';
    }elseif($Especialidad == 5){
        $Especialidad = 'Unidad de Cirujias';
    }elseif($Especialidad == 6){
        $Especialidad = 'Homeopatia';
    }elseif($Especialidad == 7){
        $Especialidad = 'Nutricion';
    }elseif($Puesto == 2){
        $Especialidad = '';
    }

    $Mail = $_POST["Mail"];
    $User = $_POST["User"];
    $Password = $_POST["Password"];
   
        // Encriptar la contraseña
        $hashed_password = sha1($Password);

        // Verificar si el nombre ya existe en la base de datos
        $consulta_existencia = "SELECT Nombre FROM sr_med WHERE Nombre = '$Nombre'";
        $resultado_existencia = $mysqli->query($consulta_existencia);

        if ($resultado_existencia->num_rows > 0) {
            // El paciente ya existe, mostrar mensaje de error
            echo '<script language="javascript"> alert("El colaborador ya existe"); window.history.back();  </script>';
        } else {

            // Preparar la consulta de inserción
            $consulta = "INSERT INTO sr_med (Nombre, Puesto, Especialidad, Correo, Usuario, Password)
                         VALUES ('$Nombre','$Puesto','$Especialidad','$Mail','$User','$hashed_password')";

            // Ejecutar la consulta
            if ($mysqli->query($consulta) === TRUE) {
                // Mostrar mensaje de éxito
                //echo "Registro exitoso!";
                // Redireccionar a la página de inicio de sesión
                echo '<script language="javascript"> alert("Colaborador añadido exitosamente."); window.location.href="../Administrador.php"; </script>';
                session_start();
                exit();
            } else {
                // Mostrar mensaje de error
                echo "Error al insertar datos en la tabla usuarios: " . $conexion->error;
            }
        }
}
 
// Cerrar la conexión
$mysqli->close();

?>
