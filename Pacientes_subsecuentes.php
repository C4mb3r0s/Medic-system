<?php
session_start();
if (!isset($_SESSION['ID'])) {
    header("location: Index.php");
}
$nombre = $_SESSION['Nombre'];
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
    <!--Boostrap icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!--Boostrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <!--Style css-->
    <link rel="stylesheet" href="css/Paciente_sub.css">
    <!--DataTable-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <title>Dashboard recepción (Recepsionista)</title>
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <a class="title" href="dashboard_recep.php"><i class="fa-solid fa-receipt"></i> Recepción</a>

            <div class="dropdown ms-auto">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-person-fill"></i> Recepcionista: <?php echo "$nombre";
                                                                        $_SESSION['Nombre'] = $nombre; ?>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="include/logout.php">Cerrar Sesión</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container my-3">
        <div class="row">
            <div class="tabla col-sm-12 col-mg-12 col-lg-12 col-xl-12 bg-white" style="width: 950px;">
                <h2>Consultas del día</h2>
                <form class="return" method="post" action="dashboard_recep.php">
                    <button class="btn solid" method="post" type="btn">
                        <a>Regresar</a>
                        <i class="fa-solid fa-rotate-left"></i>
                    </button>
                </form>
                <?php
                require "include/conexion.php";

                $sql = "SELECT * FROM pacientes";
                $result = mysqli_query($mysqli, $sql);
                ?>
                <table class="table table-striped table-dark" id="dataTable_pacientes">
                    <thead>
                        <tr>
                            <th class="text-center align-middle">#</th>
                            <th class="text-center align-middle">Nombre del paciente</th>
                            <th class="text-center align-middle">Estatus</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($mostrar = mysqli_fetch_array($result)) {
                        ?>
                            <tr>
                                <td class="text-center align-middle" style="font-size: .75rem;"><?php echo $mostrar['ID_Paciente']; ?></td>
                                <td class="text-center align-middle" style="font-size: .75rem;"><?php echo $mostrar['NombreCom']; ?></td>
                                <td class="text-center align-middle">
                                    <button class="btn solid icon-button" onclick="abrirCONFIRMACION(<?php echo $mostrar['ID_Paciente']; ?>)" style="background-color: blue; border-radius: 49px; color:white; font-weight: 700; width: 120px;">
                                        Ingresar
                                        <span class="button-text">
                                            <i class="bi bi-door-open-fill" style="margin-left: 5px;"></i>
                                        </span>
                                    </button>
                                    <script>
                                        function abrirCONFIRMACION(id) {
                                            var ventanaAncho = 800;
                                            var ventanaAlto = 600;
                                            var ventanaIzquierda = (screen.width - ventanaAncho) / 2;
                                            var ventanaArriba = (screen.height - ventanaAlto) / 2;
                                            window.open("Confirmacion_consulta.php?id=" + id, "_blank", "width=" + ventanaAncho + ", height=" + ventanaAlto + ", left=" + ventanaIzquierda + ", top=" + ventanaArriba);
                                        }
                                    </script>
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
</body>
</html>