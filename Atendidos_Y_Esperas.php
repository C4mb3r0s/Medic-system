<?php
session_start();
if (!isset($_SESSION['ID'])) {
    header("location: index.php");
}
$nombre = $_SESSION['Nombre'];
$Especialidad = $_SESSION['Especialidad'];

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--Font awesome icons-->
    <link href="assets/fontawesome/css/fontawesome.css" rel="stylesheet">
    <link href="assets/fontawesome/css/brands.css" rel="stylesheet">
    <link href="assets/fontawesome/css/solid.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/Atendidos.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <!--DataTable-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

    <title>Esperas</title>
</head>

<body>
    <!--Barra de navegación-->
    <nav class="navbar">
        <div class="container">
            <a class="title" href="dashboard_medico.php"><i class="bi bi-heart-pulse-fill"></i> Atención médica</a>
            <div class="dropdown ms-auto">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-person-fill"></i> Médico: <?php echo "$nombre";
                                                                $_SESSION['Nombre'] = $nombre; ?>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="include/logout.php">Cerrar Sesión</a></li>


                </ul>
            </div>
        </div>
    </nav>
    <div class="container my-3">
        <div class="row uno">
            <div class="tabla col-sm-6 col-md-6 col-lg-6 col-xl-6 bg-white">
                <h2 class="title">Pacientes sin atender</h2>
                <table class="table table-striped table-dark " id="dataTable_pacientes" style="width: 100%;">
                    <thead>
                        <tr>

                            <td class="text-center align-middle">Paciente</td>
                            <td class="text-center align-middle">Estatus</td>
                            <td class="text-center align-middle"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require "include/conexion.php";
                        date_default_timezone_set('America/Mexico_City');
                        $hoy = date("Y-m-d");
                        $sql = "SELECT * FROM consultas WHERE TipoServ='$Especialidad' AND Estatus='Pendiente' AND DATE(HoraFech) != '$hoy'";
                        $result = mysqli_query($mysqli, $sql);

                        while ($mostrar = mysqli_fetch_array($result)) {
                        ?>
                            <tr>
                                <td class="text-center align-middle"><?php echo $mostrar['NombreCom']; ?></td>
                                <td class="text-center align-middle">
                                    <?php

                                    $valor_base_datos = $mostrar['Estatus']; // Obtener el valor de la base de datos

                                    if ($valor_base_datos == 'Pendiente') {
                                        echo '<span style="background-color: blue; border-radius:45px; padding:6px;">' . $valor_base_datos . '</span>';
                                    } elseif ($valor_base_datos == 'URGENTE') {
                                        echo '<span style="background-color: yellow; color: black; border-radius:45px; padding:6px;">' . $valor_base_datos . '</span>';
                                    }
                                    ?>
                                </td>
                                <td class="text-center align-middle">
                                    <form class="form" method="post" action="include/Asignar_a_consulta.php">
                                        <input type="hidden" name="id_registro" value="<?php echo $mostrar['ID_Registro']; ?>">
                                        <input type="submit" class="btn solid" name="submit" value="Asignar" style="background-color: violet; border-radius: 49px; color: white; font-weight: 700; width: 100px;">
                                    </form>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="tabla col-sm-6 col-md-6 col-lg-6 col-xl-6 bg-white">
                <form class="return d-flex justify-content-end" method="post" action="dashboard_medico.php">
                    <button class="btn solid" method="post" type="btn">
                        <a>Regresar</a>
                        <i class="fa-solid fa-rotate-left"></i>
                    </button>
                </form>
                <h2 class="tittle">Pacientes atendidos</h2>
                <table class="table table-striped table-dark" id="dataTable_pacientes2" style="width: 100%;">
                    <thead>
                        <tr>
                            <th class="text-center align-middle">Nombre del paciente</th>
                            <th class="text-center align-middle">Resultados</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require "include/conexion.php";
                        date_default_timezone_set('America/Mexico_City');
                        $hoy = date("Y-m-d");
                        $sql = "SELECT * FROM consultas WHERE TipoServ='$Especialidad' AND Estatus='Atendido' AND DATE(HoraFech) != '$hoy'";
                        $result = mysqli_query($mysqli, $sql);

                        while ($mostrar = mysqli_fetch_array($result)) {
                        ?>
                            <tr>
                                <td class="text-center align-middle"><?php echo $mostrar['NombreCom']; ?></td>
                                <td class="text-center align-middle">
                                    <div class="row">
                                        <form class="form col-sm-6 col-mg-6 col-lg-6 col-xl-6" method="post" action="include/ir_consulta_edit.php">
                                            <input type="hidden" name="id_registro" value="<?php echo $mostrar['ID_Registro']; ?>">
                                            <input type="hidden" name="nombre_paciente" value="<?php echo $mostrar['NombreCom']; ?>">
                                            <input type="hidden" name="esp" value="<?php echo $mostrar['TipoServ']; ?>">
                                            <input type="submit" class="btn solid" name="submit" value="Editar" style="background-color: orange; border-radius: 49px; color: white; font-weight: 700; width: 75px;">
                                        </form>
                                        <button class="btn solid icon-button" onclick="abrirPDF(<?php echo $mostrar['ID_Registro']; ?>)" style="background-color: blue; border-radius: 49px; color:white; font-weight: 700; width: 100px;">
                                            <span class="button-text"></span>
                                            <i class="bi bi-printer-fill button-icon"></i>

                                            <?php
                                            if ($Especialidad === 'Optometrista') {
                                            ?>
                                                <script>
                                                    function abrirPDF(id) {
                                                        var ventanaAncho = 800;
                                                        var ventanaAlto = 600;
                                                        var ventanaIzquierda = (screen.width - ventanaAncho) / 2;
                                                        var ventanaArriba = (screen.height - ventanaAlto) / 2;
                                                        window.open("areas/Optometrista/include_questions/Reporte.php?id=" + id, "_blank", "width=" + ventanaAncho + ", height=" + ventanaAlto + ", left=" + ventanaIzquierda + ", top=" + ventanaArriba);
                                                    }
                                                </script>
                                            <?php
                                            } elseif ($Especialidad === 'Dental') {
                                            ?>
                                                <script>
                                                    function abrirPDF(id) {
                                                        var ventanaAncho = 800;
                                                        var ventanaAlto = 600;
                                                        var ventanaIzquierda = (screen.width - ventanaAncho) / 2;
                                                        var ventanaArriba = (screen.height - ventanaAlto) / 2;
                                                        window.open("areas/Dental/include_questions/Reporte.php?id=" + id, "_blank", "width=" + ventanaAncho + ", height=" + ventanaAlto + ", left=" + ventanaIzquierda + ", top=" + ventanaArriba);
                                                    }
                                                </script>
                                            <?php
                                            } elseif ($Especialidad === 'Pediatria') {
                                            ?>
                                                <script>
                                                    function abrirPDF(id) {
                                                        var ventanaAncho = 800;
                                                        var ventanaAlto = 600;
                                                        var ventanaIzquierda = (screen.width - ventanaAncho) / 2;
                                                        var ventanaArriba = (screen.height - ventanaAlto) / 2;
                                                        window.open("areas/Pediatria/include_questions/Reporte.php?id=" + id, "_blank", "width=" + ventanaAncho + ", height=" + ventanaAlto + ", left=" + ventanaIzquierda + ", top=" + ventanaArriba);
                                                    }
                                                </script>
                                            <?php
                                            } elseif ($Especialidad === 'Medico General') {
                                            ?>
                                                <script>
                                                    function abrirPDF(id) {
                                                        var ventanaAncho = 800;
                                                        var ventanaAlto = 600;
                                                        var ventanaIzquierda = (screen.width - ventanaAncho) / 2;
                                                        var ventanaArriba = (screen.height - ventanaAlto) / 2;
                                                        window.open("areas/MedicoGeneral/include_questions/Reporte.php?id=" + id, "_blank", "width=" + ventanaAncho + ", height=" + ventanaAlto + ", left=" + ventanaIzquierda + ", top=" + ventanaArriba);
                                                    }
                                                </script>
                                            <?php
                                            } elseif ($Especialidad === 'Homeopatia') {
                                            ?>
                                                <script>
                                                    function abrirPDF(id) {
                                                        var ventanaAncho = 800;
                                                        var ventanaAlto = 600;
                                                        var ventanaIzquierda = (screen.width - ventanaAncho) / 2;
                                                        var ventanaArriba = (screen.height - ventanaAlto) / 2;
                                                        window.open("areas/Homeopatia/include_questions/Reporte.php?id=" + id, "_blank", "width=" + ventanaAncho + ", height=" + ventanaAlto + ", left=" + ventanaIzquierda + ", top=" + ventanaArriba);
                                                    }
                                                </script>
                                            <?php
                                            } elseif ($Especialidad === 'Nutricion') {
                                            ?>
                                                <script>
                                                    function abrirPDF(id) {
                                                        var ventanaAncho = 800;
                                                        var ventanaAlto = 600;
                                                        var ventanaIzquierda = (screen.width - ventanaAncho) / 2;
                                                        var ventanaArriba = (screen.height - ventanaAlto) / 2;
                                                        window.open("areas/Nutricion/include_questions/Reporte.php?id=" + id, "_blank", "width=" + ventanaAncho + ", height=" + ventanaAlto + ", left=" + ventanaIzquierda + ", top=" + ventanaArriba);
                                                    }
                                                </script>
                                            <?php
                                            }
                                            ?>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <!--Boostrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <!--JQuery-->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <!--DataTable-->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <script src="main.js"></script>
    <script src="main2.js"></script>
</body>

</html>