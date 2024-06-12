<?php
require "../../../include/conexion.php";

session_start();
$id_registro = $_GET['id_registro'];


$sql = "DELETE FROM signosvitales WHERE ID_Registro = '$id_registro'";
$sql1 = "DELETE FROM heredofam WHERE ID_Registro = '$id_registro'";
$sql2 = "DELETE FROM personalespat WHERE ID_Registro = '$id_registro'";
$sql3 = "DELETE FROM ginecoobs WHERE ID_Registro = '$id_registro'";
$sql4 = "DELETE FROM padecimientoactual WHERE ID_Registro = '$id_registro'";
$sql5 = "DELETE FROM interrogatorioaparatos WHERE ID_Registro = '$id_registro'";
$sql6 = "DELETE FROM exploracion WHERE ID_Registro = '$id_registro'";
$sql7 = "DELETE FROM evaluaciones WHERE ID_Registro = '$id_registro'";
$sql8 = "DELETE FROM notas WHERE ID_Registro = '$id_registro'";

// Ejecutar las consultas individualmente
if ($mysqli->query($sql) === TRUE && $mysqli->query($sql1) === TRUE && $mysqli->query($sql2) === TRUE 
    && $mysqli->query($sql3) === TRUE && $mysqli->query($sql4) === TRUE && $mysqli->query($sql5) === TRUE 
    && $mysqli->query($sql6) === TRUE && $mysqli->query($sql7) === TRUE && $mysqli->query($sql8) === TRUE) {

        $sql9 = "SELECT * FROM consultas WHERE ID_Registro = '$id_registro'";

        $result = mysqli_query($mysqli, $sql9);

            while ($mostrar = mysqli_fetch_array($result)) {
                $Directo = $mostrar['Directo'];

                if ($Directo === 'Si'){
                    $Estatus = 'URGENTE';
                }elseif($Directo === 'No'){
                    $Estatus = 'Pendiente';
                }

                $sql10 = "UPDATE consultas SET Estatus = '$Estatus' WHERE ID_Registro = '$id_registro'";

                $result2 = mysqli_query($mysqli, $sql10);

                if ($mysqli->query($sql10) === TRUE){
                    header("Location: ../../../dashboard_medico.php");
                    exit();
                }else {
                    // Mostrar mensaje de error
                    echo "Error: " . $mysqli->error;
                }

            }

    
} else {
    // Mostrar mensaje de error
    echo "Error: " . $mysqli->error;
}

// Cerrar la conexión
$mysqli->close();

?>