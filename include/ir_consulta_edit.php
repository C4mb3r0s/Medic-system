<?php
session_start();

if (isset($_POST['submit'])) {

    $id_registro = $_POST['id_registro']; // Obtener el valor del ID_Paciente del formulario
    $_SESSION['id_registro'] = $id_registro; // Asignar el valor a la variable de sesión

    $nombre_paciente = $_POST['nombre_paciente']; // Obtener el valor del nombre del paciente del formulario
    $_SESSION['nombre_paciente'] = $nombre_paciente; // Asignar el valor a la variable de sesión
    
    $Espacialidad = $_POST['esp'];
    if ($Espacialidad === 'Optometrista'){
        header('Location: ../areas/Optometrista/Questionnaire_pacient_optometrista_edit.php');
    } elseif ($Espacialidad === 'Dental') {
        header('Location: ../areas/Dental/Questionnaire_pacient_dental_edit.php');
    } elseif ($Espacialidad === 'Pediatria') {
        header('Location: ../areas/Pediatria/Questionnaire_pacient_pediatria_edit.php');
    } elseif ($Espacialidad === 'Medico General') {
        header('Location: ../areas/MedicoGeneral/Questionnaire_pacient_medgen_edit.php');
    } elseif ($Espacialidad === 'Homeopatia') {
        header('Location: ../areas/Homeopatia/Questionnaire_pacient_homeo_edit.php');
    } elseif ($Espacialidad === 'Nutricion') {
        header('Location: ../areas/Nutricion/Questionnaire_pacient_nutricion_edit.php');
    }else{
        echo 'Error';
    }

}
?>