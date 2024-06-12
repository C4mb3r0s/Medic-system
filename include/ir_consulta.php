<?php
session_start();
$Especialidad = $_SESSION['Especialidad'];
if (isset($_POST['submit'])) {
    /**
     * cambio de estatus
     */
    $id_registro = $_POST['id_registro']; // Obtener el valor del ID_Paciente del formulario
    $_SESSION['id_registro'] = $id_registro; // Asignar el valor a la variable de sesión

    $nombre_paciente = $_POST['nombre_paciente']; // Obtener el valor del nombre del paciente del formulario
    $_SESSION['nombre_paciente'] = $nombre_paciente; // Asignar el valor a la variable de sesión
     
            $Estatus = "En Consulta";
            require "conexion.php";
           
            $ID = $id_registro;  
            
            $sql = "UPDATE consultas SET Estatus='$Estatus' WHERE ID_Registro='$ID'";
                // Ejecutar la consulta
            if ($mysqli->query($sql) === TRUE) {
                if ($Especialidad === "Medico General"){
                    header("Location: ../areas/MedicoGeneral/Questionnaire_pacient_medgen.php");
                    exit();
                }elseif ($Especialidad === "Optometrista") {
                    header("Location: ../areas/Optometrista/Questionnaire_pacient_optometrista.php");
                    exit();
                }elseif ($Especialidad === "Dental") {
                    header("Location: ../areas/Dental/Questionnaire_pacient_dental.php");
                    exit();
                } elseif ($Especialidad === "Pediatria") {
                    header("Location: ../areas/Pediatria/Questionnaire_pacient_pediatria.php");
                    exit();
                } elseif ($Especialidad === "Homeopatia") {
                    header("Location: ../areas/Homeopatia/Questionnaire_pacient_homeo.php");
                    exit();
                }  elseif ($Especialidad == "Nutricion"){
                    header ("Location: ../areas/Nutricion/Questionnaire_pacient_nutricion.php");
                    exit();
                }            
            } else {
                // Mostrar mensaje de error
                echo "Error al icambiar tú contraseña: " . $conexion->error;
            }   
}
?>
