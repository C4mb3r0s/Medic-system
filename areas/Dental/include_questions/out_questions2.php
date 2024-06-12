<?php
require "../../../include/conexion.php";

session_start();
$id_registro = $_GET['id_registro'];


$sql = "DELETE FROM tratamientosdental WHERE ID_Registro = '$id_registro'";

// Ejecutar las consultas individualmente
if ($mysqli->query($sql) === TRUE) {

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