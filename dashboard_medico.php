<?php
session_start();
if (!isset($_SESSION['ID'])) {
   header("location: index.php");
}
$nombre = $_SESSION['Nombre'];
$Especialidad = $_SESSION['Especialidad'];
$close1 = '';
$_SESSION['close1'] = $close1;
$close2 = '';
$_SESSION['close2'] = $close2;
$close3 = '';
$_SESSION['close3'] = $close3;
$close4 = '';
$_SESSION['close4'] = $close4;
$close5 = '';
$_SESSION['close5'] = $close5;
$close6 = '';
$_SESSION['close6'] = $close6;
$close7 = '';
$_SESSION['close7'] = $close7;
$close8 = '';
$_SESSION['close8'] = $close8;
$close9 = '';
$_SESSION['close9'] = $close8;
?>
<!DOCTYPE html>
<html lang="es">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
   <link rel="stylesheet" href="css/medico.css">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
   <!--DataTable-->
   <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

   <title>Dashboard Medico</title>
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
               <li><a class="dropdown-item" href="Atendidos_Y_Esperas.php">Pendientes y atendidos</a></li>
            </ul>
         </div>
      </div>
   </nav>
   <div class="container my-3">
      <div class="row">
         <div class="tabla col-sm-12 col-mg-12 col-lg-12 col-xl-12 bg-white">
            <h2>Pacientes en espera</h2>
            <div class="row">
               <form class="return" method="post" action="Nuevo_pacient_med.php">
                  <button class="btn solid" method="post" type="btn">
                     <i class="bi bi-person-plus-fill"></i>
                     <a>Nuevo Paciente</a>
                  </button>
               </form>
               <form class="return dos" method="post" action="Pacientes_subsecuentes_med.php">
                  <button class="btn solid" method="post" type="btn">
                     <i class="bi bi-person-plus-fill"></i>
                     <a>Paciente subsecuente</a>
                  </button>
               </form>
            </div>
            <table class="table table-striped table-dark" id="dataTable_pacientes" style="width: 100%;">
               <thead>
                  <tr>
                     <th class="text-center align-middle">N° de consulta</th>
                     <th class="text-center align-middle">Nombre del paciente</th>
                     <th class="text-center align-middle">Visita</th>
                     <th class="text-center align-middle">Estatus</th>
                     <th class="text-center align-middle"></th>
                  </tr>
               </thead>
               <tbody>
                  <?php
                  require "include/conexion.php";
                  date_default_timezone_set('America/Mazatlan');
                  $hoy = date("Y-m-d");
                  $sql = "SELECT * FROM consultas WHERE TipoServ='$Especialidad' AND DATE(HoraFech) = '$hoy'";
                  $result = mysqli_query($mysqli, $sql);
                  while ($mostrar = mysqli_fetch_array($result)) {
                  ?>
                     <tr>
                        <td class="text-center align-middle"><?php echo $mostrar['ID_Registro']; ?></td>
                        <td class="text-center align-middle"><?php echo $mostrar['NombreCom']; ?></td>
                        <td class="text-center align-middle"><?php echo $mostrar['Citade']; ?></td>
                        <td class="text-center align-middle">
                           <?php
                           $mostrar['Estatus'];

                           $valor_base_datos = $mostrar['Estatus']; // Obtener el valor de la base de datos

                           if ($valor_base_datos == 'Pendiente') {
                              echo '<span style="background-color: blue; border-radius:45px; padding:6px;">' . $valor_base_datos . '</span>';
                           } elseif ($valor_base_datos == 'En Consulta') {
                              echo '<span style="background-color: green; border-radius:45px; padding: 6px;">' . $valor_base_datos . '</span>';
                           } elseif ($valor_base_datos == 'Atendido') {
                              echo '<span style="background-color: red; border-radius:45px; padding:6px;">' . $valor_base_datos . '</span>';
                           } elseif ($valor_base_datos == 'URGENTE') {
                              echo '<span style="background-color: yellow; color: black; border-radius:45px; padding:6px;">' . $valor_base_datos . '</span>';
                           }
                           ?>
                        </td>
                        <td class="text-center align-middle">
                           <?php
                           if ($valor_base_datos === 'Atendido') {
                           ?>
                              <div class="row">
                                 <form class="form col-sm-6 col-mg-6 col-lg-6 col-xl-6" method="post" action="include/ir_consulta_edit.php">
                                    <input type="hidden" name="id_registro" value="<?php echo $mostrar['ID_Registro']; ?>">
                                    <input type="hidden" name="nombre_paciente" value="<?php echo $mostrar['NombreCom']; ?>">
                                    <input type="hidden" name="esp" value="<?php echo $mostrar['TipoServ']; ?>">
                                    <input type="submit" class="btn solid" name="submit" value="Editar" style="background-color: orange; border-radius: 49px; color: white; font-weight: 700; width: 100px;">
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
                           <?php
                           } elseif ($valor_base_datos === 'En Consulta') {
                           ?>
                              <form action="include/ir_consulta.php" method="post">
                                 <input type="hidden" name="id_registro" value="<?php echo $mostrar['ID_Registro']; ?>">
                                 <input type="hidden" name="nombre_paciente" value="<?php echo $mostrar['NombreCom']; ?>">
                                 <input type="submit" class="btn solid" name="submit" value="Iniciar" style="background-color: greenyellow; color: white; font-weight: 700; border-radius: 49px; ">
                              </form>
                           <?php
                           } elseif ($valor_base_datos === 'Pendiente') {
                           ?>
                              <form action="include/ir_consulta.php" method="post">
                                 <input type="hidden" name="id_registro" value="<?php echo $mostrar['ID_Registro']; ?>">
                                 <input type="hidden" name="nombre_paciente" value="<?php echo $mostrar['NombreCom']; ?>">
                                 <input type="submit" class="btn solid" name="submit" value="Iniciar" style="background-color: greenyellow;  color: white; font-weight: 700; border-radius: 49px;">
                              </form>
                           <?php
                           } elseif ($valor_base_datos === 'URGENTE') {
                           ?>
                              <form action="include/ir_consulta.php" method="post">
                                 <input type="hidden" name="id_registro" value="<?php echo $mostrar['ID_Registro']; ?>">
                                 <input type="hidden" name="nombre_paciente" value="<?php echo $mostrar['NombreCom']; ?>">
                                 <input type="submit" class="btn solid" name="submit" value="Iniciar" style="background-color: greenyellow; color: white; font-weight: 700; border-radius: 49px;">
                              </form>
                           <?php
                           }
                           ?>
                        </td>
                     </tr>
                  <?php
                  }
                  $_SESSION['Especialidad'] = $Especialidad;
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