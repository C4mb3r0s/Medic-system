<?php
require "conexion.php";

session_start();
$id_registro = $_GET['id_registro'];


$sql = "DELETE FROM valoracionopto WHERE ID_Registro = '$id_registro'";


// Ejecutar las consultas individualmente
if ($mysqli->query($sql) === TRUE) {

        $sql2 = "SELECT * FROM consultas WHERE ID_Registro = '$id_registro'";

        $result = mysqli_query($mysqli, $sql2);

            while ($mostrar = mysqli_fetch_array($result)) {
                $Directo = $mostrar['Directo'];

                if ($Directo === 'Si'){
                    $Estatus = 'URGENTE';
                }elseif($Directo === 'No'){
                    $Estatus = 'Pendiente';
                }

                $sql3 = "UPDATE consultas SET Estatus = '$Estatus' WHERE ID_Registro = '$id_registro'";

                $result2 = mysqli_query($mysqli, $sql3);

                if ($mysqli->query($sql3) === TRUE){
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