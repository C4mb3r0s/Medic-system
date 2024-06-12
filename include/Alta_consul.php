<?php

require 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    $idPaciente = $_SESSION['ID_Paciente'];

    $full_name = $_POST['fullname'];
    $fecha = $_POST['fecha'];
    $edad = $_POST['edad'];

    $domicilio = $_POST['domicilio'];
    $colonia = $_POST['colonia'];
    $municipio = $_POST['municipio'];
    $municipio = $_POST['municipio'];
    if ($municipio == 1) {
        $municipio = "Colima";
    } elseif ($municipio == 2) {
        $municipio = "Manzanillo";
    } elseif ($municipio == 3) {
        $municipio = "Tecomán";
    } elseif ($municipio == 4) {
        $municipio = "Villa de Álvarez";
    } elseif ($municipio == 5) {
        $municipio = "Armería";
    } elseif ($municipio == 6) {
        $municipio = "Coquimatlán";
    } elseif ($municipio == 7) {
        $municipio = "Comala";
    } elseif ($municipio == 8) {
        $municipio = "Cuauhtémoc";
    } elseif ($municipio == 9) {
        $municipio = "Ixtlahuacán";
    } elseif ($municipio == 10) {
        $municipio = "Minatitlán";
    }

    $telefono = $_POST['tel'];
    $genero = $_SESSION['Genero'];
    $lugarNac = $_SESSION['LugarNac'];
    $ocupacion = $_SESSION['Ocupacion'];
    $escolaridad = $_SESSION['Escolaridad'];
    $estadoCiv = $_SESSION['EstadoCiv'];
    $nacionalidad = $_SESSION['Nacionalidad'];
    $religion = $_SESSION['Religion'];
    $grupoEt = $_SESSION['GrupoEt'];
    $grupoRh = $_SESSION['GrupoRh'];

    $tipo_serv = $_POST['tipo_serv'];

    if ($tipo_serv == 1) {
        $tipo_serv = 'Optometrista';
    } elseif ($tipo_serv == 2) {
        $tipo_serv = 'Dental';
    } elseif ($tipo_serv == 3) {
        $tipo_serv = 'Pediatria';
    } elseif ($tipo_serv == 4) {
        $tipo_serv = 'Medico General';
    }  elseif ($tipo_serv == 5) {
        $tipo_serv = 'Homeopatia';
    } elseif ($tipo_serv == 6) {
        $tipo_serv = 'Nutricion';
    }

    $elaborado = $_SESSION['Elaborado'];
    $subsecuente = $_POST['primera'];

    if (isset($_POST['canalizado'])) { 
        $canalizado = "Si"; 
    } else {
        $canalizado = "No"; 
    }

    if (isset($_POST['directo'])) { 
        $directo = "Si";
        $Estatus = "URGENTE";
    } else {
        $directo = "No"; 
        $Estatus = "Pendiente";
    }



  
    $consulta = "INSERT INTO consultas (ID_Paciente, NombreCom, FechaNac, Edad, Genero, LugarNac, Domicilio, Colonia, Municipio, Telefono, Ocupacion, Escolaridad, EstadoCiv, Religion, Nacionalidad, GrupoEt, GrupoRh, TipoServ, ElaboradoPor, Citade, Canalizado, Directo, HoraFech, Estatus)
     VALUES ('$idPaciente','$full_name','$fecha','$edad','$genero','$lugarNac','$domicilio','$colonia','$municipio','$telefono','$ocupacion','$escolaridad','$estadoCiv','$nacionalidad','$religion','$grupoEt','$grupoRh','$tipo_serv','$elaborado','$subsecuente','$canalizado','$directo', NOW(),'$Estatus')";


    if ($mysqli->query($consulta) === TRUE) {

        echo '<script language="javascript"> alert("Consulta agregada"); window.opener.location.reload(); window.close(); </script>';

        exit();
    } else {
        
        echo "Error al insertar datos en la tabla usuarios: " . $conexion->error;
    }
}

// Cerrar la conexión
$mysqli->close();

?>